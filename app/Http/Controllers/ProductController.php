<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\product;
use App\Models\customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::all();
        return view('product.index', compact('product'));
    }

    public function create()
    {
        $customers = customer::all();
        return view('product.tambah', compact('customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'nama' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'harga' => 'required|numeric',
            'quantity' => 'required|integer',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('uploads/products', 'public');
        }

        Product::create([
            'customer_id' => $request->customer_id,
            'nama' => $request->nama,
            'photo' => $photoPath,
            'category' => $request->category,
            'description' => $request->description,
            'harga' => $request->harga,
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('product.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        return view('product.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'harga' => 'required|numeric',
            'quantity' => 'required|integer',
        ]);

        if ($request->hasFile('photo')) {
            if ($product->photo) {
                Storage::disk('public')->delete($product->photo);
            }
            $photoPath = $request->file('photo')->store('uploads/products', 'public');
            $product->photo = $photoPath;
        }

        $product->update([
            'nama' => $request->nama,
            'category' => $request->category,
            'description' => $request->description,
            'harga' => $request->harga,
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('product.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        if ($product->photo) {
            Storage::disk('public')->delete($product->photo);
        }

        $product->delete();

        return redirect()->route('product.index')->with('success', 'Produk berhasil dihapus.');
    }
}
