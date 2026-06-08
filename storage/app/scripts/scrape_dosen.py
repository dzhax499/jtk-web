"""
=============================================================================
  SCRAPING DATA DOSEN — PDDIKTI (Politeknik Negeri Bandung, Teknik Informatika)
=============================================================================
  Menggunakan library pddiktipy untuk mengekstrak:
    - Biodata dosen
    - Riwayat pendidikan & mengajar
    - Portofolio (penelitian, pengabdian, karya, paten)

  Output: folder CSV terstruktur di ./Data_Dosen_Polban_TI/
=============================================================================
"""

import os
import re
import time
import pandas as pd
from pddiktipy import api


# ──────────────────────────────────────────────────────────────────────────────
# KONFIGURASI
# ──────────────────────────────────────────────────────────────────────────────
KEYWORD = "Politeknik Negeri Bandung Teknik Informatika"
OUTPUT_DIR = os.path.join(os.path.dirname(os.path.abspath(__file__)), "Data_Dosen_Polban_TI")
DELAY_SECONDS = 1.5  # jeda antar request API untuk menghindari rate-limit


# ──────────────────────────────────────────────────────────────────────────────
# FUNGSI UTILITAS
# ──────────────────────────────────────────────────────────────────────────────

def sanitize_folder_name(name: str) -> str:
    """Bersihkan nama dari karakter spesial agar aman sebagai nama folder."""
    # Hapus karakter yang tidak valid untuk nama folder Windows/Linux
    name = re.sub(r'[<>:"/\\|?*.,;\'!@#$%^&()+=\[\]{}~`]', '', name)
    # Ganti spasi berlebih menjadi satu underscore
    name = re.sub(r'\s+', '_', name.strip())
    # Batasi panjang nama folder
    return name[:100] if name else "Unknown"


def safe_extract_data(response):
    """
    Ekstrak list of dict dari response API secara aman.
    Response bisa berupa:
      - dict dengan key 'data' berisi list
      - list langsung
      - None
    """
    if response is None:
        return []
    if isinstance(response, dict):
        data = response.get('data', response.get('dosen', []))
        if isinstance(data, list):
            return data
        if isinstance(data, dict):
            return [data]
        return []
    if isinstance(response, list):
        return response
    return []


def safe_api_call(func, *args, label="API Call"):
    """Wrapper untuk panggilan API dengan error handling."""
    try:
        time.sleep(DELAY_SECONDS)
        result = func(*args)
        return result
    except Exception as e:
        print(f"      [WARN] Gagal {label}: {e}")
        return None


def build_dataframe(data_list: list, extra_cols: dict = None) -> pd.DataFrame:
    """Buat DataFrame dari list of dict, tambahkan kolom ekstra jika ada."""
    if not data_list:
        return pd.DataFrame()
    df = pd.DataFrame(data_list)
    if extra_cols:
        for col, val in extra_cols.items():
            df[col] = val
    return df


# ──────────────────────────────────────────────────────────────────────────────
# FUNGSI UTAMA
# ──────────────────────────────────────────────────────────────────────────────

