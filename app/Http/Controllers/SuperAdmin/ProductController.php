<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::user()->hasAnyRole(['superadmin', 'admin_gudang'])) {
            abort(403, 'Unauthorized');
        }

        $query = Product::query();

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('code', 'like', '%' . $request->search . '%')
                  ->orWhere('category', 'like', '%' . $request->search . '%');
        }

        if ($request->category) {
            $query->where('category', $request->category);
        }

        if ($request->low_stock) {
            $query->whereRaw('stock <= min_stock');
        }

        $products = $query->paginate(10);
        $categories = Product::distinct()->pluck('category');

        return view('superadmin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        if (!Auth::user()->hasAnyRole(['superadmin', 'admin_gudang'])) {
            abort(403, 'Unauthorized');
        }

        return view('superadmin.products.create');
    }

    public function store(Request $request)
    {
        if (!Auth::user()->hasAnyRole(['superadmin', 'admin_gudang'])) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:products',
            'description' => 'nullable|string',
            'category' => 'required|in:elektronik,fashion,makanan,minuman,kesehatan,olahraga,otomotif,lainnya',
            'price' => 'required|numeric|min:0',
            'cost_price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'min_stock' => 'required|integer|min:0',
            'unit' => 'required|string|max:255',
            'supplier' => 'nullable|string|max:255',
        ]);

        Product::create($request->all());

        return redirect()->route('superadmin.products.index')
                        ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function show(Product $product)
    {
        if (!Auth::user()->hasAnyRole(['superadmin', 'admin_gudang', 'operator_gudang'])) {
            abort(403, 'Unauthorized');
        }

        return view('superadmin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        if (!Auth::user()->hasAnyRole(['superadmin', 'admin_gudang'])) {
            abort(403, 'Unauthorized');
        }

        return view('superadmin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        if (!Auth::user()->hasAnyRole(['superadmin', 'admin_gudang'])) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:products,code,' . $product->id,
            'description' => 'nullable|string',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'cost_price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'min_stock' => 'required|integer|min:0',
            'unit' => 'required|string|max:255',
            'supplier' => 'nullable|string|max:255',
        ]);

        $product->update($request->all());

        return redirect()->route('superadmin.products.index')
                        ->with('success', 'Produk berhasil diupdate.');
    }

    public function destroy(Product $product)
    {
        if (!Auth::user()->hasRole('superadmin')) {
            abort(403, 'Unauthorized');
        }

        $product->delete();

        return redirect()->route('superadmin.products.index')
                        ->with('success', 'Produk berhasil dihapus.');
    }

    public function updateStock(Request $request, Product $product)
    {
        if (!Auth::user()->hasAnyRole(['superadmin', 'admin_gudang', 'operator_gudang'])) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'stock' => 'required|integer|min:0',
            'note' => 'nullable|string'
        ]);

        $product->update(['stock' => $request->stock]);

        return redirect()->back()->with('success', 'Stok berhasil diupdate.');
    }
}
