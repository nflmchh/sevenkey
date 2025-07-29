const puppeteer = require('puppeteer');
const fs = require('fs');

// Simple configuration
const CONFIG = {
    baseUrl: 'http://127.0.0.1:8000',
    screenshotDir: './public/screenshots',
    adminEmail: 'admin@example.com', // Update with your admin email
    adminPassword: 'password',       // Update with your admin password
    pages: [
        { name: 'login', url: '/login', title: 'Login Page' },
        { name: 'dashboard', url: '/superadmin/dashboard', title: 'SuperAdmin Dashboard' },
        { name: 'users', url: '/superadmin/users', title: 'User Management' },
        { name: 'mobile-test', url: '/mobile-test.html', title: 'Mobile Layout Test' }
    ]
};

class QuickScreenshot {
    constructor() {
        this.setupDirectory();
    }

    setupDirectory() {
        if (!fs.existsSync(CONFIG.screenshotDir)) {
            fs.mkdirSync(CONFIG.screenshotDir, { recursive: true });
            console.log(`Created directory: ${CONFIG.screenshotDir}`);
        }
    }

    async takeScreenshots() {
        console.log('🚀 Starting Quick Screenshot Tool...');
        
        const browser = await puppeteer.launch({
            headless: false,
            defaultViewport: null,
            args: ['--start-maximized']
        });

        const page = await browser.newPage();
        
        // Set desktop viewport
        await page.setViewport({ width: 1920, height: 1080 });

        try {
            console.log('📸 Taking screenshots...');

            // 1. Login page
            await page.goto(`${CONFIG.baseUrl}/login`);
            await page.waitForTimeout(2000);
            await page.screenshot({
                path: `${CONFIG.screenshotDir}/01-login-page.jpg`,
                type: 'jpeg',
                quality: 90,
                fullPage: true
            });
            console.log('✅ Login page captured');

            // 2. Login and go to dashboard
            await page.type('input[name="email"]', CONFIG.adminEmail);
            await page.type('input[name="password"]', CONFIG.adminPassword);
            await Promise.all([
                page.waitForNavigation({ waitUntil: 'networkidle0' }),
                page.click('button[type="submit"]')
            ]);

            // 3. Dashboard
            await page.waitForTimeout(3000);
            await page.screenshot({
                path: `${CONFIG.screenshotDir}/02-dashboard-desktop.jpg`,
                type: 'jpeg',
                quality: 90,
                fullPage: true
            });
            console.log('✅ Dashboard captured');

            // 4. User management
            await page.goto(`${CONFIG.baseUrl}/superadmin/users`);
            await page.waitForTimeout(3000);
            await page.screenshot({
                path: `${CONFIG.screenshotDir}/03-user-management.jpg`,
                type: 'jpeg',
                quality: 90,
                fullPage: true
            });
            console.log('✅ User management captured');

            // 5. Mobile test page
            await page.goto(`${CONFIG.baseUrl}/mobile-test.html`);
            await page.waitForTimeout(2000);
            await page.screenshot({
                path: `${CONFIG.screenshotDir}/04-mobile-test-desktop.jpg`,
                type: 'jpeg',
                quality: 90,
                fullPage: true
            });
            console.log('✅ Mobile test page captured');

            // 6. Mobile viewport screenshots
            await page.setViewport({ width: 375, height: 812 });
            
            // Dashboard mobile
            await page.goto(`${CONFIG.baseUrl}/superadmin/dashboard`);
            await page.waitForTimeout(3000);
            await page.screenshot({
                path: `${CONFIG.screenshotDir}/05-dashboard-mobile.jpg`,
                type: 'jpeg',
                quality: 90,
                fullPage: true
            });
            console.log('✅ Dashboard mobile captured');

            // Mobile test page mobile
            await page.goto(`${CONFIG.baseUrl}/mobile-test.html`);
            await page.waitForTimeout(2000);
            await page.screenshot({
                path: `${CONFIG.screenshotDir}/06-mobile-test-mobile.jpg`,
                type: 'jpeg',
                quality: 90,
                fullPage: true
            });
            console.log('✅ Mobile test mobile captured');

            // 7. Create simple HTML gallery
            this.createGallery();

        } catch (error) {
            console.error('❌ Error:', error.message);
        } finally {
            await browser.close();
            console.log('🎉 Screenshots completed!');
            console.log(`📁 Check ${CONFIG.screenshotDir} folder`);
        }
    }

