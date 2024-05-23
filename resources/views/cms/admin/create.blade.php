@extends('layouts.app')

@php

    $data_page = [
        'title' => 'User Admin',
        'sub_title' => 'Buat User',
        'create_button' => [
            'is_enabled' => FALSE,
        ]
    ];
@endphp

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('cms.admin.store')}}" method="post" novalidate>
                @csrf
                <div class="mb-3">
                    <label class="form-label">Fullname</label>
                    <input type="text" name="fullname" class="form-control @error('fullname') is-invalid @enderror"
                           value="{{old('fullname')}}"
                           placeholder="Fullname..." required>
                    @error('fullname')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                           value="{{old('email')}}"
                           placeholder="Email..." required>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" name="password" id="password"
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="Masukkan password..."
                               autocomplete="off">
                        <span class="input-group-text">
                        <button type="button" class="link-secondary btn-show-password" id="button-show-password"
                                tabindex="-1"
                                title="Show password">
                            <i id="icon-show-password" class="fas fa-eye"></i>
                        </button>
                    </span>
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password Confirmation</label>
                    <div class="input-group">
                        <input type="password" name="password_confirmation"
                               class="form-control @error('password_confirmation') is-invalid @enderror"
                               placeholder="Masukkan password confirmation..." autocomplete="off">
                        <span class="input-group-text">
                        <button type="button" class="link-secondary btn-show-password" id="button-show-confirmation"
                                tabindex="-1"
                                title="Show password">
                            <i id="icon-show-password" class="fas fa-eye"></i>
                        </button>
                    </span>
                        @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select name="role" id="role" class="form-control @error('role') is-invalid @enderror"
                            required>
                        <option value="" disabled selected>--Pilih Role--</option>
                        @foreach ($roles as $role)
                            <option
                                value="{{$role->name}}" {{old('role') == $role->name ?  'selected' : ''}}>{{$role->name}}</option>
                        @endforeach

                    </select>
                    @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <x-active-status :status="old('is_active') ? true : false "/>
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{route('cms.admin.index')}}" class="btn btn-secondary">Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection
