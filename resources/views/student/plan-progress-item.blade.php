@extends('components.layout')

@section('title', $plan_progress->plan_item->title)

@section('custom styles')

@endsection

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            {{ $plan_progress->plan_item->title }}
        </h1>
    </div>
    <div class="container">
        <div class="row mb-3">
            <div class="col d-flex flex-column flex-sm-row align-items-center">
                <label class="col-form-label mr-sm-2">
                    <a href="{{ route('profile', $plan_progress->student) }}">
                        {{ $plan_progress->student->fullnameShort() }} :
                    </a>
                </label>
                <button
                    @if ($plan_progress->student->id == auth()->user()->id) onclick="Livewire.dispatch('openModal', { component: 'are-you-sure-plan-item-is-done-modal', arguments: {plan_progress_id: {{ $plan_progress->id }}}})" @endif
                    class="btn btn-icon-split text-left @if ($plan_progress->is_done) btn-success @else btn-secondary @endif">
                    <span class="icon text-white-50">
                        @if ($plan_progress->is_done)
                            <i class="fas fa-solid fa-check"></i>
                        @else
                            <i class="fas fa-solid fa-times"></i>
                        @endif
                    </span>
                    <span class="text">
                        @if ($plan_progress->is_done)
                            Выполнен
                        @else
                            Не выполнен
                        @endif
                    </span>
                </button>
                @if ($plan_progress->done_at && $plan_progress->is_done)
                    <label class="ml-sm-2">{{ $plan_progress->done_at }}</label>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col d-flex flex-column flex-sm-row align-items-center">
                <label class="col-form-label mr-sm-2">
                    <a href="{{ route('profile', $plan_progress->student) }}">
                        {{ $plan_progress->student->professor->fullnameShort() }}:
                    </a>
                </label>
                <button
                    @if ($plan_progress->student->professor->id == auth()->user()->id) onclick="Livewire.dispatch('openModal', { component: 'are-you-sure-plan-item-is-done-modal', arguments: {plan_progress_id: {{ $plan_progress->id }}}})" @endif
                    class="btn btn-icon-split text-left @if ($plan_progress->confirmed) btn-success @else btn-secondary @endif">
                    <span class="icon text-white-50">
                        @if ($plan_progress->confirmed)
                            <i class="fas fa-solid fa-check"></i>
                        @else
                            <i class="fas fa-solid fa-times"></i>
                        @endif
                    </span>
                    <span class="text">
                        @if ($plan_progress->confirmed)
                            Подтвержден
                        @else
                            Не подтвержден
                        @endif
                    </span>
                </button>
                @if ($plan_progress->confirmed && $plan_progress->confirmed_at)
                    <label class="ml-sm-2">{{ $plan_progress->confirmed_at }}</label>
                @endif
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg6 m-2">
            <!-- Collapsable Card Example -->
            <div class="card shadow">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button"
                    aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Описание</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample">
                    <div class="card-body">
                        <b>Дедлайн: </b><label
                            class="@if ($plan_progress->is_overdue()) text-danger @endif">{{ $plan_progress->plan_item->deadline }}</label><br>
                        {{ $plan_progress->plan_item->description }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4 col-sm-12">
            <livewire:notes-card noteable_type="{{ $plan_progress->getMorphClass() }}"
                noteable_id="{{ $plan_progress->id }}"
                can_create_notes="{{ auth()->user()->id == $plan_progress->student->id || auth()->user()->id == $plan_progress->student->professor->id }}" />
        </div>
        <div class="col-md-4 col-sm-12">

            <livewire:attachments_card attachable_type="{{ $plan_progress->plan_item->getMorphClass() }}"
                attachable_id="{{ $plan_progress->plan_item->id }}"
                can_attach="{{ auth()->user()->id == $plan_progress->student->professor->id }}"
                card_title="Вложения плана" />

        </div>
        <div class="col-md-4 col-sm-12">

            <livewire:attachments_card attachable_type="{{ $plan_progress->getMorphClass() }}"
                attachable_id="{{ $plan_progress->id }}"
                can_attach="{{ auth()->user()->id == $plan_progress->student->id || auth()->user()->id == $plan_progress->student->professor->id }}"
                card_title="Вложения выполнения" />

        </div>
    </div>
@endsection

@section('custom scripts')

@endsection
