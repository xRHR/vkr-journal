@extends('components.layout')

@section('title', 'Изменение плана работ')

@section('custom styles')

@endsection

@section('content')

<h1 class="h3 mb-2 text-gray-800">Изменение плана работ ВКР</h1>

<form id="edit_plan" name="edit_plan" action="{{ route('editPlan', $plan->id) }}" method="POST">
    @csrf
    <div class="col-lg-7">
        <div class="form-group col">
            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">План работ ВКР</h6>
                </div>
                <div class="card-body">
                    <label class="mt-3">Название плана</label>
                    <input name="title" required class="form-control form-control-user" id="inputTitle"  placeholder="Введите название плана..." value="{{ $plan->title }}">
                    <label class="mt-3">Описание плана</label>
                    <textarea name="description" required class="form-control form-control-user" id="inputDescription">{{ $plan->description }}</textarea>

                    <button type="submit" class="btn btn-primary btn-icon-split mt-3">
                        <span class="icon text-white-50">
                            <i class="fas fa-solid fa-floppy-disk"></i>
                        </span>
                        <span class="text">Сохранить</span>
                    </button>      

                </div>
            </div>
        </div>
    </div>
</form>

@endsection

@section('custom scripts')

@endsection