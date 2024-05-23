<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"/>

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
    ])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css"
          integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }

        .btn-show-password {
            padding: 0;
            border: none;
            background: none;
        }

        @yield('css')
    </style>


</head>

<body class="font-sans antialiased">
<div class="page">
    <!-- Sidebar -->
    @include('layouts.sidebar')
    <div class="page-wrapper">
        <!-- Page header -->
        @include('layouts.header')

        @include('layouts.header-page')
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                @include('cms.partials.success_message')
                @include('cms.partials.error_message')
                @yield('content')
            </div>
        </div>
    </div>
</div>
</body>
@yield('js')
<script type="module">


    if (document.getElementById('table-data')) {
        $('#table-data').DataTable({
            responsive: true,
            order: [],
            columnDefs: [{
                'targets': -1,
                'orderable': false
            }]
        });
    }
</script>
<script>

    // make dropdown on the top of the page
    const myDropdown = document.getElementById('myDropdown');

    myDropdown.addEventListener('show.bs.dropdown', event => {
        $('.table-responsive').css("overflow", "inherit");
    })

    myDropdown.addEventListener('hide.bs.dropdown', event => {
        $('.table-responsive').css("overflow", "auto");
    })


    // modal delete action
    const modalDelete = document.getElementById('modal-delete');

    if (modalDelete) {
        modalDelete.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;

            const actionUrl = button.getAttribute('data-bs-action-url');

            const modalForm = modalDelete.querySelector('form')

            modalForm.action = actionUrl;
        });
    }

</script>
</html>
