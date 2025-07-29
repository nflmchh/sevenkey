// Fast screenshot using existing Chrome browser
const puppeteer = require('puppeteer-core');
const fs = require('fs');

const CONFIG = {
    baseUrl: 'http://127.0.0.1:8000',
    screenshotDir: './public/screenshots',
    adminEmail: 'admin@example.com',
    adminPassword: 'password',
    // Use existing Chrome installation
    chromePath: 'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe'
};

class FastScreenshot {
    constructor() {
        this.setupDirectory();
    }

    setupDirectory() {
        if (!fs.existsSync(CONFIG.screenshotDir)) {
            fs.mkdirSync(CONFIG.screenshotDir, { recursive: true });
        }
    }

    async findChrome() {
        const possiblePaths = [
            'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe',
            'C:\\Program Files (x86)\\Google\\Chrome\\Application\\chrome.exe',
            process.env.LOCALAPPDATA + '\\Google\\Chrome\\Application\\chrome.exe',
            'C:\\Program Files\\Microsoft\\Edge\\Application\\msedge.exe'
        ];

        for (const path of possiblePaths) {
            if (fs.existsSync(path)) {
                console.log(`✅ Found browser: ${path}`);
                return path;
            }
        }
        
        throw new Error('❌ No Chrome/Edge browser found. Please install Chrome.');
    }

    async takeQuickScreenshots() {
        console.log('🚀 Starting Fast Screenshot (using existing Chrome)...');
        
        try {
            const chromePath = await this.findChrome();
            
            const browser = await puppeteer.launch({
                executablePath: chromePath,
                headless: false,
                defaultViewport: null,
                args: ['--start-maximized', '--disable-web-security']
            });

            const page = await browser.newPage();
            await page.setViewport({ width: 1920, height: 1080 });

            const screenshots = [];

            // 1. Login page
            console.log('📸 Capturing login page...');
            await page.goto(`${CONFIG.baseUrl}/login`, { waitUntil: 'domcontentloaded' });
            await page.waitForTimeout(1000);
            const loginPath = `${CONFIG.screenshotDir}/01-login.jpg`;
            await page.screenshot({ path: loginPath, type: 'jpeg', quality: 85 });
            screenshots.push({ name: 'Login Page', path: loginPath });

            // 2. Try login (might fail, that's OK)
            try {
                await page.type('input[name="email"]', CONFIG.adminEmail, { delay: 50 });
                await page.type('input[name="password"]', CONFIG.adminPassword, { delay: 50 });
                await page.click('button[type="submit"]');
                await page.waitForTimeout(2000);
            } catch (e) {
                console.log('⚠️ Login might have failed, continuing...');
            }

            // 3. Dashboard
            console.log('📸 Capturing dashboard...');
            await page.goto(`${CONFIG.baseUrl}/superadmin/dashboard`, { waitUntil: 'domcontentloaded' });
            await page.waitForTimeout(2000);
            const dashPath = `${CONFIG.screenshotDir}/02-dashboard.jpg`;
            await page.screenshot({ path: dashPath, type: 'jpeg', quality: 85 });
            screenshots.push({ name: 'Dashboard', path: dashPath });

            // 4. Mobile test
            console.log('📸 Capturing mobile test...');
            await page.goto(`${CONFIG.baseUrl}/mobile-test.html`, { waitUntil: 'domcontentloaded' });
            await page.waitForTimeout(1000);
            const mobilePath = `${CONFIG.screenshotDir}/03-mobile-test.jpg`;
            await page.screenshot({ path: mobilePath, type: 'jpeg', quality: 85 });
            screenshots.push({ name: 'Mobile Test', path: mobilePath });

            // 5. Mobile viewport
            console.log('📸 Capturing mobile view...');
            await page.setViewport({ width: 375, height: 812 });
            await page.reload({ waitUntil: 'domcontentloaded' });
            await page.waitForTimeout(1000);
            const mobileViewPath = `${CONFIG.screenshotDir}/04-mobile-view.jpg`;
            await page.screenshot({ path: mobileViewPath, type: 'jpeg', quality: 85, fullPage: true });
            screenshots.push({ name: 'Mobile View', path: mobileViewPath });

            await browser.close();

            // Create simple gallery
            this.createSimpleGallery(screenshots);
            
            console.log('🎉 Fast screenshots completed!');
            console.log(`📁 Screenshots saved to: ${CONFIG.screenshotDir}`);
            console.log(`📊 Gallery: ${CONFIG.screenshotDir}/gallery.html`);

        } catch (error) {
            console.error('❌ Error:', error.message);
            console.log('\n💡 Try the manual method instead:');
            console.log('   1. Run: run-manual-screenshots.bat');
            console.log('   2. Or use browser extensions for screenshots');
        }
    }

    createSimpleGallery(screenshots) {
        const html = `
<!DOCTYPE html>
<html>
<head>
    <title>SevenKey Screenshots</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .screenshot { margin-bottom: 2rem; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; }
        .screenshot img { width: 100%; max-height: 400px; object-fit: cover; }
        .screenshot-title { padding: 1rem; background: #f8f9fa; }
    </style>
</head>
<body>
    <div class="container py-4">
        <h1 class="text-center mb-4">📸 SevenKey Screenshots</h1>
        <p class="text-center text-muted">Generated: ${new Date().toLocaleString()}</p>
        
        <div class="row">
            ${screenshots.map(shot => `
            <div class="col-md-6 mb-4">
                <div class="screenshot">
                    <img src="./${shot.path.split('/').pop()}" alt="${shot.name}">
                    <div class="screenshot-title">
                        <h5>${shot.name}</h5>
                        <small class="text-muted">${shot.path}</small>
                    </div>
                </div>
            </div>
            `).join('')}
        </div>
        
        <div class="alert alert-info">
            <h6>📋 Manual Screenshot Tips:</h6>
            <ul class="mb-0">
                <li>Use browser's built-in screenshot (Ctrl+Shift+S)</li>
                <li>Install "Full Page Screen Capture" extension</li>
                <li>Set browser to 1920x1080 for desktop screenshots</li>
                <li>Use device mode (F12) for mobile screenshots</li>
            </ul>
        </div>
    </div>
</body>
</html>`;
        
        fs.writeFileSync(`${CONFIG.screenshotDir}/gallery.html`, html);
    }
}

// Check if this is being run directly
if (require.main === module) {
    const tool = new FastScreenshot();
    tool.takeQuickScreenshots();
}

module.exports = FastScreenshot;
