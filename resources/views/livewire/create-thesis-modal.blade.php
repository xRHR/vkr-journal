<x-modal>
    <div></div>
    <x-slot name="tools">
    </x-slot>
    <x-slot name="title">
        <div class="row align-items-center justify-content-beetween">
            <div class="col">
                @if ($thesis)
                    Редактирование ВКР
                @else
                    Создание ВКР
                @endif
            </div>
        </div>
    </x-slot>
    <x-slot name="content">
        <div class="form-group">
            <label>
                Название ВКР
            </label>
            <input type="text" name="title" wire:model="title" class="form-control mb-3" placeholder="Введите название...">
            <label>
                Описание
            </label>
            <textarea name="description" wire:model="description" class="form-control form-control-user mb-3"></textarea>
            <label>
                Научный руководитель
            </label>
            <input type="text" name="professor" class="form-control" value="{{ $user->professor ? $user->professor->fullnameShort() : '' }}" disabled>
            <label>
                Дата защиты
            </label>
            <input type="date" name="defense_date" wire:model="defense_date" class="form-control mb-3">
        </div>
    </x-slot>
    <x-slot name="buttons">
        <button wire:click="save" class="btn btn-primary btn-icon-split mt-3">
            <span class="icon text-white-50">
                <i class="fas fa-solid fa-floppy-disk"></i>
            </span>
            <span class="text">Сохранить</span>
        </button>
        @if ($thesis)
            <button wire:click="delete" class="btn btn-danger btn-icon-split mt-3">
                <span class="icon text-white-50">
                    <i class="fas fa-solid fa-trash"></i>
                </span>
                <span class="text">Удалить</span>
            </button>
        @endif
        <button wire:click="$dispatch('closeModal')" class="btn btn-secondary btn-icon-split mt-3">
            <span class="icon text-white-50">
                <i class="fas fa-solid fa-times"></i>
            </span>
            <span class="text">Отмена</span>
        </button>
    </x-slot>
</x-modal>
