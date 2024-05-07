@extends('components.layout')

@section('title', 'Регистрация пользователей')

@section('custom styles')
<!-- Custom styles for this page -->
<link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="http://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet">

<meta name="csrf-token" content="{{ csrf_token() }}" />

@endsection

@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Регистрация пользователей</h1>
<p class="mb-4">Введите e-mail пользователя и выберите роль, затем нажмите "Добавить". Новый пользователь появится в таблице ниже. Чтобы убрать пользователя из таблицы, выберите строку и нажмите "Удалить". После того как вы добавили пользователей нажмите "Регистрация". Введенные пользователи будут зарегистрированы и на e-mail будут отправлены данные для входа.</p>
{{-- action="/admin/register" method="POST" --}}
<form id="user_registration" name="user_registration" action="/register" method="POST">
    @csrf
    <div class="col-lg-7">
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <input name="email" type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
            </div>
            <div class="col-sm-6 mb-3 mb-sm-0">
                <select name="status">
                    @foreach($statuses as $status)
                    <option value="{{ $status->id }}">{{ $status->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-3">
                <div class="form-group">
                    <input id="add_new_user" type="button" class="btn btn-primary btn-user btn-block" value="Добавить">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <input id="remove_selected_user" type="button" class="btn btn-primary btn-user btn-block" value="Удалить">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <button id="save" type="button" class="btn btn-primary btn-user btn-block">
                        Регистрация
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Новые пользователи</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table name="new_users_table" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>E-mail</th>
                            <th>Статус</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>E-mail</th>
                            <th>Статус</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</form>
@endsection

@section('custom scripts')
<!-- Page level plugins -->
<script src="/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="http://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

<script>
function add_user() {
    var email = document.user_registration.email.value;
    var status = document.user_registration.status.value;
    tableData.push({
        "email" : email,
        "status" : status
    })
    table.row.add([
        counter++,
        email,
        statusesDict[status]
    ]).draw(false);
}
function remove_user() {
    const selectedRow = table.row('.selected').index();
    if (selectedRow !== undefined && selectedRow !== null && selectedRow > -1) {
        tableData.splice(selectedRow, 1);
        table.row('.selected').remove().draw(false);
    }
}
const table = new DataTable('#dataTable');
let counter = 1;

statuses = {!! json_encode($statuses) !!};
statusesDict = {};
statuses.forEach((status) => {
    statusesDict[status.id] = status.title
});

tableData = [];

table.on('click', 'tbody tr', (e) => {
    let classList = e.currentTarget.classList;

    if (classList.contains('selected')) {
        classList.remove('selected');
    }
    else {
        table.rows('.selected').nodes().each((row) => row.classList.remove('selected'));
        classList.add('selected');
    }
});

document.querySelector('#add_new_user').addEventListener('click', add_user)
document.querySelector('#remove_selected_user').addEventListener('click', remove_user);
var ddd = document.querySelector('#user_registration');
document.querySelector('#save').addEventListener('click', () => {
    if (tableData.length != 0) {
        $.ajax("/register", {
            method: "POST",
            data: {
                array: JSON.stringify(tableData)
            },
            _token: $('meta[name="csrf-token"]').attr('content'),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: (data) => {
                var count = tableData.length;
                var message = "";
                if (count == 1) {
                    message = "Пользователь успешно зарегистрирован";
                } else {
                    message = "Пользователи успешно зарегистрированы";
                }
                showAlert('success', 'Успех', message, 'fa-circle-check')
            },
            error: (data) => {
                showAlert('danger', 'Ошибка', data.responseJSON.message, 'fa-circle-xmark')
            }
        });
    }
})
</script>
<!-- Page level custom scripts -->
<script src="/js/demo/datatables-demo.js"></script>
@endsection