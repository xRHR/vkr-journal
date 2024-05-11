@extends('components.layout')

@section('title', 'Редактирование профиля ' . $user->lastname . ' ' . $user->firstname)

@section('custom styles')

@endsection

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Редактирование профиля {{ $user->lastname }} {{ $user->firstname }}</h1>
</div>
<form id="edit_profile" name="edit_profile" action="{{ route('editProfile', $user->id) }}" method="POST">
    @csrf

    <button type="submit" class="btn btn-primary btn-user btn-block col-lg-2 mb-3">
        Сохранить
    </button>

    <!-- Collapsable Card Example -->
    <div class="card shadow mb-4">
        <!-- Card Header - Accordion -->
        <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"
            role="button" aria-expanded="true" aria-controls="collapseCardExample">
            <h6 class="m-0 font-weight-bold text-primary">ФИО</h6>
        </a>
        <!-- Card Content - Collapse -->
        <div class="collapse show" id="collapseCardExample">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4 mb-3 mb-sm-0">
                        <label>Фамилия:</label>
                        <input type="text" class="form-control" name="lastname" value="{{ $user->lastname }}">
                    </div>
                    <div class="col-sm-4 mb-3 mb-sm-0">
                        <label>Имя:</label>
                        <input type="text" class="form-control" name="firstname" value="{{ $user->firstname }}">
                    </div>
                    <div class="col-sm-4 mb-3 mb-sm-0">
                        <label>Отчество:</label>
                        <input type="text" class="form-control" name="patronymic" value="{{ $user->patronymic }}">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Collapsable Card Example -->
    <div class="card shadow mb-4">
        <!-- Card Header - Accordion -->
        <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"
            role="button" aria-expanded="true" aria-controls="collapseCardExample">
            <h6 class="m-0 font-weight-bold text-primary">ФИО в родительном падеже</h6>
        </a>
        <!-- Card Content - Collapse -->
        <div class="collapse show" id="collapseCardExample">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4 mb-3 mb-sm-0">
                        <label>Фамилия:</label>
                        <input type="text" class="form-control" name="lastname_genitive" value="{{ $user->miscInfo->lastname_genitive }}">
                    </div>
                    <div class="col-sm-4 mb-3 mb-sm-0">
                        <label>Имя:</label>
                        <input type="text" class="form-control" name="firstname_genitive" value="{{ $user->miscInfo->firtsname_genitive }}">
                    </div>
                    <div class="col-sm-4 mb-3 mb-sm-0">
                        <label>Отчество:</label>
                        <input type="text" class="form-control" name="patronymic_genitive" value="{{ $user->miscInfo->patronymic_genitive }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection

@section('custom scripts')

@endsection