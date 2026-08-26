<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $menus = Menu::with('parent')->ordered()->get();

        return view('admin.menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $parentMenus = Menu::roots()->ordered()->get();
        $permissions = Permission::orderBy('name')->get();

        return view('admin.menus.create', compact('parentMenus', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'route' => ['nullable', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:255'],
            'permission_name' => ['nullable', 'string', 'exists:permissions,name'],
            'parent_id' => ['nullable', 'exists:menus,id'],
            'order' => ['required', 'integer', 'min:0'],
            'is_active' => ['boolean'],
        ]);

        $validated['is_active'] = $request->has('is_active');

        Menu::create($validated);

        return redirect()->route('admin.menus.index')
            ->with('status', 'Item menu baru berhasil ditambahkan ke database.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu): View
    {
        $parentMenus = Menu::roots()->where('id', '!=', $menu->id)->ordered()->get();
        $permissions = Permission::orderBy('name')->get();

        return view('admin.menus.edit', compact('menu', 'parentMenus', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'route' => ['nullable', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:255'],
            'permission_name' => ['nullable', 'string', 'exists:permissions,name'],
            'parent_id' => ['nullable', 'exists:menus,id', 'not_in:' . $menu->id],
            'order' => ['required', 'integer', 'min:0'],
            'is_active' => ['boolean'],
        ]);

        $validated['is_active'] = $request->has('is_active');

        $menu->update($validated);

        return redirect()->route('admin.menus.index')
            ->with('status', "Item menu '{$menu->title}' berhasil diperbarui.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu): RedirectResponse
    {
        // Unset children's parent_id
        $menu->children()->update(['parent_id' => null]);
        
        $menu->delete();

        return redirect()->route('admin.menus.index')
            ->with('status', 'Item menu berhasil dihapus dari sistem.');
    }
}
