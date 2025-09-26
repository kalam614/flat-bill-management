<div class="mb-3">
    <label for="house_owner_id" class="form-label">House Owner</label>
    @if (auth()->user()->isAdmin())
        <select name="house_owner_id" id="house_owner_id" class="form-select">
            <option value="">Select Owner</option>
            @foreach ($houseOwners as $owner)
                <option value="{{ $owner->id }}"
                    {{ old('house_owner_id', $bill->house_owner_id ?? '') == $owner->id ? 'selected' : '' }}>
                    {{ $owner->user->name }}
                </option>
            @endforeach
        </select>
    @else
        <input type="text" class="form-control" value="{{ auth()->user()->houseOwner->user->name }}" disabled>
        <input type="hidden" name="house_owner_id" value="{{ auth()->user()->houseOwner->id }}">
    @endif
    @error('house_owner_id')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="mb-3">
    <label for="flat_id" class="form-label">Flat</label>
    <select name="flat_id" id="flat_id" class="form-select">
        <option value="">Select Flat</option>
        @foreach ($flats as $flat)
            <option value="{{ $flat->id }}"
                {{ old('flat_id', $bill->flat_id ?? '') == $flat->id ? 'selected' : '' }}>
                {{ $flat->flat_number }}
            </option>
        @endforeach
    </select>
    @error('flat_id')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="mb-3">
    <label for="bill_category_id" class="form-label">Category</label>
    <select name="bill_category_id" id="bill_category_id" class="form-select">
        <option value="">Select Category</option>
        @foreach ($billCategories as $category)
            <option value="{{ $category->id }}"
                {{ old('bill_category_id', $bill->bill_category_id ?? '') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    @error('bill_category_id')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="mb-3">
    <label for="bill_month" class="form-label">Bill Month</label>
    <input type="month" name="bill_month" id="bill_month" class="form-control"
        value="{{ old('bill_month', $bill->bill_month ?? '') }}" required>
    @error('bill_month')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>


<div class="mb-3">
    <label for="amount" class="form-label">Amount</label>
    <input type="number" step="0.01" name="amount" id="amount" class="form-control"
        value="{{ old('amount', $bill->amount ?? '') }}">
    @error('amount')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="mb-3">
    <label for="due_date" class="form-label">Due Date</label>
    <input type="date" name="due_date" id="due_date" class="form-control"
        value="{{ old('due_date', $bill->due_date ?? '') }}">
    @error('due_date')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="mb-3">
    <label for="notes" class="form-label">Notes</label>
    <textarea name="notes" id="notes" class="form-control">{{ old('notes', $bill->notes ?? '') }}</textarea>
</div>
