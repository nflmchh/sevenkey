const puppeteer = require('puppeteer');
const fs = require('fs');
const path = require('path');

// Configuration
const CONFIG = {
    baseUrl: 'http://127.0.0.1:8000',
    screenshotDir: './public/screenshots',
    viewport: {
        width: 1920,
        height: 1080
    },
    mobileViewport: {
        width: 375,
        height: 812
    },
    delay: 2000, // Wait time after page load
    quality: 90, // JPEG quality
};

// User credentials for each role
const USERS = {
    superadmin: { email: 'superadmin@sevenkey.com', password: 'password' },
    owner: { email: 'owner@sevenkey.com', password: 'password' },
    'admin-gudang': { email: 'admin-gudang@sevenkey.com', password: 'password' },
    'operator-gudang': { email: 'operator-gudang@sevenkey.com', password: 'password' },
    kasir: { email: 'kasir@sevenkey.com', password: 'password' },
    'supervisor-keuangan': { email: 'supervisor-keuangan@sevenkey.com', password: 'password' },
    marketing: { email: 'marketing@sevenkey.com', password: 'password' }
};

// Pages to screenshot for each role
const PAGES = {
    superadmin: [
        { name: 'dashboard', url: '/superadmin/dashboard', title: 'SuperAdmin Dashboard' },
        { name: 'users', url: '/superadmin/users', title: 'User Management' },
        { name: 'products', url: '/superadmin/products', title: 'Product Management' },
        { name: 'users-create', url: '/superadmin/users/create', title: 'Create User' }
    ],
    owner: [
        { name: 'dashboard', url: '/owner/dashboard', title: 'Owner Dashboard' },
        { name: 'reports', url: '/owner/reports', title: 'Business Reports' }
    ],
    'admin-gudang': [
        { name: 'dashboard', url: '/admin-gudang/dashboard', title: 'Warehouse Admin Dashboard' },
        { name: 'inventory', url: '/admin-gudang/inventory', title: 'Inventory Management' }
    ],
    'operator-gudang': [
        { name: 'dashboard', url: '/operator-gudang/dashboard', title: 'Warehouse Operator Dashboard' },
        { name: 'operations', url: '/operator-gudang/operations', title: 'Daily Operations' }
    ],
    kasir: [
        { name: 'dashboard', url: '/kasir/dashboard', title: 'Cashier Dashboard' },
        { name: 'pos', url: '/kasir/pos', title: 'Point of Sale' }
    ],
    'supervisor-keuangan': [
        { name: 'dashboard', url: '/supervisor-keuangan/dashboard', title: 'Financial Supervisor Dashboard' },
        { name: 'finance', url: '/supervisor-keuangan/finance', title: 'Financial Management' }
    ],
    marketing: [
        { name: 'dashboard', url: '/marketing/dashboard', title: 'Marketing Dashboard' },
        { name: 'campaigns', url: '/marketing/campaigns', title: 'Marketing Campaigns' }
    ]
};

class ScreenshotAutomation {
    constructor() {
        this.browser = null;
        this.page = null;
        this.setupDirectories();
    }

    setupDirectories() {
        // Create screenshots directory structure
        const dirs = [
            CONFIG.screenshotDir,
            `${CONFIG.screenshotDir}/desktop`,
            `${CONFIG.screenshotDir}/mobile`,
            `${CONFIG.screenshotDir}/thumbnails`
        ];

        dirs.forEach(dir => {
            if (!fs.existsSync(dir)) {
                fs.mkdirSync(dir, { recursive: true });
                console.log(`Created directory: ${dir}`);
            }
        });

        // Create role-specific directories
        Object.keys(USERS).forEach(role => {
            const desktopDir = `${CONFIG.screenshotDir}/desktop/${role}`;
            const mobileDir = `${CONFIG.screenshotDir}/mobile/${role}`;
            const thumbDir = `${CONFIG.screenshotDir}/thumbnails/${role}`;
            
            [desktopDir, mobileDir, thumbDir].forEach(dir => {
                if (!fs.existsSync(dir)) {
                    fs.mkdirSync(dir, { recursive: true });
                }
            });
        });
    }

