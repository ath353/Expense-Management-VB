# ⚡ Railway Quick Start - 5 phút deploy

## TL;DR - Các bước tối thiểu

### 1. Generate APP_KEY
```bash
php artisan key:generate --show
```
Copy key này (bắt đầu với `base64:`)

### 2. Push lên GitHub
```bash
git init
git add .
git commit -m "Ready for deployment"
git branch -M main
git remote add origin https://github.com/YOUR_USERNAME/expense-management.git
git push -u origin main
```

### 3. Deploy trên Railway
1. Vào https://railway.app → Login with GitHub
2. New Project → Deploy from GitHub repo → Chọn repo
3. New → Database → Add PostgreSQL
4. Click vào Laravel service → Variables → Raw Editor → Paste:

```env
APP_NAME=Expense Management
APP_ENV=production
APP_KEY=base64:YOUR_KEY_FROM_STEP_1
APP_DEBUG=false
APP_URL=${{RAILWAY_PUBLIC_DOMAIN}}
APP_LOCALE=vi
APP_FALLBACK_LOCALE=en
LOG_LEVEL=error

DB_CONNECTION=pgsql
DB_HOST=${{Postgres.PGHOST}}
DB_PORT=${{Postgres.PGPORT}}
DB_DATABASE=${{Postgres.PGDATABASE}}
DB_USERNAME=${{Postgres.PGUSER}}
DB_PASSWORD=${{Postgres.PGPASSWORD}}

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database

MAIL_MAILER=log
MAIL_FROM_ADDRESS=noreply@expense-management.app
```

5. Settings → Networking → Generate Domain
6. Đợi deploy xong → Click domain để xem app!

### 4. Tạo user đầu tiên
```bash
npm i -g @railway/cli
railway login
railway link
railway run php artisan tinker
```

Trong tinker:
```php
$user = new App\Models\User();
$user->name = 'Admin';
$user->email = 'admin@example.com';
$user->password = bcrypt('password123');
$user->save();
exit
```

## ✅ Done!

App live tại domain Railway đã generate.

**Có vấn đề?** Xem file `.deployment-guide.md` để biết chi tiết.
