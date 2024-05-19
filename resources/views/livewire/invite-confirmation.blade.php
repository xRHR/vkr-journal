<x-modal>
    <div></div>
    <x-slot name="tools">
    </x-slot>
    <x-slot name="title">
        <div class="row align-items-center justify-content-beetween">
            <div class="col">
                    Вы действительно хотите прикрепить студента {{ $invitee->fullnameShort() }}?
            </div>

        </div>
    </x-slot>
    <x-slot name="content">

    </x-slot>
    <x-slot name="buttons">
        <button wire:click="createInvite" class="btn btn-primary">
            Прикрепить
        </button>
        <button wire:click="$dispatch('closeModal')" class="btn btn-secondary">
            Отмена
        </button>
    </x-slot>
</x-modal>
