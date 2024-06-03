<x-modal>
    <div></div>
    <x-slot name="tools">
    </x-slot>
    <x-slot name="title">
        <div class="row align-items-center justify-content-beetween">
            <div class="col">
                @if ($chapter)
                    Редактирование главы ВКР
                @else
                    Добавление главы ВКР
                @endif
            </div>
        </div>
    </x-slot>
    <x-slot name="content">
        <div class="form-group">
            <label>
                Название главы
            </label>
            <input type="text" name="title" wire:model="title" class="form-control mb-3" placeholder="Введите название...">
        </div>
    </x-slot>
    <x-slot name="buttons">
        <button wire:click="save" class="btn btn-primary btn-icon-split mt-3">
            <span class="icon text-white-50">
                <i class="fas fa-solid fa-floppy-disk"></i>
            </span>
            <span class="text">Сохранить</span>
        </button>
        @if ($chapter)
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
