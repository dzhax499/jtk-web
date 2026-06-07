# Dokumentasi Sistem Dynamic Fields - Filament PHP

Dokumen ini menjelaskan implementasi fitur **Dynamic Fields** pada backend Filament PHP. Fitur ini memungkinkan admin untuk menambah, mengubah, dan menghapus form input tambahan secara dinamis untuk berbagai resource (Dosen, Post, Media, Kategori, dll.) langsung melalui Admin Panel tanpa mengubah kode program.

---

## 1. Perubahan Basis Data (Database Migrations)
Dua file migrasi baru telah ditambahkan dan dieksekusi:
1.  **`create_dynamic_field_configs_table`**: Menyimpan konfigurasi field dinamis (seperti tipe input, label, target resource, placeholder, opsi select, dan validasi required).
2.  **`add_extra_attributes_to_lecturers_table`**: Menambahkan kolom JSON `extra_attributes` pada tabel `lecturers` untuk menyimpan nilai field dinamis.
3.  **`add_extra_attributes_to_all_tables`**: Menambahkan kolom JSON `extra_attributes` secara otomatis ke semua tabel resource lainnya (termasuk `posts`, `media`, `pages`, `users`, `categories`, `study_programs`, dll.).

---

## 2. Struktur Kode Program

### A. Helper Terpusat (DynamicFieldsHelper)
Pusat logika form input dan kolom tabel dinamis terletak di file:
*   [`app/Helpers/DynamicFieldsHelper.php`](file:///c:/Users/Lenovo/Documents/JTK/Akademik/Semester-4/PPL/TugasAkhir/jtk-web/app/Helpers/DynamicFieldsHelper.php)
    *   `getFormComponents($modelClass)`: Menghasilkan array form komponen Filament (seperti `TextInput`, `Select`, `Toggle`, `Textarea`) berdasarkan konfigurasi di database dan dibungkus di dalam collapsible `Section` ("Informasi Tambahan").
    *   `getTableColumns($modelClass)`: Menghasilkan array kolom tabel Filament yang bersifat `toggleable` (dapat dimunculkan/disembunyikan di list utama melalui menu toggle kolom).

### B. Eloquent Models
Atribut `extra_attributes` telah dikonfigurasi sebagai casting `array` di seluruh file model di dalam [`app/Models/`](file:///c:/Users/Lenovo/Documents/JTK/Akademik/Semester-4/PPL/TugasAkhir/jtk-web/app/Models) agar data JSON otomatis terserialisasi saat dibaca atau disimpan oleh Eloquent.

### C. Filament Resources Wrapper
Seluruh 13 resource Filament (misal: `LecturerResource.php`, `PostResource.php`, `MediaResource.php`, dll.) telah dimodifikasi pada fungsi `form()` dan `table()` agar memanggil helper terpusat:
```php
public static function form(Schema $schema): Schema
{
    $schema = UserForm::configure($schema);
    $components = array_merge($schema->getComponents() ?? [], \App\Helpers\DynamicFieldsHelper::getFormComponents(self::$model));
    return $schema->components($components);
}

public static function table(Table $table): Table
{
    $table = UsersTable::configure($table);
    $columns = array_merge($table->getColumns() ?? [], \App\Helpers\DynamicFieldsHelper::getTableColumns(self::$model));
    return $table->columns($columns);
}
```

### D. Konfigurasi Admin (DynamicFieldConfigResource)
Resource baru untuk mengelola konfigurasi field dinamis telah ditambahkan pada folder modular:
*   [`app/Filament/Resources/DynamicFieldConfigs`](file:///c:/Users/Lenovo/Documents/JTK/Akademik/Semester-4/PPL/TugasAkhir/jtk-web/app/Filament/Resources/DynamicFieldConfigs)
    *   Menampilkan form pembuatan kunci nama JSON, label tampilan form, pilihan tipe data input, toggle wajib diisi, dan input key-value dinamis untuk tipe dropdown (select).
    *   Dropdown target resource secara dinamis memindai direktori `app/Models` sehingga admin dapat memilih target resource apapun dalam aplikasi.

---

## 3. Menghubungkan ke Web Utama (Frontend)
Untuk menampilkan data dinamis secara otomatis di halaman frontend publik (misalnya halaman detail Dosen), Anda cukup menaruh potongan kode Blade berikut di file template Anda:

```html
@if(!empty($lecturer->extra_attributes))
    <div class="dynamic-attributes">
        @foreach(\App\Models\DynamicFieldConfig::where('target_resource', get_class($lecturer))->get() as $field)
            @if(isset($lecturer->extra_attributes[$field->name]))
                <div class="attribute-item">
                    <strong>{{ $field->label }}:</strong> 
                    @if($field->type === 'toggle')
                        {{ $lecturer->extra_attributes[$field->name] ? 'Ya' : 'Tidak' }}
                    @elseif($field->type === 'select')
                        {{ $field->options[$lecturer->extra_attributes[$field->name]] ?? $lecturer->extra_attributes[$field->name] }}
                    @else
                        {{ $lecturer->extra_attributes[$field->name] }}
                    @endif
                </div>
            @endif
        @endforeach
    </div>
@endif
```
Dengan kode ini, setiap penambahan field baru dari admin panel akan langsung muncul di frontend secara otomatis.

---

## 4. Rekomendasi Pesan Commit Git
Anda dapat menggunakan pesan commit terstruktur berikut untuk push ke repository Anda:

### Opsi 1: Pesan Commit Terpadu (Satu Commit)
```bash
git add .
git commit -m "feat(filament): implement dynamic fields system globally across all resources" -m "- Add dynamic_field_configs and extra_attributes column to all model tables.
- Cast extra_attributes as array on all Eloquent models.
- Create centralized DynamicFieldsHelper to inject inputs and index columns dynamically.
- Implement DynamicFieldConfigResource to manage custom fields directly from admin GUI.
- Fix custom Filament Schema Get/Section component namespace conflicts."
```

### Opsi 2: Pesan Commit Bertahap (Multi Commit)
*   **Commit 1 (Database & Models)**:
    ```bash
    git commit -m "feat(database): create dynamic_field_configs and add extra_attributes JSON columns"
    ```
*   **Commit 2 (Helper & Resources)**:
    ```bash
    git commit -m "feat(filament): add global DynamicFieldsHelper and wrap all resources"
    ```
*   **Commit 3 (Admin Panel Resource)**:
    ```bash
    git commit -m "feat(filament): add DynamicFieldConfigResource to configure custom fields"
    ```
