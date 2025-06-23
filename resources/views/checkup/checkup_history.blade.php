@extends('layouts.app')
@section('content')
<div class="container">
    <h4 class="text-center mb-3">Check-up History</h4>
    <div class="card">
        <div class="card-header bg-white">
            <div class="row mb-3 mt-3">
                <div class="form-group col-md-2">
                    <div class="form-label">{{__('Name')}}</div>
                    <input type="text" class="form-control" name="search" id="search" value="{{ request('search') }}">
                </div>
                <div class="form-group col-md-2">
                    <div class="form-label">{{__('YYYYMM (FROM)')}}</div>
                    <input type="month" class="form-control" name="from_date" id="from_date" value="{{ request('from_date',\Carbon\Carbon::now()->subYear()->startOfYear()->format('Y-m')) }}">
                </div>
                <div class="form-group col-md-2">
                    <div class="form-label">{{__('YYYYMM (TO)')}}</div>
                    <input type="month" class="form-control" name="to_date" id="to_date" value="{{ request('to_date',\Carbon\Carbon::now()->format('Y-m')) }}">
                </div>
                <div class="form-group col-md-2">
                    <div class="form-label">{{__('Package')}}</div>
                    <select class="form-control" id="package_id" name="package_id">
                        @foreach($packages as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-2 d-flex align-items-end">
                    <div class="form-check" id="resign_member">
                        <input type="checkbox" class="form-check-input" id="resign_member" name="resign_member" value="1">
                        <label class="form-check-label" for="resign_member">Show Resign Member</label>
                    </div>
                </div>
                <div class="form-group col-md-2 d-flex align-items-end">
                    <div>
                        <button type="submit" class="btn btn-outline-primary me-2"><i class="fas fa-magnifying-glass"></i> {{__('Search')}}</button>
                        <button class="btn btn-outline-primary "><i class="fas fa-refresh"></i> {{__('Clear')}}</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="mt-3">
                <a href="#" class="btn btn-outline-primary ml-auto"> {{ __('Check-up Current Month List') }}</a>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead class="table-secondary">
                            <tr>
                                <th class="text-center" >{{ __('No') }}</th>
                                <th class="text-center" >{{ __('Name') }}</th>
                                <th class="text-center" >{{ __('Hepatitis B 4th Dose @ MTM ') }}</th>
                                <th class="text-center" >{{ __('Check-up') }}</th>
                                <th class="text-center" >{{ __('Package') }}</th>
                                <th class="text-center" >{{ __('Option Test') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
      $(document).ready(function () {
        let from_date = $('#from_date').val();
        console.log('form_date',from_date);
        let to_date = $('#to_date').val();
        console.log('form_date',to_date);
        
      });
</script>
@endsection
