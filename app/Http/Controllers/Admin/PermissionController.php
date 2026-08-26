<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $search = $request->query('search');

        $permissions = Permission::with('roles')
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->orderBy('name', 'asc')
            ->paginate(15)
            ->withQueryString();

        return view('admin.permissions.index', compact('permissions', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:permissions,name',
                'regex:/^[a-zA-Z0-9_\-\.]+$/',
            ],
        ], [
            'name.regex' => 'Format nama permission harus berupa teks alfanumerik atau dot notation (contoh: modul.aksi).',
        ]);

        $permission = Permission::create([
            'name' => strtolower($validated['name']),
            'guard_name' => 'web',
        ]);

        return redirect()->route('admin.permissions.index')
            ->with('status', "Permission '{$permission->name}' berhasil ditambahkan ke sistem.");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission): View
    {
        return view('admin.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission): RedirectResponse
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('permissions')->ignore($permission->id),
                'regex:/^[a-zA-Z0-9_\-\.]+$/',
            ],
        ], [
            'name.regex' => 'Format nama permission harus berupa teks alfanumerik atau dot notation (contoh: modul.aksi).',
        ]);

        $permission->name = strtolower($validated['name']);
        $permission->save();

        return redirect()->route('admin.permissions.index')
            ->with('status', "Permission '{$permission->name}' berhasil diperbarui.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission): RedirectResponse
    {
        $permission->delete();

        return redirect()->route('admin.permissions.index')
            ->with('status', 'Permission berhasil dihapus.');
    }
}
