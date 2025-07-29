@echo off
echo ============================================
echo    SevenKey Quick Screenshot Tool
echo ============================================
echo.

echo This tool will capture screenshots of:
echo  ✓ Login page
echo  ✓ SuperAdmin dashboard (desktop + mobile)
echo  ✓ User management page
echo  ✓ Mobile test page (desktop + mobile)
echo.

echo [IMPORTANT] Before running:
echo 1. Make sure XAMPP is running
echo 2. Laravel should be accessible at http://127.0.0.1:8000
echo 3. Update credentials in quick-screenshots.js if needed
echo.

set /p continue="Press Enter to continue or Ctrl+C to exit..."

echo.
echo [1/2] Installing Puppeteer...
call npm install puppeteer

echo.
echo [2/2] Taking screenshots...
node quick-screenshots.js

echo.
echo ✅ Done! Check these files:
echo    📁 ./public/screenshots/ folder
echo    📊 ./public/screenshots/gallery.html
echo.
echo 🌐 Open gallery.html in browser to view all screenshots
pause
