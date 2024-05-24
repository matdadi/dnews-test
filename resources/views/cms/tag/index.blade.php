@extends('layouts.app')

@php
    $data_page = [
        'title' => 'Tag',
        'sub_title' => 'Tag',
        'create_button' => [
            'is_enabled' => auth()->user()->can('tag-create') ? TRUE : FALSE,
            'caption' => 'Create Tag',
            'redirect' => route('cms.tag.create')
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
                        <th>Tag Name</th>
                        <th>Slug</th>
                        <th>Active Status</th>
                        <th>Created By</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($tags as $tag)
                        <tr>
                            <td>{{$tag->tag_name}}</td>
                            <td>{{$tag->slug}}</td>
                            <td>{!! $tag->status_badge !!}</td>
                            <td>{{$tag->user_created?->fullname}}</td>
                            <td class="text-end">
                                @canany(['tag-update', 'tag-delete'])
                                    <div class="dropdown" id="myDropdown">
                                        <button class="btn btn-sm dropdown-toggle align-text-top"
                                                data-bs-toggle="dropdown">
                                            Actions
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            @can('tag-update')
                                                <a class="dropdown-item"
                                                   href="{{route('cms.tag.edit', $tag->id)}}">
                                                    Edit
                                                </a>
                                            @endcan
                                            @can('tag-update')
                                                <form action="{{ route('cms.tag.status-update', $tag->id) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button class="dropdown-item">
                                                        {{ $tag->is_active ? 'Deactivate' : 'Activate' }}
                                                    </button>
                                                </form>
                                            @endcan
                                            @can('tag-delete')
                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#modal-delete"
                                                        data-bs-action-url="{{route('cms.tag.destroy', $tag->id)}}">
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
        :title="'Tag'"
    />
@endsection
