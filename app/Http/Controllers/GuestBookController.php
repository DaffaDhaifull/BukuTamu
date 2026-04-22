<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;

class GuestBookController extends Controller
{
    public function showForm()
    {
        return view('client.guestbook');
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'school' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:20',
        ]);

        Guest::create($validated);

        return redirect()->route('guestbook.form')->with('success', 'Terima kasih telah mengisi buku tamu! Data Anda telah tersimpan.');
    }
}
