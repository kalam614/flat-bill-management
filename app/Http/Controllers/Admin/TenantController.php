<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Tenant, HouseOwner, Flat};
use Illuminate\Http\Request;

class TenantController extends Controller
{
    public function index()
    {
        $tenants = Tenant::withoutGlobalScopes()
            ->with(['houseOwner.user', 'flat'])
            ->paginate(3);

        return view('admin.tenants.index', compact('tenants'));
    }

    public function create()
    {
        $houseOwners = HouseOwner::with('user')->get();
        return view('admin.tenants.create', compact('houseOwners'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
            'house_owner_id' => 'required|exists:house_owners,id',
            'flat_id' => 'nullable|exists:flats,id',
            'move_in_date' => 'nullable|date',
        ]);

        $tenant = Tenant::withoutGlobalScopes()->create($request->all());

        if ($request->flat_id) {
            Flat::withoutGlobalScopes()->find($request->flat_id)->update(['is_occupied' => true]);
        }

        return redirect()->route('admin.tenants.index')
            ->with('success', 'Tenant created successfully.');
    }

    public function show(Tenant $tenant)
    {
        $tenant->load(['houseOwner.user', 'flat']);
        return view('admin.tenants.show', compact('tenant'));
    }

    public function edit(Tenant $tenant)
    {
        $houseOwners = HouseOwner::with('user')->get();
        $flats = Flat::withoutGlobalScopes()->where('house_owner_id', $tenant->house_owner_id)->get();
        return view('admin.tenants.edit', compact('tenant', 'houseOwners', 'flats'));
    }

    public function update(Request $request, Tenant $tenant)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
            'house_owner_id' => 'required|exists:house_owners,id',
            'flat_id' => 'nullable|exists:flats,id',
            'move_in_date' => 'nullable|date',
            'move_out_date' => 'nullable|date',
        ]);

        $oldFlatId = $tenant->flat_id;
        $tenant->update($request->all());

        // Update flat occupancy status
        if ($oldFlatId && $oldFlatId != $request->flat_id) {
            Flat::withoutGlobalScopes()->find($oldFlatId)->update(['is_occupied' => false]);
        }

        if ($request->flat_id) {
            Flat::withoutGlobalScopes()->find($request->flat_id)->update(['is_occupied' => true]);
        }

        return redirect()->route('admin.tenants.index')
            ->with('success', 'Tenant updated successfully.');
    }

    public function destroy(Tenant $tenant)
    {
        if ($tenant->flat_id) {
            Flat::withoutGlobalScopes()->find($tenant->flat_id)->update(['is_occupied' => false]);
        }

        $tenant->delete();

        return redirect()->route('admin.tenants.index')
            ->with('success', 'Tenant removed successfully.');
    }

    public function getFlats(Request $request)
    {
        $flats = Flat::withoutGlobalScopes()
            ->where('house_owner_id', $request->house_owner_id)
            ->get(['id', 'flat_number']);

        return response()->json($flats);
    }
}
