@extends('components.layout')

@section('title', 'Редактирование содержания плана работ ВКР')

@section('custom styles')
<!-- Custom styles for this page -->
<link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="http://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet">
@vite(['resources/js/datepickr.js'])
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<meta name="csrf-token" content="{{ csrf_token() }}" />

@endsection

@section('content')

<h1 class="h3 mb-2 text-gray-800">Редактирование содержания плана работ ВКР</h1>

<form id="edit_plan_items" name="edit_plan_items" action="{{ route('editPlanItems', $plan->id) }}" method="POST">
    @csrf
    <div class="">
        <div class="form-group col">
            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Пункты плана</h6>
                </div>
                <div class="card-body">
                    <label class="mt-3">Название пункта</label>
                    <input name="itemTitle" required class="form-control form-control-user" id="inputItemTitle"  placeholder="Введите название пункта...">
                    <label class="mt-3">Описание</label>
                    <textarea name="itemDescription" required class="form-control form-control-user" id="inputItemDescription"></textarea>
                    <label class="mt-3">Дедлайн</label>
                    <input id="datetime" name="deadline" type="datetime" required class="form-control form-control-user" id="inputDescription">

                    <div class="form-group flex-wrap">
                        <div class="row">
                            <div class="m-1">
                                <div class="form-group">
                                    <button id="add_item" type="button" class="btn btn-primary btn-icon-split mt-3">
                                        <span class="icon text-white-50">
                                            <i class="fa-solid fa-circle-plus"></i>
                                        </span>
                                        <span class="text">Добавить</span>
                                    </button>   
                                </div>
                            </div>
                            <div class="m-1">
                                <div class="form-group">
                                    <button id="remove_item" type="button" class="btn btn-primary btn-icon-split mt-3">
                                        <span class="icon text-white-50">
                                            <i class="fa-solid fa-circle-minus"></i>
                                        </span>
                                        <span class="text">Удалить</span>
                                    </button>   
                                </div>
                            </div>
                            <div class="m-1">
                                <div class="form-group">
                                    <button id="save" type="button" class="btn btn-primary btn-icon-split mt-3">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-solid fa-floppy-disk"></i>
                                        </span>
                                        <span class="text">Сохранить</span>
                                    </button>   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Содержание плана</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table name="plan_table" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Дедлайн</th>
                                    <th>Название пункта</th>
                                    <th>Описание</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Дедлайн</th>
                                    <th>Название пункта</th>
                                    <th>Описание</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($plan_items as $item)
                                    <tr>
                                        <td>{{ $item->deadline }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->description }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
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
tableData = [
    @foreach ($plan_items as $item)
        {
            "deadline" : "{{ $item->deadline }}",
            "title" : "{{ $item->title }}",
            "description" : "{{ $item->description }}"
        },
    @endforeach
];
function add_item() {
    var title = document.edit_plan_items.itemTitle.value;
    var description = document.edit_plan_items.itemDescription.value;
    var deadline = document.edit_plan_items.deadline.value;
    tableData.push({
        "deadline" : deadline,
        "title" : title,
        "description" : description
    })
    table.row.add([
        deadline,
        title,
        description
    ]).draw(false);
    console.log(tableData)
}
function remove_item() {
    const selectedRow = table.row('.selected').index();
    if (selectedRow !== undefined && selectedRow !== null && selectedRow > -1) {
        tableData.splice(selectedRow, 1);
        table.row('.selected').remove().draw(false);
    }
}
const table = new DataTable('#dataTable');

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

document.querySelector('#add_item').addEventListener('click', add_item)
document.querySelector('#remove_item').addEventListener('click', remove_item);
document.querySelector('#save').addEventListener('click', () => {
    console.log(tableData);
    if (tableData.length != 0) {
        $.ajax("{{ route('editPlanItems', $plan->id) }}", {
            method: "POST",
            data: {
                array: JSON.stringify(tableData)
            },
            _token: $('meta[name="csrf-token"]').attr('content'),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: (data) => {
                window.location.href = "{{ route('viewPlan', $plan->id) }}";
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