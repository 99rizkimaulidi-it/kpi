# KPI Management System (Laravel 11)

Production-oriented KPI platform covering task management, submissions, evaluations, realtime chat, KPI dashboards, and exports.

## Requirements
- PHP 8.2+
- Composer
- MySQL 8+
- Node.js (for Echo client if used)

## Setup
1. Copy `.env.example` to `.env` and configure database and pusher credentials.
2. Install dependencies: `composer install` and `npm install && npm run build` (if Echo UI required).
3. Run migrations and seeders: `php artisan migrate --seed`.
4. Start queue and websocket workers as needed.

## Default Accounts
- Super Admin: `admin@example.com` / `password`
- Co-Admin: `coadmin@example.com` / `password`
- Karyawan: `karyawan@example.com` / `password`

## Modules
- User management with RBAC middleware.
- Task creation, deadlines, and submissions with late flagging.
- File validation for office/PDF/image formats.
- Evaluations with immutable ratings and KPI aggregation.
- Dashboard ranking and KPI exports (PDF/Excel).
- Realtime chat scaffolding compatible with Laravel Echo/Pusher.

## Deployment
- Ensure queues run for notifications and broadcasting.
- Configure HTTPS, caching, and storage links (`php artisan storage:link`).
- Rotate `APP_KEY` and use strong credentials.
