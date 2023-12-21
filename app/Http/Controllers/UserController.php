<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\User;
use App\Models\Regions;
use App\Models\District;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', User::class);

        $search = $request->get('search', '');

        $users = User::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.users.index', compact('users', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', User::class);

        $districts = District::pluck('name', 'id');
        $allRegions = Regions::pluck('name', 'id');

        $languages = Language::pluck('name', 'id');

        return view(
            'app.users.create',
            compact('districts', 'allRegions', 'languages')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', User::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'email' => ['required', 'unique:users,email', 'email'],
            'password' => ['required'],
            'phone' => ['required', 'max:255', 'string'],
            'dob' => ['required', 'date'],
            'district_id' => ['required', 'exists:districts,id'],
            'regions_id' => ['required', 'exists:regions,id'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        $user->syncRoles($request->roles);

        return redirect()
            ->route('users.edit', $user)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, User $user): View
    {
        $this->authorize('view', $user);

        return view('app.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, User $user): View
    {
        $this->authorize('update', $user);

        $districts = District::pluck('name', 'id');
        $allRegions = Regions::pluck('name', 'id');

        $roles = Role::get();

        return view(
            'app.users.edit',
            compact('user', 'districts', 'allRegions', 'roles')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $this->authorize('update', $user);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'email' => [
                'required',
                Rule::unique('users', 'email')->ignore($user),
                'email',
            ],
            'password' => ['nullable'],
            'phone' => ['required', 'max:255', 'string'],
            'dob' => ['required', 'date'],
            'district_id' => ['required', 'exists:districts,id'],
            'regions_id' => ['required', 'exists:regions,id'],
        ]);

        if (empty($validated['password'])) {
            unset($validated['password']);
        } else {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);

        $user->syncRoles($request->roles);

        return redirect()
            ->route('users.edit', $user)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, User $user): RedirectResponse
    {
        $this->authorize('delete', $user);

        $user->delete();

        return redirect()
            ->route('users.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
