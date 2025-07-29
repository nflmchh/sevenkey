//
<?php
use Illuminate\Support\Facades\Route;
use Milon\Barcode\DNS1D;
use Illuminate\Support\Facades\Response;

// Barcode PNG generator
Route::get('/barcode/png/{barcode}', function($barcode) {
    try {
        $barcode = urldecode($barcode);
        if (!class_exists('Milon\\Barcode\\DNS1D')) {
            throw new \Exception('Barcode library not found');
        }
        $generator = new DNS1D();
        $imageData = $generator->getBarcodePNG($barcode, 'C128', 2, 60, [0,0,0], true);
        return Response::make($imageData, 200, [
            'Content-Type' => 'image/png',
            'Content-Disposition' => 'inline; filename="barcode.png"'
        ]);
    } catch (\Throwable $e) {
        // Return 1x1 transparent PNG if error
        $blank = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR4nGNgYAAAAAMAASsJTYQAAAAASUVORK5CYII=');
        return Response::make($blank, 200, [
            'Content-Type' => 'image/png',
            'Content-Disposition' => 'inline; filename="barcode.png"'
        ]);
    }
})->where('barcode', '.*');

// Landing page route
Route::get('/', function() {
    return view('welcome-clothing');
});
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuperAdmin\UserController;
use App\Http\Controllers\SuperAdmin\ProductController;
use App\Http\Controllers\AdminGudangProdukController;
// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard Routes (Protected by auth middleware)
Route::middleware('auth')->group(function () {
    // Katalog Produk per Kategori (Admin Gudang)
    Route::get('/admin-gudang/catalog', function() {
        $kategoriList = \App\Models\Produk::select('kategori')->distinct()->pluck('kategori')->toArray();
        $query = \App\Models\Produk::query();
        if (request('kategori')) {
            $query->where('kategori', request('kategori'));
        }
        $produks = $query->orderBy('nama_barang')->get();
        return view('dashboard.catalog', compact('produks', 'kategoriList'));
    })->name('admin-gudang.catalog');
    // General dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Role-specific dashboards
    Route::get('/superadmin/dashboard', [DashboardController::class, 'superadmin'])->name('superadmin.dashboard');
    Route::get('/owner/dashboard', [DashboardController::class, 'owner'])->name('owner.dashboard');
    Route::get('/admin-gudang/dashboard', [DashboardController::class, 'adminGudang'])->name('admin-gudang.dashboard');
    Route::get('/operator-gudang/dashboard', [DashboardController::class, 'operatorGudang'])->name('operator-gudang.dashboard');
    Route::get('/kasir/dashboard', [DashboardController::class, 'kasir'])->name('kasir.dashboard');
    Route::get('/supervisor-keuangan/dashboard', [DashboardController::class, 'supervisorKeuangan'])->name('supervisor-keuangan.dashboard');
    Route::get('/marketing/dashboard', [DashboardController::class, 'marketing'])->name('marketing.dashboard');

    // Produk CRUD
    Route::post('/admin-gudang/produk/store', [AdminGudangProdukController::class, 'store'])->name('admin-gudang.produk.store');
    Route::put('/admin-gudang/produk/update/{id}', [AdminGudangProdukController::class, 'update'])->name('admin-gudang.produk.update');
    Route::delete('/admin-gudang/produk/destroy/{id}', [AdminGudangProdukController::class, 'destroy'])->name('admin-gudang.produk.destroy');

    // Stock Masuk page
    Route::get('/admin-gudang/stock-masuk', function() {
        $totalProduk = 0;
        $barangMasukHariIni = 0;
        $produks = \App\Models\Produk::orderBy('created_at', 'desc')->get();
        return view('dashboard.admin-gudang', [
            'menu' => 'stock-masuk',
            'totalProduk' => $totalProduk,
            'barangMasukHariIni' => $barangMasukHariIni,
            'produks' => $produks
        ]);
    })->name('admin-gudang.stock-masuk');

    // Stock Keluar page
    Route::get('/admin-gudang/stock-keluar', function() {
        return view('dashboard.stock-keluar');
    })->name('admin-gudang.stock-keluar');

    // Export Stock Keluar (PDF/Excel)
    Route::get('/admin-gudang/stock-keluar/export', [\App\Http\Controllers\StockKeluarExportController::class, 'export'])->name('admin-gudang.stock-keluar.export');

    // Proses keluar (scanner input)
    Route::post('/admin-gudang/stock-keluar', [\App\Http\Controllers\AdminGudangProdukController::class, 'stockKeluarStore'])->name('admin-gudang.stock-keluar.store');

    // Superadmin Routes
    Route::prefix('superadmin')->name('superadmin.')->group(function () {
        // User Management
        Route::resource('users', UserController::class);
        // Product Management
        Route::resource('products', ProductController::class);
        Route::patch('products/{product}/stock', [ProductController::class, 'updateStock'])->name('products.update-stock');
    });
});
