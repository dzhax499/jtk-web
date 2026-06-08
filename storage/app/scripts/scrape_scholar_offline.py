import os
import re
import pandas as pd
from bs4 import BeautifulSoup

# Configuration
BASE_DIR = r"c:\Users\gemaa\OneDrive - Politeknik Negeri Bandung\Polban\SEMESTER 4\Pengembangan Perangkat Lunak\Tubes\Cluster 3\scrapping-pddikti\Data_Dosen_Polban_TI"
HTML_DIR = r"c:\Users\gemaa\OneDrive - Politeknik Negeri Bandung\Polban\SEMESTER 4\Pengembangan Perangkat Lunak\Tubes\Cluster 3\scrapping-pddikti\html_profil_dosen"
SUMMARY_PATH = os.path.join(BASE_DIR, "scholar_summary.csv")

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

def get_best_html(folder_name, html_files):
    folder_clean = re.sub(r'_[0-9]+$', '', folder_name).lower()
    folder_tokens = set(re.findall(r'[a-z]+', folder_clean))
    
    best_match = None
    best_score = 0
    
    for h in html_files:
        h_clean = h.replace(' - Google Scholar.html', '').replace('_', '').lower()
        h_tokens = set(re.findall(r'[a-z]+', h_clean))
        
        intersection = folder_tokens & h_tokens
        if intersection:
            score = len(intersection) / max(len(folder_tokens), len(h_tokens))
            if score > best_score:
                best_score = score
                best_match = h
                
    if not best_match:
        for h in html_files:
            h_clean = h.replace(' - Google Scholar.html', '').replace('_', '').lower()
            h_tokens = re.findall(r'[a-z]+', h_clean)
            folder_tokens_list = re.findall(r'[a-z]+', folder_clean)
            
            if h_tokens and folder_tokens_list and h_tokens[-1] == folder_tokens_list[-1]:
                if h_tokens[0][0] == folder_tokens_list[0][0]:
                    best_match = h
                    break
    return best_match

def parse_scholar_html(file_path):
    pubs = []
    try:
        with open(file_path, 'r', encoding='utf-8') as f:
            soup = BeautifulSoup(f.read(), 'html.parser')
            
        table = soup.find('tbody', id='gsc_a_b')
        if not table:
            return pubs
            
        rows = table.find_all('tr', class_='gsc_a_tr')
        for row in rows:
            title_a = row.find('a', class_='gsc_a_at')
            if not title_a:
                continue
            title = title_a.get_text().strip()
            
            divs = row.find('td', class_='gsc_a_t').find_all('div')
            authors = divs[0].get_text().strip() if len(divs) > 0 else ''
            venue = divs[1].get_text().strip() if len(divs) > 1 else ''
            
            cit_a = row.find('td', class_='gsc_a_c').find('a')
            citations_str = cit_a.get_text().strip() if cit_a else '0'
            try:
                citations = int(citations_str) if citations_str else 0
            except ValueError:
                citations = 0
                
            year_span = row.find('td', class_='gsc_a_y').find('span')
            year = year_span.get_text().strip() if year_span else ''
            
            pub_url = title_a.get('href', '')
            if pub_url and not pub_url.startswith('http'):
                pub_url = 'https://scholar.google.com' + pub_url
                
            pubs.append({
                'judul_scholar': title,
                'authors': authors,
                'venue': venue,
                'jumlah_sitasi': citations,
                'tahun_scholar': year,
                'pub_url': pub_url,
                'eprint_url': '',
                'publisher': '',
                'abstract': ''
            })
    except Exception as e:
        print(f"      [ERROR] Gagal parsing {os.path.basename(file_path)}: {e}")
    return pubs

