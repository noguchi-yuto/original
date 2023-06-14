<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>BooksList</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://cdn.jsdelivr.net/npm/daisyui@2.24.0/dist/full.css" rel="stylesheet" type="text/css" />
        <script src="https://cdn.tailwindcss.com"></script>
        <!-- Datatable css -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css"/>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css"/>
    </head>

    <body>
    <!-- dataTables -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
        {{-- ナビゲーションバー --}}
        @include('commons.navbar')

        <div class="container mx-auto">
            {{-- エラーメッセージ --}}
            @include('commons.error_messages')

            @yield('content')
        </div>

    </body>
</html>