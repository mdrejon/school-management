# ASP.NET to Laravel API Integration Guide (Master Guide)

Complete documentation for the ASP.NET development team to synchronize Teacher, Notice, Exam, and Student Result data with the School Management Laravel application.

---

## 1. Overview & Architecture

All API endpoints follow a unified RESTful routing strategy:
`POST {site_url}/api/rest-api/v1/{module}/{action}`

### Supported Modules & Actions:

| Module | Available Actions | Documentation & Sample Payload |
| :--- | :--- | :--- |
| **`teachers`** | `insert`, `update`, `delete`, `list`, `get` | [`TEACHER_INSERT_API.md`](file:///d:/laragon-new/laragon/www/school-management/routes/api-json-file-format/TEACHER_INSERT_API.md) \| [`teachers.json`](file:///d:/laragon-new/laragon/www/school-management/routes/api-json-file-format/teachers.json) |
| **`notices`** | `insert`, `update`, `delete`, `list`, `get` | [`NOTICE_INSERT_API.md`](file:///d:/laragon-new/laragon/www/school-management/routes/api-json-file-format/NOTICE_INSERT_API.md) \| [`notices.json`](file:///d:/laragon-new/laragon/www/school-management/routes/api-json-file-format/notices.json) |
| **`exams`** | `insert`, `update`, `delete`, `list`, `get` | [`EXAM_RESULT_API.md`](file:///d:/laragon-new/laragon/www/school-management/routes/api-json-file-format/EXAM_RESULT_API.md) \| [`exams.json`](file:///d:/laragon-new/laragon/www/school-management/routes/api-json-file-format/exams.json) |
| **`results`** | `insert`, `bulk_insert`, `update`, `delete`, `list`, `get` | [`EXAM_RESULT_API.md`](file:///d:/laragon-new/laragon/www/school-management/routes/api-json-file-format/EXAM_RESULT_API.md) \| [`results.json`](file:///d:/laragon-new/laragon/www/school-management/routes/api-json-file-format/results.json) |

### Key Principles:
1. **Primary Key Mapping via `external_id`:**
   Every record in each module must have an `external_id` from your ASP.NET database. This ensures 100% accurate upserting without duplicate entries.
2. **Upsert Behavior:**
   Calling the `insert` endpoint with an `external_id` that already exists safely updates the existing record instead of throwing a duplicate entry error.
3. **Binary / File Attachments via Base64:**
   - Teacher Photos: `photo_base64`
   - Notice Documents: `file_base64` / `pdf_base64`
   - Exam Marksheets: `marksheet_base64` / `pdf_base64`
   Files are securely stored on disk and direct download URLs (`download_url`) are automatically returned.
4. **Physical File Cleanup on Delete:**
   When deleting any teacher, notice, or result, associated stored media files are automatically removed from disk.

---

## 2. Request Headers

```http
Authorization: Bearer YOUR_SECRET_TOKEN
Content-Type: application/json
Accept: application/json
```

---

## 3. Quick Reference by Module

### 3.1 Teachers Module
- **Insert:** `POST /api/rest-api/v1/teachers/insert`
- **Update:** `POST /api/rest-api/v1/teachers/update`
- **Delete:** `POST /api/rest-api/v1/teachers/delete`
- **List:** `GET /api/rest-api/v1/teachers/list`

### 3.2 Notices Module
- **Insert:** `POST /api/rest-api/v1/notices/insert`
- **Update:** `POST /api/rest-api/v1/notices/update`
- **Delete:** `POST /api/rest-api/v1/notices/delete`
- **List:** `GET /api/rest-api/v1/notices/list`

### 3.3 Exams Module
- **Insert:** `POST /api/rest-api/v1/exams/insert`
- **Update:** `POST /api/rest-api/v1/exams/update`
- **Delete:** `POST /api/rest-api/v1/exams/delete`
- **List:** `GET /api/rest-api/v1/exams/list`

### 3.4 Results Module
- **Insert (Single):** `POST /api/rest-api/v1/results/insert`
- **Insert (Bulk):** `POST /api/rest-api/v1/results/bulk_insert`
- **Update:** `POST /api/rest-api/v1/results/update`
- **Delete:** `POST /api/rest-api/v1/results/delete`
- **List:** `GET /api/rest-api/v1/results/list`
- **Get:** `GET /api/rest-api/v1/results/get?external_id={id}` or `?roll_no={roll}&exam_id={exam}`

---

## 4. Public Web Interfaces

- **Notices Board:** `/notices`
- **Teachers Directory:** `/teachers`
- **Public Results Search:** `/results` (Allows students and guardians to query results by Exam, Class, and Roll Number, view complete academic transcripts, print marksheet cards, and download attached PDF transcripts).
