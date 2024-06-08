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
            <form action="{{ route('cms.post.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-8 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label">Subcategory</label>
                            <select class="form-select @error('subcategory_id') is-invalid @enderror"
                                    name="subcategory_id">
                                <option value="">Select Subcategory</option>
                                @foreach($subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}"
                                        {{ old('subcategory_id') == $subcategory->id ? 'selected' : '' }}>
                                        {{ $subcategory->title }} - {{ $subcategory->category->title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('subcategory_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                                   id="title"
                                   value="{{ old('title') }}" placeholder="Title...">
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Slug</label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug"
                                   id="slug"
                                   value="{{ old('slug') }}" placeholder="Slug...">
                            @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Meta</label>
                            <input type="text" class="form-control @error('meta') is-invalid @enderror" name="meta"
                                   value="{{ old('meta') }}" placeholder="Meta...">
                            @error('meta')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                                      placeholder="Description...">{{ old('description') }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Post Text</label>
                            <textarea class="form-control @error('post_text') is-invalid @enderror" name="post_text"
                                      id="post_text"
                                      placeholder="Post Text...">{{ old('post_text') }}</textarea>
                            @error('post_text')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <x-active-status :status="old('is_active', true) ? true : false"/>
                        <div class="mb-3">
                            <label class="form-check form-switch">
                                <input type="hidden" name="is_published" value="0">
                                <input class="form-check-input" name="is_published" value="1"
                                       type="checkbox" {{ old('is_published', true) ? true : false }}>
                                <span class="form-check-label">Published Status</span>
                            </label>
                        </div>

                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label">Post Image</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image"
                                   accept="image/*">
                            @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class=" form-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a class="btn btn-secondary"
                           href="{{ route('cms.category.index') }}">Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{URL::to('vendor/ckeditor/build/ckeditor.js')}}"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#post_text'), {
                styles: [
                    'fullPage',
                    'sideBySide',
                    'content',
                ],
                cssPath: '{{ URL::to('vendor/ckeditor/build/contents.css') }}',
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    <script type="module">
        $(document).ready(function () {
            $('#title').on('input', function () {
                let title = $(this).val();
                let slug = title.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
                $('#slug').val(slug);
            });
        });
    </script>
@endsection
