<?php

namespace App\Http\Controllers;

use App\Models\Regions;
use App\Models\District;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', District::class);

        $search = $request->get('search', '');

        $districts = District::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.districts.index', compact('districts', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', District::class);

        $allRegions = Regions::pluck('name', 'id');

        return view('app.districts.create', compact('allRegions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', District::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'regions_id' => ['required', 'exists:regions,id'],
        ]);

        $district = District::create($validated);

        return redirect()
            ->route('districts.edit', $district)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, District $district): View
    {
        $this->authorize('view', $district);

        return view('app.districts.show', compact('district'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, District $district): View
    {
        $this->authorize('update', $district);

        $allRegions = Regions::pluck('name', 'id');

        return view('app.districts.edit', compact('district', 'allRegions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        Request $request,
        District $district
    ): RedirectResponse {
        $this->authorize('update', $district);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'regions_id' => ['required', 'exists:regions,id'],
        ]);

        $district->update($validated);

        return redirect()
            ->route('districts.edit', $district)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        District $district
    ): RedirectResponse {
        $this->authorize('delete', $district);

        $district->delete();

        return redirect()
            ->route('districts.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
