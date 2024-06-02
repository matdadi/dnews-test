@extends('layouts.app')

@php
    $data_page = [
        'title' => 'Post',
        'sub_title' => 'Post List',
        'create_button' => [
            'is_enabled' => auth()->user()->can('post-create') ? TRUE : FALSE,
            'caption' => 'Create Post',
            'redirect' => route('cms.post.create')
        ]
    ];
@endphp

@section('content')

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="table-data">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Sort</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{$post->title}}</td>
                            <td>{{$post->slug}}</td>
                            <td>{{$category->sort}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <x-modal-delete
        :title="'Post'"
    />
@endsection
