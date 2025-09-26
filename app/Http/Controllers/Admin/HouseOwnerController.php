<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{User, HouseOwner};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Hash, DB};

class HouseOwnerController extends Controller
{
    public function index()
    {
        $houseOwners = HouseOwner::with('user')
            ->paginate(10);

        return view('admin.house-owners.index', compact('houseOwners'));
    }

    public function create()
    {
        return view('admin.house-owners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'building_name' => 'required|string|max:255',
            'building_address' => 'required|string',
        ]);

        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'house_owner',
            ]);

            HouseOwner::create([
                'user_id' => $user->id,
                'phone' => $request->phone,
                'address' => $request->address,
                'building_name' => $request->building_name,
                'building_address' => $request->building_address,
            ]);
        });

        return redirect()->route('admin.house-owners.index')
            ->with('success', 'House owner created successfully.');
    }

    public function show(HouseOwner $houseOwner)
    {
        $houseOwner->load(['user', 'flats', 'tenants', 'bills']);
        return view('admin.house-owners.show', compact('houseOwner'));
    }

    public function edit(HouseOwner $houseOwner)
    {
        return view('admin.house-owners.edit', compact('houseOwner'));
    }

    public function update(Request $request, HouseOwner $houseOwner)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $houseOwner->user_id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'building_name' => 'required|string|max:255',
            'building_address' => 'required|string',
        ]);

        DB::transaction(function () use ($request, $houseOwner) {
            $houseOwner->user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            $houseOwner->update([
                'phone' => $request->phone,
                'address' => $request->address,
                'building_name' => $request->building_name,
                'building_address' => $request->building_address,
            ]);
        });

        return redirect()->route('admin.house-owners.index')
            ->with('success', 'House owner updated successfully.');
    }

    public function destroy(HouseOwner $houseOwner)
    {
        DB::transaction(function () use ($houseOwner) {
            $houseOwner->user->delete();
            $houseOwner->delete();
        });

        return redirect()->route('admin.house-owners.index')
            ->with('success', 'House owner deleted successfully.');
    }
}
