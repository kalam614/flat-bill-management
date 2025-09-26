<div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" name="name" value="{{ old('name', $tenant->name ?? '') }}" class="form-control" required>
</div>

<div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" name="email" value="{{ old('email', $tenant->email ?? '') }}" class="form-control" required>
</div>

<div class="mb-3">
    <label class="form-label">Phone</label>
    <input type="text" name="phone" value="{{ old('phone', $tenant->phone ?? '') }}" class="form-control" required>
</div>

<div class="mb-3">
    <label class="form-label">Address</label>
    <textarea name="address" class="form-control">{{ old('address', $tenant->address ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label">House Owner</label>
    <select name="house_owner_id" id="house_owner_id" class="form-control" required>
        <option value="">Select Owner</option>
        @foreach ($houseOwners as $owner)
            <option value="{{ $owner->id }}"
                {{ old('house_owner_id', $tenant->house_owner_id ?? '') == $owner->id ? 'selected' : '' }}>
                {{ $owner->user->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Flat</label>
    <select name="flat_id" id="flat_id" class="form-control">
        <option value="">Select Flat</option>
        @if (isset($flats))
            @foreach ($flats as $flat)
                <option value="{{ $flat->id }}"
                    {{ old('flat_id', $tenant->flat_id ?? '') == $flat->id ? 'selected' : '' }}>
                    {{ $flat->flat_number }}
                </option>
            @endforeach
        @endif
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Move In Date</label>
    <input type="date" name="move_in_date" value="{{ old('move_in_date', $tenant->move_in_date ?? '') }}"
        class="form-control">
</div>

<div class="mb-3">
    <label class="form-label">Move Out Date</label>
    <input type="date" name="move_out_date" value="{{ old('move_out_date', $tenant->move_out_date ?? '') }}"
        class="form-control">
</div>

<script>
    document.getElementById('house_owner_id')?.addEventListener('change', function() {
        fetch(`/admin/tenants/flats/${this.value}`)
            .then(res => res.json())
            .then(data => {
                let flatSelect = document.getElementById('flat_id');
                flatSelect.innerHTML = '<option value="">Select Flat</option>';
                data.forEach(flat => {
                    flatSelect.innerHTML +=
                        `<option value="${flat.id}">${flat.flat_number}</option>`;
                });
            });
    });
</script>
