@extends('layouts.app')
@section('content')
@php
    use App\Constants\GeneralConst;
@endphp
<div class="container-fluid">
    @if (session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success')}}
        </div>
    @endif
    <h3 class="text-center mb-4">Check-up Current Month</h3>
    <div class="card">
        <div class="card-body">
            <form action="{{route('checkup.inform')}}" method="post">
                @csrf
                <table class="table table-bordered">
                    <thead class="table-secondary">
                        <tr>
                            <th class="text-center">{{ __('No') }}</th>
                            <th class="text-center">{{ __('Name') }}</th>
                            <th class="text-center">{{ __('Position') }}</th>
                            <th class="text-center">{{ __('Member Type') }}</th>
                            <th class="text-center">{{ __('Last Check-up Date') }}</th>
                            <th class="text-center">{{ __('Check-up/Not') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employees as $employee)
                            <tr>
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td class="text-center">{{ $employee->name ?? ''}}</td>
                                <td class="text-center">{{ GeneralConst::POSITION[$employee->position] ?? '' }}</td>
                                <td class="text-center">{{ GeneralConst::MEMBER_TYPES[$employee->member_type] ?? '' }}</td>
                                @php
                                    $last_checkup_date = $employee->employeeCheckup->sortByDesc('checkup_date')->first()?->checkup_date;
                                @endphp
                                <td class="text-center">
                                    {{ $last_checkup_date ?? '' }}
                                </td>
                                <td class="d-flex justify-content-center">
                                    <!-- @php
                                        $inform = $employee->employeeCheckup->where('status',GeneralConst::INFORM)->first();
                                    @endphp

                                    @if($inform)
                                        <span class="badge bg-primary">Finish</span>
                                    @else
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{$employee->id}}" name="checkup[]" id="checkup">
                                    </div>
                                    @endif -->
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{$employee->id}}" name="checkup[]" id="checkup">
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-3 form-group">
                                <div class="form-label">{{__('Package')}}</div>
                                <select class="form-control" id="package_id" name="package_id">
                                    <option value="">Choose Package</option>
                                    @foreach($packages as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <div class="form-label">{{__('Hospital')}}</div>
                                <input type="text" class="form-control" name="hospital_id" id="hospital_id" value="{{ old('hospital_id') }}" disabled>
                            </div>
                            <div class="col-md-3 form-group">
                                <div class="form-label">{{__('Deadline Date')}}</div>
                                <input type="date" class="form-control" name="deadline_date" id="deadline_date" value="" min="{{ now()->addDay(1)->format('Y-m-d') }}">
                            </div>
                            <div class="col-md-2 form-group d-flex align-items-end">
                                <button type="submit" class="btn btn-outline-primary w-50"> {{__('Inform')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $('#package_id').on('change',function(event){
        event.preventDefault();

        let package_id = $('#package_id').val();
        
        $.ajax({
            url: 'checkup-current-month/getHospital',
            type: 'GET',
            data: {
                package_id : package_id
            },
            success: function(response){
                console.log('respones',response);
                
                $('#hospital_id').val(response.hospital.hospital_name)
            }
        })
    })
</script>
@endsection