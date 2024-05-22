@extends('layouts.app')

@php
    $data_page = [
        'title' => 'Permissions',
        'sub_title' => 'Daftar Permission',
        'create_button' => [
            'is_enabled' => auth()->user()->can('permission-create') ? TRUE : FALSE,
            'caption' => 'Buat Permission',
            'redirect' => route('permission.create')
        ]
    ];
@endphp

@section('content')

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="table-permissions">
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
                                                   href="{{route('permission.edit', $permission->id)}}">
                                                    Edit
                                                </a>
                                            @endcan
                                            @can('permission-delete')
                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#modal-delete"
                                                        data-bs-action-url="{{route('permission.destroy', $permission->id)}}">
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

    <div class="modal modal-blur fade" id="modal-delete" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-title">Delete Permission</div>
                    <div>Apakah anda yakin ingin menghapus data ini?</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">Kembali
                    </button>
                    <form method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Ya, Hapus data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="module">
        $('#table-permissions').DataTable({
            responsive: true,
            columnDefs: [{
                'targets': 2,
                'orderable': false
            }]
        });
    </script>
    <script>

        const modalDelete = document.getElementById('modal-delete');
        if (modalDelete) {
            modalDelete.addEventListener('show.bs.modal', event => {

                const button = event.relatedTarget;

                const actionUrl = button.getAttribute('data-bs-action-url');

                // Update the modal's content.
                const modalForm = modalDelete.querySelector('form')

                modalForm.action = actionUrl;
            });
        }

    </script>
@endsection
