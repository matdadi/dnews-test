@extends('layouts.app')

@php
    $data_page = [
        'title' => 'Subcategory',
        'sub_title' => 'Daftar Subcategory',
        'create_button' => [
            'is_enabled' => auth()->user()->can('subcategory-create') ? TRUE : FALSE,
            'caption' => 'Buat Subcategory',
            'redirect' => route('cms.subcategory.create')
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
                        <th>Category</th>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Sort</th>
                        <th>Active Status</th>
                        <th>Created By</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($subcategories as $subcategory)
                        <tr>
                            <td>{{$subcategory->category?->title}}</td>
                            <td>{{$subcategory->title}}</td>
                            <td>{{$subcategory->slug}}</td>
                            <td>{{$subcategory->sort}}</td>
                            <td>{!! $subcategory->status_badge !!}</td>
                            <td>{{$subcategory->user_created?->fullname}}</td>
                            <td class="text-end">
                                @canany(['subcategory-update', 'subcategory-delete'])
                                    <div class="dropdown" id="myDropdown">
                                        <button class="btn btn-sm dropdown-toggle align-text-top"
                                                data-bs-toggle="dropdown">
                                            Actions
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            @can('subcategory-update')
                                                <a class="dropdown-item"
                                                   href="{{route('cms.subcategory.edit', $subcategory->id)}}">
                                                    Edit
                                                </a>
                                            @endcan
                                            @can('subcategory-update')
                                                <form
                                                    action="{{ route('cms.subcategory.status-update', $subcategory->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button class="dropdown-item">
                                                        {{ $subcategory->is_active ? 'Deactivate' : 'Activate' }}
                                                    </button>
                                                </form>
                                            @endcan
                                            @can('subcategory-delete')
                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#modal-delete"
                                                        data-bs-action-url="{{route('cms.subcategory.destroy', $subcategory->id)}}">
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
        :title="'Subcategory'"
    />
@endsection
