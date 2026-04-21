# API Dokumentasi - News (Berita)

## Base URL
```
http://localhost/api
```

## Endpoints

### 1. Get All News
**Endpoint:** `GET /news`

**Description:** Mengambil semua berita

**Response Success (200):**
```json
{
  "success": true,
  "message": "News retrieved successfully",
  "data": [
    {
      "id": 1,
      "title": "Berita Pertama",
      "slug": "berita-pertama",
      "content": "Konten berita...",
      "category_id": 1,
      "image": "news/image.jpg",
      "date": "2026-04-05",
      "created_at": "2026-04-05T10:30:00.000000Z",
      "updated_at": "2026-04-05T10:30:00.000000Z",
      "category": {
        "id": 1,
        "name": "Teknologi",
        "slug": "teknologi",
        "created_at": "2026-04-05T10:30:00.000000Z",
        "updated_at": "2026-04-05T10:30:00.000000Z"
      }
    }
  ]
}
```

---

### 2. Create News (POST)
**Endpoint:** `POST /news`

**Description:** Membuat berita baru

**Required Headers:**
```
Content-Type: multipart/form-data
```

**Request Body:**
```
- title (string, required, max: 255) - Judul berita
- content (string, required) - Konten berita
- image (file, required) - Gambar berita (jpeg, png, jpg, gif, max: 2MB)
- category_id (integer, required) - ID kategori yang terdaftar
- date (date, required) - Tanggal posting (format: YYYY-MM-DD)
```

**Example Request (cURL):**
```bash
curl -X POST http://localhost/api/news \
  -H "Accept: application/json" \
  -F "title=Judul Berita" \
  -F "content=Konten berita yang panjang" \
  -F "image=@/path/to/image.jpg" \
  -F "category_id=1" \
  -F "date=2026-04-05"
```

**Response Success (201):**
```json
{
  "success": true,
  "message": "News created successfully",
  "data": {
    "id": 2,
    "title": "Judul Berita",
    "slug": "judul-berita",
    "content": "Konten berita yang panjang",
    "category_id": 1,
    "image": "news/abc123.jpg",
    "date": "2026-04-05",
    "created_at": "2026-04-21T10:30:00.000000Z",
    "updated_at": "2026-04-21T10:30:00.000000Z",
    "category": {...}
  }
}
```

**Response Error (422):**
```json
{
  "success": false,
  "message": "Validation failed",
  "errors": {
    "title": ["The title field is required."],
    "image": ["The image must be an image."]
  }
}
```

---

### 3. Get Single News
**Endpoint:** `GET /news/{id}`

**Description:** Mengambil detail satu berita

**Parameters:**
- `id` (integer, required) - ID berita

**Example Request:**
```bash
curl http://localhost/api/news/1
```

**Response Success (200):**
```json
{
  "success": true,
  "message": "News retrieved successfully",
  "data": {
    "id": 1,
    "title": "Berita Pertama",
    "slug": "berita-pertama",
    "content": "Konten berita...",
    "category_id": 1,
    "image": "news/image.jpg",
    "date": "2026-04-05",
    "created_at": "2026-04-05T10:30:00.000000Z",
    "updated_at": "2026-04-05T10:30:00.000000Z",
    "category": {...}
  }
}
```

**Response Error (404):**
```json
{
  "success": false,
  "message": "News not found"
}
```

---

### 4. Update News
**Endpoint:** `PUT /news/{id}`

**Description:** Mengupdate berita yang sudah ada

**Parameters:**
- `id` (integer, required) - ID berita

**Request Body (Form Data):**
```
- title (string, required, max: 255)
- content (string, required)
- image (file, optional) - Jika upload gambar baru, gambar lama akan dihapus
- category_id (integer, required)
- date (date, required)
```

**Example Request (cURL):**
```bash
curl -X PUT http://localhost/api/news/1 \
  -H "Accept: application/json" \
  -F "title=Judul Berita Baru" \
  -F "content=Konten berita yang diupdate" \
  -F "category_id=1" \
  -F "date=2026-04-21"
```

