@echo off
echo.
echo 🔑 Generating Laravel APP_KEY...
echo.

REM Check if artisan exists
if not exist "artisan" (
    echo ❌ Error: artisan file not found. Are you in the Laravel project root?
    pause
    exit /b 1
)

REM Generate key
for /f "delims=" %%i in ('php artisan key:generate --show') do set KEY=%%i

echo ✅ Your APP_KEY is:
echo.
echo ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
echo %KEY%
echo ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
echo.
echo 📋 Copy this key and paste it into Railway Variables as APP_KEY
echo.
echo Next steps:
echo 1. Go to Railway dashboard
echo 2. Click on your Laravel service
echo 3. Go to Variables tab
echo 4. Add/Update APP_KEY with the value above
echo.
pause
