@extends('layouts.app')
@section('content')
@php
    use App\Constants\GeneralConst;
@endphp
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>{{ __('User Save') }}</h1>
            <form action="{{ empty($user['id']) ? route('user.create') : route('user.edit', ['id' => $user['id']]) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">{{ __('Name') }}</label>
                    <input type="text" class="form-control  @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}">
                </div>
                @error('name')
                    <div class="text-danger">
                        {{ $message }}
                    </div>                    
                @enderror
                <div class="form-group">
                    <label for="email">{{ __('Email') }}</label>
                    <input type="email" class="form-control  @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}">
                </div>
                @error('email')
                    <div class="text-danger">
                        {{ $message }}
                    </div>                    
                @enderror
                @if (empty($user['id']))
                    <div class="form-group">
                        <label for="password">{{ __('Password') }}</label>
                        <input type="password" class="form-control  @error('password') is-invalid @enderror" id="password" name="password">
                    </div>
                    @error('password')
                        <div class="text-danger">
                            {{ $message }}
                        </div>                    
                    @enderror
                    <div class="form-group">
                        <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                        <input type="password" class="form-control  @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation">  
                    </div>
                    @error('password_confirmation')
                        <div class="text-danger">
                            {{ $message }}
                        </div>                    
                    @enderror
                @endif
                <div class="form-group">
                    <label for="role">{{ __('Role') }}</label>
                    <select class="form-control  @error('role') is-invalid @enderror" id="role" name="role">
                        <option value="">{{ __('Select Role') }}</option>
                        @foreach (GeneralConst::ROLES as $key => $role)
                            <option value="{{ $key }}" {{ (old('role', $user->role) == $key) ? 'selected' : '' }}>{{ $role }}</option>
                        @endforeach
                    </select>
                </div>
                @error('role')
                    <div class="text-danger">
                        {{ $message }}
                    </div>                    
                @enderror
                <div class="mt-3">
                    <a href="{{ route('user.list') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
