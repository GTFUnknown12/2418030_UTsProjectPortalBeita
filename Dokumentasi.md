# Dokumentasi API Portal Berita

## Ringkasan API
Base URL: `http://localhost:8000/api`

Resource yang tersedia:
- `categories` → CRUD kategori
- `news` → CRUD berita

> Semua endpoint berada di bawah prefix `/api`.

---

## Model Data

### Category
- `id` (integer)
- `name` (string)
- `slug` (string)
- `created_at` (timestamp)
- `updated_at` (timestamp)

### News
- `id` (integer)
- `title` (string)
- `slug` (string)
- `content` (text)
- `category_id` (integer)
- `date` (date)
- `image` (string) — path file di storage
- `created_at` (timestamp)
- `updated_at` (timestamp)
- `category` (object) — relasi kategori pada response `news`

---

## Endpoints Categories

### 1. GET /api/categories
Mengambil semua kategori.

**Method:** GET  
**URL:** `/api/categories`  
**Headers:**
- Accept: application/json

**Response (200 OK):**
```json
[
  {
    "id": 1,
    "name": "Teknologi",
    "slug": "teknologi",
    "created_at": "2026-04-14T00:00:00.000000Z",
    "updated_at": "2026-04-14T00:00:00.000000Z"
  }
]
```

### 2. POST /api/categories
Membuat kategori baru.

**Method:** POST  
**URL:** `/api/categories`  
**Headers:**
- Accept: application/json
- Content-Type: application/json

**Body Parameters:**
- `name` (string, required): nama kategori

**Response (201 Created):**
```json
{
  "id": 2,
  "name": "Bisnis",
  "slug": "bisnis",
  "created_at": "2026-04-14T00:00:00.000000Z",
  "updated_at": "2026-04-14T00:00:00.000000Z"
}
```

**Error Response (422 Unprocessable Entity):**
```json
{
  "message": "The given data was invalid.",
  "errors": {
    "name": ["The name field is required."]
  }
}
```

### 3. GET /api/categories/{id}
Mengambil kategori berdasarkan ID.

**Method:** GET  
**URL:** `/api/categories/{id}`  
**Headers:**
- Accept: application/json

**URL Parameters:**
- `id` (integer): ID kategori

**Response (200 OK):**
```json
{
  "id": 1,
  "name": "Teknologi",
  "slug": "teknologi",
  "created_at": "2026-04-14T00:00:00.000000Z",
  "updated_at": "2026-04-14T00:00:00.000000Z"
}
```

**Error Response (404 Not Found):**
```json
{
  "message": "No query results for model [App\\Models\\Category] 99"
}
```

### 4. PUT /api/categories/{id}
Memperbarui kategori berdasarkan ID.

**Method:** PUT  
**URL:** `/api/categories/{id}`  
**Headers:**
- Accept: application/json
- Content-Type: application/json

**URL Parameters:**
- `id` (integer): ID kategori

**Body Parameters:**
- `name` (string, required): nama kategori baru

**Response (200 OK):**
```json
{
  "id": 1,
  "name": "Teknologi Terbaru",
  "slug": "teknologi-terbaru",
  "created_at": "2026-04-14T00:00:00.000000Z",
  "updated_at": "2026-04-14T00:00:00.000000Z"
}
```

**Error Response (422 Unprocessable Entity):**
```json
{
  "message": "The given data was invalid.",
  "errors": {
    "name": ["The name field is required."]
  }
}
```

### 5. DELETE /api/categories/{id}
Menghapus kategori berdasarkan ID.

**Method:** DELETE  
**URL:** `/api/categories/{id}`  
**Headers:**
- Accept: application/json

**URL Parameters:**
- `id` (integer): ID kategori

**Response (200 OK):**
```json
{
  "message": "Category deleted successfully"
}
```

**Error Response (404 Not Found):**
```json
{
  "message": "No query results for model [App\\Models\\Category] 99"
}
```

---

## Endpoints News

### 1. GET /api/news
Mengambil semua berita.

**Method:** GET  
**URL:** `/api/news`  
**Headers:**
- Accept: application/json

**Response (200 OK):**
```json
[
  {
    "id": 1,
    "title": "Judul Berita",
    "slug": "judul-berita",
    "content": "Konten berita...",
    "category_id": 1,
    "date": "2026-04-14",
    "image": "news/image.jpg",
    "created_at": "2026-04-14T00:00:00.000000Z",
    "updated_at": "2026-04-14T00:00:00.000000Z",
    "category": {
      "id": 1,
      "name": "Teknologi",
      "slug": "teknologi"
    }
  }
]
```

### 2. POST /api/news
Membuat berita baru.

**Method:** POST  
**URL:** `/api/news`  
**Headers:**
- Accept: application/json
- Content-Type: multipart/form-data

