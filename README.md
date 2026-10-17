# Solo Leveling API (Hunters)

**Course:** CIT3102 · Module 5, Build Your Own API
**Section:** IT2E
**Partners:** <Partner 1 full name> and <Partner 2 full name>
**Resource:** Hunter (a hunter from the Solo Leveling world)

A REST API built with Laravel, SQLite and Laravel Sanctum. It manages **hunters** with full CRUD, query-string filtering, and token authentication.

| Field | Type |
|---|---|
| name | string |
| rank | string (E, D, C, B, A, S) |
| class | string |
| level | integer |
| power | integer |

---

## Setup

Follow these steps to run the project from a fresh clone.

1. Clone the repository and go into the folder.
   ```bash
   git clone https://github.com/<your-username>/cit3102-m5-hunter.git
   cd cit3102-m5-hunter
   ```
2. Install the PHP packages (this recreates the `vendor/` folder).
   ```bash
   composer install
   ```
3. Create your own `.env` file and generate the app key.
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   On Windows Command Prompt, use `copy .env.example .env` instead of `cp`.
4. Create the SQLite database file.
   ```bash
   touch database/database.sqlite
   ```
   On Windows Command Prompt, use `type nul > database\database.sqlite`.
5. Create the tables.
   ```bash
   php artisan migrate
   ```
6. Start the server.
   ```bash
   php artisan serve
   ```
   The API is now at `http://127.0.0.1:8000/api`.
7. In Bruno, send every request with the header `Accept: application/json`.

---

## Routes

| Verb | Path | What it does | Needs token? |
|---|---|---|---|
| POST | `/api/register` | Creates a new user and returns a token | No |
| POST | `/api/login` | Logs in and returns a token | No |
| POST | `/api/logout` | Deletes the current token | Yes |
| GET | `/api/me` | Returns the logged-in user | Yes |
| GET | `/api/hunters` | Lists hunters. Filters: `name`, `rank`, `class`, `level`, `power` | Yes |
| POST | `/api/hunters` | Creates a hunter | Yes |
| GET | `/api/hunters/{hunter}` | Shows one hunter | Yes |
| PUT | `/api/hunters/{hunter}` | Updates a hunter | Yes |
| DELETE | `/api/hunters/{hunter}` | Deletes a hunter | Yes |

Filter examples:

```
GET /api/hunters
GET /api/hunters?rank=S
GET /api/hunters?rank=S&class=Necromancer
```

---

## Proof that it runs

### 1. Register (201)
![1 Register](screenshots/01-register.png)

### 2. Login (200)
![2 Login](screenshots/02-login.png)

### 3. List hunters with no token (401)
![3 No token](screenshots/03-no-token.png)

### 4. List hunters with token (200)
![4 With token](screenshots/04-with-token.png)

### 5. Create hunter with valid data (201)
![5 Create](screenshots/05-create.png)

### 6. Create hunter with a missing field (422)
![6 Validation error](screenshots/06-validation.png)

### 7. Show hunter 1 (200)
![7 Show](screenshots/07-show.png)

### 8. Show hunter 99999 (404)
![8 Not found](screenshots/08-not-found.png)

### 9. Update hunter 1 (200)
![9 Update](screenshots/09-update.png)

### 10. Delete hunter 1 (204)
![10 Delete](screenshots/10-delete.png)

---

## Why does DELETE return 204 and not 200?

A successful DELETE removes the hunter, so there is nothing left to send back. Status 204 means "No Content": the request worked and the response body is empty on purpose. A 200 response normally carries data, and here the data no longer exists. Returning 204 also tells the client it can stop and does not need to read a body.