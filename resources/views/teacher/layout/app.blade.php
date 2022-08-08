<!DOCTYPE html>
<html lang="{{ App::currentLocale() }}" dir="{{ App::isLocale('ar') ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>QUIZRUN-{{ $page_title }}</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    @if (App::isLocale('ar'))
        <link rel="stylesheet" href="{{ url('/assets/css/dataTables.bootstrap5.rtl.min.css') }}">
        <link rel="stylesheet" href="{{ url('/assets/css/adminlte.rtl.min.css') }}">
    @else
        <link rel="stylesheet" href="{{ url('/assets/css/dataTables.bootstrap5.min.css') }}">
        <link rel="stylesheet" href="{{ url('/assets/css/adminlte.min.css') }}">
    @endif
    <link rel="stylesheet" href="{{ url('/assets/css/app.css') }}">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/4.1.5/css/flag-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed {{ $theme }}">
    <div class="wrapper">
        <header>
            @include('teacher.layout.sidebar')
            @include('teacher.layout.navbar')
        </header>
        <main>
            @include($view_file, $controller_data)
        </main>
    </div>
    <script src="{{ url('/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('/assets/js/adminlte.min.js') }}"></script>
    <script src="{{ url('/assets/js/app.js') }}"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.16/moment-timezone-with-data.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $("#example").DataTable({
                language: {
                    lengthMenu: "{{ __('Showing') }} _MENU_ {{ __('entries') }}",
                    zeroRecords: "{{ __('Nothing found') }}",
                    info: "{{ __('Showing') }}  _PAGE_ {{ __('to') }} _TOTAL_ {{ __('of') }} _PAGES_ {{ __('entries') }}",
                    infoEmpty: "{{ __('No records available') }}",
                    emptyTable: "{{ __('No data available in table') }}",
                    infoFiltered: "{{__('filtered from _MAX_ total records')}}",
                    decimal: "",
                    infoPostFix: "",
                    thousands: ",",
                    loadingRecords: "{{ __('Loading') }}...",
                    processing: "{{ __('Processing') }}...",
                    search: "{{ __('Search') }}:",
                    paginate: {
                        first: "{{ __('First') }}",
                        last: "{{ __('Last') }}",
                        next: "{{ __('Next') }}",
                        previous: "{{ __('Previous') }}",
                    },
                    aria: {
                        sortAscending: "{{__(': activate to sort column ascending')}}",
                        sortDescending: "{{__(': activate to sort column descending')}}",
                    },
                },
                paging: true,
                lengthChange: true,
                searching: true,
                ordering: true,
                info: true,
                autoWidth: true,
                responsive: true,
                pagingType: "full_numbers",
                columnDefs: [{
                    searchable: false,
                    orderable: false,
                    targets: 0,
                }, ],
                order: [
                    [1, "asc"]
                ],
            });

            table
                .on("order.dt search.dt", function() {
                    table
                        .column(0, {
                            search: "applied",
                            order: "applied"
                        })
                        .nodes()
                        .each(function(cell, i) {
                            cell.innerHTML = i + 1;
                        });
                })
                .draw();
        });
    </script>
</body>

</html>
