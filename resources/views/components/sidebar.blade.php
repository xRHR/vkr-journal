<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <i class="fas fa-book-open"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Журнал ВКР</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="/redirect/homepage">
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
            <a class="nav-link" href="/user-list">
                <i class="fas fa-fw fa-users"></i>
                <span>Список пользователей</span></a>
        </li>

        @can('create', App\Models\User::class)
        <li class="nav-item">
            <a class="nav-link" href="/register">
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
            <a class="nav-link" href="/professor/{{ auth()->user()->id }}/plans">
                <i class="fas fa-fw fa-list"></i>
                <span>Список планов</span></a>
        </li>
        @can('create', App\Models\Plan::class)
        <li class="nav-item">
            <a class="nav-link" href="/professor/create-plan">
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
            <a class="nav-link" href="/professor/students">
                <i class="fas fa-solid fa-user-graduate"></i>
                <span>Список дипломников</span></a>
        </li>
    @endif


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->