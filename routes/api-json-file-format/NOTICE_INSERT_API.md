# Notice Insert & Sync API Documentation

API documentation for synchronizing, inserting, updating, deleting, and downloading notices from external software (ASP.NET / ERP / School Management Software) into the School Management website.

---

## 1. Endpoint Details

| Property | Value |
| :--- | :--- |
| **HTTP Method** | `POST` *(or `GET` for list and get)* |
| **Live API URL** | `https://skmadrasah.edu.bd/api/rest-api/v1/notices/{action}` |
| **Local API URL** | `http://school-management.test/api/rest-api/v1/notices/{action}` <br>*(or `http://localhost:8000/api/rest-api/v1/notices/{action}`)* |
| **Controller** | `App\Http\Controllers\Api\SyncController@handleRequest` |

### Available Endpoints:
- **Insert / Upsert:** `POST /api/rest-api/v1/notices/insert`
- **Update:** `POST /api/rest-api/v1/notices/update`
- **Delete:** `POST /api/rest-api/v1/notices/delete`
- **Get Single Notice:** `GET` or `POST` `/api/rest-api/v1/notices/get?external_id={id}`
- **List Notices:** `GET /api/rest-api/v1/notices/list`

---

## 2. Request Headers

| Header | Value | Required | Description |
| :--- | :--- | :--- | :--- |
| `Content-Type` | `application/json` | Yes | Specifies request payload format |
| `Accept` | `application/json` | Yes | Ensures JSON responses |

---

## 3. Request Body (Sample Payload for Insert / Upsert)

```json
{
    "external_id": "ASP-NET-NOTICE-1001",
    "published_at": "2026-10-07",
    "is_active": true,
    "title": {
        "en": "Annual Examination 2026 Routine & Instructions",
        "bn": "বার্ষিক পরীক্ষা ২০২৬ এর সময়সূচী ও নির্দেশনাবলী"
    },
    "description": {
        "en": "<p>The annual examination for all classes will commence from November 15, 2026. Please download the attached routine PDF for details.</p>",
        "bn": "<p>সকল শ্রেণির বার্ষিক পরীক্ষা আগামী ১৫ নভেম্বর ২০২৬ থেকে অনুষ্ঠিত হবে। বিস্তারিত জানতে সংযুক্ত রুটিন পিডিএফ ডাউনলোড করুন।</p>"
    },
    "file_name": "exam_routine_2026.pdf",
    "file_base64": "data:application/pdf;base64,JVBERi0xLjQKJcTl8uXrp/Og0MTGCjQgMCBvYmoKPDwKL1R5cGUgL1BhZ2VzCi9Db3VudCAxCj4+CmVuZG9iagoxIDAgb2JqCjw8Ci9UeXBlIC9DYXRhbG9nCi9QYWdlcyA0IDAgUgo+PgplbmRvYmoKMyAwIG9iago8PAovTGVuZ3RoIDQ0Cj4+CnN0cmVhbQpCVAovRjEgMTIgVGYKNzIgNzEyIFRECihoZWxsbykgVGoKRVQKZW5kc3RyZWFtCmVuZG9iago1IDAgb2JqCjw8Ci9UeXBlIC9QYWdlCi9QYXJlbnQgNCAwIFIKL01lZGlhQm94IFswIDAgNjEyIDc5Ml0KL0NvbnRlbnRzIDMgMCBSCj4+CmVuZG9iagp4cmVmCjAgNgowMDAwMDAwMDAwIDY1NTM1IGYgCjAwMDAwMDAwNjggMDAwMDAgbiAKMDAwMDAwMDAwMCA2NTUzNSBmIAowMDAwMDAwMTE3IDAwMDAwIG4gCjAwMDAwMDAwMTUgMDAwMDAgbiAKMDAwMDAwMDIxMiAwMDAwMCBuIAp0cmFpbGVyCjw8Ci9TaXplIDYKL1Jvb3QgMSAwIFIKPj4Kc3RhcnR4cmVmCjMwOQolJUVPRgo="
}
```

---

## 4. Field Specifications & Rules

| Field | Type | Required / Nullable | Description |
| :--- | :--- | :--- | :--- |
| `external_id` | `string` | **Required** | The unique identifier in the external ASP.NET/ERP database. Used for matching, upserting, updating, and deleting. |
| `title` | `object` \| `string` | **Required** | Translatable notice title. Can be an object `{"en": "...", "bn": "..."}` or a single string. At least one language must not be empty. |
| `title.bn` | `string` | **Nullable** | Bengali title. |
| `title.en` | `string` | **Nullable** | English title. |
| `description` | `object` \| `string` | **Nullable** | Translatable notice body / details (HTML or plain text). Can be `{"en": "...", "bn": "..."}`. |
| `published_at`| `string` | **Nullable** | Publication date in `YYYY-MM-DD` format (e.g. `2026-10-07`). If omitted during insert, defaults to today's date. |
| `is_active` | `boolean` | **Nullable** | Notice active status (`true` or `false`). Defaults to `true` if omitted. |
| `file_base64` / `pdf_base64` | `string` | **Nullable** | Base64-encoded PDF or document attachment (e.g. `data:application/pdf;base64,...`). Stored in public disk and accessible via direct download URL. |
| `file_name` | `string` | **Nullable** | Optional file name with extension (e.g. `routine.pdf`). Used to preserve file extension. |
| `remove_file` | `boolean` | **Nullable** | Set to `true` in Update endpoint to delete existing file attachment. |

