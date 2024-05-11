@extends('components.layout')

@section('title', 'Подопечные студенты')

@section('custom styles')
<!-- Custom styles for this page -->
<link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="http://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Подопечные студенты</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table name="users_table" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ФИО</th>
                        <th>E-mail</th>
                        <th>Выполняемый план</th>
                        <th>Прогресс</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ФИО</th>
                        <th>E-mail</th>
                        <th>Выполняемый план</th>
                        <th>Прогресс</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->fullname() }}</td>
                            <td><a href="{{ route('profile', $user->id) }}">{{ $user->email }}</a></td>
                            @if($user->plan)
                            <td><a href="{{ route('viewPlan', $user->plan->id) }}">{{ $user->plan->title }}</a></td>
                            @else
                            <td><i>(Отсутствует)</i></td>
                            @endif
                            <td></td>
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