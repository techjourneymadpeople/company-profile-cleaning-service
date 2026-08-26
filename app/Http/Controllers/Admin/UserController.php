<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        if(auth()->user()->hasRole('Super Admin')){
            $users = User::with('roles')->latest()->get();
        }else{
            $users = User::with('roles')->whereHas('roles',function($q){
                $q->where('name','!=','Super Admin');
            })->latest()->get();
        }
        // if (!auth()->user()->hasRole('Super Admin')) {
        //     $users = User::with('roles')->whereNotIn('id', [auth()->user()->id])->latest()->get();
        // } else {
        //     $users = User::with('roles')->latest()->get();
        // }

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        if(auth()->user()->hasRole('Super Admin')){
            $roles = Role::all();
        }else{
            $roles = Role::where('name','!=','Super Admin')->get();
        }

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'roles' => ['nullable', 'array'],
            'roles.*' => ['string', 'exists:roles,name'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'email_verified_at' => now(),
        ]);

        if (!empty($validated['roles'])) {
            $user->syncRoles($validated['roles']);
        }

        return redirect()->route('admin.users.index')
            ->with('status', 'Pengguna baru berhasil ditambahkan dan role telah ditetapkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): View
    {
        if(auth()->user()->hasRole('Super Admin')){
            $roles = Role::all();
        }else{
            $roles = Role::where('name','!=','Super Admin')->get();
        }
        $userRoleNames = $user->roles->pluck('name')->toArray();

        return view('admin.users.edit', compact('user', 'roles', 'userRoleNames'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'confirmed', Password::defaults()],
            'roles' => ['nullable', 'array'],
            'roles.*' => ['string', 'exists:roles,name'],
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        if (isset($validated['roles'])) {
            $user->syncRoles($validated['roles']);
        } else {
            $user->syncRoles([]);
        }

        return redirect()->route('admin.users.index')
            ->with('status', 'Data pengguna berhasil diperbarui beserta penugasan rolenya.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        if ($user->id === Auth::id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri yang sedang aktif.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('status', 'Pengguna berhasil dihapus dari sistem.');
    }
}
