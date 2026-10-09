# Student Sync & Multi-Language CRUD API Documentation

Comprehensive API documentation for synchronizing, inserting, updating, deleting, and fetching student data with full **multi-language (`en` / `bn`)** support based on the system's translation standard (matching Teacher API).

---

## 1. Endpoint Overview

| Action | HTTP Method | Live Endpoint (`https://eduex.hostdivine.com`) | Local Endpoint |
| :--- | :--- | :--- | :--- |
| **Insert / Upsert** | `POST` | `https://eduex.hostdivine.com/api/rest-api/v1/students/insert` | `http://localhost:8000/api/rest-api/v1/students/insert` |
| **Bulk Insert / Sync** | `POST` | `https://eduex.hostdivine.com/api/rest-api/v1/students/bulk_insert` | `http://localhost:8000/api/rest-api/v1/students/bulk_insert` |
| **Update / Edit** | `POST` | `https://eduex.hostdivine.com/api/rest-api/v1/students/update` | `http://localhost:8000/api/rest-api/v1/students/update` |
| **Delete** | `POST` | `https://eduex.hostdivine.com/api/rest-api/v1/students/delete` | `http://localhost:8000/api/rest-api/v1/students/delete` |
| **Get Single Student** | `GET` \| `POST` | `https://eduex.hostdivine.com/api/rest-api/v1/students/get` | `http://localhost:8000/api/rest-api/v1/students/get` |
| **List Students** | `GET` \| `POST` | `https://eduex.hostdivine.com/api/rest-api/v1/students/list` | `http://localhost:8000/api/rest-api/v1/students/list` |

*Controller:* `App\Http\Controllers\Api\SyncController@handleRequest`

---

## 2. Request Headers

| Header | Value | Required | Description |
| :--- | :--- | :--- | :--- |
| `Content-Type` | `application/json` | Yes | Specifies request payload format |
| `Accept` | `application/json` | Yes | Ensures JSON responses |

---

## 3. Request Body (Multi-Language Sample Payload)

You can pass multi-language translation objects (`{"en": "...", "bn": "..."}`) or plain strings. Translatable fields include `name`, `first_name`, `last_name`, `father_name`, `mother_name`, `guardian_name`, `address`, and `guardian_address`.

```json
{
    "external_id": "STU-2026-1001",
    
    "name": {
        "en": "Tanvir Ahmed",
        "bn": "তানভীর আহমেদ"
    },
    "first_name": {
        "en": "Tanvir",
        "bn": "তানভীর"
    },
    "last_name": {
        "en": "Ahmed",
        "bn": "আহমেদ"
    },
    
    "father_name": {
        "en": "Abdur Rahman",
        "bn": "আব্দুর রহমান"
    },
    "mother_name": {
        "en": "Fatema Begum",
        "bn": "ফাতেমা বেগম"
    },
    "guardian_name": {
        "en": "Abdur Rahman",
        "bn": "আব্দুর রহমান"
    },
    "guardian_relationship": "Father",
    "guardian_phone": "01712345678",
    "guardian_email": "rahman@example.com",
    
    "address": {
        "en": "House 12, Road 4, Sector 7, Uttara, Dhaka",
        "bn": "বাড়ি ১২, রোড ৪, সেক্টর ৭, উত্তরা, ঢাকা"
    },
    "guardian_address": {
        "en": "House 12, Road 4, Sector 7, Uttara, Dhaka",
        "bn": "বাড়ি ১২, রোড ৪, সেক্টর ৭, উত্তরা, ঢাকা"
    },
    
    "roll_no": "101",
    "registration_no": "REG-2026-8801",
    "admission_number": "ADM-2026-015",
    "class_name": "Class 8",
    "section_name": "A",
    "group": "Science",
    "gender": "Male",
    "blood_group": "A+",
    "religion": "Islam",
    
    "status": "approved",
    "email": "tanvir.student@example.com",
    "password": "Password123",
    "picture": ""
}
```

---

## 4. Multi-Language Field Specifications

### A. Translatable Object Fields (English & Bengali)

Like the Teacher API, translatable fields can be sent as an object containing `en` and/or `bn`:

| Field | Type | Required / Nullable | Description |
| :--- | :--- | :--- | :--- |
| `name` | `object` \| `string` | **Nullable** | Translatable full name object (e.g. `{"en": "Tanvir Ahmed", "bn": "তানভীর আহমেদ"}`). Automatically splits into first and last name if `first_name` is omitted. |
| `first_name` | `object` \| `string` | **Nullable** | Translatable first name (e.g. `{"en": "Tanvir", "bn": "তানভীর"}`). |
| `last_name` | `object` \| `string` | **Nullable** | Translatable last name (e.g. `{"en": "Ahmed", "bn": "আহমেদ"}`). |
| `father_name` | `object` \| `string` | **Nullable** | Father's name in `{"en": "...", "bn": "..."}` or string. |
| `mother_name` | `object` \| `string` | **Nullable** | Mother's name in `{"en": "...", "bn": "..."}` or string. |
| `guardian_name` | `object` \| `string` | **Nullable** | Guardian's name in `{"en": "...", "bn": "..."}` or string. |
| `address` | `object` \| `string` | **Nullable** | Student's address in `{"en": "...", "bn": "..."}` or string. |
| `guardian_address` | `object` \| `string` | **Nullable** | Guardian's address in `{"en": "...", "bn": "..."}` or string. |

> **Note on Languages:** If only one language is available (e.g. only `"bn"` or only `"en"`), you can pass `""` or omit the missing language. If plain strings are provided, the system accepts them seamlessly as well.

---

### B. Standard Fields

| Field | Type | Required / Nullable | Description |
| :--- | :--- | :--- | :--- |
| `external_id` | `string` | **Required** | The unique identifier in the external software (ASP.NET / ERP). Used for upserting and cross-system matching. |
| `roll_no` | `string` | **Nullable** | Class roll number (e.g., `"101"`). |
| `registration_no` | `string` | **Nullable** | Board or institutional registration number. |
| `admission_number`| `string` | **Nullable** | Admission register number. |
| `class_name` | `string` | **Nullable** | Academic class name (e.g., `"Class 8"`). Automatically resolves to `class_id`. |
| `class_id` | `integer` | **Nullable** | Local database class ID if known. |
| `section_name` | `string` | **Nullable** | Section name (e.g., `"A"`). Automatically resolves to `section_id`. |
| `section_id` | `integer` | **Nullable** | Local database section ID if known. |
| `group` | `string` | **Nullable** | Academic stream/group (e.g., `"Science"`, `"Humanities"`, `"Business Studies"`). |
| `gender` | `string` | **Nullable** | `"Male"`, `"Female"`, or `"Other"`. |
| `blood_group` | `string` | **Nullable** | `"A+"`, `"B+"`, `"O+"`, `"AB+"`, `"A-"`, `"B-"`, `"O-"`, `"AB-"`. |
| `religion` | `string` | **Nullable** | `"Islam"`, `"Hinduism"`, `"Christianity"`, `"Buddhism"`, etc. |
| `guardian_relationship` | `string` | **Nullable** | `"Father"`, `"Mother"`, `"Uncle"`, `"Brother"`, etc. |
| `guardian_phone` | `string` | **Nullable** | Guardian's contact telephone / mobile number. |
| `guardian_email` | `string` | **Nullable** | Guardian's email address. |
| `status` | `string` | **Nullable** | `"approved"` or `"pending"`. Defaults to `"approved"`. |
| `picture` / `photo` | `string` | **Nullable** | Base64-encoded image (`data:image/jpeg;base64,...`) or storage image path. |
| `email` | `string` | **Nullable** | Optional student email address. If passed, automatically generates or links a student portal user login account. |
| `password` | `string` | **Nullable** | Password for user account (defaults to `"12345678"` if `email` is supplied). |

---

## 5. Flow 1: Add / Insert Student (with Auto-Upsert)

