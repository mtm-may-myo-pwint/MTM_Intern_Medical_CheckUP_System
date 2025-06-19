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
    <h3 class="text-center mb-3">Employee List</h3>
    <div class="row">
        <div class="d-flex justify-content-between">
            <div></div>
            <div class="create text-end">
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
                            <td class="text-center">{{ GeneralConst::position[$employee->position] ?? '' }}</td>
                            <td>{{ DateFormat::dateFormatSlash($employee->dob) ?? '' }}</td>
                            <td>{{ $employee->gender ?? '' }}</td>
                            <td>{{ DateFormat::dateFormatSlash($employee->entry_date) ?? '' }}</td>
                            <td>{{ DateFormat::dateFormatSlash($employee->resign_date) ?? '' }}</td>
                            <td>{{ GeneralConst::member_type[$employee->member_type] ?? '' }}</td>
                            <td>{{ DateFormat::dateFormatSlash($employee->created_at) ?? '' }}</td>
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
                <!-- {{ $employees->links('pagination::bootstrap-5') }} -->
            </div>
        </div>
    </div>
</div>
@endsection