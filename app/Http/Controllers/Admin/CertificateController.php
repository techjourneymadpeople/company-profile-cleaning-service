<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CertificateController extends Controller
{
    public function index(): View
    {
        $certificates = Certificate::latest()->get();

        return view('admin.certificates.index', compact('certificates'));
    }

    public function create(): View
    {
        return view('admin.certificates.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'issuer' => ['nullable', 'string', 'max:255'],
            'license_number' => ['nullable', 'string', 'max:255'],
            'valid_until' => ['nullable', 'date'],
            'image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp,pdf', 'max:3072'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('certificates', 'public');
        }

        Certificate::create($validated);

        return redirect()->route('admin.certificates.index')
            ->with('status', 'Sertifikat akreditasi baru berhasil ditambahkan.');
    }

    public function edit(Certificate $certificate): View
    {
        return view('admin.certificates.edit', compact('certificate'));
    }

    public function update(Request $request, Certificate $certificate): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'issuer' => ['nullable', 'string', 'max:255'],
            'license_number' => ['nullable', 'string', 'max:255'],
            'valid_until' => ['nullable', 'date'],
            'image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp,pdf', 'max:3072'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('certificates', 'public');
        }

        $certificate->update($validated);

        return redirect()->route('admin.certificates.index')
            ->with('status', 'Sertifikat akreditasi berhasil diperbarui.');
    }

    public function destroy(Certificate $certificate): RedirectResponse
    {
        $certificate->delete();

        return redirect()->route('admin.certificates.index')
            ->with('status', 'Sertifikat akreditasi berhasil dihapus.');
    }
}
