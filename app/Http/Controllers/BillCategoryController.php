<?php

namespace App\Http\Controllers;

use App\Models\BillCategory;
use App\Models\HouseOwner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillCategoryController extends Controller
{
    public function index()
    {
        $query = BillCategory::with('houseOwner.user');


        if (Auth::user()->role === 'house_owner') {
            $query->where('house_owner_id', Auth::user()->houseOwner->id);
        }

        $billCategories = $query->paginate(10);

        return view('bill_categories.index', compact('billCategories'));
    }

    public function create()
    {
        $houseOwners = [];


        if (Auth::user()->role === 'admin') {
            $houseOwners = HouseOwner::with('user')->get();
        }

        return view('bill_categories.create', compact('houseOwners'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'default_amount' => 'nullable|numeric|min:0',
            'is_active' => 'boolean',
        ];

        if (Auth::user()->role === 'admin') {
            $rules['house_owner_id'] = 'required|exists:house_owners,id';
        }

        $validated = $request->validate($rules);

        if (Auth::user()->role === 'house_owner') {
            $validated['house_owner_id'] = Auth::user()->houseOwner->id;
        }

        BillCategory::create($validated);

        return redirect()->route('bill-category.index')
            ->with('success', 'Bill Category created successfully.');
    }

    public function edit(BillCategory $billCategory)
    {
        $houseOwners = [];

        if (Auth::user()->role === 'admin') {
            $houseOwners = HouseOwner::with('user')->get();
        }

        return view('bill_categories.edit', compact('billCategory', 'houseOwners'));
    }

    public function update(Request $request, BillCategory $billCategory)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'default_amount' => 'nullable|numeric|min:0',
            'is_active' => 'boolean',
        ];

        if (Auth::user()->role === 'admin') {
            $rules['house_owner_id'] = 'required|exists:house_owners,id';
        }

        $validated = $request->validate($rules);

        if (Auth::user()->role === 'house_owner') {
            $validated['house_owner_id'] = Auth::user()->houseOwner->id;
        }

        $billCategory->update($validated);

        return redirect()->route('bill-category.index')
            ->with('success', 'Bill Category updated successfully.');
    }

    public function destroy(BillCategory $billCategory)
    {
        $billCategory->delete();

        return redirect()->route('bill-category.index')
            ->with('success', 'Bill Category deleted successfully.');
    }
}
