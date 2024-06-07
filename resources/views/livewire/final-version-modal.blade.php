<x-modal>
    <div></div>
    <x-slot name="tools">
    </x-slot>
    <x-slot name="title">
        <div class="row align-items-center justify-content-beetween">
            <div class="col">
                Финальная версия {{ $chapter->title }}
            </div>
        </div>
    </x-slot>
    <x-slot name="content">
        @if (auth()->user()->status->title == 'Студент')
            Вы уверены, что хотите попросить руководителя утвердить {{ $version->file_name }} как финальную версию главы {{ $chapter->title }}?
        @else
            Вы уверены, что хотите утвердить {{ $version->file_name }} как финальную версию главы {{ $chapter->title }}?
        @endif
    </x-slot>
    <x-slot name="buttons">
        <button wire:click="yes" class="btn btn-success btn-icon-split mt-3">
            <span class="icon text-white-50">
                <i class="fas fa-solid fa-check"></i>
            </span>
            <span class="text">Да</span>
        </button>
        <button wire:click="$dispatch('closeModal')" class="btn btn-secondary btn-icon-split mt-3">
            <span class="icon text-white-50">
                <i class="fas fa-solid fa-times"></i>
            </span>
            <span class="text">Отмена</span>
        </button>
    </x-slot>
</x-modal>
