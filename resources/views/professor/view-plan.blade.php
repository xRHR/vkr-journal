@extends('components.layout')

@section('title', $plan->title)

@section('custom styles')
    <!-- Custom styles for this page -->
    <link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="http://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $plan->title }}</h1>
    </div>

    <!-- Row of cards -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Владелец</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><a
                                    href="{{ route('profile', $plan->owner->id) }}">{{ $plan->owner->fullname() }}</a></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-solid fa-user-tie fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Collapsable Card Example -->
    <div class="card shadow mb-4">
        <!-- Card Header - Accordion -->
        <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button"
            aria-expanded="true" aria-controls="collapseCardExample">
            <h6 class="m-0 font-weight-bold text-primary">Описание</h6>
        </a>
        <!-- Card Content - Collapse -->
        <div class="collapse show" id="collapseCardExample">
            <div class="card-body">
                {{ $plan->description }}
            </div>
        </div>
    </div>

    <div class="row">
        @if ($plan->owner_id != auth()->user()->id)
            <div class="m-2">
                <div class="form-group">
                    <a href="#" id="save_plan" type="button" class="btn btn-primary btn-icon-split mt-3">
                        <span class="icon text-white-50">
                            <i class="fa-solid fa-floppy-disk"></i>
                        </span>
                        <span class="text">Добавить план к себе</span>
                    </a>
                </div>
            </div>
        @endif

        @can('update', $plan)
            <div class="m-2">
                <div class="form-group">
                    <a href="{{ route('editPlanForm', $plan->id) }}" id="edit_plan" type="button"
                        class="btn btn-primary btn-icon-split mt-3">
                        <span class="icon text-white-50">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </span>
                        <span class="text">Изменить название/описание</span>
                    </a>
                </div>
            </div>

            <div class="m-2">
                <div class="form-group">
                    <a href="{{ route('editPlanItemsForm', $plan->id) }}" id="edit_plan" type="button"
                        class="btn btn-primary btn-icon-split mt-3">
                        <span class="icon text-white-50">
                            <i class="fa-solid fa-list-check"></i>
                        </span>
                        <span class="text">Изменить содержание плана</span>
                    </a>
                </div>
            </div>
        @endcan
    </div>
    <!-- Plan table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $plan->title }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table name="plan_items_table" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Дедлайн</th>
                            <th>Название</th>
                            <th>Описание</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Дедлайн</th>
                            <th>Название</th>
                            <th>Описание</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($plan->items as $item)
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

@endsection

@section('custom scripts')
    <!-- Page level plugins -->
    <script src="/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="http://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="/js/demo/datatables-demo.js"></script>
@endsection
