<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with('product')->get();
        return view('review.index', compact('reviews'));
    }

    public function create()
    {
        $products = Product::all();
        return view('review.tambah', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        Review::create([
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('review.index')->with('success', 'Review berhasil ditambahkan!');
    }

    public function show(string $id)
    {
        $review = Review::with('product')->findOrFail($id);
        return view('review.show', compact('review'));
    }

    public function edit(string $id)
    {
        $review = Review::findOrFail($id);
        $products = Product::all();

        return view('review.edit', compact('review', 'products'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $review = Review::findOrFail($id);

        $review->update([
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('review.index')->with('success', 'Review berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $review = Review::findOrFail($id);

        $review->delete();

        return redirect()->route('review.index')->with('success', 'Review berhasil dihapus!');
    }
}
