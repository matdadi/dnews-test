@extends('layouts.app')

@php
    $data_page = [
        'title' => 'Post View',
        'sub_title' => 'Post View Index',
        'create_button' => [
            'is_enabled' => FALSE
        ]
    ];
@endphp

@section('content')
    <div class="card">
        <div class="table-responsive">
            <table class="table table-vcenter card-table">
                <thead>
                <tr>
                    <th>Post Title</th>
                    <th>Viewed At</th>
                    <th>Viewed By</th>
                </tr>
                </thead>
                <tbody>
                @foreach($views as $view)
                    <tr>
                        <td>{{ $view->post->title }}</td>
                        <td class="text-secondary">{{ $view->viewed_at }}</td>
                        <td>{{ $view->user->name }}</td>
                    </tr>
                @endforeach
                @if($views->isEmpty())
                    <tr>
                        <td colspan="3" class="text-center text-secondary">No data available</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>

@endsection
