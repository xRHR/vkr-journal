@extends('components.layout')

@section('title', 'Профиль ' . $user->lastname . ' ' . $user->firstname)

@section('custom styles')
@endsection

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $user->fullname() }} @if ($user->id == Auth::user()->id)
                (Вы)
            @elseif($user->professor_id == Auth::user()->id)
                (Ваш подопечный)
            @elseif($user->id == Auth::user()->professor_id)
                (Ваш руководитель)
            @endif
        </h1>
    </div>
    <div class="row">

        @can('viewAny', App\Models\User::class)
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    E-mail</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $user->email }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-solid fa-envelope fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endcan

        @if ($user->status->title == 'Администратор')

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Статус</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Администратор</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas {{ $user->icon() }} fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($user->status->title == 'Научный руководитель')
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Статус</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Научный руководитель</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas {{ $user->icon() }} fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($user->status->title == 'Студент')
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Статус</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Студент</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas {{ $user->icon() }} fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if ($user->professor != null)
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Научный руководитель</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <a
                                            href="{{ route('profile', $user->professor->id) }}">{{ $user->professor->fullnameShort() }}</a>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-solid fa-user-tie fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @else
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Статус</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $user->status->title }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas {{ $user->icon() }} fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    </div>

    <hr>
    <div class="row">
        @if (!$user->plans->isEmpty())
            <a href="{{ route('viewPlans', $user->id) }}" class="btn btn-primary btn-icon-split m-2">
                <span class="icon text-white-50">
                    <i class="fa-solid fa-list"></i>
                </span>
                <span class="text">Планы</span>
            </a>
        @endif

        @can('update', $user)
            <a href="{{ route('editProfileForm', $user->id) }}" class="btn btn-primary btn-icon-split m-2">
                <span class="icon text-white-50">
                    <i class="fa-solid fa-pen-to-square"></i>
                </span>
                <span class="text">Редактировать</span>
            </a>
        @endcan
        @if (
            $user->status->title == 'Студент' &&
                $user->professor == null &&
                auth()->user()->status->title == 'Научный руководитель')
            <button onclick="Livewire.dispatch('openModal', { component: 'invite-confirmation', arguments: {invitee_id: {{ $user->id }}, inviter_id: {{ auth()->user()->id }}}})" class="btn btn-primary btn-icon-split m-2">
                <span class="icon text-white-50">
                    <i class="fa-solid fa-thumbtack"></i>
                </span>
                <span class="text">Прикрепить</span>
            </button>
        @endif
    </div>

    <div class="row">
        <div class="col-lg6 m-2">
            <!-- Collapsable Card Example -->
            <div class="card shadow">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button"
                    aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">ФИО</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample">
                    <div class="card-body">
                        <label>Фамилия: {{ $user->lastname }}</label>
                    </div>
                    <div class="card-body">
                        <label>Имя: {{ $user->firstname }}</label>
                    </div>
                    <div class="card-body">
                        <label>Отчество: {{ $user->patronymic }}</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg6 m-2">
            <!-- Collapsable Card Example -->
            <div class="card shadow">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button"
                    aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">ФИО в родительном падеже</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample">
                    <div class="card-body">
                        <label>Фамилия: {{ $user->miscInfo->lastname_genitive }}</label>
                    </div>
                    <div class="card-body">
                        <label>Имя: {{ $user->miscInfo->firstname_genitive }}</label>
                    </div>
                    <div class="card-body">
                        <label>Отчество: {{ $user->miscInfo->patronymic_genitive }}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">

    </div>

@endsection

@section('custom scripts')

@endsection
