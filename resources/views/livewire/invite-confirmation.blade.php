<x-modal>
    <div></div>
    <x-slot name="tools">
    </x-slot>
    <x-slot name="title">
        <div class="row align-items-center justify-content-beetween">
            <div class="col">
                @if ($you_already_invited)
                    Вы уже отправляли приглашение пользователю {{ $invitee->fullnameShort() }}
                @else
                    @if ($inviter->status->title == 'Научный руководитель')
                        Вы действительно хотите прикрепить студента {{ $invitee->fullnameShort() }}?
                    @else
                        Вы действительно хотите прикрепиться к научруку {{ $invitee->fullnameShort() }}?
                    @endif
                @endif
            </div>

        </div>
    </x-slot>
    <x-slot name="content">
        @if ($you_already_invited)
            ggg
        @else
            loh
        @endif
        @if ($you_are_invited)
            yes
        @else
            no
        @endif
    </x-slot>
    <x-slot name="buttons">
        @if (!$you_already_invited)
            <button wire:click="createInvite" class="btn btn-primary">
                @if ($inviter->status->title == 'Научный руководитель')
                    Прикрепить
                @else
                    Прикрепиться
                @endif
            </button>
        @endif
        <button wire:click="$dispatch('closeModal')" class="btn btn-secondary">
            Отмена
        </button>
    </x-slot>
</x-modal>
