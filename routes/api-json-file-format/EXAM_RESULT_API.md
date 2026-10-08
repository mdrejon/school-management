# Exam & Result Synchronization API Documentation

API documentation for synchronizing **Exams** and **Student Results** from external software (ASP.NET / ERP / School Management Software) into the School Management website.

---

## 1. Overview & Endpoints

| Resource | HTTP Method | Endpoint | Description |
| :--- | :--- | :--- | :--- |
| **Exam** | `POST` | `/api/rest-api/v1/exams/insert` | Insert or Upsert Exam |
| **Exam** | `POST` | `/api/rest-api/v1/exams/update` | Update Exam by `external_id` |
| **Exam** | `POST` | `/api/rest-api/v1/exams/delete` | Delete Exam by `external_id` |
| **Exam** | `GET` | `/api/rest-api/v1/exams/list` | List all Exams |
| **Exam** | `GET` | `/api/rest-api/v1/exams/get?external_id={id}` | Get single Exam details |
| **Result** | `POST` | `/api/rest-api/v1/results/insert` | Insert or Upsert Student Result |
| **Result** | `POST` | `/api/rest-api/v1/results/bulk_insert` | Bulk Insert / Upsert Results |
| **Result** | `POST` | `/api/rest-api/v1/results/update` | Update Result by `external_id` |
| **Result** | `POST` | `/api/rest-api/v1/results/delete` | Delete Result & Marksheet PDF |
| **Result** | `GET` | `/api/rest-api/v1/results/list` | List Results with filters |
| **Result** | `GET` | `/api/rest-api/v1/results/get?external_id={id}` | Get single Result by ID or Roll |

### Base URLs
- **Live Server:** `https://skmadrasah.edu.bd`
- **Local Server:** `http://school-management.test` *(or `http://localhost:8000`)*

---

## 2. Request Headers

| Header | Value | Required | Description |
| :--- | :--- | :--- | :--- |
| `Content-Type` | `application/json` | Yes | Specifies request payload format |
| `Accept` | `application/json` | Yes | Ensures JSON responses |

---

## 3. Exam Synchronization

### 3.1 Insert / Upsert Exam Payload
```json
{
    "external_id": "ASP-EXAM-2026-ANNUAL",
    "name": "Annual Examination 2026",
    "code": "ANN-26",
    "academic_year": "2026",
    "is_active": true
}
```

#### Fields:
- `external_id` (string, **Required**): Unique ID from external ASP.NET system.
- `name` (string, **Required**): Examination title (e.g. "Annual Examination 2026", "1st Term").
- `code` (string, *Nullable*): Exam abbreviation or short code.
- `academic_year` (string, *Nullable*): Academic year (e.g. "2026").
- `is_active` (boolean, *Nullable*): Whether this exam is active and visible for results search. Defaults to `true`.

#### Success Response (`201 Created`):
```json
{
    "status": "success",
    "message": "Exam created successfully",
    "data": {
        "laravel_id": 5,
        "external_id": "ASP-EXAM-2026-ANNUAL",
        "name": "Annual Examination 2026",
        "code": "ANN-26",
        "academic_year": "2026",
        "is_active": true
    }
}
```

---

## 4. Result Synchronization

### 4.1 Insert / Upsert Result Payload
```json
{
    "external_id": "ASP-RES-1001",
    "exam_name": "Annual Examination 2026",
    "student_name": "Ahnaf Tahmid",
    "roll_no": "101",
    "registration_no": "REG-2026-101",
    "class_name": "Class 6",
    "section_name": "A",
    "group_name": "General",
    "academic_year": "2026",
    "total_marks": 300,
    "obtained_marks": 265,
    "gpa": 4.85,
    "grade": "A",
    "merit_position": "2nd",
    "status": "PASSED",
    "remarks": "Excellent academic performance",
    "subjects": [
        {
            "code": "101",
            "name": "Bangla 1st Paper",
            "written": 60,
            "mcq": 28,
            "total": 88,
            "grade": "A+",
            "point": 5.0
        },
        {
            "code": "107",
            "name": "English 1st Paper",
            "written": 78,
            "total": 78,
            "grade": "A",
            "point": 4.0
        },
        {
            "code": "109",
            "name": "General Math",
            "written": 70,
            "mcq": 29,
            "total": 99,
            "grade": "A+",
            "point": 5.0
        }
    ],
    "file_name": "transcript_101.pdf",
    "marksheet_base64": "data:application/pdf;base64,JVBERi0xLjQK...",
    "is_published": true
}
```

### 4.2 Result Field Specifications

| Field | Type | Required / Nullable | Description |
| :--- | :--- | :--- | :--- |
| `external_id` | `string` | **Required** | The primary key of the result record in your ASP.NET database. Used for upserting and updating. |
| `roll_no` | `string` | **Required** | Student's class roll number used by students for search. |
| `student_name`| `string` | **Required** | Full name of the student. |
| `class_name` | `string` | **Required** | Class name (e.g. "Class 6", "Class 7"). |
| `exam_name` | `string` | **Required** | Exam name (e.g. "Annual Examination 2026"). Automatically links to matching `global_exams`. |
| `registration_no` | `string` | *Nullable* | Student registration / admission number. |
| `section_name`| `string` | *Nullable* | Section name (e.g. "A", "B"). |
| `group_name` | `string` | *Nullable* | Academic group (e.g. "Science", "General", "Humanities"). |
| `academic_year`| `string` | *Nullable* | Academic session year (e.g. "2026"). |
| `total_marks` | `numeric`| *Nullable* | Total maximum marks of the examination. |
| `obtained_marks`| `numeric`| *Nullable* | Total marks achieved by the student. |
| `gpa` | `numeric`| *Nullable* | Grade Point Average (e.g. `5.00`, `4.85`). |
| `grade` | `string` | *Nullable* | Letter Grade (e.g. `A+`, `A`, `B`, `F`). |
| `merit_position`| `string`| *Nullable* | Position in class / merit list (e.g. `1st`, `2nd`). |
| `status` | `string` | *Nullable* | Result status (`PASSED`, `FAILED`, `WITHHELD`). Defaults to `PASSED`. |
| `remarks` | `string` | *Nullable* | Teacher or institution remarks. |
| `subjects` | `array` | *Nullable* | Array of subject breakdown objects with code, name, written, mcq, total, grade, point. |
| `marksheet_base64` / `file_base64` | `string` | *Nullable* | Base64-encoded PDF of the official signed marksheet. Stored and downloadable directly. |
| `file_name` | `string` | *Nullable* | Optional file name (e.g. `marksheet_101.pdf`). |
| `is_published`| `boolean`| *Nullable* | Whether result is published for public viewing. Defaults to `true`. |

