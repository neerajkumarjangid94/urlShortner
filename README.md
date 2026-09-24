# URL Shortener

## Notes

1. Functionality:
   All required functionality and flows are completed and working as per the assignment requirements. UI/CSS styling was kept minimal, with the main focus on functionality and flow. In a production project, Request classes, Services, Helpers, `try/catch`, logging, and other best practices could be added.

2. AI Assistance:
   AI assistance was used for writing inline CSS in HTML/Blade pages and partially for writing a small portion of the Feature Test cases.



## Requirements

* XAMPP
* PHP
* Composer
* Node.js & NPM
* MySQL

## Installation & Setup

### 1. Clone Repository

```bash
git clone <repository-url>
cd urlShortner
git checkout dev
```

### 2. Start XAMPP

Start **Apache** and **MySQL** from XAMPP Control Panel.

Create a MySQL database:

```text
url_shortner
```

### 3. Install Dependencies

```bash
composer install
npm install
```

### 4. Configure Environment

Create `.env` file:

```bash
Copy-Item .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

Update `.env` with:

* Database credentials
* SMTP mail credentials

### 5. Run Database Migration & Seeder

```bash
php artisan migrate --seed
```

### 6. Clear Cache

```bash
php artisan optimize:clear
```

### 7. Start Application

Start Laravel server:

```bash
php artisan serve
```

Start Vite in a new terminal:

```bash
npm run dev
```

Start queue worker in another terminal:

```bash
php artisan queue:work
```

## Testing

### 1. Create Testing Database

The testing database will be created automatically if it does not exist:

```bash
php artisan test:setup-db
```

### 2. Run Testing Migrations

```bash
php artisan migrate --env=testing
```

### 3. Run Tests

```bash
php artisan test
```

## Routes

To view all application routes:

```bash
php artisan route:list
```
