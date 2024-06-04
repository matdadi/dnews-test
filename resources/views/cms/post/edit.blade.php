@extends('layouts.app')

@php
    $data_page = [
        'title' => 'Post',
        'sub_title' => 'Edit Post',
        'create_button' => [
            'is_enabled' => FALSE,
        ]
    ];
@endphp

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('cms.post.update', $post->id)}}" method="post" enctype="multipart/form-data"
                  autocomplete="off">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="form-label">Subcategory</label>
                            <select class="form-control @error('subcategory_id') is-invalid @enderror"
                                    name="subcategory_id">
                                <option value="">--Pilih Subcategory--</option>
                                @foreach($subcategories as $subcategory)
                                    <option
                                        value="{{ $subcategory->id }}" {{ old('subcategory_id', $subcategory->id) == $post->subcategory_id ? 'selected' : '' }}>{{ $subcategory->title }}
                                        - {{$subcategory->category->title}}</option>
                                @endforeach
                            </select>
                            @error('subcategory_id')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                                   value="{{old('title', $post->title)}}"
                                   placeholder="Title...">
                            @error('title')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Slug</label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug"
                                   value="{{old('slug', $post->slug)}}"
                                   placeholder="Slug...">
                            @error('slug')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Meta</label>
                            <input type="text" class="form-control @error('meta') is-invalid @enderror" name="meta"
                                   value="{{ old('meta', $post->meta) }}" placeholder="Meta...">
                            @error('meta')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                                      placeholder="Description...">{{ old('description', $post->description) }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Post Text</label>
                            <textarea class="form-control @error('post_text') is-invalid @enderror" name="post_text"
                                      placeholder="Post Text...">{{ old('post_text', $post->post_text) }}</textarea>
                            @error('post_text')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <x-active-status :status="old('is_active', $post->is_active) ? true : false"/>

                        <div class="mb-3">
                            <label class="form-check form-switch">
                                <input type="hidden" name="is_published" value="0">
                                <input class="form-check-input" name="is_published" value="1"
                                       type="checkbox" {{ old('is_published', $post->is_published) ? 'checked' : '' }}>
                                <span class="form-check-label">Published Status</span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Current Image</label>
                            <img src="{{ $post->image?->content }}" alt="{{$post->title}}"
                                 class="img-fluid">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Post Image</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image"
                                   accept="image/*">
                            @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>


                <div class="form-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a class="btn btn-secondary"
                       href="{{ route('cms.post.index') }}">Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection
