@echo off
echo ==========================================
echo    SevenKey FAST Screenshots (No Wait!)
echo ==========================================
echo.

echo This uses your existing Chrome browser
echo No download needed - runs immediately!
echo.

echo Installing lightweight package...
call npm install puppeteer-core --silent --no-optional

if errorlevel 1 (
    echo.
    echo ❌ npm install failed. Using manual method...
    goto :manual
)

echo.
echo 🚀 Running fast screenshots...
node fast-screenshots.js

if errorlevel 1 (
    echo.
    echo ❌ Auto-screenshot failed. Using manual method...
    goto :manual
)

echo.
echo ✅ Screenshots completed!
echo 📁 Check: ./public/screenshots/
echo 📊 View: ./public/screenshots/gallery.html
goto :end

:manual
echo.
echo 📖 MANUAL SCREENSHOT METHOD:
echo.
echo 1. Open Chrome in incognito mode
echo 2. Press F12 → Click device icon → Select "Responsive"
echo 3. Set size to 1920x1080
echo 4. Visit these URLs and take screenshots:
echo.
echo    📱 http://127.0.0.1:8000/login
echo    📱 http://127.0.0.1:8000/superadmin/dashboard  
echo    📱 http://127.0.0.1:8000/superadmin/users
echo    📱 http://127.0.0.1:8000/mobile-test.html
echo.
echo 5. For mobile: Change size to 375x812 and repeat
echo 6. Save as JPG files in ./public/screenshots/
echo.
echo 💡 TIP: Use Ctrl+Shift+S for full page screenshots
echo.

:end
pause
