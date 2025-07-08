<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\growplan;
use App\Models\customer;
use Illuminate\Http\Request;

class GrowplanController extends Controller
{
    public function index()
    {
        $growplan = Growplan::all();
        return view('growplan.index', compact('growplan'));
    }

    public function create()
    {
        $growplan = Growplan::all();
        $customers = Customer::all();
        return view('growplan.tambah', compact('customers', 'growplan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'title' => 'required|string|max:255',
            'seed' => 'required|string|max:255',
            'land' => 'required|string|max:255',
            'soil' => 'required|string|max:255',
            'tanggal' => 'required|date',
        ]);

        GrowPlan::create([
            'customer_id' => $request->customer_id,
            'title' => $request->title,
            'seed' => $request->seed,
            'land' => $request->land,
            'soil' => $request->soil,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('growplan.index')->with('success', 'Growplan berhasil ditambahkan!');
    }

    public function show(string $id)
    {
        $growplan = Growplan::findOrFail($id);
        
        return view('growplan.show', compact('growplan'));
    }

    public function edit(string $id)
    {
        $customers = Customer::all();
        $growplan = Growplan::findOrFail($id);
        return view('growplan.edit', compact('growplan', 'customers'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'seed' => 'required|string|max:255',
            'land' => 'required|string|max:255',
            'soil' => 'required|string|max:255',
            'tanggal' => 'required|date',
        ]);

        $growplan = Growplan::findOrFail($id);

        $growplan->update([
            'title' => $request->title,
            'seed' => $request->seed,
            'land' => $request->land,
            'soil' => $request->soil,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('growplan.index')->with('success', 'Growplan berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $growplan = Growplan::findOrFail($id);
        $growplan->delete();
        return redirect()->route('growplan.index')->with('success', 'Growplan berhasil dihapus!');
    }
}
