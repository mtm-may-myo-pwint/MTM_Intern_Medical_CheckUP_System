@extends('layouts.app')
@section('content')
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
            <h3 class="text-center mb-3">Hospital</h3>
            <div class="d-flex justify-content-center align-items-center">
                <div class="card w-100 shadow p-3 mb-5 bg-white rounded" style="max-width:700px;" >
                    <!-- <div class="card-header">
                    </div> -->
                    <div class="card-body">
                        <form action="{{route('hospital.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="hospital_id" name="hospital_id" value=" ">
                            <div class="form-group row">
                                <div class="col-md-6 text-center">
                                    <label for="hospital_name" class="text-muted required">{{ __('Hospital Name') }}</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control  @error('hospital_name') is-invalid @enderror" id="hospital_name" name="hospital_name" value="{{ old('hospital_name','') }}" required>
                                    @error('hospital_name')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>                    
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <div class="col-md-6 text-center">
                                    <label for="hospital_image" class="text-muted">{{ __('Hospital Image') }}</label>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-between">
                                        <div class="mb-3" id="image_preview"></div>
                                        <div class="form-check mt-2 mb-2" id="remove_image" style="display:none;">
                                            <input type="checkbox" class="form-check-input" id="remove_hospital_image" name="remove_hospital_image" value="1">
                                            <label class="form-check-label" for="remove_hospital_image">Remove current image</label>
                                        </div>
                                    </div>
                                    <input type="file" class="form-control mb-3  @error('hospital_image') is-invalid @enderror" id="hospital_image" name="hospital_image" accept="image/*" value="{{ old('hospital_image','') }}">
                                    @error('hospital_image')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>                    
                                    @enderror
                                </div>

                            </div>
                            <div class="form-group row mt-3">
                                <div class="col-md-6 text-center">
                                    <label for="hospital_address" class="text-muted required">{{ __('Hospital Address') }}</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control  @error('hospital_address') is-invalid @enderror" id="hospital_address" name="hospital_address" value="{{ old('hospital_address','') }}" required>
                                    @error('hospital_address')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>                    
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <div class="col-md-6 text-center">
                                    <label for="hospital_ph_no" class="text-muted required">{{ __('Phone Number') }}</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control  @error('hospital_ph_no') is-invalid @enderror" id="hospital_ph_no" name="hospital_ph_no" value="{{ old('hospital_ph_no','') }}" required>
                                    @error('hospital_ph_no')
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
                    <h4 class="text-center mb-3">Hospital List</h4>
                    <table class="table table-bordered">
                        <thead class="table-secondary">
                            <tr>
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('Hospital Name') }}</th>
                                <th>{{ __('Hospital Image') }}</th>
                                <th>{{ __('Hospital Address') }}</th>
                                <th>{{ __('Phone Number') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($hospitals as $hospital)
                                <tr>
                                    <td>{{ $hospital->id }}</td>
                                    <td>{{ $hospital->hospital_name ?? '' }}</td>
                                    <td>
                                        @if($hospital->hospital_image)
                                            <img src="{{ asset('storage/'.$hospital->hospital_image) }}" width="100">
                                        @else
                                            <img src="{{ asset('img/image_not_found.jpg') }}" width="100">
                                        @endif
                                    </td>
                                    <td>{{ $hospital->hospital_address ?? '' }}</td>
                                    <td>{{ $hospital->hospital_ph_no ?? '' }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="#" class="btn btn-sm btn-outline-primary me-2 editbtn" data-id="{{ $hospital->id }}"><i class="fas fa-pen-to-square"></i></a>
                                            <form method="POST" action="{{ route('hospital.delete', $hospital->id) }}" onsubmit="return confirm('Please confirm you want to delete!')">
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
                        {{ $hospitals->links('pagination::bootstrap-5') }}
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
            url: 'hospital/getData',
            type: 'GET',
            data: {
                id: id
            },
            success: function(response){
                console.log(response);

                $('#hospital_id').val(response.data.id);
                $('#hospital_name').val(response.data.hospital_name);
                $('#hospital_address').val(response.data.hospital_address);
                $('#hospital_ph_no').val(response.data.hospital_ph_no);
                // $('#hospital_image').val(response.data.hospital_image);

                if (response.data.hospital_image) {
                    $('#remove_image').show();
                    $('#remove_package_image').prop('checked', false);
                    $('#image_preview').html(
                        `<img src="{{ asset('storage') }}/${response.data.hospital_image}" width="100">`
                    );
                }else{
                    $('#remove_image').hide();
                    $('#image_preview').html(
                        `<img src="{{ asset('img/image_not_found.jpg') }}" width="100">`
                    );
                }
                
            }
        })
        
   })

   $('.clear').on('click',function(e){
        e.preventDefault();

        $('#hospital_id').val('');
        $('#hospital_name').val('');
        $('#hospital_image').val('');
        $('#hospital_address').val('');
        $('#hospital_ph_no').val('');
        $('#hospital_image').val('');
        $('#image_preview').html('');
        $('#remove_image').hide();
   })
</script>
@endsection