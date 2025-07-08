<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $chat = Chat::all();
        return view('chat.index', compact('chat'));
    }

    public function create()
    {
        $customers = Customer::all();
        return view('chat.tambah', compact('customers'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Chat::create($validatedData);

        return redirect()->route('chat.index')->with('success', 'Chat berhasil ditambahkan!');
    }

    public function show(Chat $chat)
    {
        return view('chats.show', compact('chat'));
    }

    public function edit(Chat $chat)
    {
        return view('chat.edit', compact('chat'));
    }

    public function update(Request $request, Chat $chat)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $chat->update($validatedData);

        return redirect()->route('chat.index')->with('success', 'Chat berhasil diperbarui!');
    }

    public function destroy(Chat $chat)
    {
        $chat->delete();

        return redirect()->route('chat.index')->with('success', 'Chat berhasil dihapus!');
    }
}
