<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="SHORTCUT ICON" href="/vkr-journal-logo.png" type="image/x-icon">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Регистрация</title>

    <!-- Custom fonts for this template-->
    <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            @include('components.flash-message')
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Регистрация</h1>
                                        <p><i>Регистрация доступна только в тестовой версии приложения.</i></p>
                                    </div>
                                    <form class="user" action="{{ route('selfRegister') }}" method="POST">
                                        @csrf
                                        <div class="form-group row">
                                            <div class="col-lg-4 col-md-12 col-sm-12 mb-3">
                                                <input type="text" class="form-control form-control-user" id="lastname" name="lastname"
                                                    placeholder="Фамилия" value="{{ old('lastname') }}">
                                            </div>
                                            <div class="col-lg-4 col-md-12 col-sm-12 mb-3">
                                                <input type="text" class="form-control form-control-user"
                                                    id="firstname" name="firstname" placeholder="Имя" value="{{ old('firstname') }}">
                                            </div>
                                            <div class="col-lg-4 col-md-12 col-sm-12">
                                                <input type="text" class="form-control form-control-user"
                                                    id="patronymic" name="patronymic" placeholder="Отчество" value="{{ old('patronymic') }}">
                                            </div>
                                        </div>
                                        @error('lastname')
                                        <div class="mb-3 small alert alert-danger shadow-sm">{{ $message }}</div>
                                        @enderror
                                        @error('firstname')
                                        <div class="mb-3 small alert alert-danger shadow-sm">{{ $message }}</div>
                                        @enderror
                                        @error('patronymic')
                                        <div class="mb-3 small alert alert-danger shadow-sm">{{ $message }}</div>
                                        @enderror

                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" id="email" name="email"
                                                placeholder="Электронная почта" value="{{ old('email') }}">
                                        </div>
                                        @error('email')
                                        <div class="mb-3 small alert alert-danger shadow-sm">{{ $message }}</div>
                                        @enderror

                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="password" class="form-control form-control-user"
                                                    id="password" name="password" placeholder="Придумайте пароль">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="password" class="form-control form-control-user"
                                                    id="repeatPassword" name="password_confirmation" placeholder="Повторите пароль">
                                            </div>
                                        </div>
                                        @error('password')
                                        <div class="m-3 small alert alert-danger shadow-sm">{{ $message }}</div>
                                        @enderror
                                        
                                        <div class="form-group text-center">
                                            <select name="status" class="">
                                                @foreach ($statuses as $status)
                                                    <option value="{{ $status->id }}">{{ $status->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('status')
                                        <div class="mb-3 small alert alert-danger shadow-sm">{{ $message }}</div>
                                        @enderror

                                        <input type="submit" class="btn btn-primary btn-user btn-block"
                                            value="Зарегистрироваться">
                                    </form>
                                    <div class="text-center">
                                        <a class="small" href="{{ route('loginForm') }}">Вход в систему</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
