# tes News API CRUD

Semua endpoint dapat ditest menggunakan **Postman** atau tools HTTP lainnya.

Base URL: `http://localhost:8000/api`

---

## 1️⃣ GET - Retrieve All News

**Endpoint:** `GET /api/news`

### Postman Setup:
```
Method: GET
URL: http://localhost:8000/api/news
Headers:
  - Accept: application/json
```

### Expected Response (200 OK):
```json
{
  "success": true,
  "message": "News retrieved successfully",
  "data": [
    {
      "id": 7,
      "category_id": 2,
      "title": "halo",
      "slug": "halo",
      "content": "222",
      "image": "news/1grIxemjoNxqQvPfGgz1b9EJeOkBOP7w3i6apcu9.png",
      "date": "2026-04-15T00:00:00.000000Z",
      "created_at": "2026-04-13T17:35:32.000000Z",
      "updated_at": "2026-04-13T17:35:32.000000Z",
      "category": {
        "id": 2,
        "name": "Budaya",
        "slug": "budaya",
        "created_at": "2026-04-05T18:33:32.000000Z",
        "updated_at": "2026-04-05T18:33:32.000000Z"
      }
    },
    {
      "id": 3,
      "category_id": 5,
      "title": "MBAPPE WORLD CUP 2018",
      "slug": "mbappe-world-cup-2018",
      "content": "WORLD CUP 2018",
      "image": "news/oX6c9YDr8enVRY2m9pvENS5PkyvhsM1RxJcr8Ei9.jpg",
      "date": "2026-04-06T00:00:00.000000Z",
      "created_at": "2026-04-05T18:40:04.000000Z",
      "updated_at": "2026-04-05T18:40:04.000000Z",
      "category": {
        "id": 5,
        "name": "Olahraga",
        "slug": "olahraga"
      }
    }
  ]
}
```

---

## 2️⃣ GET - Retrieve Single News (Detail)

**Endpoint:** `GET /api/news/{id}`

### Postman Setup:
```
Method: GET
URL: http://localhost:8000/api/news/7
Headers:
  - Accept: application/json
```

### Expected Response (200 OK):
```json
{
  "success": true,
  "message": "News retrieved successfully",
  "data": {
    "id": 7,
    "category_id": 2,
    "title": "halo",
    "slug": "halo",
    "content": "222",
    "image": "news/1grIxemjoNxqQvPfGgz1b9EJeOkBOP7w3i6apcu9.png",
    "date": "2026-04-15T00:00:00.000000Z",
    "created_at": "2026-04-13T17:35:32.000000Z",
    "updated_at": "2026-04-13T17:35:32.000000Z",
    "category": {
      "id": 2,
      "name": "Budaya",
      "slug": "budaya"
    }
  }
}
```

### Response Error - Not Found (404):
```json
{
  "success": false,
  "message": "News not found"
}
```

---

## 3️⃣ POST - Create News (Store)

**Endpoint:** `POST /api/news`

### Postman Setup:
```
Method: POST
URL: http://localhost:8000/api/news
Headers:
  - Accept: application/json

Body: form-data
  - title: "Berita Terbaru" (Text)
  - content: "Ini adalah konten berita yang sangat menarik dan penting" (Text)
  - category_id: "1" (Text)
  - date: "2026-04-21" (Text)
  - image: (File - upload gambar)
```

### Minimal Request Body (JSON Alternative):
```json
{
  "title": "Berita Terbaru",
  "content": "Ini adalah konten berita yang sangat menarik",
  "category_id": 1,
  "date": "2026-04-21"
}
```

### Expected Response (201 Created):
```json
{
  "success": true,
  "message": "News created successfully",
  "data": {
    "id": 8,
    "title": "Berita Terbaru",
    "slug": "berita-terbaru",
    "content": "Ini adalah konten berita yang sangat menarik",
    "category_id": 1,
    "image": "news/abc123xyz.jpg",
    "date": "2026-04-21",
    "created_at": "2026-04-21T14:30:00.000000Z",
    "updated_at": "2026-04-21T14:30:00.000000Z",
    "category": {
      "id": 1,
      "name": "Teknologi",
      "slug": "teknologi"
    }
  }
}
```

### Response Error - Validation (422):
```json
{
  "success": false,
  "message": "Validation failed",
  "errors": {
    "title": ["The title field is required."],
    "image": ["The image must be an image."],
    "category_id": ["The selected category_id is invalid."]
  }
}
```

---

## 4️⃣ PUT - Update News

**Endpoint:** `PUT /api/news/{id}`

### Postman Setup:
```
Method: PUT
URL: http://localhost:8000/api/news/8
Headers:
  - Accept: application/json

Body: form-data
  - title: "Berita yang Sudah Diupdate" (Text)
  - content: "Konten yang sudah diubah" (Text)
  - category_id: "2" (Text)
  - date: "2026-04-21" (Text)
  - image: (File - opsional, jika ingin ganti gambar)
```

### Alternative: Update tanpa ganti image (hanya update text)
```json
{
  "title": "Berita yang Sudah Diupdate",
  "content": "Konten yang sudah diubah",
  "category_id": 2,
  "date": "2026-04-21"
}
```

