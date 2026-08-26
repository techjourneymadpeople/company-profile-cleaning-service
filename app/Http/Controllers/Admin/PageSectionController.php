<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageSection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PageSectionController extends Controller
{
    /**
     * Define the supported public pages and their metadata.
     */
    protected array $pages = [
        'home' => [
            'name' => 'Beranda (Home)',
            'description' => 'Halaman utama website company profile.',
            'route' => 'public.home',
            'icon' => 'heroicon-o-home',
        ],
        'services' => [
            'name' => 'Solusi & Layanan',
            'description' => 'Halaman katalog solusi dan paket layanan kebersihan.',
            'route' => 'public.services',
            'icon' => 'heroicon-o-sparkles',
        ],
        'portfolio' => [
            'name' => 'Mitra & Portofolio',
            'description' => 'Halaman galeri hasil pengerjaan before-after & daftar klien.',
            'route' => 'public.portfolio',
            'icon' => 'heroicon-o-photo',
        ],
        'articles' => [
            'name' => 'Berita & Artikel',
            'description' => 'Halaman pusat edukasi, tips kebersihan & berita perusahaan.',
            'route' => 'public.articles',
            'icon' => 'heroicon-o-newspaper',
        ],
        'contact' => [
            'name' => 'Kontak & Penawaran',
            'description' => 'Halaman kontak, jam operasional, dan formulir RFQ penawaran.',
            'route' => 'public.contact',
            'icon' => 'heroicon-o-phone',
        ],
    ];

    /**
     * Display a listing of the page sections grouped by page.
     */
    public function index(Request $request): View
    {
        $currentPage = $request->query('page', 'home');

        if (!array_key_exists($currentPage, $this->pages)) {
            $currentPage = 'home';
        }

        $pages = $this->pages;

        // Fetch section stats per page
        $allSections = PageSection::ordered()->get();
        $sections = $allSections->where('page_key', $currentPage);

        $pageStats = [];
        foreach (array_keys($pages) as $pageKey) {
            $pageSections = $allSections->where('page_key', $pageKey);
            $pageStats[$pageKey] = [
                'total' => $pageSections->count(),
                'active' => $pageSections->where('is_active', true)->count(),
            ];
        }

        return view('admin.page_sections.index', compact('pages', 'currentPage', 'sections', 'pageStats'));
    }

    /**
     * Show the form for editing the specified page section.
     */
    public function edit(PageSection $pageSection): View
    {
        $pages = $this->pages;
        $pageMeta = $pages[$pageSection->page_key] ?? [
            'name' => ucfirst($pageSection->page_key),
            'route' => 'public.home',
        ];

        // Sibling sections for quick switching
        $siblingSections = PageSection::forPage($pageSection->page_key)
            ->ordered()
            ->get();

        return view('admin.page_sections.edit', compact('pageSection', 'pages', 'pageMeta', 'siblingSections'));
    }

    /**
     * Update the specified page section in storage.
     */
    public function update(Request $request, PageSection $pageSection): RedirectResponse
    {
        $validated = $request->validate([
            'section_name' => ['required', 'string', 'max:150'],
            'badge' => ['nullable', 'string', 'max:255'],
            'title' => ['nullable', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:2000'],
            'body' => ['nullable', 'string'],
            'button_text' => ['nullable', 'string', 'max:100'],
            'button_url' => ['nullable', 'string', 'max:255'],
            'secondary_button_text' => ['nullable', 'string', 'max:100'],
            'secondary_button_url' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'string', 'max:500'],
            'image_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:4096'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer'],
            'data' => ['nullable', 'array'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        // Handle Image Upload if provided
        if ($request->hasFile('image_file')) {
            // Remove old uploaded image if it is local
            if ($pageSection->image && !str_starts_with($pageSection->image, 'http')) {
                Storage::disk('public')->delete($pageSection->image);
            }

            $validated['image'] = $request->file('image_file')->store('sections', 'public');
        }

        // Clean & update data
        unset($validated['image_file']);

        // Merge existing data array if partial update of data
        if ($request->has('data')) {
            $validated['data'] = $request->input('data');
        }

        $pageSection->update($validated);
        PageSection::clearPageCache($pageSection->page_key);

        return redirect()->route('admin.page-sections.index', ['page' => $pageSection->page_key])
            ->with('status', "Section '{$pageSection->section_name}' berhasil diperbarui.");
    }

    /**
     * Quick toggle status active/inactive.
     */
    public function toggleStatus(PageSection $pageSection): RedirectResponse
    {
        $pageSection->is_active = !$pageSection->is_active;
        $pageSection->save();

        PageSection::clearPageCache($pageSection->page_key);

        $statusText = $pageSection->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()->back()
            ->with('status', "Section '{$pageSection->section_name}' berhasil {$statusText}.");
    }
}
