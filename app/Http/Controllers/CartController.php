<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    /**
     * Menampilkan halaman keranjang belanja.
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    /**
     * Menambahkan produk ke keranjang.
     */
    public function add(Request $request)
    {
        // Validasi produk yang dikirim
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Ambil data keranjang dari session
        $cart = session()->get('cart', []);

        // Tambahkan atau update produk di keranjang
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++; // Jika produk sudah ada, tambahkan kuantitas
        } else {
            $cart[$product->id] = [
                'name' => $product->nama,
                'price' => $product->harga,
                'quantity' => 1,
            ];
        }

        // Simpan kembali ke session
        session()->put('cart', $cart);

        return redirect()->route('product.index')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    /**
     * Mengupdate jumlah kuantitas produk di keranjang.
     */
    public function update(Request $request)
    {
        // Validasi input untuk memastikan product_id adalah array
        $request->validate([
            'product_id' => 'required|array',
            'product_id.*' => 'integer|min:1', // Pastikan setiap item dalam array adalah integer
        ]);

        $cart = session()->get('cart', []);

        foreach ($request->product_id as $id => $quantity) {
            if (isset($cart[$id])) {
                $cart[$id]['quantity'] = max(1, (int) $quantity); // Update kuantitas, minimal 1
            }
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Keranjang berhasil diperbarui!');
    }

    /**
     * Menghapus produk dari keranjang.
     */
    public function remove(Request $request)
    {
        // Validasi input
        $request->validate([
            'product_id' => 'required|integer',
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$request->product_id])) {
            unset($cart[$request->product_id]); // Hapus produk dari keranjang
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Produk berhasil dihapus dari keranjang!');
    }

    /**
     * Menghapus semua item di keranjang.
     */
    public function clear()
    {
        session()->forget('cart'); // Hapus semua data di keranjang
        return redirect()->route('cart.index')->with('success', 'Keranjang berhasil dikosongkan!');
    }
}