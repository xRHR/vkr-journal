<x-modal>
    <x-slot name="tools">
    </x-slot>
    <x-slot name="title">
        Смена пароля
    </x-slot>
    <x-slot name="content">
        <div class="card-body">
            <form wire:submit.prevent="changePassword">
                <div class="container">
                    <div class="col-11">
                        @if (auth()->user()->status->title == 'Администратор')
                            <div class="mb-3 text-muted">
                                <i>Ввод старого пароля необязателен для администратора.</i>
                            </div>
                        @else
                            <div class="mb-3 row">
                                <div class="col-12">
                                    <label class="form-label">
                                        Старый пароль
                                    </label>
                                    <input wire:model="old_password" type="password"
                                        class="form-control  @error('old_password') is-invalid @enderror"
                                        name="old_password" autocomplete="current-old_password"
                                        placeholder="Введите пароль" autocomplete="off">
                                    @error('old_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        @endif
                        <div class="mb-3">
                            <div class="col-md-6 col-sm-12">
                                <label class="form-label">
                                    Новый пароль
                                </label>
                                <input wire:model="password" type="password"
                                    class="mb-3 form-control @error('password') is-invalid @enderror" name="password"
                                    autocomplete="current-password" placeholder="Введите пароль" autocomplete="off">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label class="form-label">
                                    Повторите пароль
                                </label>
                                <input wire:model="password_confirmation" type="password"
                                    class="form-control  @error('password_confirmation') is-invalid @enderror"
                                    name="password_confirmation" autocomplete="current-password"
                                    placeholder="Повторите пароль" autocomplete="off">
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-outline-primary" type="submit">Сохранить пароль</button>
                </div>
            </form>
        </div>
    </x-slot>
    <x-slot name="buttons">
    </x-slot>
</x-modal>
