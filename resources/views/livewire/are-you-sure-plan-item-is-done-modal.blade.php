<x-modal>
    <div></div>
    <x-slot name="tools">
    </x-slot>
    <x-slot name="title">
        <div class="row align-items-center justify-content-beetween">
            <div class="col">
                @if (auth()->user()->status->title == 'Студент')
                    @if ($plan_progress->confirmed)
                        Вы не можете отметить этот пункт как невыполненный, так как ваш научный руководитель подтвердил
                        выполнение.
                    @else
                        @if ($plan_progress->is_done)
                            Вы уверены, что хотите отметить этот пункт плана как невыполненный?
                        @else
                            Вы уверены, что хотите отметить этот пункт плана как выполненный? Ваш научный руководитель
                            проверит его после этого.
                        @endif
                    @endif
                @elseif (auth()->user()->status->title == 'Научный руководитель')
                    @if ($plan_progress->confirmed)
                        Вы уверены, что хотите убрать подтверждение что этот пункт плана был выполнен?
                    @else
                        Вы уверены, что хотите подтвердить этот пункт плана как выполненный?
                    @endif
                @endif
            </div>
        </div>
    </x-slot>
    <x-slot name="content">
    </x-slot>
    <x-slot name="buttons">
        @if (auth()->user()->status->title == 'Студент' && $plan_progress->confirmed)

        @else
        <button wire:click="yes" class="btn btn-success btn-icon-split mt-3">
            <span class="icon text-white-50">
                <i class="fas fa-solid fa-check"></i>
            </span>
            <span class="text">Да</span>
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
