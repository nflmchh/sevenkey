@echo off
echo ===========================================
echo    SevenKey Screenshot Automation Tool
echo ===========================================
echo.

echo [1/3] Checking Node.js installation...
node --version >nul 2>&1
if errorlevel 1 (
    echo ERROR: Node.js is not installed or not in PATH
    echo Please install Node.js from https://nodejs.org/
    pause
    exit /b 1
)
echo ✅ Node.js found

echo.
echo [2/3] Installing dependencies...
call npm install puppeteer
if errorlevel 1 (
    echo ERROR: Failed to install Puppeteer
    pause
    exit /b 1
)
echo ✅ Dependencies installed

echo.
echo [3/3] Starting Laravel server...
echo Please make sure XAMPP is running and Laravel is accessible at http://127.0.0.1:8000
echo.
echo Press any key when Laravel server is ready...
pause >nul

echo.
echo 🚀 Starting screenshot automation...
echo This will capture screenshots for all roles:
echo   • SuperAdmin
echo   • Owner  
echo   • Admin Gudang
echo   • Operator Gudang
echo   • Kasir
echo   • Supervisor Keuangan
echo   • Marketing
echo.
echo Screenshots will be saved to: ./public/screenshots/
echo.

node screenshot-automation.js

echo.
echo ✅ Screenshot automation completed!
echo 📁 Check ./public/screenshots/ folder for results
echo 📊 Open ./public/screenshots/screenshot-report.html for detailed report
echo.
pause
