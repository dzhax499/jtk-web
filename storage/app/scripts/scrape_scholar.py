"""
Scrape Google Scholar — Author-first approach.
Cari profil dosen → buka publikasi → cocokin dengan portofolio.csv.
"""

import os
import re
import sys
import time
import json
import random
import argparse
import pandas as pd

import httpx
_original_client_init = httpx.Client.__init__
def _patched_client_init(self, *args, **kwargs):
    if 'proxies' in kwargs:
        proxy_val = kwargs.pop('proxies')
        if proxy_val and 'proxy' not in kwargs:
            if isinstance(proxy_val, dict):
                proxy_val = next(iter(proxy_val.values()), None)
            kwargs['proxy'] = proxy_val
    return _original_client_init(self, *args, **kwargs)
httpx.Client.__init__ = _patched_client_init

from scholarly import scholarly

if hasattr(sys.stdout, 'reconfigure'):
    sys.stdout.reconfigure(line_buffering=True, encoding='utf-8', errors='replace')

BASE_DIR = os.path.join(
    os.path.dirname(os.path.abspath(__file__)), "Data_Dosen_Polban_TI"
)
DELAY_MIN = 20
DELAY_MAX = 30
DELAY_DOSEN = 60
MAX_RETRY = 2
RETRY_WAIT = 300
POLBAN_KEYWORDS = ['politeknik negeri bandung', 'polban', 'bandung']


def smart_delay(min_s=None, max_s=None):
    mn = min_s or DELAY_MIN
    mx = max_s or DELAY_MAX
    time.sleep(random.uniform(mn, mx))


def normalize_title(title):
    t = (title or '').lower().strip()
    t = re.sub(r'[^\w\s]', '', t)
    t = re.sub(r'\s+', ' ', t)
    return t


def is_match(a, b, threshold=0.5):
    a = normalize_title(a)
    b = normalize_title(b)
    sa = set(a.split())
    sb = set(b.split())
    if not sa or not sb:
        return False
    return len(sa & sb) / len(sa | sb) >= threshold


def search_author(name):
    for attempt in range(1, MAX_RETRY + 1):
        try:
            smart_delay()
            results = scholarly.search_author(name)
            author = next(results, None)
            if author:
                return author
            return None
        except Exception as e:
            err = str(e).lower()
            if 'fetch' in err or '429' in err or 'captcha' in err or 'blocked' in err:
                if attempt < MAX_RETRY:
                    print(f"   [BLOCK] search_author, tunggu {RETRY_WAIT}s...")
                    time.sleep(RETRY_WAIT)
                else:
                    print(f"   [FAIL] search_author: {e}")
                    return None
            else:
                print(f"   [WARN] search_author: {e}")
                return None
    return None


def fill_author(author):
    for attempt in range(1, MAX_RETRY + 1):
        try:
            smart_delay()
            return scholarly.fill(author, sections=['publications', 'citedby', 'indices'])
        except Exception as e:
            err = str(e).lower()
            if 'fetch' in err or '429' in err or 'captcha' in err or 'blocked' in err:
                if attempt < MAX_RETRY:
                    print(f"   [BLOCK] fill_author, tunggu {RETRY_WAIT}s...")
                    time.sleep(RETRY_WAIT)
                else:
                    print(f"   [FAIL] fill_author: {e}")
                    return None
            else:
                print(f"   [WARN] fill_author: {e}")
                return None
    return None


def extract_pub(pub):
    bib = pub.get('bib', {})
    return {
        'judul_scholar': bib.get('title', ''),
        'tahun_scholar': str(bib.get('pub_year', '')),
        'venue': bib.get('venue', ''),
        'authors': '; '.join(bib.get('author', [])),
        'abstract': (bib.get('abstract', '') or '')[:200],
        'jumlah_sitasi': pub.get('num_citations', 0),
        'pub_url': pub.get('pub_url', ''),
        'eprint_url': pub.get('eprint_url', ''),
        'publisher': bib.get('publisher', ''),
    }


