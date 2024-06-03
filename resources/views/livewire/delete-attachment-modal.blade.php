<x-modal>
    <div></div>
    <x-slot name="tools">
    </x-slot>
    <x-slot name="title">
        <div class="row align-items-center justify-content-beetween">
            <div class="col">
                Удаление файла
            </div>
        </div>
    </x-slot>
    <x-slot name="content">
        Вы уверены что хотите удалить файл "{{ $attachment->file_name }}" навсегда?
    </x-slot>
    <x-slot name="buttons">
        <button wire:click="yes" class="btn btn-danger btn-icon-split mt-3">
            <span class="icon text-white-50">
                <i class="fas fa-solid fa-trash"></i>
            </span>
            <span class="text">Удалить файл</span>
        </button>
        <button wire:click="$dispatch('closeModal')" class="btn btn-secondary btn-icon-split mt-3">
            <span class="icon text-white-50">
                <i class="fas fa-solid fa-times"></i>
            </span>
            <span class="text">Отмена</span>
        </button>
    </x-slot>
</x-modal>
