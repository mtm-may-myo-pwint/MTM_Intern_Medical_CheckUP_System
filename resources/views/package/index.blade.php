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
                                    <input type="text" class="form-control  @error('package_name') is-invalid @enderror" id="package_name" name="package_name" value="{{ old('package_name','') }}" required>
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
                                    <input type="text" class="form-control  @error('package_price') is-invalid @enderror" id="package_price" name="package_price" value="{{ old('package_price','') }}" required>
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
                                    <select class="form-control  @error('package_type') is-invalid @enderror" id="package_type" name="package_type" required>
                                        <option value="">{{ __('Select Package') }}</option>
                                        @foreach (GeneralConst::PACKAGE_TYPES as $key => $package)
                                             <option value="{{ $key }}" {{ old('package_type') !== null && old('package_type') == $key ? 'selected' : '' }} >
                                                {{ $package }}
                                            </option>
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
                                    <input type="number" class="form-control  @error('package_year') is-invalid @enderror" id="package_year" name="package_year" value="{{ old('package_year','') }}" required>
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
                                    <img id="package_image_preview" src="{{ asset('img/image_not_found.jpg') }}" style="width:280px;">

                                    <div class="form-check mt-2 mb-2" id="remove_image" style="display:none;">
                                        <input type="checkbox" class="form-check-input" id="remove_package_image" name="remove_package_image" value="1">
                                        <label class="form-check-label" for="remove_package_image">Remove current image</label>
                                    </div>

                                    <input type="file" class="form-control mt-3 mb-4 @error('package_image') is-invalid @enderror" id="package_image" name="package_image" accept="image/*" value="{{ old('package_image','') }}">
                                    @error('package_image')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>                    
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <div class="col-md-6 text-center">
                                    <label for="hospital_id" class="text-muted required mt-1">{{ __('Hospital Name') }}</label>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-control  @error('hospital_id') is-invalid @enderror" id="hospital_id" name="hospital_id" required>
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
                            <div class="d-flex justify-content-center mt-4">
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
                                    <td class="text-center">{{ GeneralConst::PACKAGE_TYPES[$package->package_type] ?? '' }}</td>
                                    <td class="text-center">{{ $package->package_year ?? '' }}</td>
                                    <td class="text-center">{{ $package->hospital->hospital_name ?? '' }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="#" class="btn btn-sm btn-outline-primary me-2 editbtn" data-id="{{ $package->id }}"><i class="fas fa-pen-to-square"></i></a>
                                            <form method="POST" action="{{ route('package.delete', $package->id) }}" onsubmit="return confirm('Please confirm you want to delete!')">
                                                @csrf
                                                @method('DELETE')
    
                                                <button type="submit" class="btn btn-outline-danger btn-sm btn-delete">
                                                    <i class="fas fa-trash"></i>
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
@section('script')
<script>
   $('.editbtn').on('click',function(e){
        e.preventDefault();

        const id = $(this).data('id');
        console.log('id',id);

        $.ajax({
            url: 'package/getData',
            type: 'GET',
            data: {
                id: id
            },
            success: function(response){
                console.log(response);

                $('#package_id').val(response.data.id);
                $('#package_name').val(response.data.package_name);
                $('#package_price').val(response.data.package_price);
                $('#package_year').val(response.data.package_year);
                $('#package_type').val(response.data.package_type);
                $('#hospital_id').val(response.data.hospital_id);

                
                if (response.data.package_image) {
                    $('#remove_image').show();
                    $('#remove_package_image').prop('checked', false);
                    $('#package_image_preview').attr('src', '/storage/' + response.data.package_image);
                } else {
                    $('#package_image_preview').attr('src', '{{ asset('img/image_not_found.jpg') }}');
                    $('#remove_image').hide();
                }
            }
        })
        
   })

   $('.clear').on('click',function(e){
        e.preventDefault();

        $('#package_id').val('');
        $('#package_name').val('');
        $('#package_price').val('');
        $('#package_year').val('');
        $('#package_type').val('');
        $('#hospital_id').val('');
        $('#package_image').val('');
        $('#package_image_preview').attr('src', '{{ asset('img/image_not_found.jpg') }}');
        $('#remove_image').hide();
   })
</script>
@endsection