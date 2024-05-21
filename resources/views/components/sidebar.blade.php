<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <img src="/vkr-journal-logo.png" class="w-75">
        </div>
        <div class="sidebar-brand-text mx-3">Журнал ВКР</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('redirect.homepage') }}">
            <i class="fas fa-fw fa-home"></i>
            <span>На главную</span></a>
    </li>

    @can('viewAny', App\Models\User::class)

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Пользователи
        </div>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('userList') }}">
                <i class="fas fa-fw fa-users"></i>
                <span>Список пользователей</span></a>
        </li>

        @can('create', App\Models\User::class)
        <li class="nav-item">
            <a class="nav-link" href="{{ route('registerForm') }}">
                <i class="fas fa-fw fa-user-plus"></i>
                <span>Регистрация</span></a>
        </li>
        @endcan

    @endcan

    @can('viewAny', App\Models\Plan::class)

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Планы
        </div>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('viewPlans', auth()->user()->id) }}">
                <i class="fas fa-fw fa-list"></i>
                <span>Список планов</span></a>
        </li>
        @can('create', App\Models\Plan::class)
        <li class="nav-item">
            <a class="nav-link" href="{{ route('createPlanForm') }}">
                <i class="fas fa-fw fa-plus"></i>
                <span>Создать новый план</span></a>
        </li>
        @endcan

    @endcan

    @if(auth()->user()->status->title == 'Научный руководитель')
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Подопечные
        </div>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('professor.viewStudents') }}">
                <i class="fas fa-solid fa-user-graduate"></i>
                <span>Список дипломников</span></a>
        </li>
    @endif

    @if(auth()->user()->status->title == 'Студент')
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            ВКР
        </div>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('viewPlanProgress', auth()->user()->id) }}">
                <i class="fas fa-fw fa-list"></i>
                <span>План работ</span></a>
        </li>
    @endif

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->