**Body Parameters:**
- `title` (string, required)
- `content` (string, required)
- `image` (file, required): jpeg, png, jpg, max 2MB
- `category_id` (integer, required): ID kategori harus ada
- `date` (date, required)

**Response (201 Created):**
```json
{
  "id": 10,
  "title": "Berita Baru",
  "slug": "berita-baru",
  "content": "Isi konten berita...",
  "category_id": 1,
  "date": "2026-04-14",
  "image": "news/abcd1234.jpg",
  "created_at": "2026-04-14T00:00:00.000000Z",
  "updated_at": "2026-04-14T00:00:00.000000Z"
}
```

**Contoh curl:**
```bash
curl -X POST http://localhost:8000/api/news \
  -H "Accept: application/json" \
  -F "title=Berita Baru" \
  -F "content=Konten berita" \
  -F "category_id=1" \
  -F "date=2026-04-14" \
  -F "image=@/path/to/image.jpg"
```

**Error Response (422 Unprocessable Entity):**
```json
{
  "message": "The given data was invalid.",
  "errors": {
    "image": ["The image field is required."]
  }
}
```

### 3. GET /api/news/{id}
Mengambil berita berdasarkan ID.

**Method:** GET  
**URL:** `/api/news/{id}`  
**Headers:**
- Accept: application/json

**URL Parameters:**
- `id` (integer)

**Response (200 OK):**
```json
{
  "id": 1,
  "title": "Judul Berita",
  "slug": "judul-berita",
  "content": "Konten berita...",
  "category_id": 1,
  "date": "2026-04-14",
  "image": "news/image.jpg",
  "created_at": "2026-04-14T00:00:00.000000Z",
  "updated_at": "2026-04-14T00:00:00.000000Z",
  "category": {
    "id": 1,
    "name": "Teknologi",
    "slug": "teknologi"
  }
}
```

**Error Response (404 Not Found):**
```json
{
  "message": "No query results for model [App\\Models\\News] 99"
}
```

### 4. PUT /api/news/{id}
Memperbarui berita berdasarkan ID.

**Method:** PUT  
**URL:** `/api/news/{id}`  
**Headers:**
- Accept: application/json
- Content-Type: multipart/form-data

**URL Parameters:**
- `id` (integer)

**Body Parameters:**
- `title` (string, required)
- `content` (string, required)
- `image` (file, optional)
- `category_id` (integer, required)
- `date` (date, required)

**Response (200 OK):**
```json
{
  "id": 1,
  "title": "Judul Berita Diperbarui",
  "slug": "judul-berita-diperbarui",
  "content": "Konten berita diperbarui...",
  "category_id": 1,
  "date": "2026-04-15",
  "image": "news/new_image.jpg",
  "created_at": "2026-04-14T00:00:00.000000Z",
  "updated_at": "2026-04-15T00:00:00.000000Z"
}
```

**Error Response (422 Unprocessable Entity):**
```json
{
  "message": "The given data was invalid.",
  "errors": {
    "category_id": ["The selected category id is invalid."]
  }
}
```

### 5. DELETE /api/news/{id}
Menghapus berita berdasarkan ID.

**Method:** DELETE  
**URL:** `/api/news/{id}`  
**Headers:**
- Accept: application/json

**URL Parameters:**
- `id` (integer)

**Response (200 OK):**
```json
{
  "message": "News deleted successfully"
}
```

**Error Response (404 Not Found):**
```json
{
  "message": "No query results for model [App\\Models\\News] 99"
}
```

---

## Contoh Request Lain

### Contoh GET semua categories
```bash
curl -X GET http://localhost:8000/api/categories \
  -H "Accept: application/json"
```

### Contoh GET semua news
```bash
curl -X GET http://localhost:8000/api/news \
  -H "Accept: application/json"
```

---

## Catatan Penting
- `POST` dan `PUT` untuk `news` menggunakan `multipart/form-data` karena `image` adalah file.
- File gambar disimpan di `storage/app/public/news/`.
- Untuk menampilkan gambar di frontend akses: `http://localhost:8000/storage/{path}`.
- Pastikan menjalankan `php artisan storage:link` untuk membuat symbolic link ke `public/storage` jika belum.
- Endpoint auth `/api/user` aktif jika `auth:sanctum` digunakan, namun tidak dijelaskan di dokumentasi ini karena fokus pada kategori dan berita.

---

## Sinkronisasi dengan Proyek
Dokumentasi ini sudah sinkron dengan kode di proyek:
- `routes/api.php` menggunakan `Route::apiResource('categories', CategoryController::class)` dan `Route::apiResource('news', NewsController::class)`.
- `app/Http/Controllers/Api/CategoryController.php` menangani semua operasi kategori.
- `app/Http/Controllers/Api/NewsController.php` menangani semua operasi berita, termasuk upload dan delete gambar.
- `news` menggunakan relasi `category` di response, sehingga response `GET /api/news` memuat data kategori.

