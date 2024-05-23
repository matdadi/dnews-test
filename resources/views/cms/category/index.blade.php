@extends('layouts.app')

@php
    $data_page = [
        'title' => 'Category',
        'sub_title' => 'Daftar Category',
        'create_button' => [
            'is_enabled' => auth()->user()->can('category-create') ? TRUE : FALSE,
            'caption' => 'Buat Category',
            'redirect' => route('cms.category.create')
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
                        <th>Active Status</th>
                        <th>Created By</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{$category->title}}</td>
                            <td>{{$category->slug}}</td>
                            <td>{{$category->sort}}</td>
                            <td>{!! $category->status_badge !!}</td>
                            <td>{{$category->user_created?->fullname}}</td>
                            <td class="text-end">
                                @canany(['category-update', 'category-delete'])
                                    <div class="dropdown" id="myDropdown">
                                        <button class="btn btn-sm dropdown-toggle align-text-top"
                                                data-bs-toggle="dropdown">
                                            Actions
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            @can('category-update')
                                                <a class="dropdown-item"
                                                   href="{{route('cms.category.edit', $category->id)}}">
                                                    Edit
                                                </a>
                                            @endcan
                                            @can('category-delete')
                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#modal-delete"
                                                        data-bs-action-url="{{route('cms.category.destroy', $category->id)}}">
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
        :title="'Category'"
    />
@endsection
