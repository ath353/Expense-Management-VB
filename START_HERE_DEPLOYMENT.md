# 🎯 BẮT ĐẦU TẠI ĐÂY - Deploy lên Railway

## 👋 Chào bạn!

Bạn đang muốn deploy app Expense Management lên internet? Tuyệt vời!

Tôi đã chuẩn bị sẵn mọi thứ cho bạn. Chỉ cần làm theo hướng dẫn dưới đây.

---

## ⚡ Quick Start (5-10 phút)

### Bước 1: Generate APP_KEY

**Windows:**
```cmd
generate-key.bat
```

**Mac/Linux:**
```bash
chmod +x generate-key.sh
./generate-key.sh
```

Hoặc chạy trực tiếp:
```bash
php artisan key:generate --show
```

→ **Copy key này** (bắt đầu với `base64:...`)

---

### Bước 2: Push lên GitHub

```bash
git init
git add .
git commit -m "Ready for Railway deployment"
git branch -M main
```

Tạo repo mới trên GitHub: https://github.com/new

```bash
git remote add origin https://github.com/YOUR_USERNAME/expense-management.git
git push -u origin main
```

---

### Bước 3: Deploy trên Railway

1. **Tạo account:** https://railway.app (login bằng GitHub)

2. **Tạo project:**
   - Click "New Project"
   - Chọn "Deploy from GitHub repo"
   - Chọn repository `expense-management`

3. **Add Database:**
   - Click "New" → "Database" → "Add PostgreSQL"

4. **Set Environment Variables:**
   - Click vào Laravel service
   - Tab "Variables" → "Raw Editor"
   - Paste config này (thay `YOUR_APP_KEY`):

```env
APP_NAME=Expense Management
APP_ENV=production
APP_KEY=base64:YOUR_APP_KEY_FROM_STEP_1
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

5. **Generate Domain:**
   - Tab "Settings" → "Networking" → "Generate Domain"

6. **Đợi deploy xong** (2-3 phút)
   - Xem progress ở tab "Deployments"

7. **Truy cập app:**
   - Click vào domain vừa generate
   - Bạn sẽ thấy trang welcome! 🎉

---

### Bước 4: Tạo User Admin

```bash
npm i -g @railway/cli
railway login
railway link
railway run php artisan tinker
```

Trong tinker, gõ:
```php
$user = new App\Models\User();
$user->name = 'Admin';
$user->email = 'admin@example.com';
$user->password = bcrypt('password123');
$user->save();
exit
```

---

## ✅ Xong rồi!

App của bạn đã live! 🚀

**Login với:**
- Email: `admin@example.com`
- Password: `password123`

---

## 📚 Muốn biết thêm chi tiết?

- **Quick guide:** `RAILWAY_QUICKSTART.md`
- **Chi tiết từng bước:** `.deployment-guide.md`
- **Checklist:** `.railway-checklist.md`
- **Tổng quan:** `DEPLOYMENT.md`

---

## 🐛 Gặp lỗi?

### Lỗi "No APP_KEY"
→ Kiểm tra lại bước 1, đảm bảo key có prefix `base64:`

### Lỗi database connection
→ Đảm bảo đã add PostgreSQL service và variables đúng

### App không load
→ Check logs: Tab "Deployments" → Click deployment mới nhất → Xem logs

### Lỗi khác
→ Xem troubleshooting trong `.deployment-guide.md`

---

## 💡 Tips

- Railway tự động deploy mỗi khi bạn push code mới lên GitHub
- Free tier: $5 credit/tháng (đủ cho personal projects)
- Logs có thể xem realtime trên Railway dashboard
- Có thể add custom domain sau

---

## 🎉 Chúc mừng!

Bạn vừa deploy thành công Laravel app lên production!

**Next steps:**
1. ✅ Test tất cả features
2. ✅ Đổi password admin
3. ✅ Share app với bạn bè
4. ✅ Enjoy! 🎊

---

**Cần help?** Railway Discord: https://discord.gg/railway
