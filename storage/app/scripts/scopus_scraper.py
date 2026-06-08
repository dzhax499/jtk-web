"""
scopus_scraper_3h.py
Kelompok 3H — Scraper Publikasi Scopus Dosen TI POLBAN
=======================================================
Script ini mengambil detail publikasi Scopus untuk 35 dosen
yang sudah teridentifikasi dari SINTA, menggunakan Scopus API
(Elsevier Developer API) atau fallback ke scraping HTML.

SETUP:
    pip install requests pandas tqdm dotenv

CARA PAKAI:
    1. Daftar API key gratis di https://dev.elsevier.com/
       (gunakan email kampus untuk institutional access)
    2. Jalankan: python scopus_scraper_3h.py --api-key YOUR_KEY
    3. Tanpa API key (mode scrape): python scopus_scraper_3h.py --no-api

Output:
    - scopus_detail_all.csv    : semua publikasi gabungan
    - per_dosen/               : folder, satu file JSON per dosen
    - scrape_log.txt           : log proses
"""

import os
import re
import json
import time
import logging
import argparse
import requests
import pandas as pd
from pathlib import Path
from tqdm import tqdm
from dotenv import load_dotenv


# ─── KONFIGURASI ─────────────────────────────────────────────────────────────
ROOT_DIR = Path(__file__).resolve().parents[3]

# Load Laravel .env
load_dotenv(ROOT_DIR / ".env")

SCOPUS_API_KEY = os.getenv("API_SCOPUS")
BASE_DIR = Path(__file__).parent
INPUT_CSV = BASE_DIR / "scopus_base_from_sinta.csv"
OUTPUT_CSV = BASE_DIR / "scopus_detail_all.csv"
PER_DOSEN_DIR = BASE_DIR / "per_dosen"
LOG_FILE = BASE_DIR / "scrape_log.txt"

SCOPUS_ABSTRACT_API = "https://api.elsevier.com/content/abstract/eid/{eid}"
SCOPUS_SEARCH_API   = "https://api.elsevier.com/content/search/scopus"

DELAY_BETWEEN_REQUESTS = 1.5  # detik, jangan terlalu cepat
MAX_RETRIES = 3

logging.basicConfig(
    level=logging.INFO,
    format="%(asctime)s [%(levelname)s] %(message)s",
    handlers=[
        logging.FileHandler(LOG_FILE, encoding="utf-8"),
        logging.StreamHandler()
    ]
)
log = logging.getLogger(__name__)

# ─── HEADERS ──────────────────────────────────────────────────────────────────
def get_headers(api_key: str) -> dict:
    return {
        "X-ELS-APIKey": api_key,
        "Accept": "application/json",
        "User-Agent": "Mozilla/5.0 (research scraper)"
    }

# ─── SCOPUS API: AMBIL DETAIL SATU ARTIKEL VIA EID ───────────────────────────
def fetch_abstract_by_eid(eid: str, api_key: str) -> dict:
    """
    Ambil detail artikel dari Scopus Abstract Retrieval API.
    EID contoh: 2-s2.0-85200037523
    """
    url = SCOPUS_ABSTRACT_API.format(eid=eid)
    headers = get_headers(api_key)
    
    for attempt in range(MAX_RETRIES):
        try:
            resp = requests.get(url, headers=headers, timeout=15)
            if resp.status_code == 200:
                data = resp.json()
                ab = data.get("abstracts-retrieval-response", {})
                coredata = ab.get("coredata", {})
                
                # Authors
                authors_raw = ab.get("authors", {}).get("author", [])
                if isinstance(authors_raw, dict):
                    authors_raw = [authors_raw]
                authors_str = "; ".join([
                    a.get("preferred-name", {}).get("$", "") or
                    f"{a.get('ce:surname','')} {a.get('ce:given-name','')}".strip()
                    for a in authors_raw
                ])
                
                # Scopus Author IDs (untuk cari ID dosen)
                author_ids = [
                    a.get("@auid", "") for a in authors_raw
                ]
                
                doi = coredata.get("prism:doi", "")
                citations = coredata.get("citedby-count", "")
                title = coredata.get("dc:title", "")
                year = coredata.get("prism:coverDate", "")[:4] if coredata.get("prism:coverDate") else ""
                venue = coredata.get("prism:publicationName", "")
                issn = coredata.get("prism:issn", "")
                
                return {
                    "status": "OK",
                    "EID": eid,
                    "Judul": title,
                    "Tahun": year,
                    "Venue_Jurnal": venue,
                    "ISSN": issn,
                    "DOI": doi,
                    "Jumlah_Sitasi": citations,
                    "Authors": authors_str,
                    "Author_IDs_Scopus": "|".join(filter(None, author_ids)),
                }
            elif resp.status_code == 401:
                log.error(f"API key tidak valid atau expired. Status: 401")
                return {"status": "AUTH_ERROR", "EID": eid}
            elif resp.status_code == 429:
                log.warning(f"Rate limit kena, tunggu 30 detik...")
                time.sleep(30)
            else:
                log.warning(f"EID {eid} -> HTTP {resp.status_code}, attempt {attempt+1}")
                time.sleep(2)
        except requests.exceptions.RequestException as e:
            log.warning(f"Request error untuk {eid}: {e}, attempt {attempt+1}")
            time.sleep(3)
    
    return {"status": "FAILED", "EID": eid}


