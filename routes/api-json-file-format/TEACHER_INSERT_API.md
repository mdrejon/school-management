# Teacher Insert API Documentation

API documentation for synchronizing and inserting teacher data from external software (ASP.NET / ERP / School Management Software) into the School Management website.

---

## 1. Endpoint Details

| Property | Value |
| :--- | :--- |
| **HTTP Method** | `POST` |
| **Live API URL** | `https://eduex.hostdivine.com/api/rest-api/v1/teachers/insert` |
| **Local API URL** | `http://school-management.test/api/rest-api/v1/teachers/insert` <br>*(or `http://localhost:8000/api/rest-api/v1/teachers/insert`)* |
| **Controller** | `App\Http\Controllers\Api\SyncController@handleRequest` |

---

## 2. Request Headers

| Header | Value | Required | Description |
| :--- | :--- | :--- | :--- |
| `Content-Type` | `application/json` | Yes | Specifies request payload format |
| `Accept` | `application/json` | Yes | Ensures JSON responses |

---

## 3. Request Body (Sample Payload)

```json
{
    "external_id": "64-203",
    "email": "",
    "phone": "01818012231",
    "is_active": true,
    "sort_order": 1,
    "name": { 
        "en": "", 
        "bn": "মুহাম্মদ ওসমান গনি" 
    },
    "designation": { 
        "en": "Principal", 
        "bn": "Principal" 
    },
    "serial_no": "EMP001"
}
```

---

## 4. Field Specifications & Nullable Rules

| Field | Type | Required / Nullable | Description |
| :--- | :--- | :--- | :--- |
| `external_id` | `string` | **Required** | The unique identifier in the external system. Used for matching, upserting, and updating records. |
| `name` | `object` | **Required** | Translatable name object. |
| `name.bn` | `string` | **Nullable** | Bengali name. If `en` is empty, this must not be empty. |
| `name.en` | `string` | **Nullable** | English name. Can be empty `""` or `null` if Bengali name is provided. |
| `designation` | `object` \| `string` | **Nullable** | Teacher designation (e.g., `{"en": "Principal", "bn": "Principal"}`). |
| `email` | `string` | **Nullable** | Email address. Pass `""` or `null` if unavailable. |
| `phone` | `string` | **Nullable** | Phone/mobile number. Pass `""` or `null` if unavailable. |
| `is_active` | `boolean` | **Nullable (Optional)** | `true` or `false`. Defaults to `true` if omitted. |
| `sort_order` | `integer` | **Nullable (Optional)** | Display sorting order. Defaults to `0` if omitted. |
| `serial_no` | `string` | **Nullable** | Employee serial / code (e.g., `EMP001`). |

### Additional Optional / Nullable Fields

| Field | Type | Description |
| :--- | :--- | :--- |
| `photo_base64` | `string` | Base64-encoded image (e.g. `data:image/jpeg;base64,...`) |
| `short_intro` | `object` | Short bio / intro in `{"en": "...", "bn": "..."}` |
| `address` | `object` | Address in `{"en": "...", "bn": "..."}` |
| `biography` | `object` | Detailed biography in `{"en": "...", "bn": "..."}` |
| `gender` | `string` | Gender (e.g., `Male`, `Female`) |
| `religion` | `string` | Religion (e.g., `Islam`) |
| `blood_group` | `string` | Blood group (e.g., `B+`, `A+`) |
| `department_id`| `integer`| Local department ID (if known) |
| `joining_date` | `string` | Joining date in `YYYY-MM-DD` format |
| `facebook_url` | `string` | Profile URL |
| `whatsapp_url` | `string` | Profile URL / Number |
| `linkedin_url` | `string` | Profile URL |

> **Note:** If an `external_id` already exists, calling this `insert` endpoint will automatically perform an **Upsert** (update the existing record instead of creating a duplicate).

---

## 5. Responses

### Success Response (`201 Created`)
```json
{
    "status": "success",
    "message": "Teacher created successfully",
    "data": {
        "laravel_id": 8,
        "external_id": "64-203",
        "slug": "muhammd-oosman-gni"
    }
}
```

### Validation Error (`422 Unprocessable Content`)
```json
{
    "status": "error",
    "errors": {
        "name": [
            "At least one name translation (English or Bengali) is required."
        ]
    }
}
```

---

## 6. cURL Example

```bash
curl -X POST "https://eduex.hostdivine.com/api/rest-api/v1/teachers/insert" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "external_id": "64-203",
    "email": "",
    "phone": "01818012231",
    "is_active": true,
    "sort_order": 1,
    "name": { 
        "en": "", 
        "bn": "মুহাম্মদ ওসমান গনি" 
    },
    "designation": { 
        "en": "Principal", 
        "bn": "Principal" 
    },
    "serial_no": "EMP001"
}'
```

---

## 7. Postman Configuration

1. Open Postman and click **New Request**.
2. Set Method to **`POST`**.
3. Set URL to **`https://eduex.hostdivine.com/api/rest-api/v1/teachers/insert`**.
4. In **Headers** tab, add:
   - `Content-Type`: `application/json`
   - `Accept`: `application/json`
5. In **Body** tab:
   - Select **raw**
   - Select **JSON** from the dropdown
   - Paste the JSON payload
6. Click **Send**.

---

## 8. Common Errors & Troubleshooting

### Error: `"The external id field is required"` & `"The name field is required"`

```json
{
    "status": "error",
    "errors": {
        "external_id": ["The external id field is required."],
        "name": ["The name field is required."]
    }
}
```

**Why this happens:**
This error occurs when the server receives an **empty body** or cannot parse the body:
1. **Wrong HTTP Method:** You sent a `GET` request instead of `POST`. Postman does not send body content with `GET`.
2. **Missing / Wrong Format in Postman:** You pasted the JSON in Postman's `Body -> raw`, but the format dropdown was set to **`Text`** instead of **`JSON`**.
3. **Empty Body:** The `Body` tab was set to `none` or `form-data` with no fields.

**How to fix in Postman:**
1. Change HTTP Method to **`POST`**.
2. Go to **Body** tab -> select **raw** -> click the dropdown on the far right and choose **JSON** (not `Text`).
3. Paste the complete JSON payload into the box and hit **Send**.
