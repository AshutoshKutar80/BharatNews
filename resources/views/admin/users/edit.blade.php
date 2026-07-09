@extends('admin.layout')

@section('title', 'Edit User')
@section('page-title', 'Edit User')
@section('page-subtitle', 'Update user details (mobile number cannot be changed)')

@section('content')

  <div class="panel">
    <div class="panel-head">
      <h3>{{ $user->name }}</h3>
      <a href="{{ route('admin.users') }}" class="btn-sm btn-ghost">← Back to Users</a>
    </div>

    <div class="panel-pad">
      <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
        @csrf
        @method('PUT')

        <div class="form-grid-2">
          <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
            @error('name') <div class="field-error">{{ $message }}</div> @enderror
          </div>

          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
            @error('email') <div class="field-error">{{ $message }}</div> @enderror
          </div>

          <div class="form-group">
            <label>Mobile Number (locked)</label>
            <input type="text" value="{{ $user->mobile }}" disabled>
            <div class="form-hint">Mobile number is the account identifier and cannot be edited here.</div>
          </div>

          <div class="form-group">
            <label>Pincode</label>
            <input type="text" name="pincode" maxlength="6" value="{{ old('pincode', $user->pincode) }}" required>
            @error('pincode') <div class="field-error">{{ $message }}</div> @enderror
          </div>

          <div class="form-group">
            <label>State</label>
            <input type="text" name="state" value="{{ old('state', $user->state) }}" required>
            @error('state') <div class="field-error">{{ $message }}</div> @enderror
          </div>

          <div class="form-group">
            <label>District</label>
            <input type="text" name="district" value="{{ old('district', $user->district) }}" required>
            @error('district') <div class="field-error">{{ $message }}</div> @enderror
          </div>

          <div class="form-group">
            <label>Tehsil</label>
            <input type="text" name="tehsil" value="{{ old('tehsil', $user->tehsil) }}" required>
            @error('tehsil') <div class="field-error">{{ $message }}</div> @enderror
          </div>

          <div class="form-group">
            <label>City</label>
            <input type="text" name="city" value="{{ old('city', $user->city) }}" required>
            @error('city') <div class="field-error">{{ $message }}</div> @enderror
          </div>

          <div class="form-group full">
            <label>Status</label>
            <input type="text" value="{{ ucfirst($user->status) }}" disabled>
            <div class="form-hint">Change status from the Users list (Approve / Reject / Block buttons).</div>
          </div>
        </div>

        <div class="form-actions">
          <a href="{{ route('admin.users') }}" class="btn-cancel">Cancel</a>
          <button type="submit" class="btn-primary">Save Changes</button>
        </div>
      </form>
    </div>
  </div>

@endsection