# ─── CARI SCOPUS AUTHOR ID DARI EID ARTIKEL ──────────────────────────────────
def find_author_scopus_id(author_name: str, api_key: str) -> str:
    """
    Cari Scopus Author ID berdasarkan nama dosen.
    Gunakan Scopus Author Search API.
    """
    headers = get_headers(api_key)
    params = {
        "query": f'AUTHLASTNAME("{author_name.split()[-1]}") AND AUTHFIRST("{author_name.split()[0]}")',
        "field": "dc:identifier,preferred-name,affiliation",
        "count": 5,
    }
    try:
        resp = requests.get(
            "https://api.elsevier.com/content/search/author",
            headers=headers, params=params, timeout=15
        )
        if resp.status_code == 200:
            data = resp.json()
            entries = data.get("search-results", {}).get("entry", [])
            # Filter yang affiliasi POLBAN
            for entry in entries:
                affs = entry.get("affiliation-current", {})
                affs_name = str(affs.get("affiliation-name", "")).lower()
                if "polban" in affs_name or "politeknik negeri bandung" in affs_name:
                    return entry.get("dc:identifier", "").replace("AUTHOR_ID:", "")
            # Fallback: return first result
            if entries:
                return entries[0].get("dc:identifier", "").replace("AUTHOR_ID:", "")
    except Exception as e:
        log.warning(f"Author search error untuk {author_name}: {e}")
    return ""


# ─── FALLBACK: SCRAPE HALAMAN SCOPUS TANPA API ───────────────────────────────
def scrape_scopus_page(scopus_url: str) -> dict:
    """
    Fallback scraping HTML halaman Scopus (tanpa API key).
    Hasilnya lebih terbatas karena Scopus memblokir scraping.
    Untuk tujuan akademik, gunakan API key jika memungkinkan.
    """
    headers = {
        "User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36",
        "Accept": "text/html,application/xhtml+xml",
    }
    try:
        resp = requests.get(scopus_url, headers=headers, timeout=20)
        if resp.status_code == 200:
            # Basic extraction dari meta tags
            from html.parser import HTMLParser
            
            class MetaParser(HTMLParser):
                def __init__(self):
                    super().__init__()
                    self.meta = {}
                def handle_starttag(self, tag, attrs):
                    if tag == "meta":
                        d = dict(attrs)
                        name = d.get("name", d.get("property", ""))
                        content = d.get("content", "")
                        if name and content:
                            self.meta[name] = content
            
            parser = MetaParser()
            parser.feed(resp.text)
            meta = parser.meta
            
            return {
                "status": "SCRAPED_HTML",
                "Judul": meta.get("citation_title", ""),
                "Tahun": meta.get("citation_date", "")[:4] if meta.get("citation_date") else "",
                "Venue_Jurnal": meta.get("citation_journal_title", ""),
                "DOI": meta.get("citation_doi", ""),
                "Authors": meta.get("citation_author", ""),
                "Jumlah_Sitasi": "",  # tidak bisa dari HTML
            }
        return {"status": f"HTTP_{resp.status_code}"}
    except Exception as e:
        return {"status": f"ERROR: {e}"}


