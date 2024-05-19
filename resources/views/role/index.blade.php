
@extends('layouts.app')

@php
$data_page = [
    'title' => 'Roles',
    'sub_title' => 'Daftar Roles',
    'create_button' => [
        'is_enabled' => auth()->user()->can('role-read') ? TRUE : FALSE,
        'caption' => 'Buat Roles',
        'redirect' => route('role.create')
    ]
];
@endphp

@section('content')
@if ($message = Session::get('success'))
  <div class="alert alert-success" role="alert">
    <div class="d-flex justify-content-between">
      <div class="d-flex">
        <div>
          <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
        </div>
        <div>
          <h4 class="alert-title">Success!</h4>
          <div class="text-secondary">{{$message}}</div>
        </div>
      </div>
      <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
    </div>
  </div>
@endif

    <div class="card" style="overflow: visible !important;">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="table-roles">
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
                                <div class="dropdown" style="z-index:9999 !important;" id="myDropdown">
                                    <button class="btn btn-sm dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                                      Actions
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                      @can('role-update')
                                      <a class="dropdown-item" href="{{route('role.edit', $role->id)}}">
                                        Edit
                                      </a>
                                      @endif

                                      @can('role-delete')
                                      <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal-delete" data-bs-action-url="{{route('role.destroy', $role->id)}}">
                                        Delete
                                      </button>
                                      @endcan
                                    </div>
                                  </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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
          <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">Kembali</button>
          <form method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Ya, Hapus data</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script type="module">
    $('#table-roles').DataTable({
        responsive: true,
        columnDefs: [{
            'targets' : 1,
            'orderable':false
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
