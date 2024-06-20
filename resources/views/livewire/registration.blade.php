<div>
    {{-- @if (session()->has('success'))
        <div class="container container--narrow">
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        </div>
    @endif --}}
    @isset($statuses)
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Выберите статус регистрируемого пользователя
            </h1>
        </div>
        <div class="row mb-3 ml-2">
            @foreach ($statuses as $status)
                <button type="button" wire:click="chooseStatus({{ $status->id }})"
                    class="btn btn-primary btn-icon-split mr-3 mb-3">
                    <span class="icon text-white-50">
                        <i class="fas fa-solid {{ $status->icon() }}"></i>
                    </span>
                    <span class="text">{{ $status->title }}</span>
                </button>
            @endforeach
        </div>
    @endisset
    @isset($chosen_status)
        <form id="user_registration" name="user_registration" action="{{ route('register') }}" method="POST"
            autocomplete="off">
            @csrf
            <div class="col-lg-7">
                <div class="form-group">

                    <input type="hidden" name="status" value="{{ $chosen_status->id }}">

                    <div class="col-sm-6 mb-3">
                        <label>Адрес электронной почты</label>
                        <input name="email" type="email" class="form-control form-control-user"
                            aria-describedby="emailHelp" placeholder="Email...">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-sm-6 mb-3">
                        <label>Пароль (не обязательно)</label>
                        <input name="password" type="password" class="form-control form-control-user" id="exampleInputEmail"
                            aria-describedby="emailHelp" placeholder="Пароль...">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    @isset($groups)
                        <div class="col-sm-6 mb-3 row ml-2">
                            <label>Группа: </label>
                            <select name="group" class="ml-2">
                                @foreach ($groups as $group)
                                    <option value="{{ $group->id }}">{{ $group->title }}</option>
                                @endforeach
                            </select>
                            @error('group')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    @endisset

                    <button type="submit" class="btn btn-primary btn-icon-split mb-3 mr-3">
                        <span class="icon text-white-50">
                            <i class="fa-solid fa-user-plus"></i>
                        </span>
                        <span class="text">Регистрация</span>
                    </button>

                </div>
            </div>
        </form>
    @endisset
</div>
