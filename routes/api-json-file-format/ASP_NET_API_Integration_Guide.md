# ASP.NET to Laravel API Integration Guide (Teachers Module)

This document provides complete instructions for the ASP.NET team to synchronize teacher data with the Laravel application.

## 1. Overview
The Laravel API receives JSON payloads from the ASP.NET system to `insert`, `update`, `delete`, and `list` teacher records. 

**Base URL Strategy:**
`POST {laravel_site_url}/api/rest-api/v1/teachers/{action}`

The API relies heavily on an `external_id` (The ASP.NET Teacher ID) to accurately map records between the two systems without data duplication or conflicts.

---

## 2. Authentication
*Currently, the endpoints are open for local development testing. In production, requests must be secured using Laravel Sanctum.*

**Headers Required:**
```http
Authorization: Bearer YOUR_SECRET_TOKEN
Accept: application/json
Content-Type: application/json
```

---

## 3. The Data Structure (JSON)

### Important Rules:
1. **`external_id`**: **Required** for Insert, Update, and Delete. This is your primary key from the ASP.NET database.
2. **Translatable Fields**: Fields like `name`, `designation`, `short_intro`, `address`, and `biography` must be sent as JSON objects containing language codes (e.g., `"en"`, `"bn"`).
3. **Images**: Send the teacher's profile picture as a base64 encoded string in the `photo_base64` property. Laravel will decode it, save the file to storage, and save the link in the database.

### Full JSON Payload Example (For Insert/Update)
```json
{
    "external_id": "ASP-NET-TEACHER-1001",
    
    "email": "teacher1001@example.com",
    "phone": "01700000000",
    "is_active": true,
    "sort_order": 1,
    
    "name": {
        "en": "John Doe",
        "bn": "জন ডো"
    },
    "designation": {
        "en": "Head of Science",
        "bn": "বিজ্ঞান বিভাগের প্রধান"
    },
    "short_intro": {
        "en": "Passionate science educator with 10 years experience.",
        "bn": "১০ বছরের অভিজ্ঞতা সম্পন্ন বিজ্ঞান শিক্ষক।"
    },
    "address": {
        "en": "123 School Road, Dhaka",
        "bn": "১২৩ স্কুল রোড, ঢাকা"
    },
    "biography": {
        "en": "<p>Full biography HTML here...</p>",
        "bn": "<p>সম্পূর্ণ জীবনী এখানে...</p>"
    },

    "photo_base64": "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mP8z8BQDwAEhQGAhKmMIQAAAABJRU5ErkJggg==",
    
    "facebook_url": "https://facebook.com/johndoe",
    "whatsapp_url": "https://wa.me/8801700000000",
    "linkedin_url": "https://linkedin.com/in/johndoe",
    "behance_url": "",
    "pinterest_url": "",

    "skills": [
        {
            "label": {
                "en": "Physics",
                "bn": "পদার্থবিদ্যা"
            },
            "percentage": "95"
        },
        {
            "label": {
                "en": "Chemistry",
                "bn": "রসায়ন"
            },
            "percentage": "90"
        }
    ],

    "gender": "Male",
    "religion": "Islam",
    "blood_group": "O+",
    "serial_no": "EMP-001",
    "joining_date": "2023-01-15",
    
    "user_id": 1, 
    "department_id": 2
}
```

---

## 4. Endpoints

### 4.1 Insert / Upsert a Teacher
**Endpoint:** `POST /api/rest-api/v1/teachers/insert`
**Behavior:** If the `external_id` already exists, Laravel will safely **update** the existing record instead of throwing a duplicate entry error. If it does not exist, it creates a new one.
**Required Fields:** `external_id`, `email`, `name`, `designation`.

### 4.2 Update a Teacher
**Endpoint:** `POST /api/rest-api/v1/teachers/update`
**Behavior:** Finds the teacher by `external_id` and updates *only* the fields provided in the JSON payload. You do not need to send the entire object.
**Required Fields:** `external_id`.
**Example Payload:**
```json
{
    "external_id": "ASP-NET-TEACHER-1001",
    "phone": "01999999999",
    "designation": {
        "en": "Senior Science Teacher"
    }
}
```

### 4.3 Delete a Teacher
**Endpoint:** `POST /api/rest-api/v1/teachers/delete`
**Behavior:** Permanently deletes the teacher and automatically deletes their associated photo from Laravel's storage.
**Required Fields:** `external_id`.
**Example Payload:**
```json
{
    "external_id": "ASP-NET-TEACHER-1001"
}
```

### 4.4 List all Teachers
**Endpoint:** `GET /api/rest-api/v1/teachers/list`
**Behavior:** Returns a JSON array of all teachers currently in the Laravel database. Useful for initial synchronization audits.

---

## 5. Postman Testing Flow

To verify the integration is working, the ASP.NET team can follow this step-by-step flow in Postman:

### Step 1: Test the Insert Endpoint
1. Open Postman and create a new **POST** request.
2. Set the URL to: `http://127.0.0.1:8000/api/rest-api/v1/teachers/insert` (replace domain if testing on live server).
3. Go to the **Headers** tab and add:
   - `Accept` : `application/json`
4. Go to the **Body** tab, select **raw**, and click the dropdown to select **JSON**.
5. Paste the **Full JSON Payload** provided in section 3 of this document.
6. Click **Send**.
7. **Expected Result:** Status `201 Created` with a `success` message indicating the teacher was created.

### Step 2: Verify in the List Endpoint
1. Create a new **GET** request.
2. Set URL to: `http://127.0.0.1:8000/api/rest-api/v1/teachers/list`.
3. Click **Send**.
4. **Expected Result:** You should see the teacher you just inserted in the JSON array, complete with a generated `photo_url` pointing to the saved base64 image.

### Step 3: Test the Update Endpoint
1. Create a new **POST** request.
2. Set URL to: `http://127.0.0.1:8000/api/rest-api/v1/teachers/update`.
3. In the **Body** (raw -> JSON), paste:
   ```json
   {
       "external_id": "ASP-NET-TEACHER-1001",
       "phone": "01222222222"
   }
   ```
4. Click **Send**.
5. **Expected Result:** Status `200 OK` with a success message. (You can hit the List endpoint again to verify the phone number changed).

### Step 4: Test the Delete Endpoint
1. Create a new **POST** request.
2. Set URL to: `http://127.0.0.1:8000/api/rest-api/v1/teachers/delete`.
3. In the **Body** (raw -> JSON), paste:
   ```json
   {
       "external_id": "ASP-NET-TEACHER-1001"
   }
   ```
4. Click **Send**.
5. **Expected Result:** Status `200 OK`. The teacher and their photo are now removed from the system.
