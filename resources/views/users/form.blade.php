<div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name ?? '') }}" required>
</div>
<div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email ?? '') }}" required>
</div>
<div class="mb-3">
    <label class="form-label">Password</label>
    <input type="password" name="password" class="form-control" @if(!isset($user)) required @endif>
</div>
<div class="mb-3">
    <label class="form-label">Confirm Password</label>
    <input type="password" name="password_confirmation" class="form-control" @if(!isset($user)) required @endif>
</div>
<div class="mb-3">
    <label class="form-label">Status</label>
    <select name="status" class="form-select">
        <option value="active" @selected(old('status', $user->status ?? '') === 'active')>Active</option>
        <option value="inactive" @selected(old('status', $user->status ?? '') === 'inactive')>Inactive</option>
    </select>
</div>
<div class="mb-3">
    <label class="form-label">Roles</label>
    <div class="d-flex gap-3">
        @foreach($roles as $role)
            <label><input type="checkbox" name="roles[]" value="{{ $role->id }}" @checked(in_array($role->id, old('roles', isset($user) ? $user->roles->pluck('id')->toArray() : [])))> {{ $role->name }}</label>
        @endforeach
    </div>
</div>
<button class="btn btn-success">Save</button>
