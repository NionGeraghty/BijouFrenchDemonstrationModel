# Bijou French – Demonstration Application

A production-style Laravel application built to demonstrate real-world backend and frontend patterns, admin tooling, and deployment readiness.

## 🔗 Live Demo

👉 https://bijoufrenchdemonstrationmodel-production.up.railway.app

---

## What This Project Demonstrates

- Laravel 12 application structure using modern best practices
- Inertia.js for a server-driven SPA experience
- Filament for admin panels and internal tooling
- Real database-backed models and relationships
- Vite-based frontend asset pipeline
- Production deployment using Docker

This project is intentionally scoped as a **demonstration app**, focusing on architecture, clarity, and maintainability rather than end-user completeness.

---

## Tech Stack

- **Backend:** Laravel 12, PHP 8.3
- **Frontend:** Inertia.js, Vite
- **Admin:** Filament
- **Database:** SQLite (demo-friendly, production-ready structure)
- **Deployment:** Docker, Railway

---

## Local Development

```bash
git clone https://github.com/your-username/your-repo.git
cd your-repo

composer install
npm install
npm run dev

php artisan migrate
php artisan serve
