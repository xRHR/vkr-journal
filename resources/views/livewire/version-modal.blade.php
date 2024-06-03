<x-modal>
    <div></div>
    <x-slot name="tools">
    </x-slot>
    <x-slot name="title">
        <div class="row align-items-center justify-content-beetween">
            <div class="col">
                Загрузка главы ВКР {{ $version->file_name }}
            </div>
        </div>
    </x-slot>
    <x-slot name="content">
        <div class="form-group">
            <label>
                Введите комментарий
            </label>
            <textarea name="comment" wire:model="comment" class="form-control form-control-user"></textarea>
            @include('components.single-attachment', [
                'attachment' => $version,
                'can_delete' => false,
            ])
        </div>
    </x-slot>
    <x-slot name="buttons">
        <button wire:click="save" class="btn btn-primary btn-icon-split mt-3">
            <span class="icon text-white-50">
                <i class="fas fa-solid fa-floppy-disk"></i>
            </span>
            <span class="text">Сохранить</span>
        </button>
        <button wire:click="$dispatch('closeModal')" class="btn btn-secondary btn-icon-split mt-3">
            <span class="icon text-white-50">
                <i class="fas fa-solid fa-times"></i>
            </span>
            <span class="text">Отмена</span>
        </button>
    </x-slot>
</x-modal>
