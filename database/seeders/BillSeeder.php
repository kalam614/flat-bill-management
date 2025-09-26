<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{HouseOwner, Bill};
use Carbon\Carbon;

class BillSeeder extends Seeder
{
    public function run()
    {
        $houseOwners = HouseOwner::all();

        foreach ($houseOwners as $houseOwner) {
            $flats = $houseOwner->flats;
            $billCategories = $houseOwner->billCategories;

            // Generate bills for last 3 months
            for ($month = 2; $month >= 0; $month--) {
                $billMonth = Carbon::now()->subMonths($month)->format('Y-m');
                $dueDate = Carbon::now()->subMonths($month)->addDays(15);

                foreach ($flats as $flat) {
                    foreach ($billCategories as $category) {
                        $amount = $category->default_amount + rand(-20, 50);
                        $status = $month > 0 ? (rand(1, 10) > 3 ? 'paid' : 'unpaid') : 'unpaid';
                        $paidDate = $status === 'paid' ? $dueDate->copy()->subDays(rand(1, 10)) : null;

                        Bill::withoutGlobalScopes()->create([
                            'house_owner_id' => $houseOwner->id,
                            'flat_id' => $flat->id,
                            'bill_category_id' => $category->id,
                            'bill_month' => $billMonth,
                            'amount' => $amount,
                            'due_amount' => $month == 2 ? rand(0, 100) : 0, // Add some previous dues for oldest bills
                            'total_amount' => $amount + ($month == 2 ? rand(0, 100) : 0),
                            'status' => $status,
                            'due_date' => $dueDate->toDateString(),
                            'paid_date' => $paidDate?->toDateString(),
                            'notes' => 'Generated sample bill for ' . $billMonth,
                        ]);
                    }
                }
            }
        }
    }
}