> **Upsert Note:** If `external_id` already exists, calling `insert` will automatically update the existing record instead of creating duplicates.

---

## 5. Endpoints & Responses

### 5.1 Insert / Upsert Notice
**Endpoint:** `POST /api/rest-api/v1/notices/insert`

#### Success Response (`201 Created`)
```json
{
    "status": "success",
    "message": "Notice created successfully",
    "data": {
        "laravel_id": 4,
        "external_id": "ASP-NET-NOTICE-1001",
        "slug": "annual-examination-2026-routine-instructions",
        "title": {
            "en": "Annual Examination 2026 Routine & Instructions",
            "bn": "বার্ষিক পরীক্ষা ২০২৬ এর সময়সূচী ও নির্দেশনাবলী"
        },
        "published_at": "2026-10-07",
        "pdf_url": "https://skmadrasah.edu.bd/storage/notices/XREML8oqGFDZotyV.pdf",
        "download_url": "https://skmadrasah.edu.bd/storage/notices/XREML8oqGFDZotyV.pdf",
        "is_active": true
    }
}
```

### 5.2 Update Notice
**Endpoint:** `POST /api/rest-api/v1/notices/update`

#### Request Body
```json
{
    "external_id": "ASP-NET-NOTICE-1001",
    "title": {
        "en": "Updated Annual Examination 2026 Routine",
        "bn": "হালনাগাদ বার্ষিক পরীক্ষা ২০২৬ এর সময়সূচী"
    },
    "is_active": true
}
```

#### Success Response (`200 OK`)
```json
{
    "status": "success",
    "message": "Notice updated successfully",
    "data": {
        "laravel_id": 4,
        "external_id": "ASP-NET-NOTICE-1001",
        "slug": "annual-examination-2026-routine-instructions",
        "title": {
            "en": "Updated Annual Examination 2026 Routine",
            "bn": "হালনাগাদ বার্ষিক পরীক্ষা ২০২৬ এর সময়সূচী"
        },
        "published_at": "2026-10-07",
        "pdf_url": "https://skmadrasah.edu.bd/storage/notices/XREML8oqGFDZotyV.pdf",
        "download_url": "https://skmadrasah.edu.bd/storage/notices/XREML8oqGFDZotyV.pdf",
        "is_active": true
    }
}
```

### 5.3 Delete Notice
**Endpoint:** `POST /api/rest-api/v1/notices/delete`

#### Request Body
```json
{
    "external_id": "ASP-NET-NOTICE-1001"
}
```

#### Success Response (`200 OK`)
```json
{
    "status": "success",
    "message": "Notice deleted successfully",
    "data": {
        "external_id": "ASP-NET-NOTICE-1001"
    }
}
```
*(Notice record and its attached file are permanently removed from the server.)*

### 5.4 Get Single Notice
**Endpoint:** `GET` or `POST` `/api/rest-api/v1/notices/get?external_id=ASP-NET-NOTICE-1001`

#### Success Response (`200 OK`)
```json
{
    "status": "success",
    "data": {
        "id": 4,
        "external_id": "ASP-NET-NOTICE-1001",
        "slug": "annual-examination-2026-routine-instructions",
        "title": {
            "en": "Annual Examination 2026 Routine & Instructions",
            "bn": "বার্ষিক পরীক্ষা ২০২৬ এর সময়সূচী ও নির্দেশনাবলী"
        },
        "description": {
            "en": "<p>Exam instructions...</p>",
            "bn": "<p>পরীক্ষার নির্দেশনা...</p>"
        },
        "pdf": "notices/XREML8oqGFDZotyV.pdf",
        "published_at": "2026-10-07T00:00:00.000000Z",
        "is_active": true,
        "pdf_url": "https://skmadrasah.edu.bd/storage/notices/XREML8oqGFDZotyV.pdf",
        "download_url": "https://skmadrasah.edu.bd/storage/notices/XREML8oqGFDZotyV.pdf"
    }
}
```

### 5.5 List Notices
**Endpoint:** `GET /api/rest-api/v1/notices/list`

