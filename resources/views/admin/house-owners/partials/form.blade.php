<div class="form-group mb-3">
    <label for="name">Owner Name</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $houseOwner->user->name ?? '') }}"
        required>
</div>

<div class="form-group mb-3">
    <label for="email">Email</label>
    <input type="email" name="email" class="form-control" value="{{ old('email', $houseOwner->user->email ?? '') }}"
        required>
</div>

@if (!isset($houseOwner))

    <div class="form-group mb-3">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <div class="form-group mb-3">
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" name="password_confirmation" class="form-control" required>
    </div>
@endif

<div class="form-group mb-3">
    <label for="phone">Phone</label>
    <input type="text" name="phone" class="form-control" value="{{ old('phone', $houseOwner->phone ?? '') }}">
</div>

<div class="form-group mb-3">
    <label for="address">Address</label>
    <textarea name="address" class="form-control">{{ old('address', $houseOwner->address ?? '') }}</textarea>
</div>

<div class="form-group mb-3">
    <label for="building_name">Building Name</label>
    <input type="text" name="building_name" class="form-control"
        value="{{ old('building_name', $houseOwner->building_name ?? '') }}" required>
</div>

<div class="form-group mb-3">
    <label for="building_address">Building Address</label>
    <textarea name="building_address" class="form-control" required>{{ old('building_address', $houseOwner->building_address ?? '') }}</textarea>
</div>
