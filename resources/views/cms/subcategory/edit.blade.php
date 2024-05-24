@extends('layouts.app')

@php
    $data_page = [
        'title' => 'Subcategory',
        'sub_title' => 'Edit Subcategory',
        'create_button' => [
            'is_enabled' => FALSE,
        ]
    ];
@endphp

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('cms.subcategory.update', $subcategory->id)}}" method="post" autocomplete="off">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select class="form-select @error('category_id') is-invalid @enderror" name="category_id">
                        <option value="" disabled selected>Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}"
                                    @if(old('category_id', $subcategory->category_id) == $category->id) selected @endif>{{$category->title}}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                           value="{{old('title', $subcategory->title)}}"
                           placeholder="Title...">
                    @error('title')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Slug</label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug"
                           value="{{old('slug', $subcategory->slug)}}"
                           placeholder="Slug...">
                    @error('slug')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Sort</label>
                    <input type="number" class="form-control @error('sort') is-invalid @enderror" name="sort"
                           value="{{old('sort', $subcategory->sort)}}"
                           placeholder="Sort...">
                    @error('sort')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Icon</label>
                    <input type="text" class="form-control @error('icon') is-invalid @enderror" name="icon"
                           value="{{old('icon', $subcategory->icon)}}"
                           placeholder="Icon...">
                    @error('icon')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                <x-active-status :status="old('is_active', $subcategory->is_active) ? true : false"/>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a class="btn btn-secondary"
                       href="{{ route('cms.category.index') }}">Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection
