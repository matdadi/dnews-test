@extends('layouts.app')

@php
    $data_page = [
        'title' => 'Post',
        'sub_title' => 'Create Post',
        'create_button' => [
            'is_enabled' => FALSE,
        ]
    ];
@endphp

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('cms.post.create') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                           value="{{ old('title') }}" placeholder="Title...">
                </div>
                <div class="mb-3">
                    <label class="form-label">Slug</label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug"
                           value="{{ old('slug') }}" placeholder="Slug...">
                </div>
                <div class="mb-3">
                    <label class="form-label">Meta</label>
                    <input type="text" class="form-control @error('meta') is-invalid @enderror" name="meta"
                           value="{{ old('meta') }}" placeholder="Meta...">
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                              placeholder="Description...">{{ old('description') }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Content</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" name="content"
                              placeholder="Content...">{{ old('content') }}</textarea>
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a class="btn btn-secondary"
                       href="{{ route('cms.category.index') }}">Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection
