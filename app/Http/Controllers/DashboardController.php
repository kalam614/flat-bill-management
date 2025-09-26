<?php

namespace App\Http\Controllers;

use App\Models\{HouseOwner, Flat, Tenant, Bill, BillCategory};
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->isAdmin()) {
            return $this->adminDashboard();
        }

        return $this->houseOwnerDashboard();
    }

    private function adminDashboard()
    {
        $stats = [
            'total_house_owners' => HouseOwner::count(),
            'total_flats' => Flat::withoutGlobalScopes()->count(),
            'total_tenants' => Tenant::withoutGlobalScopes()->count(),
            'total_bills' => Bill::withoutGlobalScopes()->count(),
            'unpaid_bills' => Bill::withoutGlobalScopes()->where('status', 'unpaid')->count(),
        ];

        $recentBills = Bill::withoutGlobalScopes()
            ->with(['flat', 'billCategory', 'houseOwner.user'])
            ->latest()
            ->take(10)
            ->get();

        return view('dashboard.admin', compact('stats', 'recentBills'));
    }

    private function houseOwnerDashboard()
    {
        $houseOwner = auth()->user()->houseOwner;

        $stats = [
            'total_flats' => $houseOwner->flats()->count(),
            'occupied_flats' => $houseOwner->flats()->where('is_occupied', true)->count(),
            'total_tenants' => $houseOwner->tenants()->where('is_active', true)->count(),
            'unpaid_bills' => $houseOwner->bills()->where('status', 'unpaid')->count(),
            'overdue_bills' => $houseOwner->bills()->where('status', 'overdue')->count(),
            'monthly_revenue' => $houseOwner->bills()->where('status', 'paid')
                ->whereMonth('paid_date', now()->month)
                ->sum('total_amount'),
        ];

        $recentBills = $houseOwner->bills()
            ->with(['flat', 'billCategory'])
            ->latest()
            ->take(10)
            ->get();

        return view('dashboard.house-owner', compact('stats', 'recentBills'));
    }
}
