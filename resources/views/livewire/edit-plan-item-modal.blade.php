<x-modal>
    <x-slot name="tools">
    </x-slot>
    <x-slot name="title">
        <div class="row align-items-center justify-content-beetween">
            <div class="col">
                @if ($plan_item)
                Редактирование пункта плана
                @else
                Добавление пункта плана
                @endif
            </div>
        </div>
    </x-slot>
    <x-slot name="content">
        <form>
            @csrf
            <div class="form-group col">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Пункт плана</h6>
                    </div>
                    <div class="card-body">
                        <label class="mt-3">Название пункта</label>
                        <input value="{{ $title }}" wire:model="title" name="itemTitle" required class="form-control form-control-user" id="inputItemTitle"
                            placeholder="Введите название пункта...">
                        <label class="mt-3">Описание</label>
                        <textarea wire:model="description" name="itemDescription" required class="form-control form-control-user" id="inputItemDescription">{{ $description }}</textarea>
                        <label class="mt-3">Дедлайн</label>
                        <input value="{{ $deadline }}" wire:model="deadline" id="dt{{ $plan_item->id??"-1" }}" name="deadline" type="date" required
                            class="form-control form-control-user">
                    </div>
                </div>
            </div>
        </form>
        <livewire:attachments_card attachable_type="\App\Models\PlanItem" attachable_id="{{ $plan_item ? $plan_item->id : -1 }}" can_attach="true"/>
    </x-slot>
    <x-slot name="buttons">
        <div class="form-group">
            <button wire:click="save" class="btn btn-primary btn-icon-split mt-3">
                <span class="icon text-white-50">
                    <i class="fas fa-solid fa-floppy-disk"></i>
                </span>
                <span class="text">Сохранить</span>
            </button>
            @if ($plan_item)
            <button wire:click="delete" class="btn btn-danger btn-icon-split mt-3">
                <span class="icon text-white-50">
                    <i class="fas fa-solid fa-trash"></i>
                </span>
                <span class="text">Удалить</span>
            </button>
            @endif
            <button wire:click="$dispatch('closeModal')" class="btn btn-secondary btn-icon-split mt-3">
                <span class="icon text-white-50">
                    <i class="fas fa-solid fa-arrow-left"></i>
                </span>
                <span class="text">Назад</span>
            </button>
        </div>
    </x-slot>
</x-modal>
