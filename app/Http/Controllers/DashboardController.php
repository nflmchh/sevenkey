<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Superadmin Dashboard
     */
    public function superadmin()
    {
        if (!Auth::user()->hasRole('superadmin')) {
            abort(403, 'Unauthorized');
        }
        
        // Prevent browser back after logout
        \Illuminate\Support\Facades\Response::macro('nocache', function ($content = '', $status = 200, array $headers = []) {
            $headers = array_merge($headers, [
                'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
                'Pragma' => 'no-cache',
                'Expires' => 'Sat, 01 Jan 2000 00:00:00 GMT',
            ]);
            return response($content, $status, $headers);
        });
        return view('dashboard.superadmin', [
            'user' => Auth::user(),
            'title' => 'Superadmin Dashboard'
        ]);
    }

    /**
     * Owner Dashboard
     */
    public function owner()
    {
        if (!Auth::user()->hasRole('owner')) {
            abort(403, 'Unauthorized');
        }
        
        // Prevent browser back after logout
        \Illuminate\Support\Facades\Response::macro('nocache', function ($content = '', $status = 200, array $headers = []) {
            $headers = array_merge($headers, [
                'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
                'Pragma' => 'no-cache',
                'Expires' => 'Sat, 01 Jan 2000 00:00:00 GMT',
            ]);
            return response($content, $status, $headers);
        });
        return view('dashboard.owner', [
            'user' => Auth::user(),
            'title' => 'Owner Dashboard'
        ]);
    }

    /**
     * Admin Gudang Dashboard
     */
    public function adminGudang()
    {
        if (!Auth::user()->hasRole('admin_gudang')) {
            abort(403, 'Unauthorized');
        }

        // Prevent browser back after logout
        \Illuminate\Support\Facades\Response::macro('nocache', function ($content = '', $status = 200, array $headers = []) {
            $headers = array_merge($headers, [
                'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
                'Pragma' => 'no-cache',
                'Expires' => 'Sat, 01 Jan 2000 00:00:00 GMT',
            ]);
            return response($content, $status, $headers);
        });

        // Ambil produk terbaru (misal 10 terakhir)
        $produks = \App\Models\Produk::orderBy('created_at', 'asc')->take(10)->get();

        // Total produk
        $totalProduk = \App\Models\Produk::count();

        // Barang masuk hari ini
        $barangMasukHariIni = \App\Models\Produk::whereDate('created_at', now()->toDateString())->count();

        return view('dashboard.admin-gudang', [
            'user' => Auth::user(),
            'title' => 'Admin Gudang Dashboard',
            'produks' => $produks,
            'totalProduk' => $totalProduk,
            'barangMasukHariIni' => $barangMasukHariIni
        ]);
    }

    /**
     * Operator Gudang Dashboard
     */
    public function operatorGudang()
    {
        if (!Auth::user()->hasRole('operator_gudang')) {
            abort(403, 'Unauthorized');
        }
        
        // Prevent browser back after logout
        \Illuminate\Support\Facades\Response::macro('nocache', function ($content = '', $status = 200, array $headers = []) {
            $headers = array_merge($headers, [
                'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
                'Pragma' => 'no-cache',
                'Expires' => 'Sat, 01 Jan 2000 00:00:00 GMT',
            ]);
            return response($content, $status, $headers);
        });
        return view('dashboard.operator-gudang', [
            'user' => Auth::user(),
            'title' => 'Operator Gudang Dashboard'
        ]);
    }

    /**
     * Kasir Dashboard
     */
    public function kasir()
    {
        if (!Auth::user()->hasRole('kasir')) {
            abort(403, 'Unauthorized');
        }
        
        // Prevent browser back after logout
        \Illuminate\Support\Facades\Response::macro('nocache', function ($content = '', $status = 200, array $headers = []) {
            $headers = array_merge($headers, [
                'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
                'Pragma' => 'no-cache',
                'Expires' => 'Sat, 01 Jan 2000 00:00:00 GMT',
            ]);
            return response($content, $status, $headers);
        });
        return view('dashboard.kasir', [
            'user' => Auth::user(),
            'title' => 'Kasir Dashboard'
        ]);
    }

    /**
     * Supervisor Keuangan Dashboard
     */
    public function supervisorKeuangan()
    {
        if (!Auth::user()->hasRole('supervisor_keuangan')) {
            abort(403, 'Unauthorized');
        }
        
        // Prevent browser back after logout
        \Illuminate\Support\Facades\Response::macro('nocache', function ($content = '', $status = 200, array $headers = []) {
            $headers = array_merge($headers, [
                'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
                'Pragma' => 'no-cache',
                'Expires' => 'Sat, 01 Jan 2000 00:00:00 GMT',
            ]);
            return response($content, $status, $headers);
        });
        return view('dashboard.supervisor-keuangan', [
            'user' => Auth::user(),
            'title' => 'Supervisor Keuangan Dashboard'
        ]);
    }

    /**
     * Marketing Dashboard
     */
    public function marketing()
    {
        if (!Auth::user()->hasRole('marketing')) {
            abort(403, 'Unauthorized');
        }
        
        // Prevent browser back after logout
        \Illuminate\Support\Facades\Response::macro('nocache', function ($content = '', $status = 200, array $headers = []) {
            $headers = array_merge($headers, [
                'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
                'Pragma' => 'no-cache',
                'Expires' => 'Sat, 01 Jan 2000 00:00:00 GMT',
            ]);
            return response($content, $status, $headers);
        });
        return view('dashboard.marketing', [
            'user' => Auth::user(),
            'title' => 'Marketing Dashboard'
        ]);
    }

    /**
     * General Dashboard (fallback)
     */
    public function index()
    {
        return view('dashboard.index', [
            'user' => Auth::user(),
            'title' => 'Dashboard'
        ]);
    }
}
