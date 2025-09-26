<?php

namespace App\Http\Controllers;

use App\Models\{Flat, Tenant};
use Illuminate\Http\Request;

class FlatController extends Controller
{
    public function index()
    {
        $flats = Flat::with('tenant')->paginate(10);
        return view('flats.index', compact('flats'));
    }

    public function create()
    {
        return view('flats.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'flat_number' => 'required|string|max:50|unique:flats,flat_number,NULL,id,house_owner_id,' . auth()->user()->houseOwner->id,
            'flat_owner_name' => 'required|string|max:255',
            'flat_owner_phone' => 'nullable|string|max:20',
            'flat_owner_email' => 'nullable|email|max:255',
            'monthly_rent' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        Flat::create($request->all());

        return redirect()->route('flats.index')
            ->with('success', 'Flat created successfully.');
    }

    public function show(Flat $flat)
    {
        $flat->load('tenant');
        return view('flats.show', compact('flat'));
    }

    public function edit(Flat $flat)
    {
        return view('flats.edit', compact('flat'));
    }

    public function update(Request $request, Flat $flat)
    {
        $request->validate([
            'flat_number' => 'required|string|max:50|unique:flats,flat_number,' . $flat->id . ',id,house_owner_id,' . auth()->user()->houseOwner->id,
            'flat_owner_name' => 'required|string|max:255',
            'flat_owner_phone' => 'nullable|string|max:20',
            'flat_owner_email' => 'nullable|email|max:255',
            'monthly_rent' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        $flat->update($request->all());

        return redirect()->route('flats.index')
            ->with('success', 'Flat updated successfully.');
    }

    public function destroy(Flat $flat)
    {
        $flat->delete();

        return redirect()->route('flats.index')
            ->with('success', 'Flat deleted successfully.');
    }
}