    async init() {
        console.log('🚀 Starting SevenKey Screenshot Automation...');
        
        this.browser = await puppeteer.launch({
            headless: false, // Set to true for production
            defaultViewport: null,
            args: [
                '--start-maximized',
                '--no-sandbox',
                '--disable-setuid-sandbox',
                '--disable-dev-shm-usage',
                '--disable-accelerated-2d-canvas',
                '--no-first-run',
                '--no-zygote',
                '--disable-gpu'
            ]
        });

        this.page = await this.browser.newPage();
        
        // Set user agent
        await this.page.setUserAgent('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36');
        
        console.log('✅ Browser initialized');
    }

    async login(role) {
        const user = USERS[role];
        if (!user) {
            throw new Error(`User credentials not found for role: ${role}`);
        }

        console.log(`🔑 Logging in as ${role}...`);
        
        // Go to login page
        await this.page.goto(`${CONFIG.baseUrl}/login`, { waitUntil: 'networkidle0' });
        
        // Fill login form
        await this.page.type('input[name="email"]', user.email);
        await this.page.type('input[name="password"]', user.password);
        
        // Submit form
        await Promise.all([
            this.page.waitForNavigation({ waitUntil: 'networkidle0' }),
            this.page.click('button[type="submit"]')
        ]);

        console.log(`✅ Successfully logged in as ${role}`);
    }

    async takeScreenshot(role, page, device = 'desktop') {
        const viewport = device === 'mobile' ? CONFIG.mobileViewport : CONFIG.viewport;
        await this.page.setViewport(viewport);

        const url = `${CONFIG.baseUrl}${page.url}`;
        console.log(`📸 Taking ${device} screenshot: ${page.title} (${url})`);

        try {
            await this.page.goto(url, { waitUntil: 'networkidle0', timeout: 30000 });
            await this.page.waitForTimeout(CONFIG.delay);

            // Remove any loading overlays or spinners
            await this.page.evaluate(() => {
                const loadingElements = document.querySelectorAll('.loading, .spinner, .overlay');
                loadingElements.forEach(el => el.remove());
            });

            // Take full page screenshot
            const filename = `${role}-${page.name}-${device}.jpg`;
            const filepath = `${CONFIG.screenshotDir}/${device}/${role}/${filename}`;
            
            await this.page.screenshot({
                path: filepath,
                type: 'jpeg',
                quality: CONFIG.quality,
                fullPage: true
            });

            // Create thumbnail (400x300)
            const thumbPath = `${CONFIG.screenshotDir}/thumbnails/${role}/${filename}`;
            await this.page.screenshot({
                path: thumbPath,
                type: 'jpeg',
                quality: 80,
                clip: { x: 0, y: 0, width: 400, height: 300 }
            });

            console.log(`✅ Screenshot saved: ${filepath}`);
            return filepath;

        } catch (error) {
            console.error(`❌ Failed to screenshot ${page.title}: ${error.message}`);
            return null;
        }
    }

    async captureAllRoles() {
        const results = {};

        for (const [role, user] of Object.entries(USERS)) {
            console.log(`\n🎯 Processing role: ${role.toUpperCase()}`);
            results[role] = { desktop: [], mobile: [], errors: [] };

            try {
                // Login as this role
                await this.login(role);

                // Get pages for this role
                const pages = PAGES[role] || [{ name: 'dashboard', url: `/${role}/dashboard`, title: `${role} Dashboard` }];

                // Take desktop screenshots
                for (const page of pages) {
                    const desktopPath = await this.takeScreenshot(role, page, 'desktop');
                    if (desktopPath) {
                        results[role].desktop.push({ page: page.title, path: desktopPath });
                    }
                }

                // Take mobile screenshots
                for (const page of pages) {
                    const mobilePath = await this.takeScreenshot(role, page, 'mobile');
                    if (mobilePath) {
                        results[role].mobile.push({ page: page.title, path: mobilePath });
                    }
                }

                // Logout
                try {
                    await this.page.goto(`${CONFIG.baseUrl}/logout`, { waitUntil: 'networkidle0' });
                } catch (error) {
                    console.warn(`⚠️ Logout failed for ${role}, continuing...`);
                }

            } catch (error) {
                console.error(`❌ Failed to process role ${role}: ${error.message}`);
                results[role].errors.push(error.message);
            }
        }

        return results;
    }

