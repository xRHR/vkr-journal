@extends('components.layout')

@section('title', 'Заявление на выбор темы ВКР')

@section('custom styles')

@endsection

@section('content')

    <div class="col-12">
        <!-- Collapsable Card Example -->
        <div class="card shadow">
            <!-- Card Header - Accordion -->
            <a href="#fields" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true"
                aria-controls="fields">
                <h6 class="m-0 font-weight-bold text-primary">Поля документа</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="fields">
                <div class="card-body">

                    <label class="mb-3">ФИО студента (в род. падеже): {{ $thesis->student->fullnameGenitive() }}</label><br>

                    <label class="mb-3">Группа: {{ $thesis->student->group->title }}</label><br>

                    <label class="mb-3">ФИО руководителя: {{ $thesis->professor->fullname() }}</label><br>

                    <label class="mb-3">Тема ВКР: {{ $thesis->title }}</label><br>

                    <label class="mb-3">Факультет/Институт: {{ $thesis->student->faculty->title }}</label><br>

                    <label class="mb-3">Кафедра: {{ $thesis->student->department->title }}</label><br>

                    <label>Дата</label>
                    <form action="{{ route('ThesisReview', $thesis) }}" method="POST">
                        @csrf
                        @php
                            $document_id = \App\Models\Document::where('title', 'Отзыв научного руководителя')->first()->id;
                            if ($document_id) {
                                $date = $thesis->documents()->where('document_id', $document_id)->first()->due_date;
                            } else {
                                $date = now();
                            }
                        @endphp
                        <input type="date" name="date" class="form-control mb-3" value="{{ $date }}">
                        @error('date')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <button type="submit" class="btn btn-primary btn-icon-split m-2">
                            <span class="icon text-white-50">
                                <i class="fa-solid fa-thumbtack"></i>
                            </span>
                            <span class="text">Сгенерировать</span>
                        </button>
                        <br>

                        <textarea name="review_body" class="form-control" placeholder="Введите отзыв..."></textarea>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('custom scripts')

@endsection
