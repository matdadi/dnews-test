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
                        <th>Description</th>
                        <th>Image</th>
                        <th>Meta</th>
                        <th>Post Text</th>
                        <th>Subcategory</th>
                        <th>Active</th>
                        <th>Published</th>
                        <th>Created By</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{$post->title}}</td>
                            <td>{{$post->slug}}</td>
                            <td>{{$post->description}}</td>
                            <td>
                                <a target="_blank"
                                   href="{{ route('image.show', $post->image?->id) }}">{{$post->image?->filename}}</a>
                            </td>
                            <td>{{$post->meta}}</td>
                            <td>{!! $post->post_text !!}</td>
                            <td>{{ $post->subcategory->title }}</td>
                            <td>{!! $post->status_badge !!}</td>
                            <td>{!! $post->publish_badge !!}</td>
                            <td>{{ $post->createdBy?->fullname }}</td>
                            <td class="text-end">
                                @canany(['post-update', 'post-delete'])
                                    <div class="dropdown" id="myDropdown">
                                        <button class="btn btn-sm dropdown-toggle align-text-top"
                                                data-bs-toggle="dropdown">
                                            Actions
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            @can('post-update')
                                                <a class="dropdown-item"
                                                   href="{{route('cms.post.edit', $post->id)}}">
                                                    Edit
                                                </a>
                                            @endcan
                                            @can('post-update')
                                                <form action="{{ route('cms.post.active', $post->id) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button class="dropdown-item">
                                                        {{ $post->is_active ? 'Deactivate' : 'Activate' }}
                                                    </button>
                                                </form>
                                            @endcan
                                            @can('post-delete')
                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#modal-delete"
                                                        data-bs-action-url="{{route('cms.post.destroy', $post->id)}}">
                                                    Delete
                                                </button>
                                            @endcan
                                        </div>
                                    </div>
                                @endcanany
                            </td>
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
