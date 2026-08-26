<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InquiryController extends Controller
{
    public function index(): View
    {
        $inquiries = Inquiry::latest()->get();

        return view('admin.inquiries.index', compact('inquiries'));
    }

    public function show(Inquiry $inquiry): View
    {
        return view('admin.inquiries.show', compact('inquiry'));
    }

    public function update(Request $request, Inquiry $inquiry): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:new,contacted,completed'],
        ]);

        $inquiry->update($validated);

        return redirect()->route('admin.inquiries.index')
            ->with('status', "Status permintaan penawaran dari '{$inquiry->name}' berhasil diperbarui.");
    }

    public function destroy(Inquiry $inquiry): RedirectResponse
    {
        $inquiry->delete();

        return redirect()->route('admin.inquiries.index')
            ->with('status', 'Data penawaran berhasil dihapus.');
    }
}
