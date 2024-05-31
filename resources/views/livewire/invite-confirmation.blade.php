<x-modal>
    <div></div>
    <x-slot name="tools">
    </x-slot>
    <x-slot name="title">
        <div class="row align-items-center justify-content-beetween">
            <div class="col">
                @if ($detach)
                    @if ($inviter->status->title == 'Научный руководитель')
                        Вы действительно хотите открепить студента {{ $invitee->fullnameShort() }}?
                    @else
                        Вы действительно хотите открепиться от научрука {{ $invitee->fullnameShort() }}?
                    @endif
                @else
                    @if ($you_already_invited)
                        Вы уже отправляли приглашение пользователю {{ $invitee->fullnameShort() }}
                    @else
                        @if ($inviter->status->title == 'Научный руководитель')
                            Вы действительно хотите прикрепить студента {{ $invitee->fullnameShort() }}?
                        @else
                            Вы действительно хотите прикрепиться к научруку {{ $invitee->fullnameShort() }}?
                        @endif
                    @endif
                @endif
            </div>

        </div>
    </x-slot>
    <x-slot name="content">
    </x-slot>
    <x-slot name="buttons">
        @if ($detach)
            <button wire:click="detach_student" class="btn btn-danger btn-icon-split mt-3">
                <span class="icon text-white-50">
                    <div class="rotate-n-15">
                        <i class="fa-solid fa-thumbtack"></i>
                    </div>
                </span>
                <span class="text">
                    @if ($inviter->status->title == 'Научный руководитель')
                        Открепить
                    @else
                        Открепиться
                    @endif
                </span>
            </button>
        @else
            @if (!$you_already_invited)
                <button wire:click="createInvite" class="btn btn-primary btn-icon-split mt-3">
                    <span class="icon text-white-50">
                        <i class="fa-solid fa-thumbtack"></i>
                    </span>
                    <span class="text">
                        @if ($inviter->status->title == 'Научный руководитель')
                            Прикрепить
                        @else
                            Прикрепиться
                        @endif
                    </span>
                </button>
            @else
                <button wire:click="cancelInvite" class="btn btn-danger btn-icon-split mt-3">
                    <span class="icon text-white-50">
                        <i class="fa-solid fa-trash"></i>
                    </span>
                    <span class="text">
                        Отменить приглашение
                    </span>
                </button>
            @endif
        @endif
        <button wire:click="$dispatch('closeModal')" class="btn btn-secondary btn-icon-split mt-3">
            <span class="icon text-white-50">
                <i class="fa-solid fa-arrow-left"></i>
            </span>
            <span class="text">
                Назад
            </span>
        </button>
    </x-slot>
</x-modal>