    async generateReport(results) {
        const reportPath = `${CONFIG.screenshotDir}/screenshot-report.html`;
        
        let html = `
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SevenKey Screenshots Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .screenshot-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1rem; }
        .screenshot-item { border: 1px solid #ddd; border-radius: 8px; overflow: hidden; }
        .screenshot-item img { width: 100%; height: 200px; object-fit: cover; }
        .role-section { margin-bottom: 3rem; }
        .device-tabs .nav-link.active { background-color: #0d6efd; color: white; }
    </style>
</head>
<body>
    <div class="container-fluid py-4">
        <h1 class="mb-4 text-center">
            <i class="fas fa-camera"></i> SevenKey System Screenshots
        </h1>
        <p class="text-center text-muted mb-5">Generated on ${new Date().toLocaleString()}</p>
`;

        Object.entries(results).forEach(([role, data]) => {
            html += `
        <div class="role-section">
            <h2 class="text-primary mb-3">
                <i class="fas fa-user-tag"></i> ${role.toUpperCase()} Role
            </h2>
            
            <ul class="nav nav-tabs device-tabs mb-3" id="${role}-tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="${role}-desktop-tab" data-bs-toggle="tab" 
                            data-bs-target="#${role}-desktop" type="button" role="tab">
                        <i class="fas fa-desktop"></i> Desktop View
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="${role}-mobile-tab" data-bs-toggle="tab" 
                            data-bs-target="#${role}-mobile" type="button" role="tab">
                        <i class="fas fa-mobile-alt"></i> Mobile View
                    </button>
                </li>
            </ul>
            
            <div class="tab-content" id="${role}-tabContent">
                <div class="tab-pane fade show active" id="${role}-desktop" role="tabpanel">
                    <div class="screenshot-grid">
`;
            
            data.desktop.forEach(item => {
                const relativePath = item.path.replace(/.*\/public\//, './');
                html += `
                        <div class="screenshot-item">
                            <img src="${relativePath}" alt="${item.page}" loading="lazy">
                            <div class="p-3">
                                <h6 class="mb-0">${item.page}</h6>
                                <small class="text-muted">Desktop View</small>
                            </div>
                        </div>
`;
            });

            html += `
                    </div>
                </div>
                <div class="tab-pane fade" id="${role}-mobile" role="tabpanel">
                    <div class="screenshot-grid">
`;

            data.mobile.forEach(item => {
                const relativePath = item.path.replace(/.*\/public\//, './');
                html += `
                        <div class="screenshot-item">
                            <img src="${relativePath}" alt="${item.page}" loading="lazy">
                            <div class="p-3">
                                <h6 class="mb-0">${item.page}</h6>
                                <small class="text-muted">Mobile View</small>
                            </div>
                        </div>
`;
            });

            html += `
                    </div>
                </div>
            </div>
        </div>
`;
        });

        html += `
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
`;

        fs.writeFileSync(reportPath, html);
        console.log(`📊 Report generated: ${reportPath}`);
        return reportPath;
    }

    async run() {
        try {
            await this.init();
            const results = await this.captureAllRoles();
            const reportPath = await this.generateReport(results);
            
            console.log('\n🎉 Screenshot automation completed!');
            console.log(`📁 Screenshots saved to: ${CONFIG.screenshotDir}`);
            console.log(`📊 Report available at: ${reportPath}`);
            
            // Print summary
            console.log('\n📋 Summary:');
            Object.entries(results).forEach(([role, data]) => {
                console.log(`   ${role}: ${data.desktop.length} desktop + ${data.mobile.length} mobile screenshots`);
                if (data.errors.length > 0) {
                    console.log(`   ❌ Errors: ${data.errors.join(', ')}`);
                }
            });

        } catch (error) {
            console.error('❌ Automation failed:', error);
        } finally {
            if (this.browser) {
                await this.browser.close();
            }
        }
    }
}

// Run the automation
const automation = new ScreenshotAutomation();
automation.run().catch(console.error);
