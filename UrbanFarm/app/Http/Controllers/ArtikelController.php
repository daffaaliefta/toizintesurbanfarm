<?php

namespace App\Http\Controllers;

use App\Models\artikel;
use App\Models\Customer;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index()
    {
        $artikels = artikel::all();
        return view('artikel.index', compact('artikels'));
    }

    public function create()
    {
        $customers = Customer::all();
        return view('artikel.tambah', compact('customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'title' => 'required|string|max:255',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'text' => 'required|string',
        ]);

        $photoPath = $request->file('photo')->store('artikels', 'public');

        Artikel::create([
            'customer_id' => $request->customer_id,
            'title' => $request->title,
            'photo' => $photoPath,
            'text' => $request->text,
        ]);

        return redirect()->route('artikel.index')->with('success', 'Artikel berhasil ditambahkan!');
    }

    public function show($id)
    {
        $artikel = artikel::findOrFail($id);

        return view('artikel.show', compact('artikel'));
    }

    public function edit($id)
    {
        $artikel = artikel::findOrFail($id);

        return view('artikel.edit', compact('artikel'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'text' => 'required|string',
        ]);

        $artikel = artikel::findOrFail($id);

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('artikel_photos', 'public');
            $artikel->photo = $photoPath;
        }

        $artikel->title = $request->title;
        $artikel->text = $request->text;
        $artikel->save();

        return redirect()->route('artikel.index')->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $artikel = artikel::findOrFail($id);
        $artikel->delete();

        return redirect()->route('artikel.index')->with('success', 'Artikel berhasil dihapus!');
    }
}
