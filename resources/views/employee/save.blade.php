@extends('layouts.app')
@section('content')
@php
    use App\Constants\GeneralConst;
@endphp
<div class="container">
    <div class="d-flex justify-content-center align-items-center">
        <div class="card w-100 shadow rounded mb-4" style="max-width:600px;">
            <div class="card-header bg-white">
                <h4 class="text-center">{{ $employee->id ? "Edit" : 'Create' }} Employee Form</h4>
            </div>
            <div class="card-body">
                <form action="{{$employee->id ? route('employee.update',[$employee->id]) : route('employee.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @if($employee->id) @method('PUT') @endif
                    <div class="form-group row">
                        <div class="col-md-6 text-center">
                            <label for="employee_number" class="text-muted required">{{ __('Employee ID') }}</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control  @error('employee_number') is-invalid @enderror" id="employee_number" name="employee_number" value="{{ old('employee_number', $employee->employee_number) }}" >
                            @error('employee_number')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>                    
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mt-3">
                        <div class="col-md-6 text-center">
                            <label for="name" class="text-muted required">{{ __('Employee Name') }}</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control  @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $employee->name) }}" >
                            @error('name')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>                    
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mt-3">
                        <div class="col-md-6 text-center">
                            <label for="email" class="text-muted required">{{ __('Employee Email') }}</label>
                        </div>
                        <div class="col-md-6">
                            <input type="email" class="form-control  @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $employee->email) }}" >
                            @error('email')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>                    
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mt-3">
                        <div class="col-md-6 text-center">
                            <label for="position" class="text-muted required">{{ __('Position') }}</label>
                        </div>
                        <div class="col-md-6">
                            <select class="form-control  @error('position') is-invalid @enderror" id="position" name="position" >
                                <option value="">{{ __('Select Position') }}</option>
                                @foreach (GeneralConst::POSITION as $key => $position)
                                        <option value="{{ $key }}" {{ old('position',$employee->position) == $key ? 'selected' : '' }} >
                                        {{ $position }}
                                    </option>
                                @endforeach
                            </select>
                            @error('position')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>                    
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mt-3">
                        <div class="col-md-6 text-center">
                            <label for="dob" class="text-muted">{{ __('DOB') }}</label>
                        </div>
                        <div class="col-md-6">
                            <!-- <input type="date" class="form-control mb-2  @error('dob') is-invalid @enderror" id="dob" name="dob" value="{{ old('dob','') }}"> -->
                            <input type="date" class="form-control mb-2  @error('dob') is-invalid @enderror" name="dob" value="{{ old('dob', $employee->dob) }}" placeholder="Select a date" max="{{ now()->format('Y-m-d') }}">
                            @error('dob')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>                    
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mt-3">
                        <div class="col-md-6 text-center">
                            <label for="gender" class="text-muted required">{{ __('Gender') }}</label>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="Male" {{ old('gender',$employee->gender) == 'Male' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio1">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="Female" {{ old('gender',$employee->gender) == 'Female' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio2">Female</label>
                            </div>
                            @error('gender')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>                    
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mt-3">
                        <div class="col-md-6 text-center">
                            <label for="entry_date" class="text-muted required">{{ __('Entry Date') }}</label>
                        </div>
                        <div class="col-md-6">
                            <!-- <input type="date" class="form-control mb-2  @error('entry_date') is-invalid @enderror" id="entry_date" name="entry_date" value="{{ old('entry_date','') }}"> -->
                            <input type="date" class="form-control  mb-2  @error('entry_date') is-invalid @enderror" name="entry_date" value="{{ old('entry_date', $employee->entry_date) }}" placeholder="Select a date" max="{{ now()->format('Y-m-d') }}">
                            @error('entry_date')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>                    
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mt-3">
                        <div class="col-md-6 text-center">
                            <label for="resign_date" class="text-muted">{{ __('Resign Date') }}</label>
                        </div>
                        <div class="col-md-6">
                            <!-- <input type="date" class="form-control mb-2  @error('resign_date') is-invalid @enderror" id="resign_date" name="resign_date" value="{{ old('resign_date','') }}"> -->
                            <input type="date" class="form-control  mb-2  @error('resign_date') is-invalid @enderror" name="resign_date" value="{{ old('resign_date', $employee->resign_date) }}" placeholder="Select a date">
                            @error('resign_date')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>                    
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mt-3">
                        <div class="col-md-6 text-center">
                            <label for="member_type" class="text-muted required">{{ __('Old/New') }}</label>
                        </div>
                        <div class="col-md-6">
                            <select class="form-control  @error('member_type') is-invalid @enderror" id="member_type" name="member_type" >
                                <option value="">{{ __('Select Member Type') }}</option>
                                @foreach (GeneralConst::MEMBER_TYPES as $key => $member_type)
                                        <option value="{{ $key }}" 
                                            {{ (old('member_type') ?? ($employee->member_type ?? '')) == $key ? 'selected' : '' }}>
                                            {{ $member_type }}
                                        </option>
                                        {{ $member_type }}
                                    </option>
                                @endforeach
                            </select>
                            @error('member_type')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>                    
                            @enderror
                        </div>
                    </div>
                    @if (empty($employee['id']))
                    <div class="form-group row mt-3">
                        <div class="col-md-6 text-center">
                            <label for="password" class="text-muted required">{{ __('Password') }}</label>
                        </div>
                        <div class="col-md-6">
                            <input type="password" class="form-control  @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password','') }}">
                            @error('password')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>                    
                            @enderror
                        </div>
                    </div>
                    @endif
                    <div class="d-flex justify-content-center mt-4">
                        <div>
                            <a href="{{ route('employee.index') }}" class="btn btn-outline-secondary px-3 mx-3">{{ __('Back to list') }}</a>
                            <button type="submit" class="btn btn-outline-success px-6 mx-3">{{ $employee->id ? "Update" : "Create" }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
<!-- @section('script')
<script>
    flatpickr(".date_picker", {
        dateFormat: "Y-m-d",
        enableTime: false,
        noCalendar: false
    });
</script>
@endsection -->