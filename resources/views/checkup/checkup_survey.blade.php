@extends('layouts.app')
@section('content')
@php
    use App\Constants\GeneralConst;
@endphp
<div class="container">
    <h3 class="text-center">Medical Check-up Survey</h3>
    <div>
        <p>Name: {{auth()->user()?->name ?? ''}}</p>
         <div class="card" style="display: block;">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2 form-group">
                        <div class="form-label">{{__('Check-up/Not')}}</div>
                        <select class="form-control" id="package_id" name="package_id">
                            @foreach (GeneralConst::CHECK_FLG as $key => $check)
                                    <option value="{{ $key }}" 
                                        {{ (old('check') ?? ($employee->check ?? '')) == $key ? 'selected' : '' }}>
                                        {{ $check }}
                                    </option>
                                    {{ $check }}
                                </option>
                            @endforeach
                        </select>
                        @error('package_id')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-2 form-group">
                        <div class="form-label">{{__('Hepatitis B')}}</div>
                        <select class="form-control" id="package_id" name="package_id">
                           
                        </select>
                        @error('package_id')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-2 form-group">
                        <div class="form-label">{{__('Vaccine 4th Dose Date')}}</div>
                        <input type="date" class="form-control" name="vaccine_date" id="vaccine_date" value="" min="{{ now()->addDay(1)->format('Y-m-d') }}" onkeydown="return false;">
                        @error('vaccine_date')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-4 form-group">
                        <div class="form-label">{{__('Optional Test')}}</div>
                        <input type="text" class="form-control" name="option" id="option" value="{{ old('option') }}">
                    </div>
                    <div class="col-md-2 form-group d-flex align-items-end">
                        <button type="submit" class="btn btn-outline-primary w-100"> {{__('Submit')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection