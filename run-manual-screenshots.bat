@echo off
echo ===========================================
echo    SevenKey Quick Screenshot (No Install)
echo ===========================================
echo.

echo This version uses your existing Chrome browser
echo No need to download Puppeteer's Chromium (~170MB)
echo.

echo [1/2] Installing lightweight dependencies...
call npm install playwright-core --no-optional
if errorlevel 1 (
    echo Installing basic screenshot tool...
    call npm install selenium-webdriver --no-optional
)

echo.
echo [2/2] Creating manual screenshot guide...

echo ^<!DOCTYPE html^> > screenshot-guide.html
echo ^<html^> >> screenshot-guide.html
echo ^<head^> >> screenshot-guide.html
echo ^<title^>SevenKey Screenshot Guide^</title^> >> screenshot-guide.html
echo ^<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"^> >> screenshot-guide.html
echo ^</head^> >> screenshot-guide.html
echo ^<body class="bg-light"^> >> screenshot-guide.html
echo ^<div class="container py-5"^> >> screenshot-guide.html
echo ^<h1 class="text-center mb-4"^>📸 SevenKey Screenshot Guide^</h1^> >> screenshot-guide.html
echo ^<div class="card"^> >> screenshot-guide.html
echo ^<div class="card-body"^> >> screenshot-guide.html
echo ^<h3^>Manual Screenshots (Fast Method)^</h3^> >> screenshot-guide.html
echo ^<ol^> >> screenshot-guide.html
echo ^<li^>Open Chrome/Firefox in incognito mode^</li^> >> screenshot-guide.html
echo ^<li^>Set browser size: Press F12 → Device toolbar → 1920x1080^</li^> >> screenshot-guide.html
echo ^<li^>Go to: ^<a href="http://127.0.0.1:8000/login"^>http://127.0.0.1:8000/login^</a^>^</li^> >> screenshot-guide.html
echo ^<li^>Take screenshots (Ctrl+Shift+S or browser screenshot extension)^</li^> >> screenshot-guide.html
echo ^<li^>For mobile: Set device to iPhone 12 Pro (375x812)^</li^> >> screenshot-guide.html
echo ^</ol^> >> screenshot-guide.html
echo ^<h4^>Pages to Screenshot:^</h4^> >> screenshot-guide.html
echo ^<ul^> >> screenshot-guide.html
echo ^<li^>^<a href="http://127.0.0.1:8000/login"^>Login Page^</a^>^</li^> >> screenshot-guide.html
echo ^<li^>^<a href="http://127.0.0.1:8000/superadmin/dashboard"^>Dashboard^</a^>^</li^> >> screenshot-guide.html
echo ^<li^>^<a href="http://127.0.0.1:8000/superadmin/users"^>User Management^</a^>^</li^> >> screenshot-guide.html
echo ^<li^>^<a href="http://127.0.0.1:8000/mobile-test.html"^>Mobile Test^</a^>^</li^> >> screenshot-guide.html
echo ^</ul^> >> screenshot-guide.html
echo ^</div^> >> screenshot-guide.html
echo ^</div^> >> screenshot-guide.html
echo ^</div^> >> screenshot-guide.html
echo ^</body^> >> screenshot-guide.html
echo ^</html^> >> screenshot-guide.html

echo.
echo ✅ Alternative method ready!
echo 📖 Open screenshot-guide.html for manual instructions
echo 🌐 This method is faster and uses your existing browser
echo.

start screenshot-guide.html

pause
