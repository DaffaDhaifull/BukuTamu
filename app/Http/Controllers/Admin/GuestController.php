<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index(Request $request)
    {
        $query = Guest::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('school', 'like', "%{$search}%")
                  ->orWhere('phone_number', 'like', "%{$search}%");
            });
        }

        $guests = $query->latest()->paginate(10)->appends($request->query());

        return view('Admin.guests.index', compact('guests'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'school' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:20',
        ]);

        Guest::create($validated);

        return redirect()->route('admin.guests.index')->with('success', 'Tamu berhasil ditambahkan!');
    }

    public function update(Request $request, Guest $guest)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'school' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:20',
        ]);

        $guest->update($validated);

        return redirect()->route('admin.guests.index')->with('success', 'Data tamu berhasil diperbarui!');
    }

    public function destroy(Guest $guest)
    {
        $guest->delete();

        return redirect()->route('admin.guests.index')->with('success', 'Tamu berhasil dihapus!');
    }
}
