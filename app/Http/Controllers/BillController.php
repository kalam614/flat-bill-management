<?php

namespace App\Http\Controllers;

use App\Models\{Bill, Flat, BillCategory, HouseOwner, BillPayment};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\BillCreatedMail;
use App\Mail\BillPaidMail;



class BillController extends Controller
{
    public function index()
    {
        $bills = Bill::with(['flat', 'billCategory', 'houseOwner.user'])->paginate(10);
        return view('bills.index', compact('bills'));
    }

    public function create()
    {
        $billCategories = BillCategory::all();
        $flats = Flat::all();
        $houseOwners = HouseOwner::with('user')->get();

        return view('bills.create', compact('billCategories', 'flats', 'houseOwners'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'house_owner_id' => 'required|exists:house_owners,id',
            'flat_id' => 'required|exists:flats,id',
            'bill_category_id' => 'required|exists:bill_categories,id',
            'bill_month' => 'required|string',
            'amount' => 'required|numeric',
            'due_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $total = $request->amount + ($request->due_amount ?? 0);

        $bill = Bill::create([
            'house_owner_id' => $request->house_owner_id,
            'flat_id' => $request->flat_id,
            'bill_category_id' => $request->bill_category_id,
            'bill_month' => $request->bill_month,
            'amount' => $request->amount,
            'due_amount' => $request->due_amount ?? 0,
            'total_amount' => $total,
            'status' => 'unpaid',
            'due_date' => $request->due_date,
            'notes' => $request->notes,
        ]);

        // Get flat owner email
        $flat = Flat::find($request->flat_id);
        if ($flat && $flat->flat_owner_email) {
            Mail::to($flat->flat_owner_email)->send(new BillCreatedMail($bill));
        }

        return redirect()->route('bills.index')->with('success', 'Bill created and email sent successfully.');
    }

    public function show(Bill $bill)
    {
        $bill->load(['flat', 'billCategory', 'houseOwner.user']);
        return view('bills.show', compact('bill'));
    }

    public function edit(Bill $bill)
    {
        if (Auth::user()->role == 'admin') {
            $houseOwners = HouseOwner::with('user')->get();
        } else {
            $houseOwners = null;
        }

        $flats = Flat::all();
        $billCategories = BillCategory::all();

        return view('bills.edit', compact('bill', 'houseOwners', 'flats', 'billCategories'));
    }

    // ✅ Add Update Method
    public function update(Request $request, Bill $bill)
    {
        $data = $request->validate([
            'house_owner_id' => 'required|exists:house_owners,id',
            'flat_id' => 'required|exists:flats,id',
            'bill_category_id' => 'required|exists:bill_categories,id',
            'bill_month' => 'required|string',
            'amount' => 'required|numeric',
            'due_date' => 'required|date',
            'notes' => 'nullable|string',
            'status' => 'required|in:unpaid,paid,overdue',
        ]);

        $data['total_amount'] = $data['amount'];
        $data['due_amount'] = $data['status'] == 'paid' ? 0 : $data['amount'];

        $bill->update($data);

        return redirect()->route('bills.index')
            ->with('success', 'Bill updated successfully.');
    }

    public function destroy(Bill $bill)
    {
        $bill->delete();

        return redirect()->route('bills.index')
            ->with('success', 'Bill deleted successfully.');
    }



    public function pay(Request $request, Bill $bill)
    {
        $request->validate([
            'amount_paid' => 'required|numeric|min:0.01',
            'payment_date' => 'required|date',
            'payment_method' => 'nullable|string|max:255',
            'transaction_reference' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $amountPaid = $request->amount_paid;


        BillPayment::create([
            'bill_id' => $bill->id,
            'amount_paid' => $amountPaid,
            'payment_date' => $request->payment_date,
            'payment_method' => $request->payment_method,
            'transaction_reference' => $request->transaction_reference,
            'notes' => $request->notes,
        ]);


        $bill->due_amount -= $amountPaid;
        if ($bill->due_amount <= 0) {
            $bill->due_amount = 0;
            $bill->status = 'paid';
        } elseif ($bill->due_date < now()) {
            $bill->status = 'overdue';
        } else {
            $bill->status = 'unpaid';
        }

        $bill->paid_date = now(); // latest payment date
        $bill->save();

        // Send mail to flat owner
        if ($bill->flat->flat_owner_email) {
            Mail::to($bill->flat->flat_owner_email)->send(new BillPaidMail($bill, $amountPaid));
        }

        return redirect()->route('bills.show', $bill->id)
            ->with('success', 'Payment recorded successfully.');
    }
}