#### Success Response (`200 OK`)
```json
{
    "status": "success",
    "data": [
        {
            "id": 4,
            "external_id": "ASP-NET-NOTICE-1001",
            "slug": "annual-examination-2026-routine-instructions",
            "title": {
                "en": "Annual Examination 2026 Routine & Instructions",
                "bn": "বার্ষিক পরীক্ষা ২০২৬ এর সময়সূচী ও নির্দেশনাবলী"
            },
            "pdf_url": "https://skmadrasah.edu.bd/storage/notices/XREML8oqGFDZotyV.pdf",
            "download_url": "https://skmadrasah.edu.bd/storage/notices/XREML8oqGFDZotyV.pdf",
            "published_at": "2026-10-07T00:00:00.000000Z",
            "is_active": true
        }
    ]
}
```

---

## 6. File Download Handling

1. Notice attachments (PDFs, docs) uploaded via `file_base64` or multipart are stored under `storage/app/public/notices/`.
2. The response always returns `download_url` and `pdf_url` with the full absolute URL:
   `https://skmadrasah.edu.bd/storage/notices/{filename}.pdf`
3. Any HTTP client or browser can directly download or view the file using this URL.
4. On deleting a notice (`POST /notices/delete`), the attached file is automatically cleaned up from disk.
5. On updating with a new file, the old file is safely removed and replaced with the new file.

---

## 7. cURL Examples

### Insert Notice
```bash
curl -X POST "https://skmadrasah.edu.bd/api/rest-api/v1/notices/insert" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "external_id": "ASP-NET-NOTICE-1001",
    "published_at": "2026-10-07",
    "is_active": true,
    "title": {
        "en": "Holiday Notice",
        "bn": "ছুটির নোটিশ"
    },
    "description": {
        "en": "School will remain closed.",
        "bn": "বিদ্যালয় বন্ধ থাকবে।"
    }
}'
```

### Update Notice
```bash
curl -X POST "https://skmadrasah.edu.bd/api/rest-api/v1/notices/update" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "external_id": "ASP-NET-NOTICE-1001",
    "title": {
        "bn": "সংশোধিত ছুটির নোটিশ"
    }
}'
```

### Delete Notice
```bash
curl -X POST "https://skmadrasah.edu.bd/api/rest-api/v1/notices/delete" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{"external_id": "ASP-NET-NOTICE-1001"}'
```

---

## 8. Postman Testing Flow

### Step 1: Insert Notice
1. Open Postman and click **New Request**.
2. Select Method: **`POST`**.
3. URL: `https://skmadrasah.edu.bd/api/rest-api/v1/notices/insert` *(or `http://localhost:8000/api/rest-api/v1/notices/insert` for local testing)*.
4. In **Headers** tab:
   - `Content-Type`: `application/json`
   - `Accept`: `application/json`
5. In **Body** tab:
   - Select **raw**
   - In the dropdown (right side), select **JSON**
   - Paste the sample JSON payload from Section 3 or `routes/api-json-file-format/notices.json`.
6. Click **Send**.
7. **Expected Result:** `201 Created` with `pdf_url` and `download_url`.

### Step 2: Test Download URL
1. Copy the `download_url` from the response.
2. Open a browser tab or Postman GET request.
3. Verify that the file opens or downloads properly.

### Step 3: Update Notice
1. Create a new **POST** request.
2. URL: `https://skmadrasah.edu.bd/api/rest-api/v1/notices/update`.
3. In **Body** (raw -> JSON):
   ```json
   {
       "external_id": "ASP-NET-NOTICE-1001",
       "title": {
           "bn": "হালনাগাদ বার্ষিক পরীক্ষা নোটিশ"
       }
   }
   ```
4. Click **Send**. Status `200 OK`.

### Step 4: Verify in List
1. Create a new **GET** request.
2. URL: `https://skmadrasah.edu.bd/api/rest-api/v1/notices/list`.
3. Click **Send**. Verify the notice is present in the list.

### Step 5: Delete Notice
1. Create a new **POST** request.
2. URL: `https://skmadrasah.edu.bd/api/rest-api/v1/notices/delete`.
3. In **Body** (raw -> JSON):
   ```json
   {
       "external_id": "ASP-NET-NOTICE-1001"
   }
   ```
4. Click **Send**. Status `200 OK`. Notice and attached PDF are deleted.

---

## 9. Common Errors & Troubleshooting

### Error: `"The external id field is required"` & `"The title field is required"`
- **Cause 1:** HTTP method set to `GET` instead of `POST`. Postman discards request body on `GET`.
- **Cause 2:** In Postman **Body** tab, format was left as **`Text`** instead of **`JSON`**.
- **Fix:** Set method to **`POST`**, Body to **raw**, select **`JSON`** from the dropdown, and ensure the body is not empty.
