<div class="mb-3">
    <label class="form-label">Flat Number *</label>
    <input type="text" name="flat_number" value="{{ old('flat_number', $flat->flat_number ?? '') }}"
        class="form-control @error('flat_number') is-invalid @enderror">
    @error('flat_number')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Owner Name *</label>
    <input type="text" name="flat_owner_name" value="{{ old('flat_owner_name', $flat->flat_owner_name ?? '') }}"
        class="form-control @error('flat_owner_name') is-invalid @enderror">
    @error('flat_owner_name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Owner Phone</label>
    <input type="text" name="flat_owner_phone" value="{{ old('flat_owner_phone', $flat->flat_owner_phone ?? '') }}"
        class="form-control @error('flat_owner_phone') is-invalid @enderror">
    @error('flat_owner_phone')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Owner Email</label>
    <input type="email" name="flat_owner_email" value="{{ old('flat_owner_email', $flat->flat_owner_email ?? '') }}"
        class="form-control @error('flat_owner_email') is-invalid @enderror">
    @error('flat_owner_email')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Monthly Rent</label>
    <input type="number" step="0.01" name="monthly_rent"
        value="{{ old('monthly_rent', $flat->monthly_rent ?? '') }}"
        class="form-control @error('monthly_rent') is-invalid @enderror">
    @error('monthly_rent')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Notes</label>
    <textarea name="notes" class="form-control @error('notes') is-invalid @enderror" rows="3">{{ old('notes', $flat->notes ?? '') }}</textarea>
    @error('notes')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
