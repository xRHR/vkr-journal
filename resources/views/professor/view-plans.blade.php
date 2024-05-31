@extends('components.layout')

@section('title', 'Список планов')

@section('custom styles')
<!-- Custom styles for this page -->
<link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="http://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Список планов работ {{ $user->fullnameShort() }}</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table name="plans_table" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Создан</th>
                        <th>Название</th>
                        <th>Описание</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Создан</th>
                        <th>Название</th>
                        <th>Описание</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($plans as $plan)
                        <tr>
                            <td>{{ date('d.m.Y', strtotime($plan->created_at)) }}</td>
                            <td><a href="{{ route('viewPlan', $plan->id) }}">{{ $plan->title }}</a></td>
                            <td>{{ $plan->descriptionShort() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@section('custom scripts')
    <!-- Page level plugins -->
    <script src="/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="http://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="/js/demo/datatables-demo.js"></script>
@endsection