def main():
    print("=" * 70)
    print("  SCRAPING DATA DOSEN PDDIKTI")
    print(f"  Keyword: {KEYWORD}")
    print("=" * 70)
    print()

    # Buat direktori output
    os.makedirs(OUTPUT_DIR, exist_ok=True)

    with api() as client:
        # ── STEP 1: Cari dosen ────────────────────────────────────────────
        print(f"[SEARCH] Mencari dosen dengan keyword: \"{KEYWORD}\"...")
        try:
            search_result = client.search_dosen(KEYWORD)
        except Exception as e:
            print(f"[ERROR] Gagal melakukan pencarian: {e}")
            return

        dosen_list = safe_extract_data(search_result)

        if not dosen_list:
            print("[ERROR] Tidak ada dosen ditemukan. Periksa keyword dan koneksi internet.")
            return

        total_dosen = len(dosen_list)
        print(f"[OK] Ditemukan {total_dosen} dosen.\n")

        # ── STEP 2: Simpan master list ────────────────────────────────────
        master_df = pd.DataFrame(dosen_list)
        master_csv_path = os.path.join(OUTPUT_DIR, "master_list_dosen.csv")
        master_df.to_csv(master_csv_path, index=False, encoding='utf-8-sig')
        print(f"[SAVED] Master list disimpan: {master_csv_path}\n")

        # ── STEP 3: Iterasi per dosen ─────────────────────────────────────
        success_count = 0
        fail_count = 0
        failed_names = []

        for idx, dosen in enumerate(dosen_list, start=1):
            dosen_id = dosen.get('id', '')
            dosen_name = dosen.get('nama', dosen.get('name', 'Unknown'))
            dosen_nidn = dosen.get('nidn', dosen.get('nid', 'N/A'))

            print(f"[{idx}/{total_dosen}] Memproses: {dosen_name} (NIDN: {dosen_nidn})")

            try:
                # Buat folder dosen
                folder_name = f"{sanitize_folder_name(dosen_name)}_{dosen_nidn}"
                dosen_dir = os.path.join(OUTPUT_DIR, folder_name)
                os.makedirs(dosen_dir, exist_ok=True)

                # ── 3a: BIODATA ───────────────────────────────────────────
                print("      [1/7] Mengambil biodata...")
                profile_raw = safe_api_call(
                    client.get_dosen_profile, dosen_id, label="biodata"
                )
                profile_data = safe_extract_data(profile_raw)
                if not profile_data and isinstance(profile_raw, dict):
                    # Profile mungkin langsung berupa dict tunggal (bukan nested)
                    profile_data = [profile_raw]

                if profile_data:
                    bio_df = pd.DataFrame(profile_data)
                    bio_df.to_csv(
                        os.path.join(dosen_dir, "biodata.csv"),
                        index=False, encoding='utf-8-sig'
                    )
                else:
                    print("      [WARN] Biodata kosong/tidak tersedia.")

                # ── 3b: RIWAYAT (Pendidikan + Mengajar) ──────────────────
                print("      [2/7] Mengambil riwayat pendidikan...")
                study_raw = safe_api_call(
                    client.get_dosen_study_history, dosen_id,
                    label="riwayat pendidikan"
                )
                study_data = safe_extract_data(study_raw)
                study_df = build_dataframe(study_data, {"Jenis_Riwayat": "Pendidikan"})

                print("      [3/7] Mengambil riwayat mengajar...")
                teaching_raw = safe_api_call(
                    client.get_dosen_teaching_history, dosen_id,
                    label="riwayat mengajar"
                )
                teaching_data = safe_extract_data(teaching_raw)
                teaching_df = build_dataframe(teaching_data, {"Jenis_Riwayat": "Mengajar"})

                # Gabungkan riwayat
                riwayat_dfs = [df for df in [study_df, teaching_df] if not df.empty]
                if riwayat_dfs:
                    riwayat_df = pd.concat(riwayat_dfs, ignore_index=True)
                    riwayat_df.to_csv(
                        os.path.join(dosen_dir, "riwayat.csv"),
                        index=False, encoding='utf-8-sig'
                    )
                else:
                    print("      [WARN] Riwayat kosong/tidak tersedia.")

                # ── 3c: PORTOFOLIO (Penelitian, Pengabdian, Karya, Paten) ─
                portofolio_parts = []

                print("      [4/7] Mengambil data penelitian...")
                penelitian_raw = safe_api_call(
                    client.get_dosen_penelitian, dosen_id,
                    label="penelitian"
                )
                penelitian_data = safe_extract_data(penelitian_raw)
                portofolio_parts.append(
                    build_dataframe(penelitian_data, {"Kategori_Portofolio": "Penelitian"})
                )

                print("      [5/7] Mengambil data pengabdian...")
                pengabdian_raw = safe_api_call(
                    client.get_dosen_pengabdian, dosen_id,
                    label="pengabdian"
                )
                pengabdian_data = safe_extract_data(pengabdian_raw)
                portofolio_parts.append(
                    build_dataframe(pengabdian_data, {"Kategori_Portofolio": "Pengabdian"})
                )

                print("      [6/7] Mengambil data karya...")
                karya_raw = safe_api_call(
                    client.get_dosen_karya, dosen_id, label="karya"
                )
                karya_data = safe_extract_data(karya_raw)
                portofolio_parts.append(
                    build_dataframe(karya_data, {"Kategori_Portofolio": "Karya"})
                )

                print("      [7/7] Mengambil data paten...")
                paten_raw = safe_api_call(
                    client.get_dosen_paten, dosen_id, label="paten"
                )
                paten_data = safe_extract_data(paten_raw)
                portofolio_parts.append(
                    build_dataframe(paten_data, {"Kategori_Portofolio": "Paten"})
                )

                # Gabungkan portofolio
                portofolio_dfs = [df for df in portofolio_parts if not df.empty]
                if portofolio_dfs:
                    portofolio_df = pd.concat(portofolio_dfs, ignore_index=True)
                    portofolio_df.to_csv(
                        os.path.join(dosen_dir, "portofolio.csv"),
                        index=False, encoding='utf-8-sig'
                    )
                else:
                    print("      [WARN] Portofolio kosong/tidak tersedia.")

                success_count += 1
                print(f"      [DONE] Selesai: {dosen_name}\n")

            except Exception as e:
                fail_count += 1
                failed_names.append(dosen_name)
                print(f"      [ERROR] GAGAL memproses {dosen_name}: {e}\n")
                continue

        # ── STEP 4: Ringkasan ─────────────────────────────────────────────
        print("=" * 70)
        print("  RINGKASAN SCRAPING")
        print("=" * 70)
        print(f"  Total dosen ditemukan : {total_dosen}")
        print(f"  Berhasil              : {success_count}")
        print(f"  Gagal                 : {fail_count}")
        if failed_names:
            print(f"  Dosen gagal           : {', '.join(failed_names)}")
        print(f"  Output tersimpan di   : {OUTPUT_DIR}")
        print("=" * 70)


if __name__ == "__main__":
    main()