### Expected Response (200 OK):
```json
{
  "success": true,
  "message": "News updated successfully",
  "data": {
    "id": 8,
    "title": "Berita yang Sudah Diupdate",
    "slug": "berita-yang-sudah-diupdate",
    "content": "Konten yang sudah diubah",
    "category_id": 2,
    "image": "news/abc123xyz.jpg",
    "date": "2026-04-21",
    "created_at": "2026-04-21T14:30:00.000000Z",
    "updated_at": "2026-04-21T15:45:00.000000Z",
    "category": {
      "id": 2,
      "name": "Budaya",
      "slug": "budaya"
    }
  }
}
```

### Response Error - Not Found (404):
```json
{
  "success": false,
  "message": "News not found"
}
```

### Response Error - Validation (422):
```json
{
  "success": false,
  "message": "Validation failed",
  "errors": {
    "title": ["The title field is required."],
    "category_id": ["The selected category_id is invalid."]
  }
}
```

---

## 5️⃣ DELETE - Delete News

**Endpoint:** `DELETE /api/news/{id}`

### Postman Setup:
```
Method: DELETE
URL: http://localhost:8000/api/news/8
Headers:
  - Accept: application/json
Body: (Empty)
```

### Expected Response (200 OK):
```json
{
  "success": true,
  "message": "News deleted successfully"
}
```

### Response Error - Not Found (404):
```json
{
  "success": false,
  "message": "News not found"
}
```

---

## 📋 Testing Checklist

### ✅ GET Testing
- [ ] GET /api/news - Status 200 ✅
- [ ] GET /api/news/7 - Status 200 ✅
- [ ] GET /api/news/999 (ID tidak ada) - Status 404

### ✅ POST Testing (Create)
- [ ] POST /api/news dengan data lengkap - Status 201
- [ ] POST /api/news tanpa title - Status 422
- [ ] POST /api/news tanpa image - Status 422
- [ ] POST /api/news dengan category_id invalid - Status 422

### ✅ PUT Testing (Update)
- [ ] PUT /api/news/8 update title - Status 200
- [ ] PUT /api/news/8 update image - Status 200
- [ ] PUT /api/news/999 (ID tidak ada) - Status 404
- [ ] PUT /api/news/8 data invalid - Status 422

### ✅ DELETE Testing
- [ ] DELETE /api/news/8 - Status 200
- [ ] DELETE /api/news/999 (ID tidak ada) - Status 404

---

## 🔍 Bonus Endpoints

### Filter by Category
```
GET /api/news/category/2
Headers:
  - Accept: application/json
```

Response:
```json
{
  "success": true,
  "message": "News retrieved successfully",
  "data": [
    {
      "id": 7,
      "category_id": 2,
      "title": "halo",
      ...
    }
  ]
}
```

### Search News
```
POST /api/news/search
Headers:
  - Content-Type: application/json
  - Accept: application/json

Body:
{
  "keyword": "halo"
}
```

Response:
```json
{
  "success": true,
  "message": "Search completed successfully",
  "query": "halo",
  "count": 1,
  "data": [
    {
      "id": 7,
      "title": "halo",
      ...
    }
  ]
}
```

---

## 📸 How to Test in Postman

### Step 1: Create Collection
1. Open Postman
2. Click **"+"** → **Create New Collection**
3. Name it: **"News API CRUD"**

### Step 2: Add Requests
1. Click **"Add request"** in collection
2. Set Method, URL, Headers
3. Click **"Send"**
4. View response in "Response" tab

### Step 3: Save Requests
- All requests automatically saved in collection
- Can re-use and modify for different testing

### Step 4: Use Variables (Optional)
Create environment variable:
```
base_url = http://localhost:8000/api
news_id = 7
```

Then use in requests:
```
{{base_url}}/news
{{base_url}}/news/{{news_id}}
```

---

## 🎯 Response Status Codes

| Code | Meaning | Example |
|------|---------|---------|
| 200 | OK | GET, PUT, DELETE berhasil |
| 201 | Created | POST berhasil membuat resource baru |
| 400 | Bad Request | Format request salah |
| 404 | Not Found | Resource tidak ditemukan |
| 422 | Unprocessable Entity | Validasi data gagal |
| 500 | Server Error | Error di server |

---

## 💡 Tips Testing

1. **Gunakan Headers yang Tepat**
   - `Accept: application/json` untuk semua request
   - `Content-Type: application/json` untuk JSON body

2. **Test Error Cases**
   - Jangan hanya test yang sukses
   - Test dengan ID yang tidak ada
   - Test dengan data invalid

3. **Save Test Results**
   - Screenshot atau export response
   - Dokumentasikan hasil testing

4. **Test Urutan**
   - GET data existing (tidak ada side effect)
   - POST data baru
   - GET untuk verify
   - PUT update data
   - DELETE untuk cleanup

5. **Verify Image Upload**
   - Upload image file yang berbeda
   - Check storage folder: `storage/app/public/news/`
   - Verify old image di-delete saat update