Calling `/insert` checks whether a record with `external_id` already exists:
- If it **does not exist**, a new student is **created** (`201 Created`).
- If it **already exists**, the existing student is **automatically updated** (`200 OK`).

### Endpoint
`POST https://eduex.hostdivine.com/api/rest-api/v1/students/insert`

### Success Response (`201 Created`)
```json
{
    "status": "success",
    "message": "Student created successfully",
    "data": {
        "id": 15,
        "external_id": "STU-2026-1001",
        "first_name": {
            "en": "Tanvir",
            "bn": "তানভীর"
        },
        "last_name": {
            "en": "Ahmed",
            "bn": "আহমেদ"
        },
        "father_name": {
            "en": "Abdur Rahman",
            "bn": "আব্দুর রহমান"
        },
        "mother_name": {
            "en": "Fatema Begum",
            "bn": "ফাতেমা বেগম"
        },
        "guardian_name": {
            "en": "Abdur Rahman",
            "bn": "আব্দুর রহমান"
        },
        "address": {
            "en": "House 12, Road 4, Sector 7, Uttara, Dhaka",
            "bn": "বাড়ি ১২, রোড ৪, সেক্টর ৭, উত্তরা, ঢাকা"
        },
        "roll_no": "101",
        "registration_no": "REG-2026-8801",
        "class_id": 3,
        "section_id": 5,
        "status": "approved",
        "picture": null,
        "academic_class": {
            "id": 3,
            "name": "Class 8"
        },
        "section": {
            "id": 5,
            "name": "A"
        }
    }
}
```

---

## 6. Flow 2: Bulk Insert / Batch Sync

Sync a list of students in a single request.

### Endpoint
`POST https://eduex.hostdivine.com/api/rest-api/v1/students/bulk_insert`

### Request Payload
```json
{
    "students": [
        {
            "external_id": "STU-2026-1001",
            "name": {
                "en": "Tanvir Ahmed",
                "bn": "তানভীর আহমেদ"
            },
            "roll_no": "101",
            "class_name": "Class 8",
            "section_name": "A",
            "guardian_phone": "01712345678",
            "status": "approved"
        },
        {
            "external_id": "STU-2026-1002",
            "name": {
                "en": "Nafisa Islam",
                "bn": "নাফিসা ইসলাম"
            },
            "roll_no": "102",
            "class_name": "Class 8",
            "section_name": "A",
            "guardian_phone": "01812345678",
            "status": "approved"
        }
    ]
}
```

### Success Response (`200 OK`)
```json
{
    "status": "success",
    "message": "Bulk student sync completed: 2 inserted, 0 updated.",
    "total_received": 2,
    "inserted": 2,
    "updated": 0,
    "errors": []
}
```

---

## 7. Flow 3: Update / Edit Student

Updates specific fields of an existing student. Matches by `external_id` (recommended) or internal database `id`.

### Endpoint
`POST https://eduex.hostdivine.com/api/rest-api/v1/students/update`

### Request Payload
```json
{
    "external_id": "STU-2026-1001",
    "roll_no": "105",
    "section_name": "B",
    "guardian_name": {
        "en": "Abdur Rahman",
        "bn": "আব্দুর রহমান"
    },
    "guardian_phone": "01999999999",
    "status": "approved"
}
```

### Success Response (`200 OK`)
```json
{
    "status": "success",
    "message": "Student updated successfully",
    "data": {
        "id": 15,
        "external_id": "STU-2026-1001",
        "roll_no": "105",
        "class_id": 3,
        "section_id": 6,
        "guardian_phone": "01999999999"
    }
}
```

---

## 8. Flow 4: Delete Student

Permanently deletes a student record and removes their uploaded photo from disk.

### Endpoint
`POST https://eduex.hostdivine.com/api/rest-api/v1/students/delete`

### Request Payload
```json
{
    "external_id": "STU-2026-1001"
}
```

