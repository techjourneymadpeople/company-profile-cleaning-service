<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClientController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query('search');

        $clients = Client::when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->orderBy('sort_order', 'asc')
            ->paginate(15)
            ->withQueryString();

        return view('admin.clients.index', compact('clients', 'search'));
    }

    public function create(): View
    {
        return view('admin.clients.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'logo' => ['nullable', 'image', 'mimes:png,svg,webp,jpg', 'max:2048'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'is_visible' => ['boolean'],
        ]);

        $validated['is_visible'] = $request->has('is_visible');

        if ($request->hasFile('logo')) {
            $validated['logo_path'] = $request->file('logo')->store('clients', 'public');
        }

        Client::create($validated);

        return redirect()->route('admin.clients.index')
            ->with('status', 'Logo klien / mitra berhasil ditambahkan.');
    }

    public function edit(Client $client): View
    {
        return view('admin.clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'logo' => ['nullable', 'image', 'mimes:png,svg,webp,jpg', 'max:2048'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'is_visible' => ['boolean'],
        ]);

        $validated['is_visible'] = $request->has('is_visible');

        if ($request->hasFile('logo')) {
            $validated['logo_path'] = $request->file('logo')->store('clients', 'public');
        }

        $client->update($validated);

        return redirect()->route('admin.clients.index')
            ->with('status', 'Data klien berhasil diperbarui.');
    }

    public function destroy(Client $client): RedirectResponse
    {
        $client->delete();

        return redirect()->route('admin.clients.index')
            ->with('status', 'Klien berhasil dihapus.');
    }
}