    createGallery() {
        const galleryHtml = `
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SevenKey Screenshots Gallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .screenshot-gallery { display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 2rem; }
        .screenshot-item { border: 1px solid #ddd; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .screenshot-item img { width: 100%; height: 300px; object-fit: cover; cursor: pointer; transition: transform 0.3s; }
        .screenshot-item img:hover { transform: scale(1.05); }
        .screenshot-title { padding: 1rem; background: #f8f9fa; }
        .modal-img { max-width: 100%; max-height: 80vh; object-fit: contain; }
    </style>
</head>
<body>
    <div class="container py-5">
        <h1 class="text-center mb-5">
            <i class="fas fa-camera"></i> SevenKey System Screenshots
        </h1>
        <p class="text-center text-muted mb-5">Generated on ${new Date().toLocaleString()}</p>
        
        <div class="screenshot-gallery">
            <div class="screenshot-item">
                <img src="./01-login-page.jpg" alt="Login Page" data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImage(this)">
                <div class="screenshot-title">
                    <h5 class="mb-1">Login Page</h5>
                    <small class="text-muted">User authentication interface</small>
                </div>
            </div>
            
            <div class="screenshot-item">
                <img src="./02-dashboard-desktop.jpg" alt="Dashboard Desktop" data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImage(this)">
                <div class="screenshot-title">
                    <h5 class="mb-1">Dashboard - Desktop</h5>
                    <small class="text-muted">Main admin dashboard (1920x1080)</small>
                </div>
            </div>
            
            <div class="screenshot-item">
                <img src="./03-user-management.jpg" alt="User Management" data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImage(this)">
                <div class="screenshot-title">
                    <h5 class="mb-1">User Management</h5>
                    <small class="text-muted">User administration interface</small>
                </div>
            </div>
            
            <div class="screenshot-item">
                <img src="./04-mobile-test-desktop.jpg" alt="Mobile Test Desktop" data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImage(this)">
                <div class="screenshot-title">
                    <h5 class="mb-1">Mobile Test - Desktop View</h5>
                    <small class="text-muted">Mobile layout test on desktop</small>
                </div>
            </div>
            
            <div class="screenshot-item">
                <img src="./05-dashboard-mobile.jpg" alt="Dashboard Mobile" data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImage(this)">
                <div class="screenshot-title">
                    <h5 class="mb-1">Dashboard - Mobile</h5>
                    <small class="text-muted">Mobile responsive layout (375x812)</small>
                </div>
            </div>
            
            <div class="screenshot-item">
                <img src="./06-mobile-test-mobile.jpg" alt="Mobile Test Mobile" data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImage(this)">
                <div class="screenshot-title">
                    <h5 class="mb-1">Mobile Test - Mobile View</h5>
                    <small class="text-muted">Mobile layout test on mobile viewport</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for full-size images -->
    <div class="modal fade" id="imageModal" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalTitle">Screenshot</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" class="modal-img" src="" alt="">
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function showImage(img) {
            document.getElementById('modalImage').src = img.src;
            document.getElementById('imageModalTitle').textContent = img.alt;
        }
    </script>
</body>
</html>`;

        fs.writeFileSync(`${CONFIG.screenshotDir}/gallery.html`, galleryHtml);
        console.log('📊 Gallery created: ./public/screenshots/gallery.html');
    }
}

// Run the tool
const tool = new QuickScreenshot();
tool.takeScreenshots().catch(console.error);