**Response Success (200):**
```json
{
  "success": true,
  "message": "News updated successfully",
  "data": {
    "id": 1,
    "title": "Judul Berita Baru",
    "slug": "judul-berita-baru",
    "content": "Konten berita yang diupdate",
    ...
  }
}
```

**Response Error (422):**
```json
{
  "success": false,
  "message": "Validation failed",
  "errors": {...}
}
```

**Response Error (404):**
```json
{
  "success": false,
  "message": "News not found"
}
```

---

### 5. Delete News
**Endpoint:** `DELETE /news/{id}`

**Description:** Menghapus berita (beserta gambarnya)

**Parameters:**
- `id` (integer, required) - ID berita

**Example Request:**
```bash
curl -X DELETE http://localhost/api/news/1 \
  -H "Accept: application/json"
```

**Response Success (200):**
```json
{
  "success": true,
  "message": "News deleted successfully"
}
```

**Response Error (404):**
```json
{
  "success": false,
  "message": "News not found"
}
```

---

### 6. Get News by Category
**Endpoint:** `GET /news/category/{categoryId}`

**Description:** Mengambil semua berita berdasarkan kategori

**Parameters:**
- `categoryId` (integer, required) - ID kategori

**Example Request:**
```bash
curl http://localhost/api/news/category/1
```

**Response Success (200):**
```json
{
  "success": true,
  "message": "News retrieved successfully",
  "data": [
    {
      "id": 1,
      "title": "Berita Kategori 1",
      ...
    }
  ]
}
```

---

### 7. Search News
**Endpoint:** `POST /news/search`

**Description:** Mencari berita berdasarkan keyword

**Request Body (JSON):**
```json
{
  "keyword": "teknologi"
}
```

**Example Request:**
```bash
curl -X POST http://localhost/api/news/search \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{"keyword": "teknologi"}'
```

**Response Success (200):**
```json
{
  "success": true,
  "message": "Search completed successfully",
  "query": "teknologi",
  "count": 3,
  "data": [
    {
      "id": 1,
      "title": "Berita Teknologi...",
      ...
    }
  ]
}
```

**Response Error (422):**
```json
{
  "success": false,
  "message": "Validation failed",
  "errors": {
    "keyword": ["The keyword field is required."]
  }
}
```

---

## HTTP Status Codes

| Code | Meaning |
|------|---------|
| 200 | OK - Request berhasil |
| 201 | Created - Resource berhasil dibuat |
| 400 | Bad Request - Ada kesalahan di request |
| 404 | Not Found - Resource tidak ditemukan |
| 422 | Unprocessable Entity - Validasi gagal |
| 500 | Internal Server Error - Error di server |

---

## Example: Testing dengan Postman

### 1. Import Collection
Buat collection baru dengan requests berikut:

#### GET All News
```
GET http://localhost/api/news
```

#### POST Create News
```
POST http://localhost/api/news
Headers: 
  - Accept: application/json
  - Content-Type: application/x-www-form-urlencoded

Body (form-data):
  - title: "Judul Berita"
  - content: "Konten berita"
  - image: [Upload file]
  - category_id: 1
  - date: 2026-04-05
```

#### PUT Update News
```
PUT http://localhost/api/news/1
Headers:
  - Accept: application/json

Body (form-data):
  - title: "Judul Berita Update"
  - content: "Konten yang diupdate"
  - category_id: 1
  - date: 2026-04-21
```

#### DELETE News
```
DELETE http://localhost/api/news/1
Headers:
  - Accept: application/json
```

---

## File Structure

```
app/
├── Http/
│   └── Controllers/
│       └── Api/
│           └── NewsController.php      (✓ CRUD Controller)
├── Models/
│   └── News.php                        (✓ News Model)
├── Services/
│   └── NewsService.php                 (✓ Business Logic Service)
routes/
└── api.php                             (✓ API Routes)
```

---

## Notes

- Semua image disimpan di `/storage/app/public/news/`
- Pastikan symbolic link sudah dibuat: `php artisan storage:link`
- Slug otomatis di-generate dari title
- Image lama akan dihapus saat ada update dengan image baru
- Semua response menggunakan JSON dengan format `{ success, message, data }`
