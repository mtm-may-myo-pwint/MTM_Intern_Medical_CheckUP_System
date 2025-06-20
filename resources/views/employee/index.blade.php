@extends('layouts.app')
@section('content')
@php
    use App\Constants\GeneralConst;
    use App\Lib\DateFormat;
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
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h3 class="text-center mb-3">Employee List</h3>
    <div class="row">
        <div class="d-flex justify-content-between">
            <div>
            </div>
            <div class="create text-end">
                <a class="btn btn-outline-warning me-2  ml-auto" data-bs-toggle="modal" data-bs-target="#excelImportModal">
                    <i class="fas fa-file-import"></i>  {{ __('Import Excel') }}
                </a>
                <a href="{{ route('employee.create') }}" class="btn btn-outline-success ml-auto"><i class="fas fa-plus"></i> {{ __('Add Employee') }}</a>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead class="table-secondary">
                    <tr>
                        <th>{{ __('Employee Id') }}</th>
                        <th class="text-center">{{ __('Employee Name') }}</th>
                        <th class="text-center">{{ __('Employee Email') }}</th>
                        <th class="text-center">{{ __('Position') }}</th>
                        <th class="text-center">{{ __('DOB') }}</th>
                        <th class="text-center">{{ __('Gender') }}</th>
                        <th class="text-center">{{ __('Entry Date') }}</th>
                        <th class="text-center">{{ __('Resign Date') }}</th>
                        <th class="text-center">{{ __('Old/New') }}</th>
                        <th class="text-center">{{ __('Created Date') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employees as $employee)
                        <tr>
                            <td>{{ $employee->employee_number ?? '' }}</td>
                            <td>{{ $employee->name ?? '' }}</td>
                            <td>{{ $employee->email ?? '' }}</td>
                            <td class="text-center">{{ GeneralConst::POSITION[$employee->position] ?? '' }}</td>
                            <td>{{ DateFormat::dateFormatSlash($employee->dob) ?? '' }}</td>
                            <td>{{ $employee->gender ?? '' }}</td>
                            <td>{{ DateFormat::dateFormatSlash($employee->entry_date) ?? '' }}</td>
                            <td>{{ DateFormat::dateFormatSlash($employee->resign_date) ?? '' }}</td>
                            <td class="text-center">{{ GeneralConst::MEMBER_TYPES[$employee->meber_type] ?? '' }}</td>
                            <td class="text-center">{{ DateFormat::dateFormatSlash($employee->created_at) ?? '' }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('employee.edit',$employee->id) }}" class="btn btn-sm btn-outline-primary me-2"><i class="fas fa-pen-to-square"></i></a>
                                    <form method="POST" action="{{ route('employee.destroy', $employee->id) }}" onsubmit="return confirm('Please confirm you want to delete!')">
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
                {{ $employees->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    <!-- Modal for excel import-->
    <div class="modal fade" id="excelImportModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Excel Import</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST" action="{{route('employee.import')}}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group{{ $errors->has('excel_file') ? ' has-error' : '' }}">
                                <label for="excel_file" class="form-label">{{ __('Excel file to import') }}</label>
                                <div class="col-md-6">
                                    <input id="excel_file" type="file" class="form-control" name="file" accept=".xls,.xlsx" required>

                                    @error('excel_file')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>                    
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-primary">{{__('Save')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function () {
        $('#excelImportModal').on('hidden.bs.modal', function () {
            $('#excel_file').val('');
        });
    });
</script>
@endsection