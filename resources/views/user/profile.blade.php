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
    @if ($user->plan_id)
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h2 class="h3 mb-0 text-gray-800">
                План работ "{{ $user->plan->title }}"
            </h2>
        </div>
        <a href="{{ route('viewPlanProgress', $user->id) }}" class="btn btn-primary btn-icon-split m-2">
            <span class="icon text-white-50">
                <i class="fa-solid fa-clipboard-list"></i>
            </span>
            <span class="text">Посмотреть выполнение</span>
        </a>
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Выполненно
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                            {{ $user->progressPercentage() }}%</div>
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-info" role="progressbar"
                                                style="width: {{ $user->progressPercentage() }}%"
                                                aria-valuenow="{{ $user->progressPercentage() }}" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
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
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Подтверждено
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                            {{ $user->progressConfirmedPercentage() }}%</div>
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-success" role="progressbar"
                                                style="width: {{ $user->progressConfirmedPercentage() }}%"
                                                aria-valuenow="{{ $user->progressConfirmedPercentage() }}"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-check fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    @endif
    <div class="row">
        @if (!$user->plans->isEmpty())
            <a href="{{ route('viewPlans', $user->id) }}" class="btn btn-primary btn-icon-split m-2">
                <span class="icon text-white-50">
                    <i class="fa-solid fa-list"></i>
                </span>
                <span class="text">Планы</span>
            </a>
        @endif
        @if (!$user->students->isEmpty())
            <a href="{{ route('viewStudents', $user->id) }}" class="btn btn-primary btn-icon-split m-2">
                <span class="icon text-white-50">
                    <i class="fa-solid fa-graduation-cap"></i>
                </span>
                <span class="text">Дипломники</span>
            </a>
        @endif
        @if (!$user->theses->isEmpty())
            <a href="{{ route('viewTheses', $user->id) }}" class="btn btn-primary btn-icon-split m-2">
                <span class="icon text-white-50">
                    <i class="fa-solid fa-book"></i>
                </span>
                <span class="text">ВКР</span>
            </a>
        @endif
        @can('update', $user)
            <a href="{{ route('editProfileForm', $user->id) }}" class="btn btn-primary btn-icon-split m-2">
                <span class="icon text-white-50">
                    <i class="fa-solid fa-pen-to-square"></i>
                </span>
                <span class="text">Редактировать</span>
            </a>
            <button
                onclick="Livewire.dispatch('openModal', { component: 'change-password-modal', arguments: {user_id: {{ $user->id }}}})"
                class="btn btn-primary btn-icon-split m-2">
                <span class="icon text-white-50">
                    <i class="fa-solid fa-key"></i>
                </span>
                <span class="text">Сменить пароль</span>
            </button>
            <button
                onclick="Livewire.dispatch('openModal', { component: 'change-email-modal', arguments: {user_id: {{ $user->id }}}})"
                class="btn btn-primary btn-icon-split m-2">
                <span class="icon text-white-50">
                    <i class="fa-solid fa-envelope"></i>
                </span>
                <span class="text">Сменить почту</span>
            </button>
        @endcan
        @if (
            $user->status->title == 'Студент' &&
                $user->professor == null &&
                auth()->user()->status->title == 'Научный руководитель')
            <button
                onclick="Livewire.dispatch('openModal', { component: 'invite-confirmation', arguments: {invitee_id: {{ $user->id }}, inviter_id: {{ auth()->user()->id }}}})"
                class="btn btn-primary btn-icon-split m-2">
                <span class="icon text-white-50">
                    <i class="fa-solid fa-thumbtack"></i>
                </span>
                <span class="text">Прикрепить</span>
            </button>
        @endif
        @if (
            $user->status->title == 'Научный руководитель' &&
                auth()->user()->professor == null &&
                auth()->user()->status->title == 'Студент')
            <button
                onclick="Livewire.dispatch('openModal', { component: 'invite-confirmation', arguments: {invitee_id: {{ $user->id }}, inviter_id: {{ auth()->user()->id }}}})"
                class="btn btn-primary btn-icon-split m-2">
                <span class="icon text-white-50">
                    <i class="fa-solid fa-thumbtack"></i>
                </span>
                <span class="text">Прикрепиться</span>
            </button>
        @endif
        @if ($user->professor_id == auth()->user()->id)
            <button
                onclick="Livewire.dispatch('openModal', { component: 'invite-confirmation', arguments: {invitee_id: {{ $user->id }}, inviter_id: {{ auth()->user()->id }}, detach: true}})"
                class="btn btn-danger btn-icon-split m-2">
                <span class="icon text-white-50">
                    <div class="rotate-n-15">
                        <i class="fa-solid fa-thumbtack"></i>
                    </div>
                </span>
                <span class="text">Открепить</span>
            </button>
        @endif
        @if ($user->id == auth()->user()->professor_id)
            <button
                onclick="Livewire.dispatch('openModal', { component: 'invite-confirmation', arguments: {invitee_id: {{ $user->id }}, inviter_id: {{ auth()->user()->id }}, detach: true}})"
                class="btn btn-danger btn-icon-split m-2">
                <span class="icon text-white-50">
                    <div class="rotate-n-15">
                        <i class="fa-solid fa-thumbtack"></i>
                    </div>
                </span>
                <span class="text">Открепиться</span>
            </button>
        @endif
    </div>

    <div class="row">
        <div class="col-lg-4">
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
                        <label>Фамилия: {{ $user->lastname }}</label><br>
                        <label>Имя: {{ $user->firstname }}</label><br>
                        <label>Отчество: {{ $user->patronymic }}</label><br>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <!-- Collapsable Card Example -->
            <div class="card shadow">
                <!-- Card Header - Accordion -->
                <a href="#fioGenitive" class="d-block card-header py-3" data-toggle="collapse" role="button"
                    aria-expanded="true" aria-controls="fioGenitive">
                    <h6 class="m-0 font-weight-bold text-primary">ФИО в родительном падеже</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="fioGenitive">
                    <div class="card-body">
                        <label>Фамилия: {{ $user->miscInfo->lastname_genitive }}</label><br>
                        <label>Имя: {{ $user->miscInfo->firstname_genitive }}</label><br>
                        <label>Отчество: {{ $user->miscInfo->patronymic_genitive }}</label><br>
                    </div>
                </div>
            </div>
        </div>
        @if ($user->status->title == 'Студент')
            <div class="col-lg-4">
                <!-- Collapsable Card Example -->
                <div class="card shadow">
                    <!-- Card Header - Accordion -->
                    <a href="#group" class="d-block card-header py-3" data-toggle="collapse" role="button"
                        aria-expanded="true" aria-controls="group">
                        <h6 class="m-0 font-weight-bold text-primary">Группа</h6>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse show" id="group">
                        <div class="card-body">
                            <label>Номер группы: @if ($user->group)
                                    {{ $user->group->title }}
                                @endif
                            </label><br>
                            <label>Специальность: @if ($user->group && $user->specialty)
                                    {{ $user->specialty->title }}
                                @endif
                            </label><br>
                            <label>Кафедра: @if ($user->group && $user->specialty && $user->department)
                                    {{ $user->department->title }}
                                @endif
                            </label><br>
                            <label>Факультет/Институт: @if ($user->group && $user->specialty && $user->department && $user->faculty)
                                    {{ $user->faculty->title }}
                                @endif
                            </label><br>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

@endsection

@section('custom scripts')

@endsection