### Success Response (`200 OK`)
```json
{
    "status": "success",
    "message": "Student deleted successfully",
    "data": {
        "external_id": "STU-2026-1001",
        "id": 15
    }
}
```

---

## 9. Flow 5: Get Single Student Details

Retrieve full multi-language details of a student by `external_id`, database `id`, or `roll_no` + `class_id`.

### Endpoint
`GET` or `POST https://eduex.hostdivine.com/api/rest-api/v1/students/get`

### Example Request
```
GET https://eduex.hostdivine.com/api/rest-api/v1/students/get?external_id=STU-2026-1001
```

### Success Response (`200 OK`)
```json
{
    "status": "success",
    "data": {
        "id": 15,
        "external_id": "STU-2026-1001",
        "first_name": {
            "en": "Tanvir",
            "bn": "তানভীর"
        },
        "last_name": {
            "en": "Ahmed",
            "bn": "আহমেদ"
        },
        "father_name": {
            "en": "Abdur Rahman",
            "bn": "আব্দুর রহমান"
        },
        "mother_name": {
            "en": "Fatema Begum",
            "bn": "ফাতেমা বেগম"
        },
        "guardian_name": {
            "en": "Abdur Rahman",
            "bn": "আব্দুর রহমান"
        },
        "address": {
            "en": "House 12, Road 4, Sector 7, Uttara, Dhaka",
            "bn": "বাড়ি ১২, রোড ৪, সেক্টর ৭, উত্তরা, ঢাকা"
        },
        "roll_no": "101",
        "registration_no": "REG-2026-8801",
        "class_id": 3,
        "section_id": 5,
        "academic_class": {
            "id": 3,
            "name": "Class 8"
        },
        "section": {
            "id": 5,
            "name": "A"
        }
    }
}
```

---

## 10. Flow 6: List Students (Search, Filter & Pagination)

### Endpoint
`GET` or `POST https://eduex.hostdivine.com/api/rest-api/v1/students/list`

### Query / Filter Parameters

| Parameter | Type | Description |
| :--- | :--- | :--- |
| `class_id` | `integer` | Filter by academic class ID |
| `section_id` | `integer` | Filter by section ID |
| `roll_no` | `string` | Filter by roll number |
| `group` | `string` | Filter by group (e.g., `Science`, `Commerce`) |
| `status` | `string` | Filter by status (e.g., `approved`, `pending`) |
| `search` | `string` | Search query matching name, roll number, or registration number |
| `per_page` | `integer` | Results per page (Default: 50, Maximum: 200) |
| `page` | `integer` | Pagination page number (Default: 1) |

### Example Request
```
GET https://eduex.hostdivine.com/api/rest-api/v1/students/list?class_id=3&per_page=20&page=1
```

---

## 11. cURL Example

```bash
curl -X POST "https://eduex.hostdivine.com/api/rest-api/v1/students/insert" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "external_id": "STU-2026-1001",
    "name": {
      "en": "Tanvir Ahmed",
      "bn": "তানভীর আহমেদ"
    },
    "father_name": {
      "en": "Abdur Rahman",
      "bn": "আব্দুর রহমান"
    },
    "mother_name": {
      "en": "Fatema Begum",
      "bn": "ফাতেমা বেগম"
    },
    "guardian_name": {
      "en": "Abdur Rahman",
      "bn": "আব্দুর রহমান"
    },
    "guardian_phone": "01712345678",
    "roll_no": "101",
    "class_name": "Class 8",
    "section_name": "A",
    "status": "approved"
  }'
```

---

## 12. Postman Configuration Guide

1. Open Postman and click **New Request**.
2. Select Method **`POST`** (or `GET` for `/list` and `/get`).
3. Set URL to **`https://eduex.hostdivine.com/api/rest-api/v1/students/insert`**.
4. In the **Headers** tab, add:
   - `Content-Type`: `application/json`
   - `Accept`: `application/json`
5. In the **Body** tab:
   - Select **raw**
   - In the format dropdown on the right, select **JSON**
   - Paste the payload JSON
6. Click **Send**.
