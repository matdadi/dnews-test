@extends('layouts.app')

@php
    $data_page = [
        'title' => 'Category',
        'sub_title' => 'Create Category',
        'create_button' => [
            'is_enabled' => FALSE,
        ]
    ];
@endphp

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('cms.category.store')}}" method="post" autocomplete="off">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                           value="{{old('title')}}"
                           placeholder="Title...">
                    @error('title')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Slug</label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug"
                           value="{{old('slug')}}"
                           placeholder="Slug...">
                    @error('slug')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Sort</label>
                    <input type="number" class="form-control @error('sort') is-invalid @enderror" name="sort"
                           value="{{old('sort')}}"
                           placeholder="Sort...">
                    @error('sort')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Icon</label>
                    <input type="text" class="form-control @error('icon') is-invalid @enderror" name="icon"
                           value="{{old('icon')}}"
                           placeholder="Icon...">
                    @error('icon')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <x-active-status :status="old('is_active') ? true : false"/>

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a class="btn btn-secondary"
                       href="{{ route('cms.category.index') }}">Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection
