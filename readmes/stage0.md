# HNG Stage 0 — Dynamic Profile API

This project implements a simple RESTful API endpoint built with **Laravel (PHP)**.  
The endpoint returns user profile details along with a **random cat fact** fetched dynamically from an external API.

---

## 📌 Overview

The goal of this task is to demonstrate the ability to:
- Build a RESTful API in Laravel
- Consume an external API (`https://catfact.ninja/fact`)
- Return a properly formatted JSON response with dynamic data

The API exposes a single endpoint:  
```

GET /me

````

---

## 🧩 Response Structure

A successful request returns a response in the following format:

```json
{
    "status": "success", 
    "user": {
        "email": "your_email@example.com", 
        "name": "Your Full Name", 
        "stack": "Laravel/PHP"
    }, 
    "timestamp": "<Current Timestamp of Request>", 
    "fact": "<Random Cat Fact from API>"
}
````

### Field Details

| Field          | Description                              |
| -------------- | ---------------------------------------- |
| **status**     | Always `"success"`                       |
| **user.email** | Your personal email address              |
| **user.name**  | Your full name                           |
| **user.stack** | Your backend technology stack            |
| **timestamp**  | Current UTC time in ISO 8601 format      |
| **fact**       | A random cat fact from the Cat Facts API |

---

## ⚙️ Setup Instructions

### 1. Clone the Repository

```bash
git clone https://github.com/<your-username>/hng-stage0-profile-api.git
cd hng-stage0-profile-api
```

### 2. Install Dependencies

Make sure you have **Composer** installed, then run:

```bash
composer install
```

### 3. Copy Environment File

```bash
cp .env.example .env
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Run the Server

```bash
php artisan serve
```

Your API will be available at:

```
http://127.0.0.1:8000/me
```

---

## 🌐 External API Integration

The app fetches cat facts from:
`https://catfact.ninja/fact`

If the external API fails or times out, the endpoint returns a fallback message like:

```json
{
  "status": "error",
  "message": "Unable to fetch cat fact at the moment."
}
```

---

## 🧠 Environment Variables

This project uses Laravel defaults, but you may configure the following if necessary:

| Variable    | Description             | Example                 |
| ----------- | ----------------------- | ----------------------- |
| `APP_ENV`   | Application environment | `local`                 |
| `APP_DEBUG` | Enable debugging        | `true`                  |
| `APP_URL`   | Base URL of the app     | `http://127.0.0.1:8000` |

No external keys are required for this project.

---

## 🧪 Testing the Endpoint

You can test the `/me` endpoint using:

```bash
curl http://127.0.0.1:8000/me
```

or through **Postman** / **Insomnia**.

Ensure the response:

* Returns HTTP **200 OK**
* Contains `status`, `user`, `timestamp`, and `fact`
* Has a **new cat fact** each time it’s requested

---

## 🧱 Project Structure

```
app/
 ├── Http/
 │   └── Controllers/
 │       └── ProfileController.php
routes/
 └── api.php
```

The `/me` endpoint is defined in `routes/api.php` and handled by `ProfileController`.

---

## 🚀 Deployment

You can deploy this project to any supported platform (except Vercel or Render), such as:

* **Amezmo**
* **Railway**
* **Heroku**
* **PXXL App**
* **AWS**


---

## 📄 Submission Details

**Submission Form:** [https://forms.gle/cqXmjZwzRr4rchYBA](https://forms.gle/cqXmjZwzRr4rchYBA)\
**Deadline:** Sunday, 19 October 2025 (GMT+1)

---

## 🧭 Author

**Name:** Ekemezie Ifeanyichukwu Franklin\
**Email:** [franklynpeter2006@gmail.com](mailto:franklynpeter2006@gmail.com)
**Stack:** Laravel / PHP

---

## 🗒️ Notes

* The timestamp updates dynamically on every request.
* The app includes basic error handling for failed API calls.
* The response format strictly follows the JSON schema provided in the task.

---