def main():
    print("=" * 80)
    print("  SCRAPING GOOGLE SCHOLAR — OFFLINE BATCH PROCESSOR")
    print("  Memproses 45 folder dosen menggunakan HTML offline")
    print("=" * 80)
    print()

    dosen_folders = sorted([d for d in os.listdir(BASE_DIR) if os.path.isdir(os.path.join(BASE_DIR, d))])
    html_files = sorted([f for f in os.listdir(HTML_DIR) if f.endswith('.html')])

    print(f"[INFO] Terdeteksi {len(dosen_folders)} folder dosen.")
    print(f"[INFO] Terdeteksi {len(html_files)} file HTML profil.")
    print()

    global_records = []
    
    coauthor_mentions = {
        'suprihanto': [],
        'ardhian': [],
        'maisevli': []
    }

    total_processed = 0
    total_matched_global = 0

    for idx, folder in enumerate(dosen_folders, 1):
        dosen_dir = os.path.join(BASE_DIR, folder)
        porto_path = os.path.join(dosen_dir, "portofolio.csv")
        out_path = os.path.join(dosen_dir, "scholar.csv")

        parts = folder.rsplit('_', 1)
        dosen_name = parts[0].replace('_', ' ') if parts else folder

        html_file = get_best_html(folder, html_files)

        if not html_file:
            print(f"[{idx}/{len(dosen_folders)}] [SKIP] {dosen_name} - HTML profil tidak tersedia.")
            if os.path.isfile(porto_path):
                try:
                    df_porto = pd.read_csv(porto_path, encoding='utf-8-sig')
                    porto_titles = df_porto['judul_kegiatan'].dropna().tolist()
                    results = []
                    for t in porto_titles:
                        results.append({
                            'nama_dosen': dosen_name,
                            'judul_pddikti': t,
                            'judul_scholar': '',
                            'kategori_pddikti': '',
                            'sumber': 'PDDIKTI Only',
                            'status': 'not_found',
                            'tahun_scholar': '',
                            'jumlah_sitasi': 0,
                            'venue': '',
                            'authors': '',
                            'pub_url': '',
                            'eprint_url': '',
                            'publisher': '',
                            'abstract': ''
                        })
                    if results:
                        pd.DataFrame(results).to_csv(out_path, index=False, encoding='utf-8-sig')
                        global_records.extend(results)
                except Exception as e:
                    pass
            continue

        print(f"[{idx}/{len(dosen_folders)}] Memproses: {dosen_name} -> HTML: {html_file}")
        html_path = os.path.join(HTML_DIR, html_file)
        
        scholar_pubs = parse_scholar_html(html_path)
        
        # Track co-authors
        for sp in scholar_pubs:
            authors_lower = sp['authors'].lower()
            for key in coauthor_mentions.keys():
                if key in authors_lower:
                    coauthor_mentions[key].append({
                        'dosen_asal': dosen_name,
                        'judul': sp['judul_scholar'],
                        'authors': sp['authors'],
                        'pub_url': sp['pub_url']
                    })

        porto_titles = []
        if os.path.isfile(porto_path):
            try:
                df_porto = pd.read_csv(porto_path, encoding='utf-8-sig')
                for _, row in df_porto.iterrows():
                    judul = str(row.get('judul_kegiatan', '')).strip()
                    kategori = str(row.get('Kategori_Portofolio', '')).strip()
                    if judul and judul != 'nan':
                        porto_titles.append({
                            'judul_pddikti': judul,
                            'kategori_pddikti': kategori
                        })
            except Exception as e:
                print(f"      [WARN] Gagal baca portofolio: {e}")

        matched_scholar_indices = set()
        results = []

        for pt_idx, pt in enumerate(porto_titles):
            judul_pddikti = pt['judul_pddikti']
            found_pub = None
            for s_idx, sp in enumerate(scholar_pubs):
                if is_match(judul_pddikti, sp['judul_scholar']):
                    found_pub = sp
                    matched_scholar_indices.add(s_idx)
                    break
            
            if found_pub:
                meta = found_pub.copy()
                meta['sumber'] = 'PDDIKTI + Scholar'
                meta['status'] = 'found'
                total_matched_global += 1
            else:
                meta = {
                    'judul_scholar': '',
                    'sumber': 'PDDIKTI Only',
                    'status': 'not_found',
                    'authors': '',
                    'venue': '',
                    'jumlah_sitasi': 0,
                    'tahun_scholar': '',
                    'pub_url': '',
                    'eprint_url': '',
                    'publisher': '',
                    'abstract': ''
                }
            meta['nama_dosen'] = dosen_name
            meta['judul_pddikti'] = judul_pddikti
            meta['kategori_pddikti'] = pt['kategori_pddikti']
            results.append(meta)

        for s_idx, sp in enumerate(scholar_pubs):
            if s_idx not in matched_scholar_indices:
                meta = sp.copy()
                meta['sumber'] = 'Scholar Only'
                meta['status'] = 'found'
                meta['nama_dosen'] = dosen_name
                meta['judul_pddikti'] = ''
                meta['kategori_pddikti'] = ''
                results.append(meta)

        if results:
            df_out = pd.DataFrame(results)
            desired_cols = [
                'nama_dosen', 'judul_pddikti', 'judul_scholar', 'kategori_pddikti',
                'sumber', 'status', 'tahun_scholar', 'jumlah_sitasi', 'venue',
                'authors', 'pub_url', 'eprint_url', 'publisher', 'abstract'
            ]
            df_out = df_out[desired_cols]
            df_out.to_csv(out_path, index=False, encoding='utf-8-sig')
            global_records.extend(results)
            print(f"      [OK] Selesai. Cocok: {len(matched_scholar_indices)}/{len(porto_titles)} matched.")
            total_processed += 1

    if global_records:
        df_summary = pd.DataFrame(global_records)
        desired_cols = [
            'nama_dosen', 'judul_pddikti', 'judul_scholar', 'kategori_pddikti',
            'sumber', 'status', 'tahun_scholar', 'jumlah_sitasi', 'venue',
            'authors', 'pub_url', 'eprint_url', 'publisher', 'abstract'
        ]
        df_summary = df_summary[desired_cols]
        df_summary.to_csv(SUMMARY_PATH, index=False, encoding='utf-8-sig')
        print()
        print("=" * 80)
        print("  PROSES SELESAI!")
        print("=" * 80)
        print(f"  Dosen Berhasil Diproses : {total_processed} dosen")
        print(f"  Total Data Match Global : {total_matched_global} artikel")
        print(f"  Summary Global Disimpan : {SUMMARY_PATH}")
        print("=" * 80)
        print()

        print("--- INFORMASI UNTUK DOSEN YANG BELUM MEMILIKI HTML PROFIL ---")
        for key, mentions in coauthor_mentions.items():
            print(f"\n* Dosen: {key.upper()}")
            if mentions:
                print(f"  Ditemukan di {len(mentions)} publikasi dosen lain. Anda bisa mengklik link berikut untuk masuk ke profil mereka:")
                seen_titles = set()
                count = 1
                for m in mentions:
                    if m['judul'].lower() not in seen_titles:
                        print(f"  {count}. Paper: \"{m['judul']}\"")
                        print(f"     Co-Author: {m['authors']}")
                        print(f"     Dari Profil: {m['dosen_asal']}")
                        print(f"     Link Google Scholar Detail: {m['pub_url']}")
                        seen_titles.add(m['judul'].lower())
                        count += 1
                        if count > 5:
                            break
            else:
                print("  Tidak ditemukan penyebutan sebagai co-author di profil dosen lain.")

if __name__ == "__main__":
    main()