def main():
    parser = argparse.ArgumentParser()
    parser.add_argument('--start-folder', help='Mulai dari folder ini')
    args = parser.parse_args()

    print('=' * 70)
    print('  SCRAPING GOOGLE SCHOLAR — Author-first approach')
    print('  Cari profil dosen -> buka publikasi -> cocokin dgn portofolio')
    print('=' * 70)
    print()

    if not os.path.isdir(BASE_DIR):
        print(f'[ERROR] Folder tidak ditemukan: {BASE_DIR}')
        return

    dosen_folders = sorted([
        d for d in os.listdir(BASE_DIR)
        if os.path.isdir(os.path.join(BASE_DIR, d))
    ])

    if args.start_folder:
        if args.start_folder in dosen_folders:
            idx = dosen_folders.index(args.start_folder)
            dosen_folders = dosen_folders[idx:]
            print(f'[RESUME] Mulai dari folder: {args.start_folder}\n')
        else:
            print(f'[WARN] Folder {args.start_folder} tidak ditemukan, lanjut dari awal.\n')

    total_dosen = len(dosen_folders)
    print(f'[INFO] {total_dosen} folder dosen.\n')

    summary = []

    for idx, folder in enumerate(dosen_folders, 1):
        dosen_dir = os.path.join(BASE_DIR, folder)
        porto_path = os.path.join(dosen_dir, 'portofolio.csv')
        out_path = os.path.join(dosen_dir, 'scholar.csv')

        if os.path.isfile(out_path):
            print(f'[{idx}/{total_dosen}] [SKIP] {folder}')
            continue

        parts = folder.rsplit('_', 1)
        dosen_name = parts[0].replace('_', ' ') if parts else folder
        # Baca portofolio
        df_porto = pd.DataFrame()
        if os.path.isfile(porto_path):
            try:
                df_porto = pd.read_csv(porto_path, encoding='utf-8-sig')
            except Exception as e:
                print(f'   [WARN] Gagal baca portofolio: {e}')

        porto_titles = []
        if not df_porto.empty and 'judul_kegiatan' in df_porto.columns:
            for _, row in df_porto.iterrows():
                judul = str(row.get('judul_kegiatan', '')).strip()
                if judul and judul != 'nan':
                    porto_titles.append({
                        'judul_pddikti': judul,
                        'kategori_pddikti': str(row.get('Kategori_Portofolio', '')).strip()
                    })

        print(f'[{idx}/{total_dosen}] {dosen_name} ({len(porto_titles)} judul portofolio)')

        # ── Step 1: Cari profil ──────────────────────────────────
        print(f'   [1] Cari profil: {dosen_name}...')
        author = search_author(dosen_name)

        if not author:
            print(f'   [SKIP] Profil tidak ditemukan.')
            results = []
            for pt in porto_titles:
                results.append({
                    'nama_dosen': dosen_name,
                    'judul_pddikti': pt['judul_pddikti'],
                    'kategori_pddikti': pt['kategori_pddikti'],
                    'judul_scholar': '',
                    'sumber': 'PDDIKTI Only',
                    'status': 'author_not_found',
                })
            if results:
                pd.DataFrame(results).to_csv(out_path, index=False, encoding='utf-8-sig')
            print(f'   [DONE] {dosen_name} (0 matched)\n')
            continue

        affil = (author.get('affiliation', '') or '').lower()
        if not any(k in affil for k in POLBAN_KEYWORDS):
            print(f'   [SKIP] Afiliasi "{affil}" bukan Polban.')
            results = []
            for pt in porto_titles:
                results.append({
                    'nama_dosen': dosen_name,
                    'judul_pddikti': pt['judul_pddikti'],
                    'kategori_pddikti': pt['kategori_pddikti'],
                    'judul_scholar': '',
                    'sumber': 'PDDIKTI Only',
                    'status': 'affiliation_not_polban',
                })
            if results:
                pd.DataFrame(results).to_csv(out_path, index=False, encoding='utf-8-sig')
            print(f'   [DONE] {dosen_name} (0 matched)\n')
            continue

        # ── Step 2: Fill profil ──────────────────────────────────
        print(f'   [2] Buka publikasi...')
        author_filled = fill_author(author)
        if not author_filled:
            print(f'   [SKIP] Gagal buka profil.')
            results = []
            for pt in porto_titles:
                results.append({
                    'nama_dosen': dosen_name,
                    'judul_pddikti': pt['judul_pddikti'],
                    'kategori_pddikti': pt['kategori_pddikti'],
                    'judul_scholar': '',
                    'sumber': 'PDDIKTI Only',
                    'status': 'failed_fill_author',
                })
            if results:
                pd.DataFrame(results).to_csv(out_path, index=False, encoding='utf-8-sig')
            print(f'   [DONE] {dosen_name} (0 matched)\n')
            continue

        pubs = author_filled.get('publications', [])
        print(f'   [INFO] Ditemukan {len(pubs)} publikasi di profil.')

        # ── Step 3: Match ────────────────────────────────────────
        matched_porto = set()
        results = []

        for pt_idx, pt in enumerate(porto_titles, 1):
            judul_pddikti = pt['judul_pddikti']
            print(f'   [{pt_idx}/{len(porto_titles)}] Cocokin: {judul_pddikti[:60]}...')

            found_pub = None
            for pub in pubs:
                pub_title = pub.get('bib', {}).get('title', '')
                if is_match(judul_pddikti, pub_title):
                    found_pub = pub
                    matched_porto.add(pt_idx - 1)
                    break

            if found_pub:
                meta = extract_pub(found_pub)
                meta['sumber'] = 'PDDIKTI + Scholar'
                meta['status'] = 'found'
                print(f'         [FOUND] Sitasi: {meta.get("jumlah_sitasi", 0)}')
            else:
                meta = {
                    'judul_scholar': '',
                    'sumber': 'PDDIKTI Only',
                    'status': 'not_found',
                }
                print(f'         [NOT FOUND]')

            meta['nama_dosen'] = dosen_name
            meta['judul_pddikti'] = judul_pddikti
            meta['kategori_pddikti'] = pt['kategori_pddikti']
            for k in ['tahun_scholar', 'venue', 'authors', 'abstract', 'jumlah_sitasi', 'pub_url', 'eprint_url', 'publisher']:
                meta.setdefault(k, '')
            results.append(meta)

        # ── Tambah publikasi Scholar yg ga match portofolio ───────
        for pub_idx, pub in enumerate(pubs, 1):
            pub_title = pub.get('bib', {}).get('title', '')
            if not pub_title:
                continue
            # Cek apakah ini match dengan portofolio mana pun
            already_matched = False
            for pt in porto_titles:
                if is_match(pt['judul_pddikti'], pub_title):
                    already_matched = True
                    break
            if not already_matched:
                meta = extract_pub(pub)
                meta['sumber'] = 'Scholar Only'
                meta['status'] = 'found'
                meta['nama_dosen'] = dosen_name
                meta['judul_pddikti'] = ''
                meta['kategori_pddikti'] = ''
                results.append(meta)

        # ── Simpan ───────────────────────────────────────────────
        if results:
            df = pd.DataFrame(results)
            cols = [
                'nama_dosen', 'judul_pddikti', 'judul_scholar', 'kategori_pddikti',
                'sumber', 'status', 'tahun_scholar', 'jumlah_sitasi', 'venue',
                'authors', 'pub_url', 'eprint_url', 'publisher', 'abstract'
            ]
            exist = [c for c in cols if c in df.columns]
            rest = [c for c in df.columns if c not in cols]
            df = df[exist + rest]
            df.to_csv(out_path, index=False, encoding='utf-8-sig')

        summary.append({
            'folder': folder,
            'dosen': dosen_name,
            'total_porto': len(porto_titles),
            'matched': len(matched_porto),
            'total_pubs': len(pubs),
        })
        print(f'   [DONE] Match: {len(matched_porto)}/{len(porto_titles)}\n')

        if idx < total_dosen:
            print(f'   [WAIT] Jeda {DELAY_DOSEN}s...\n')
            time.sleep(DELAY_DOSEN)

    print('=' * 70)
    print('  RINGKASAN')
    print('=' * 70)
    for s in summary:
        print(f'  {s["dosen"]:35s} {s["matched"]:2d}/{s["total_porto"]:2d} matched | {s["total_pubs"]} pubs')
    print('=' * 70)


if __name__ == '__main__':
    main()