#### Success Response (`201 Created`):
```json
{
    "status": "success",
    "message": "Result created successfully",
    "data": {
        "id": 1,
        "external_id": "ASP-RES-1001",
        "exam_id": 5,
        "exam_name": "Annual Examination 2026",
        "student_name": "Ahnaf Tahmid",
        "roll_no": "101",
        "registration_no": "REG-2026-101",
        "class_id": 1,
        "class_name": "Class 6",
        "section_name": "A",
        "group_name": "General",
        "academic_year": "2026",
        "total_marks": "300.00",
        "obtained_marks": "265.00",
        "gpa": "4.85",
        "grade": "A",
        "merit_position": "2nd",
        "status": "PASSED",
        "remarks": "Excellent academic performance",
        "subjects_data": [ ... ],
        "marksheet_url": "https://skmadrasah.edu.bd/storage/results/marksheets/BUHzsBQ2LTHtygX5.pdf",
        "download_url": "https://skmadrasah.edu.bd/storage/results/marksheets/BUHzsBQ2LTHtygX5.pdf",
        "is_published": true
    }
}
```

---

### 4.3 Bulk Insert Results
**Endpoint:** `POST /api/rest-api/v1/results/bulk_insert`

Allows sending an entire classroom or grade's results in a single HTTP request:

```json
{
    "results": [
        {
            "external_id": "ASP-RES-1001",
            "exam_name": "Annual Examination 2026",
            "student_name": "Ahnaf Tahmid",
            "roll_no": "101",
            "class_name": "Class 6",
            "gpa": 5.0,
            "grade": "A+",
            "subjects": [ ... ]
        },
        {
            "external_id": "ASP-RES-1002",
            "exam_name": "Annual Examination 2026",
            "student_name": "Nabil Hasan",
            "roll_no": "102",
            "class_name": "Class 6",
            "gpa": 4.5,
            "grade": "A",
            "subjects": [ ... ]
        }
    ]
}
```

---

## 5. Public Results Search on Website

Students and guardians can view their official marksheet directly on the website:
- **URL:** `https://skmadrasah.edu.bd/results`
- **Search Parameters:**
  - `exam_id`: Selected from dynamic dropdown of active examinations.
  - `class_id`: Selected from dynamic dropdown of classes.
  - `roll_no`: Student's roll number.
- **Rendered Output:**
  - Official Academic Transcript / Marksheet card with institute header.
  - Student profile information (Name, Roll, Reg, Class, Section, Group).
  - Subject-by-subject marks, letter grade, and grade points table.
  - Total obtained marks, overall GPA, letter grade, and status badge.
  - **"Print"** button (formatted for clean print layout).
  - **"Download Marksheet"** button linking directly to the uploaded PDF.

---

## 6. cURL Examples

### Insert Exam
```bash
curl -X POST "https://skmadrasah.edu.bd/api/rest-api/v1/exams/insert" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "external_id": "ASP-EXAM-2026-ANNUAL",
    "name": "Annual Examination 2026",
    "code": "ANN-26",
    "academic_year": "2026",
    "is_active": true
  }'
```

### Insert Result
```bash
curl -X POST "https://skmadrasah.edu.bd/api/rest-api/v1/results/insert" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "external_id": "ASP-RES-1001",
    "exam_name": "Annual Examination 2026",
    "student_name": "Ahnaf Tahmid",
    "roll_no": "101",
    "class_name": "Class 6",
    "gpa": 5.0,
    "grade": "A+",
    "status": "PASSED"
  }'
```

### Delete Result
```bash
curl -X POST "https://skmadrasah.edu.bd/api/rest-api/v1/results/delete" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{"external_id": "ASP-RES-1001"}'
```

---

## 7. Postman Step-by-Step Flow

### Step 1: Create Exam
1. Method: **`POST`**.
2. URL: `https://skmadrasah.edu.bd/api/rest-api/v1/exams/insert`.
3. Body: `raw` -> `JSON`. Paste content from `routes/api-json-file-format/exams.json`.
4. Click **Send** (`201 Created`).

### Step 2: Insert Student Result
1. Method: **`POST`**.
2. URL: `https://skmadrasah.edu.bd/api/rest-api/v1/results/insert`.
3. Body: `raw` -> `JSON`. Paste content from `routes/api-json-file-format/results.json`.
4. Click **Send** (`201 Created`).

### Step 3: Verify Public Search
1. Open browser: `https://skmadrasah.edu.bd/results`.
2. Select the exam and class you inserted.
3. Enter roll number `101` and click **Search**.
4. The complete academic transcript and marksheet will display.
