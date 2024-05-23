@extends('layouts.app')

@php
    $data_page = [
        'title' => 'Roles',
        'sub_title' => 'Daftar Roles',
        'create_button' => [
            'is_enabled' => auth()->user()->can('role-create') ? TRUE : FALSE,
            'caption' => 'Buat Roles',
            'redirect' => route('cms.role.create')
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
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{$role->name}}</td>
                            <td class="text-end">
                                @canany(['role-update', 'role-delete'])
                                    <div class="dropdown" id="myDropdown">
                                        <button class="btn btn-sm dropdown-toggle align-text-top"
                                                data-bs-toggle="dropdown">
                                            Actions
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            @can('role-update')
                                                <a class="dropdown-item" href="{{route('cms.role.edit', $role->id)}}">
                                                    Edit
                                                </a>
                                            @endif

                                            @can('role-delete')
                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#modal-delete"
                                                        data-bs-action-url="{{route('cms.role.destroy', $role->id)}}">
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

    <x-modal-delete :title="'Role'"/>
@endsection
