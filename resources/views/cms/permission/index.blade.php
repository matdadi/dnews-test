@extends('layouts.app')

@php
    $data_page = [
        'title' => 'Permissions',
        'sub_title' => 'Daftar Permission',
        'create_button' => [
            'is_enabled' => auth()->user()->can('permission-create') ? TRUE : FALSE,
            'caption' => 'Buat Permission',
            'redirect' => route('cms.permission.create')
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
                        <th>Name</th>
                        <th>Guard Name</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($permissions as $permission)
                        <tr>
                            <td>{{$permission->name}}</td>
                            <td>{{$permission->guard_name}}</td>
                            <td class="text-end">
                                @canany(['permission-update', 'permission-delete'])
                                    <div class="dropdown" id="myDropdown">
                                        <button class="btn btn-sm dropdown-toggle align-text-top"
                                                data-bs-toggle="dropdown">
                                            Actions
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            @can('permission-update')
                                                <a class="dropdown-item"
                                                   href="{{route('cms.permission.edit', $permission->id)}}">
                                                    Edit
                                                </a>
                                            @endcan
                                            @can('permission-delete')
                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#modal-delete"
                                                        data-bs-action-url="{{route('cms.permission.destroy', $permission->id)}}">
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
        :title="'Permissions'"
    />
@endsection

@section('js')

@endsection
