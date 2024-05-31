@extends('components.layout')

@section('title', 'ВКР ' . $user->fullnameShort())

@section('custom styles')
    <!-- Custom styles for this page -->
    <link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="http://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet">

@endsection

@section('content')

    <h1 class="h3 mb-2 text-gray-800">Выпускные квалификационные работы {{ $user->fullnameShort() }}</h1>

    @if (auth()->user()->id == $user->id)
        <button class="btn btn-primary btn-icon-split mb-3 mr-3"
            onclick="Livewire.dispatch('openModal', { component: 'create-thesis-modal', arguments: {user_id: {{ $user->id }}}})">
            <span class="icon text-white-50">
                <i class="fa-solid fa-plus"></i>
            </span>
            <span class="text">Новая ВКР</span>
        </button>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Список ВКР</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table name="users_table" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Название</th>
                            <th>Руководитель</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Название</th>
                            <th>Руководитель</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($user->theses as $thesis)
                            <tr>
                                <td><a href="{{ route('viewThesis', ['thesis' => $thesis]) }}">{{ $thesis->title }}</a></td>
                                <td><a href="{{ route('profile', $thesis->professor_id) }}">{{ $thesis->professor->fullnameShort() }}</a>
                                </td>
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
