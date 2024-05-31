@extends('components.layout')

@section('title', 'Редактирование содержания плана работ ВКР')

@section('custom styles')
    <!-- Custom styles for this page -->
    <link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="http://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet">
    @vite(['resources/js/datepickr.js'])
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <meta name="csrf-token" content="{{ csrf_token() }}" />

@endsection

@section('content')

    <h1 class="h3 mb-2 text-gray-800">Редактирование содержания плана работ ВКР</h1>

    <livewire:plan-items-list :plan_id="$plan->id" />

@endsection

@section('custom scripts')
    <!-- Page level plugins -->
    <script src="/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="http://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <!-- Page level custom scripts -->
    <script src="/js/demo/datatables-demo.js"></script>

    <script>
        const table = new DataTable('#dataTable');

        function call_flatpickr(id) {
            flatpickr("#dt" + id, {
                dateFormat: "Y-m-d"
            });
        }
    </script>
@endsection