# ─── MAIN SCRAPING PIPELINE ───────────────────────────────────────────────────
def run_scraping(api_key: str = None, no_api: bool = False, resume: bool = True):
    PER_DOSEN_DIR.mkdir(exist_ok=True)
    
    # Load data base dari SINTA
    df = pd.read_csv(INPUT_CSV)
    log.info(f"Loaded {len(df)} baris untuk {df['Nama_Dosen'].nunique()} dosen")
    
    # Resume: skip yang sudah selesai
    if resume and OUTPUT_CSV.exists():
        done = pd.read_csv(OUTPUT_CSV)
        done_eids = set(done['EID'].dropna().tolist())
        df_pending = df[~df['EID'].isin(done_eids)].copy()
        log.info(f"Resume mode: {len(done_eids)} sudah selesai, {len(df_pending)} tersisa")
        results = done.to_dict('records')
    else:
        df_pending = df.copy()
        results = []
    
    # Proses per dosen, per artikel
    dosen_groups = df_pending.groupby('Nama_Dosen')
    
    for dosen_name, group in tqdm(dosen_groups, desc="Dosen"):
        log.info(f"Processing: {dosen_name} ({len(group)} publikasi)")
        dosen_results = []
        
        # Cari Scopus Author ID untuk dosen ini (sekali saja)
        scopus_author_id = ""
        if api_key and not no_api:
            scopus_author_id = find_author_scopus_id(dosen_name, api_key)
            if scopus_author_id:
                log.info(f"  Found Scopus Author ID: {scopus_author_id} untuk {dosen_name}")
            time.sleep(DELAY_BETWEEN_REQUESTS)
        
        for _, row in group.iterrows():
            eid = row.get('EID', '')
            link = row.get('Link_Scopus', '')
            base_record = row.to_dict()
            base_record['Scopus_Author_ID'] = scopus_author_id
            
            if eid and api_key and not no_api:
                detail = fetch_abstract_by_eid(eid, api_key)
                if detail['status'] == 'OK':
                    base_record.update({
                        'DOI': detail.get('DOI', ''),
                        'Jumlah_Sitasi': detail.get('Jumlah_Sitasi', ''),
                        'Authors': detail.get('Authors', ''),
                        'Venue_Jurnal': detail.get('Venue_Jurnal', '') or base_record.get('Venue_Jurnal', ''),
                        'Status_Detail': 'DONE_API',
                    })
                else:
                    base_record['Status_Detail'] = f"FAILED_{detail['status']}"
                time.sleep(DELAY_BETWEEN_REQUESTS)
            
            elif link and no_api:
                detail = scrape_scopus_page(link)
                base_record.update({
                    'DOI': detail.get('DOI', ''),
                    'Authors': detail.get('Authors', ''),
                    'Status_Detail': f"DONE_{detail['status']}",
                })
                time.sleep(DELAY_BETWEEN_REQUESTS * 2)
            
            else:
                base_record['Status_Detail'] = 'PENDING_SCRAPE'
            
            results.append(base_record)
            dosen_results.append(base_record)
        
        # Simpan per dosen
        safe_name = re.sub(r'[^A-Z0-9_]', '_', dosen_name.upper())
        dosen_file = PER_DOSEN_DIR / f"{safe_name}_scopus.json"
        with open(dosen_file, 'w', encoding='utf-8') as f:
            json.dump(dosen_results, f, ensure_ascii=False, indent=2)
        
        # Save checkpoint setiap dosen
        pd.DataFrame(results).to_csv(OUTPUT_CSV, index=False)
        log.info(f"  Checkpoint saved ({len(results)} total rows)")
    
    log.info(f"Selesai! Total {len(results)} baris disimpan ke {OUTPUT_CSV}")
    return pd.DataFrame(results)


# ─── UTILS: BUAT RINGKASAN HASIL ─────────────────────────────────────────────
def generate_summary(df: pd.DataFrame):
    print("\n" + "="*60)
    print("RINGKASAN SCRAPING SCOPUS - KELOMPOK 3H")
    print("="*60)
    status_counts = df['Status_Detail'].value_counts()
    print("\nStatus per record:")
    print(status_counts.to_string())
    
    print(f"\nTotal dosen: {df['Nama_Dosen'].nunique()}")
    print(f"Total publikasi: {len(df)}")
    
    done = df[df['Status_Detail'].str.startswith('DONE')]
    print(f"Berhasil didetailkan: {len(done)}")
    print(f"Masih pending: {len(df) - len(done)}")
    
    print("\nPer dosen:")
    for name, grp in df.groupby('Nama_Dosen'):
        done_n = grp['Status_Detail'].str.startswith('DONE').sum()
        print(f"  {name}: {done_n}/{len(grp)} selesai")
    print("="*60)


# ─── ENTRY POINT ─────────────────────────────────────────────────────────────
if __name__ == "__main__":
    parser = argparse.ArgumentParser(
        description="Scopus Scraper - Kelompok 3H"
    )

    parser.add_argument(
        "--no-api",
        action="store_true",
        help="Gunakan HTML scraping (tanpa API key)"
    )

    parser.add_argument(
        "--no-resume",
        action="store_true",
        help="Mulai dari awal"
    )

    parser.add_argument(
        "--summary-only",
        action="store_true",
        help="Hanya tampilkan ringkasan"
    )

    args = parser.parse_args()

    if args.summary_only:
        if OUTPUT_CSV.exists():
            df = pd.read_csv(OUTPUT_CSV)
            generate_summary(df)
        else:
            print("Belum ada hasil. Jalankan scraping dulu.")
        exit()

    api_key = None if args.no_api else SCOPUS_API_KEY

    if not args.no_api and not api_key:
        print("ERROR: API_SCOPUS tidak ditemukan di file .env")
        exit(1)

    df = run_scraping(
        api_key=api_key,
        no_api=args.no_api,
        resume=not args.no_resume
    )

    generate_summary(df)
