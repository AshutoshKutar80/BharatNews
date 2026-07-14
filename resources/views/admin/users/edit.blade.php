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
            <form method="POST" action="{{ route('admin.users.update', $user->id) }}" id="editUserForm">
                @csrf
                @method('PUT')

                <div class="form-grid-2">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Mobile Number (locked)</label>
                        <input type="text" value="{{ $user->mobile }}" disabled>
                        <div class="form-hint">Mobile number is the account identifier and cannot be edited here.</div>
                    </div>

                    <div class="form-group">
                        <label>Pincode</label>
                        <input type="text" name="pincode" maxlength="6" value="{{ old('pincode', $user->pincode) }}"
                            required>
                        @error('pincode')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>State</label>
                        <select name="state" id="state" required>
                            <option value="">Select State</option>
                            @foreach ($states as $state)
                                <option value="{{ $state }}"
                                    {{ old('state', $user->state) == $state ? 'selected' : '' }}>
                                    {{ $state }}
                                </option>
                            @endforeach
                        </select>
                        @error('state')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>District</label>
                        <select name="district" id="district" required>
                            <option value="">Select District</option>
                            @if (isset($districts) && count($districts) > 0)
                                @foreach ($districts as $district)
                                    <option value="{{ $district }}"
                                        {{ old('district', $user->district) == $district ? 'selected' : '' }}>
                                        {{ $district }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        @error('district')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Tehsil</label>
                        <select name="tehsil" id="tehsil" required>
                            <option value="">Select Tehsil</option>
                            @if (isset($tehsils) && count($tehsils) > 0)
                                @foreach ($tehsils as $tehsil)
                                    <option value="{{ $tehsil }}"
                                        {{ old('tehsil', $user->tehsil) == $tehsil ? 'selected' : '' }}>
                                        {{ $tehsil }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        @error('tehsil')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>City</label>
                        <input type="text" name="city" value="{{ old('city', $user->city) }}" required>
                        @error('city')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
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

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            // Store initial values
            var initialDistrict = $('#district').val();
            var initialTehsil = $('#tehsil').val();

            // Function to load districts
            function loadDistricts(state, selectedDistrict) {
                var districtSelect = $('#district');
                var tehsilSelect = $('#tehsil');

                // Clear and disable district and tehsil
                districtSelect.html('<option value="">Select District</option>').prop('disabled', true);
                tehsilSelect.html('<option value="">Select Tehsil</option>').prop('disabled', true);

                if (state) {
                    $.ajax({
                        url: '{{ url('admin/get-districts') }}/' + encodeURIComponent(state),
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            districtSelect.prop('disabled', false);
                            var options = '<option value="">Select District</option>';

                            if (response.districts && response.districts.length > 0) {
                                $.each(response.districts, function(index, district) {
                                    var selected = (district === selectedDistrict) ?
                                        'selected' : '';
                                    options += '<option value="' + district + '" ' + selected +
                                        '>' + district + '</option>';
                                });
                            }

                            districtSelect.html(options);

                            // If we have a selected district, load tehsils
                            if (selectedDistrict) {
                                loadTehsils(selectedDistrict, initialTehsil);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error loading districts:', error);
                            districtSelect.prop('disabled', false);
                        }
                    });
                }
            }

            // Function to load tehsils
            function loadTehsils(district, selectedTehsil) {
                var tehsilSelect = $('#tehsil');

                tehsilSelect.html('<option value="">Select Tehsil</option>').prop('disabled', true);

                if (district) {
                    $.ajax({
                        url: '{{ url('admin/get-tehsils') }}/' + encodeURIComponent(district),
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            tehsilSelect.prop('disabled', false);
                            var options = '<option value="">Select Tehsil</option>';

                            if (response.tehsils && response.tehsils.length > 0) {
                                $.each(response.tehsils, function(index, tehsil) {
                                    var selected = (tehsil === selectedTehsil) ? 'selected' :
                                        '';
                                    options += '<option value="' + tehsil + '" ' + selected +
                                        '>' + tehsil + '</option>';
                                });
                            }

                            tehsilSelect.html(options);
                        },
                        error: function(xhr, status, error) {
                            console.error('Error loading tehsils:', error);
                            tehsilSelect.prop('disabled', false);
                        }
                    });
                }
            }

            // State change event
            $('#state').change(function() {
                var state = $(this).val();
                loadDistricts(state, null);
                // Clear tehsil when state changes
                $('#tehsil').html('<option value="">Select Tehsil</option>').prop('disabled', true);
            });

            // District change event
            $('#district').change(function() {
                var district = $(this).val();
                loadTehsils(district, null);
            });

            // Load initial districts if state exists
            var initialState = $('#state').val();
            if (initialState) {
                loadDistricts(initialState, initialDistrict);
            }
        });
    </script>
@endpush
