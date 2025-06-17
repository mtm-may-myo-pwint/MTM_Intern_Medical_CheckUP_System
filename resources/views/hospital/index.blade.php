@extends('layouts.app')
@section('content')
<div class="container">
    @if (session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success')}}
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <h3 class="text-center mb-3">Hospital</h3>
            <div class="d-flex justify-content-center align-items-center">
                <div class="card w-100" style="max-width:650px;" >
                    <!-- <div class="card-header">
                    </div> -->
                    <div class="card-body">
                        <form action="" method="post">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-6 text-center">
                                    <label for="hospital_name" class="text-muted">{{ __('Hospital Name') }}</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control  @error('hospital_name') is-invalid @enderror" id="hospital_name" name="hospital_name" value="{{ old('hospital_name','') }}">
                                </div>
                            </div>
                            @error('hospital_name')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>                    
                            @enderror
                            <div class="form-group row mt-3">
                                <div class="col-md-6 text-center">
                                    <label for="hospital_image" class="text-muted">{{ __('Hospital Image') }}</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="file" class="form-control  @error('hospital_image') is-invalid @enderror" id="hospital_image" name="hospital_image" value="{{ old('hospital_image','') }}">
                                </div>
                            </div>
                            @error('hospital_image')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>                    
                            @enderror
                            <div class="form-group row mt-3">
                                <div class="col-md-6 text-center">
                                    <label for="hospital_address" class="text-muted">{{ __('Hospital Address') }}</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control  @error('hospital_address') is-invalid @enderror" id="hospital_address" name="hospital_address" value="{{ old('hospital_address','') }}">
                                </div>
                            </div>
                            @error('hospital_address')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>                    
                            @enderror
                            <div class="form-group row mt-3">
                                <div class="col-md-6 text-center">
                                    <label for="hospital_ph_no" class="text-muted">{{ __('Phone Number') }}</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control  @error('hospital_ph_no') is-invalid @enderror" id="hospital_ph_no" name="hospital_ph_no" value="{{ old('hospital_ph_no','') }}">
                                </div>
                            </div>
                            @error('hospital_ph_no')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>                    
                            @enderror
                            <div class="d-flex justify-content-center mt-3">
                                <div>
                                    <button type="submit" class="btn btn-outline-success px-5 mx-3">{{ __('Create') }}</button>
                                    <button class="btn btn-outline-primary px-5">{{ __('Clear') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row mt-4">
                <div class="col-md-12">
                    <h4 class="text-center mb-3">Hospital List</h4>
                    <table class="table table-bordered">
                        <thead class="table-secondary">
                            <tr>
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('Hospital Name') }}</th>
                                <th>{{ __('Hospital Image') }}</th>
                                <th>{{ __('Hospital Address') }}</th>
                                <th>{{ __('Phone Number') }}</th>
                                <th colspan="2">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($hospitals as $hospital)
                                <tr>
                                    <td>{{ $hospital->id }}</td>
                                    <td>{{ $hospital->hospital_name ?? '' }}</td>
                                    <td>{{ $hospital->hospital_image ?? '' }}</td>
                                    <td>{{ $hospital->hospital_address ?? '' }}</td>
                                    <td>{{ $hospital->hospital_ph_no ?? '' }}</td>
                                    <td>
                                        <a href="" class="btn btn-primary">{{ __('Edit') }}</a>
                                        <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                        {{ $hospitals->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection