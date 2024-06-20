@extends('components.layout')

@section('title', $thesis->title)

@section('custom styles')

@endsection

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $thesis->title }}
        </h1>
    </div>
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Автор работы</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <a href="{{ route('profile', $thesis->student->id) }}">
                                    {{ $thesis->student->fullnameShort() }}
                                </a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-solid fa-user-graduate fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Научный руководитель</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <a href="{{ route('profile', $thesis->professor->id) }}">
                                    {{ $thesis->professor->fullnameShort() }}
                                </a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-solid fa-user-tie fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="ml-2 col-12">
            @if (auth()->user()->id == $thesis->student->id)
                <button class="btn btn-primary btn-icon-split mb-3 mr-3"
                    onclick="Livewire.dispatch('openModal', { component: 'create-thesis-modal', arguments: {user_id: {{ $thesis->student->id }}, thesis_id: {{ $thesis->id }}}})">
                    <span class="icon text-white-50">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </span>
                    <span class="text">Редактировать</span>
                </button>
            @endif
            <div class="dropdown mb-4 col">
                <button class="btn btn-primary dropdown-toggle" type="button" id="documentsDropdown" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Документы
                </button>
                <div class="dropdown-menu animated--fade-in" aria-labelledby="documentsDropdown">
                    <a class="dropdown-item" href="{{ route('viewThesisRequest', $thesis) }}">Заявление об утверждении темы
                        ВКР и назначении научного руководителя</a>
                        <a class="dropdown-item" href="{{ route('viewThesisReview', $thesis) }}">Отзыв научного руководителя</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#thesisDescription" class="d-block card-header py-3" data-toggle="collapse" role="button"
                aria-expanded="true" aria-controls="thesisDescription">
                <h6 class="m-0 font-weight-bold text-primary">Описание</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="thesisDescription">
                <div class="card-body">
                    {{-- большой текст --}}
                    <div class="mb-3">
                        <b>Дата защиты: </b>{{ date('d.m.Y', strtotime($thesis->defense_date)) }}
                    </div>
                    @if ($thesis->description == '')
                        <i>Описание отсутствует</i>
                    @else
                        @php
                            $prepared_description = explode("\n", $thesis->description);
                            $description_string = '';

                            foreach ($prepared_description as $key => $value) {
                                $description_string .= '<p>' . $value . '</p>';
                            }
                        @endphp
                        {!! $description_string !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
    <livewire:thesis-documents-calendar thesis_id="{{ $thesis->id }}" />
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Главы ВКР
        </h1>
    </div>

    @if ($thesis->chapters->count() == 0)
        <p class="mb-3"><i>Пока нет ни одной глвы</i></p>
    @endif

    @if (auth()->user()->id == $thesis->student->id || auth()->user()->id == $thesis->professor->id)
        <button class="btn btn-primary btn-icon-split mb-3 mr-3"
            onclick="Livewire.dispatch('openModal', { component: 'chapter-modal', arguments: {thesis_id: {{ $thesis->id }}}})">
            <span class="icon text-white-50">
                <i class="fa-solid fa-plus"></i>
            </span>
            <span class="text">Добавить главу</span>
        </button>
    @endif

    @foreach ($thesis->chapters as $chapter)
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $chapter->title }}</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        {{-- <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div> --}}
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    @if (auth()->user()->id == $thesis->student->id || auth()->user()->id == $thesis->professor->id)
                        <form action="{{ route('viewChapter', ['thesis' => $thesis, 'order' => $chapter->order]) }}"
                            method="GET">
                            <button type="submit" class="btn btn-sm btn-primary shadow-sm mb-3 mr-3">
                                <i class="fa-solid fa-pen-clip"></i>
                                К написанию
                            </button>
                        </form>
                    @endif
                    <p>Номер по порядку: {{ $chapter->order }}</p>
                    @if ($chapter->final_version != null)
                        @include('components.single-attachment', [
                            'attachment' => $chapter->final_version,
                            'can_delete' => false,
                            'with_comment' => false,
                        ])
                    @else
                        <p><i>Нет финальной версии</i></p>
                    @endif
                </div>
            </div>
        </div>
    @endforeach

@endsection

@section('custom scripts')

@endsection
