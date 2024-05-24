@extends('layouts.app')

@php
    $data_page = [
        'title' => 'Tag',
        'sub_title' => 'Edit Tag',
        'create_button' => [
            'is_enabled' => FALSE,
        ]
    ];
@endphp

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('cms.tag.update', $tag->id)}}" method="post" autocomplete="off">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Tagname</label>
                    <input type="text" class="form-control @error('tag_name') is-invalid @enderror" name="tag_name"
                           value="{{old('tag_name', $tag->tag_name)}}"
                           placeholder="Tagname...">
                    @error('tag_name')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Slug</label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug"
                           value="{{old('slug', $tag->slug)}}"
                           placeholder="Slug...">
                    @error('slug')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                <x-active-status :status="old('is_active', $tag->is_active) ? true : false"/>

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a class="btn btn-secondary"
                       href="{{ route('cms.tag.index') }}">Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection
