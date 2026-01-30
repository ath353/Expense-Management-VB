# 💰 Expense Management System

Ứng dụng quản lý chi tiêu cá nhân được xây dựng với Laravel và Livewire.

## 🔗 Demo

**Live Demo:** [https://exm.up.railway.app/login](https://exm.up.railway.app/login)

## 📋 Giới thiệu

Expense Management là một ứng dụng web hiện đại giúp người dùng theo dõi và quản lý chi tiêu hàng ngày một cách dễ dàng và trực quan.

## ✨ Tính năng chính

- 🔐 **Xác thực người dùng** - Đăng ký, đăng nhập với Laravel Fortify
- 🛡️ **Two-Factor Authentication** - Bảo mật tài khoản với 2FA
- 📊 **Quản lý chi tiêu** - Thêm, sửa, xóa các khoản chi
- 🏷️ **Phân loại chi tiêu** - Tạo và quản lý danh mục
- 💱 **Hỗ trợ đa tiền tệ** - Hiển thị theo định dạng tiền tệ
- 👤 **Quản lý hồ sơ** - Cập nhật thông tin cá nhân
- 🎨 **Giao diện hiện đại** - UI/UX đẹp mắt với Livewire Flux

## 🛠️ Công nghệ sử dụng

- **Backend:** Laravel 12
- **Frontend:** Livewire 4 + Flux UI
- **Styling:** Tailwind CSS 4
- **Database:** SQLite
- **Authentication:** Laravel Fortify
- **Deployment:** Railway

## 📦 Cài đặt

```bash
# Clone repository
git clone <repository-url>

# Cài đặt dependencies
composer install
npm install

# Cấu hình môi trường
cp .env.example .env
php artisan key:generate

# Chạy migration
php artisan migrate

# Build assets
npm run build

# Khởi động server
php artisan serve
```

## 🧪 Testing

```bash
# Chạy tests
php artisan test

# Chạy linter
composer lint
```

## 📄 License

MIT License
