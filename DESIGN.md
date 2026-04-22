# Guestbook Application Design

This document outlines the plan for creating a simple Guestbook application in Laravel.

## 1. Database Schema (`guests` table)

The `guests` table will store the following information:

| Column | Type | Description |
| :--- | :--- | :--- |
| `id` | BigIncrements | Unique identifier |
| `name` | String | Name of the guest (Required) |
| `school` | String | School name of the guest (Required) |
| `email` | String | Email address (Optional) |
| `message` | Text | Guestbook message (Required) |
| `created_at` | Timestamp | Creation date |
| `updated_at` | Timestamp | Last update date |

## 2. Components

### Model
- `app/Models/Guest.php`: Will handle database interactions and define fillable fields.

### Migration
- `database/migrations/xxxx_xx_xx_create_guests_table.php`: Will define the table structure.

### Controller
- `app/Http/Controllers/GuestController.php`:
    - `index()`: Display the list of guests and the submission form.
    - `store()`: Validate and save new guest entries.

### Routes
- `routes/web.php`:
    - `GET /`: Display the guestbook.
    - `POST /guests`: Submit a new guest entry.

### Views
- `resources/views/guestbook.blade.php`: A single-page view containing the list of entries and a form to add a new one.

## 3. Implementation Steps

1.  **Environment Check:** Verify database configuration (SQLite is default).
2.  **Scaffolding:** Generate Model, Migration, and Controller using Artisan.
3.  **Migration:** Define the schema in the migration file and run it.
4.  **Model:** Set `$fillable` fields in the `Guest` model.
5.  **Controller:** Implement logic for displaying and storing guests.
6.  **Routes:** Add routes to `web.php`.
7.  **Views:** Create the Blade template with a modern, clean UI.
8.  **Validation:** Ensure all inputs are validated before saving.

## 4. Verification Plan

- **Manual Testing:** Visit the homepage, submit a guest entry, and verify it appears in the list.
- **Automated Testing:** Create a feature test `tests/Feature/GuestbookTest.php` to verify:
    - The guestbook page loads correctly.
    - A guest can be successfully created.
    - Validation errors are handled.
