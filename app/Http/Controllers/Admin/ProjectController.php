<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(): View
    {
        $projects = Project::with('service')->latest()->get();

        return view('admin.projects.index', compact('projects'));
    }

    public function create(): View
    {
        $services = Service::active()->get();

        return view('admin.projects.create', compact('services'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'service_id' => ['nullable', 'exists:services,id'],
            'category' => ['nullable', 'string', 'max:100'],
            'before_image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:3072'],
            'after_image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:3072'],
            'description' => ['nullable', 'string'],
            'completed_at' => ['nullable', 'date'],
        ]);

        if ($request->hasFile('before_image')) {
            $validated['before_image'] = $request->file('before_image')->store('projects/before', 'public');
        }

        if ($request->hasFile('after_image')) {
            $validated['after_image'] = $request->file('after_image')->store('projects/after', 'public');
        }

        Project::create($validated);

        return redirect()->route('admin.projects.index')
            ->with('status', 'Galeri proyek baru berhasil ditambahkan.');
    }

    public function edit(Project $project): View
    {
        $services = Service::active()->get();

        return view('admin.projects.edit', compact('project', 'services'));
    }

    public function update(Request $request, Project $project): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'service_id' => ['nullable', 'exists:services,id'],
            'category' => ['nullable', 'string', 'max:100'],
            'before_image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:3072'],
            'after_image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:3072'],
            'description' => ['nullable', 'string'],
            'completed_at' => ['nullable', 'date'],
        ]);

        if ($request->hasFile('before_image')) {
            $validated['before_image'] = $request->file('before_image')->store('projects/before', 'public');
        }

        if ($request->hasFile('after_image')) {
            $validated['after_image'] = $request->file('after_image')->store('projects/after', 'public');
        }

        $project->update($validated);

        return redirect()->route('admin.projects.index')
            ->with('status', 'Galeri proyek berhasil diperbarui.');
    }

    public function destroy(Project $project): RedirectResponse
    {
        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('status', 'Galeri proyek berhasil dihapus.');
    }
}
