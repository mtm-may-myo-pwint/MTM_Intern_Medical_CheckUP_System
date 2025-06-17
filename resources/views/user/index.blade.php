@extends('layouts.app')
@section('content')
@php
    use App\Constants\GeneralConst;
    use App\Lib\DateFormat;
@endphp
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mt-3">
                <h1>{{ __('User List') }}</h1>
                <div class="create">
                    <a href="{{ route('user.create') }}" class="btn btn-success ml-auto">{{ __('Create User') }}</a>
                </div>
            </div>
            @if (session()->get('success'))
                <div class="alert alert-success">
                    {{ session()->get('success')}}
                </div>
            @endif
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Role') }}</th>
                        <th>{{ __('Created_At')}}
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ GeneralConst::ROLES[$user->role] ?? '' }}</td>
                            <td>{{ DateFormat::dateTimeFormat($user->created_at) }}
                            <td>
                                <a href="{{ route('user.edit', ['id' => $user['id']]) }}" class="btn btn-primary">{{ __('Edit') }}</a>
                                <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
