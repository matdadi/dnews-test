@extends('layouts.app')

@php
    $data_page = [
        'title' => 'Permissions',
        'sub_title' => 'Create Permission',
        'create_button' => [
            'is_enabled' => FALSE,
        ]
    ];
@endphp

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('cms.permission.store')}}" method="post" autocomplete="off">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Permissions</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                           placeholder="Masukkan permission...">
                    @error('name')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a class="btn btn-secondary"
                       href="{{ route('cms.permission.index') }}">Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection
