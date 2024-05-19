@extends('components.layout')

@section('title', 'Подопечные студенты')

@section('custom styles')
<!-- Custom styles for this page -->
<link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="http://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet">

<meta name="csrf-token" content="{{ csrf_token() }}" />

@endsection

@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Подопечные дипломники</h1>
<p class="mb-4">В таблице представлен список ваших подопечных студентов и выполняемый ими план. Если дипломнику ещё не назначен план, здесь вы можете его назначить. Для этого выберите один из ваших планов в выпадающем меню, выберите одного или несколько дипломников из таблицы и нажмите на кнопку "Назначить". Если у вас пока нет планов, вы можете создать новый или скопировать существующий у других научных руководителей.</p>
<div class="col-lg-7">
    <div class="form-group row">
        <button id="appoint" class="btn btn-secondary btn-icon-split mb-3 mr-3">
            <span class="icon text-white-50">
                <i class="fa-solid fa-person-chalkboard"></i>
            </span>
            <span class="text">Назначить</span>
        </button>
        <div class="mb-3">
            <label>План:</label>
            <select name="plan" class="form-select form-select-lg">
                @foreach($plans as $plan)
                <option value="{{ $plan->id }}">{{ $plan->title }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Подопечные дипломники</h6>
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
                        <th style="display:none;"></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ФИО</th>
                        <th>E-mail</th>
                        <th>Выполняемый план</th>
                        <th>Прогресс</th>
                        <th style="display:none;"></th>
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
                            <td style="display:none;">{{ $user->id }}</td>
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

<script>

function updateButtonColor() {
    const selectedRow = table.row('.selected').index();
    if (selectedRow !== undefined && selectedRow !== null && selectedRow > -1) {
        document.getElementById('appoint').classList.remove('btn-secondary');
        document.getElementById('appoint').classList.add('btn-primary');
    } else {
        document.getElementById('appoint').classList.remove('btn-primary');
        document.getElementById('appoint').classList.add('btn-secondary');
    }
}
const table = new DataTable('#dataTable');
user_ids = [];

table.on('click', 'tbody tr', (e) => {
    let classList = e.currentTarget.classList;
    console.log(e.currentTarget.children[4].innerHTML);

    if (classList.contains('selected')) {
        user_ids.splice(user_ids.indexOf(e.currentTarget.children[4].innerHTML), 1);
        classList.remove('selected');
    } else {
        user_ids.push(e.currentTarget.children[4].innerHTML);
        classList.add('selected');
    }

    updateButtonColor();
});

function appointPlan() {
    const selectedRows = table.rows('.selected').data();
    const ids = Object.values(selectedRows.map((row) => row[4]));
    const selectedPlan = document.querySelector('select[name="plan"]').value;
    console.log(ids);
    if (ids.length > 0) {
        $.ajax("{{ route('index') }}" + "/professor/students/appoint-plan/" + selectedPlan, {
            method: "POST",
            data: {
                array: JSON.stringify(user_ids)
            },
            _token: $('meta[name="csrf-token"]').attr('content'),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: (data) => {
                location.reload();
            },
            error: (data) => {
                showAlert('danger', 'Ошибка', data.responseJSON.message, 'fa-circle-xmark')
            }
        });
    }
}
document.querySelector('#appoint').addEventListener('click', appointPlan);
</script>
@endsection