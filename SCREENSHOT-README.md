# 📸 SevenKey Screenshot Automation Tool

Alat otomatis untuk mengambil screenshot semua halaman sistem SevenKey untuk presentasi ke client.

## 🚀 Quick Start

### Opsi 1: Quick Screenshots (Recommended)
Untuk ambil screenshot cepat halaman utama:

```bash
# Double-click file ini:
run-quick-screenshots.bat
```

### Opsi 2: Full Automation (All Roles)
Untuk ambil screenshot semua role dan halaman:

```bash
# Double-click file ini:
run-screenshots.bat
```

## 📋 Prerequisites

1. **XAMPP** harus running
2. **Laravel SevenKey** dapat diakses di `http://127.0.0.1:8000`
3. **Node.js** terinstall di komputer
4. **User test** sudah dibuat untuk setiap role

## ⚙️ Configuration

### Quick Screenshots
Edit file `quick-screenshots.js` bagian config:

```javascript
const CONFIG = {
    baseUrl: 'http://127.0.0.1:8000',
    adminEmail: 'admin@example.com',  // Ganti dengan email admin
    adminPassword: 'password',        // Ganti dengan password admin
};
```

### Full Automation
Edit file `screenshot-automation.js` bagian USERS:

```javascript
const USERS = {
    superadmin: { email: 'superadmin@sevenkey.com', password: 'password' },
    owner: { email: 'owner@sevenkey.com', password: 'password' },
    // ... dst
};
```

## 📁 Output Structure

```
public/screenshots/
├── gallery.html              # Quick gallery view
├── screenshot-report.html    # Full automation report
├── desktop/
│   ├── superadmin/
│   ├── owner/
│   └── ...
├── mobile/
│   ├── superadmin/
│   ├── owner/
│   └── ...
└── thumbnails/
    ├── superadmin/
    ├── owner/
    └── ...
```

## 🎯 What Gets Captured

### Quick Screenshots:
- ✅ Login page
- ✅ SuperAdmin dashboard (desktop + mobile)
- ✅ User management page
- ✅ Mobile test page (desktop + mobile)

### Full Automation:
- ✅ All roles (SuperAdmin, Owner, Admin Gudang, dll)
- ✅ All pages per role (Dashboard, Management pages, dll)
- ✅ Desktop view (1920x1080)
- ✅ Mobile view (375x812)
- ✅ Thumbnails (400x300)

## 🔧 Manual Installation

Jika batch file tidak berjalan:

```bash
# 1. Install dependencies
npm install puppeteer

# 2. Run quick version
node quick-screenshots.js

# 3. Or run full version
node screenshot-automation.js
```

## 📊 Viewing Results

### Quick Results:
Buka `public/screenshots/gallery.html` di browser

### Full Results:
Buka `public/screenshots/screenshot-report.html` di browser

## 🐛 Troubleshooting

### "Node.js not found"
Install Node.js dari: https://nodejs.org/

### "XAMPP not running"
1. Start Apache di XAMPP Control Panel
2. Pastikan Laravel bisa diakses di http://127.0.0.1:8000

### "Login failed"
1. Cek email/password di config
2. Pastikan user sudah ada di database
3. Cek tabel users di phpMyAdmin

### "Puppeteer installation failed"
```bash
npm install puppeteer --no-optional
```

### "Page not found"
1. Pastikan routes sudah benar
2. Cek middleware auth
3. Pastikan semua halaman accessible

## 📞 Support

Jika ada masalah:
1. Cek console output untuk error messages
2. Pastikan semua prerequisites terpenuhi
3. Test manual login ke sistem dulu

## 📋 Todo / Features

- [ ] Auto-detect available roles
- [ ] Custom page configuration
- [ ] PDF export
- [ ] Watermark support
- [ ] Batch resize/compress
- [ ] Email report
- [ ] Scheduled screenshots

---

**Generated for SevenKey System**  
*Professional screenshot automation for client presentations*
