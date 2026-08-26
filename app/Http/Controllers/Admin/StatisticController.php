<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Statistic;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StatisticController extends Controller
{
    public function index(): View
    {
        $statistics = Statistic::orderBy('sort_order', 'asc')->get();

        return view('admin.statistics.index', compact('statistics'));
    }

    public function create(): View
    {
        return view('admin.statistics.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'label' => ['required', 'string', 'max:255'],
            'value' => ['required', 'string', 'max:50'],
            'icon' => ['nullable', 'string', 'max:100'],
            'sort_order' => ['required', 'integer', 'min:0'],
        ]);

        Statistic::create($validated);

        return redirect()->route('admin.statistics.index')
            ->with('status', 'Angka pencapaian baru berhasil ditambahkan.');
    }

    public function edit(Statistic $statistic): View
    {
        return view('admin.statistics.edit', compact('statistic'));
    }

    public function update(Request $request, Statistic $statistic): RedirectResponse
    {
        $validated = $request->validate([
            'label' => ['required', 'string', 'max:255'],
            'value' => ['required', 'string', 'max:50'],
            'icon' => ['nullable', 'string', 'max:100'],
            'sort_order' => ['required', 'integer', 'min:0'],
        ]);

        $statistic->update($validated);

        return redirect()->route('admin.statistics.index')
            ->with('status', 'Angka pencapaian berhasil diperbarui.');
    }

    public function destroy(Statistic $statistic): RedirectResponse
    {
        $statistic->delete();

        return redirect()->route('admin.statistics.index')
            ->with('status', 'Angka pencapaian berhasil dihapus.');
    }
}
