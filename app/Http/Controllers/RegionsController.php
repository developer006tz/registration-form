<?php

namespace App\Http\Controllers;

use App\Models\Regions;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class RegionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Regions::class);

        $search = $request->get('search', '');

        $allRegions = Regions::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.all_regions.index', compact('allRegions', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Regions::class);

        return view('app.all_regions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', Regions::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
        ]);

        $regions = Regions::create($validated);

        return redirect()
            ->route('all-regions.edit', $regions)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Regions $regions): View
    {
        $this->authorize('view', $regions);

        return view('app.all_regions.show', compact('regions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Regions $regions): View
    {
        $this->authorize('update', $regions);

        return view('app.all_regions.edit', compact('regions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Regions $regions): RedirectResponse
    {
        $this->authorize('update', $regions);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
        ]);

        $regions->update($validated);

        return redirect()
            ->route('all-regions.edit', $regions)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Regions $regions
    ): RedirectResponse {
        $this->authorize('delete', $regions);

        $regions->delete();

        return redirect()
            ->route('all-regions.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
