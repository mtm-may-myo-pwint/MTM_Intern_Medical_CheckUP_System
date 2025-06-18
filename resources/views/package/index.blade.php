@extends('layouts.app')
@section('content')
@php
    use App\Constants\GeneralConst;
@endphp
<div class="container">
     @if (session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success')}}
        </div>
    @endif
    @if (session()->get('error'))
        <div class="alert alert-danger">
            {{ session()->get('error')}}
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-center align-items-center">
                <div class="card w-100 shadow p-3 mb-5 bg-white rounded" style="max-width:650px;" >
                    <div class="card-header bg-white">
                        <h3 class="text-center">Package Form</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{route('package.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="package_id" name="package_id" value=" ">
                            <div class="form-group row">
                                <div class="col-md-6 text-center">
                                    <label for="package_name" class="text-muted required mt-1">{{ __('Package Name') }}</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control  @error('package_name') is-invalid @enderror" id="package_name" name="package_name" value="{{ old('package_name','') }}">
                                    @error('package_name')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>                    
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <div class="col-md-6 text-center">
                                    <label for="package_price" class="text-muted required mt-1">{{ __('Package Price') }}</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control  @error('package_price') is-invalid @enderror" id="package_price" name="package_price" value="{{ old('package_price','') }}">
                                    @error('package_price')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>                    
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <div class="col-md-6 text-center">
                                    <label for="package_type" class="text-muted required mt-1">{{ __('Package Type') }}</label>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-control  @error('package_type') is-invalid @enderror" id="package_type" name="package_type">
                                        <option value="">{{ __('Select Package') }}</option>
                                        @foreach (GeneralConst::package_type as $key => $package)
                                            <option value="{{ $key }}" {{ (old('package_type', '') == $key) ? 'selected' : '' }}>{{ $package }}</option>
                                        @endforeach
                                    </select>
                                    @error('package_type')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>                    
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <div class="col-md-6 text-center">
                                    <label for="package_year" class="text-muted required mt-1">{{ __('Package Year') }}</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="number" class="form-control  @error('package_year') is-invalid @enderror" id="package_year" name="package_year" value="{{ old('package_year','') }}">
                                    @error('package_year')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>                    
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <div class="col-md-6 text-center">
                                    <label for="package_image" class="text-muted">{{ __('Package Image') }}</label>
                                </div>
                                <div class="col-md-6">
                                    <img src="{{ asset('img/image_not_found.jpg') }}" style="width:280px;">
                                    <input type="file" class="form-control mt-3  @error('package_image') is-invalid @enderror" id="package_image" name="package_image" accept="image/*" value="{{ old('package_image','') }}">
                                    <div class="mt-3" id="image_preview"></div>
                                    @error('package_image')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>                    
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <div class="col-md-6 text-center">
                                    <label for="hospital_id" class="text-muted mt-1">{{ __('Hospital Name') }}</label>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-control  @error('hospital_id') is-invalid @enderror" id="hospital_id" name="hospital_id">
                                        <option value="">{{ __('Select Hospital') }}</option>
                                        @foreach ($hospitals as $hospital)
                                            <option value="{{ $hospital->id }}" {{ (old('hospital_id', '') == $key) ? 'selected' : '' }}>{{ $hospital->hospital_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('hospital_id')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>                    
                                    @enderror
                                </div>
                            </div>
                            <div class="d-flex justify-content-center mt-3">
                                <div>
                                    <button type="submit" class="btn btn-outline-success px-5 mx-3">{{ __('Submit') }}</button>
                                    <button class="btn btn-outline-primary px-5 clear">{{ __('Clear') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row mt-4">
                <div class="col-md-12">
                    <h4 class="text-center mb-3">Package List</h4>
                    <table class="table table-bordered">
                        <thead class="table-secondary">
                            <tr>
                                <th>{{ __('ID') }}</th>
                                <th class="text-center">{{ __('Package Name') }}</th>
                                <th class="text-center">{{ __('Package Price') }}</th>
                                <th class="text-center">{{ __('Package Type') }}</th>
                                <th class="text-center">{{ __('Package Year') }}</th>
                                <th class="text-center">{{ __('Hospital Name') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($packages as $package)
                                <tr>
                                    <td>{{ $package->id }}</td>
                                    <td class="text-center">{{ $package->package_name ?? '' }}</td>
                                    <td class="text-end">{{ $package->package_price ?? '' }}</td>
                                    <td class="text-center">{{ GeneralConst::package_type[$package->package_type] ?? '' }}</td>
                                    <td class="text-center">{{ $package->package_year ?? '' }}</td>
                                    <td class="text-center">{{ $package->hospital->hospital_name ?? '' }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="#" class="btn btn-sm btn-outline-primary me-2 editbtn" data-id="{{ $package->id }}">{{__('Edit')}}</a>
                                            <form method="POST" action="{{ route('package.delete', $package->id) }}" onsubmit="return confirm('Please confirm you want to delete!')">
                                                @csrf
                                                @method('DELETE')
    
                                                <button type="submit" class="btn btn-outline-danger btn-sm btn-delete">
                                                    {{ __('Delete') }}
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                        {{ $packages->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection