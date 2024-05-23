@extends('layouts.app')

@php
    $data_page = [
        'title' => 'User Admin',
        'sub_title' => 'Daftar User',
        'create_button' => [
            'is_enabled' => auth()->user()->can('admin-create') ? TRUE : FALSE,
            'caption' => 'Buat User',
            'redirect' => route('cms.admin.create')
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
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Is Active</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->fullname }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @foreach($user->getRoleNames() as $roleName)
                                    <span class="badge bg-blue text-blue-fg">{{ $roleName }}</span>
                                @endforeach
                            </td>
                            <td>{!! $user->status_badge !!}</td>
                            <td class="text-end">
                                @canany(['admin-update', 'admin-delete'])
                                    <div class="dropdown" id="myDropdown">
                                        <button class="btn btn-sm dropdown-toggle align-text-top"
                                                data-bs-toggle="dropdown">
                                            Actions
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            @can('admin-update')
                                                <a class="dropdown-item"
                                                   href="{{ route('cms.admin.edit', $user->id) }}">
                                                    Edit
                                                </a>
                                            @endcan

                                            @can('admin-update')
                                                <form action="{{ route('cms.admin.status-update', $user->id) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button class="dropdown-item">
                                                        {{ $user->is_active ? 'Deactivate' : 'Activate' }}
                                                    </button>
                                                </form>
                                            @endcan

                                            @can('admin-delete')
                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#modal-delete"
                                                        data-bs-action-url="{{ route('cms.admin.destroy', $user->id) }}">
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

    <x-modal-delete :title="'Admin User'"/>
@endsection
