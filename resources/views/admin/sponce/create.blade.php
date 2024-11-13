@extends('layouts.admin-master')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mt-4">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Create New Sponce</h3>
                    </div>
                    <form action="{{ route('sponce.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <!-- User Dropdown -->
                            <div class="form-group">
                                <label for="user_id">User</label>
                                <select id="user_id" name="user_id" class="form-control @error('user_id') is-invalid @enderror">
                                    <option value="">Select User</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Company Dropdown (based on selected User) -->
                            <div class="form-group">
                                <label for="company_id">Company</label>
                                <select id="company_id" name="company_id" class="form-control @error('company_id') is-invalid @enderror">
                                    <option value="">Select Company</option>
                                </select>
                                @error('company_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Location Type Dropdown -->
                            <div class="form-group">
                                <label for="location_type">Location Type</label>
                                <select id="location_type" name="location_type" class="form-control @error('location_type') is-invalid @enderror">
                                    <option value="">Select Location Type</option>
                                    <option value="city" {{ old('location_type') == 'city' ? 'selected' : '' }}>City</option>
                                    <option value="state" {{ old('location_type') == 'state' ? 'selected' : '' }}>State</option>
                                </select>
                                @error('location_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- City or State Dropdown based on Location Type -->
                            <div class="form-group" id="city_field" style="display: none;">
                                <label for="city_id">City</label>
                                <select id="city_id"  class="form-control @error('location_id') is-invalid @enderror">
                                    <option value="">Select City</option>
                                </select>
                                @error('location_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group" id="state_field" style="display: none;">
                                <label for="state_id">State</label>
                                <select id="state_id"  class="form-control @error('location_id') is-invalid @enderror">
                                    <option value="">Select State</option>
                                </select>
                                @error('location_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <input type="hidden" id="location_id" name="location_id" value="{{ old('location_id') }}">

                            <!-- Type Selection -->
                            <div class="form-group">
                                <label for="type">Select Type</label>
                                <select id="type" name="type" class="form-control @error('type') is-invalid @enderror">
                                    <option value="">Select Type</option>
                                    <option value="category" {{ old('type') == 'category' ? 'selected' : '' }}>Category</option>
                                    <option value="subcategory" {{ old('type') == 'subcategory' ? 'selected' : '' }}>Subcategory</option>
                                    <option value="skill" {{ old('type') == 'skill' ? 'selected' : '' }}>Skill</option>
                                    <option value="subskill" {{ old('type') == 'subskill' ? 'selected' : '' }}>Subskill</option>
                                </select>
                                @error('type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Dynamic Data Dropdown based on Type Selection -->
                            <div class="form-group">
                                <label for="data_id">Select Data</label>
                                <select id="data_id" name="data_id" class="form-control @error('data_id') is-invalid @enderror">
                                    <option value="">Select Data</option>
                                </select>
                                @error('data_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Plan Dropdown -->
                            <div class="form-group">
                                <label for="plan_id">Plan</label>
                                <select id="plan_id" name="plan_id" class="form-control @error('plan_id') is-invalid @enderror">
                                    <option value="">Select Plan</option>
                                    @foreach($plans as $plan)
                                        <option value="{{ $plan->id }}" {{ old('plan_id') == $plan->id ? 'selected' : '' }}>{{ $plan->name }}</option>
                                    @endforeach
                                </select>
                                @error('plan_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script>
    // Fetch companies based on selected user
    $('#user_id').change(function () {
        var userId = $(this).val();
        if (userId) {
            $.post('{{ route("sponce.getCompanies") }}', { user_id: userId, _token: '{{ csrf_token() }}' }, function (data) {
                $('#company_id').empty().append('<option value="">Select Company</option>');
                $.each(data, function (index, company) {
                    $('#company_id').append('<option value="' + company.id + '">' + company.name + '</option>');
                });
            });
        } else {
            $('#company_id').empty().append('<option value="">Select Company</option>');
        }
    });

    // Load data based on type selection
    $('#type').change(function () {
        var type = $(this).val();
        if (type) {
            $.post('{{ route("sponce.getDataByType") }}', { type: type, _token: '{{ csrf_token() }}' }, function (data) {
                $('#data_id').empty().append('<option value="">Select Data</option>');
                $.each(data, function (index, item) {
                    $('#data_id').append('<option value="' + item.id + '">' + item.name + '</option>');
                });
            });
        } else {
            $('#data_id').empty().append('<option value="">Select Data</option>');
        }
    });

    $('#location_type').change(function () {
        var locationType = $(this).val();
        $('#location_id').val(''); // Reset the hidden field

        if (locationType === 'city') {
            $('#city_field').show();
            $('#state_field').hide();
              fetchCities();
        } else if (locationType === 'state') {
            $('#state_field').show();
            $('#city_field').hide();
         fetchStates();
        } else {
            $('#city_field').hide();
            $('#state_field').hide();
        }
    });

    function fetchCities() {
        $.get('{{ route("sponce.getCities") }}', function (data) {
            console.log(data);
            $('#city_id').empty().append('<option value="">Select City</option>');
            $.each(data, function (index, city) {
                $('#city_id').append('<option value="' + city.id + '">' + city.name + '</option>');
            });
        });
    }

    function fetchStates() {
        $.get('{{ route("sponce.getStates") }}', function (data) {
            $('#state_id').empty().append('<option value="">Select State</option>');
            $.each(data, function (index, state) {
                $('#state_id').append('<option value="' + state.id + '">' + state.name + '</option>');
            });
        });
    }

    $('#city_id').change(function () {
        var cityId = $(this).val();
        $('#location_id').val(cityId); // Set the hidden field to the selected city ID
    });

    $('#state_id').change(function () {
        var stateId = $(this).val();
        $('#location_id').val(stateId); // Set the hidden field to the selected state ID
    });

    
</script>
@endsection
