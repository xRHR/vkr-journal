@extends('components.layout')

@section('title', 'План работ по ВКР')
@section('custom styles')

@endsection

@section('content')
    @if ($user->planProgresses()->count() == 0)
        <h1>План работ отсутствует</h1>
    @else
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                Прогресс выполнения плана "{{ $user->plan->title }}" студентом {{ $user->fullname() }}
            </h1>
        </div>
        @foreach ($user->planProgresses as $pp_item)
            <a href="{{ route('viewPlanProgressItem', ['user' => $user->id, 'plan_progress' => $pp_item->id]) }}">
                <div class="mb-4">
                    <div
                        class="card 
                        @if ($pp_item->confirmed && !$pp_item->is_done_late()) border-left-success 
                    @elseif (($pp_item->confirmed && $pp_item->is_done_late()) || $pp_item->is_overdue())
                    border-left-danger
                    @elseif (!$pp_item->confirmed && $pp_item->is_done && $pp_item->is_deadline_passed())
                    border-left-warning
                    @else
                    border-left-primary @endif
                        shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto text-center">
                                    @if ($pp_item->confirmed)
                                        <i class="fa-solid fa-circle-check fa-2x text-success"></i>
                                    @elseif ($pp_item->is_done)
                                        <i class="fa-solid fa-hourglass-half fa-2x text-warning"></i>
                                    @else
                                        <i class="fa-solid fa-circle-xmark fa-2x text-danger"></i>
                                    @endif
                                    <div
                                        class="mt-4 text-xs font-weight-bold
                                    @if ($pp_item->confirmed && !$pp_item->is_done_late()) text-success 
                                    @elseif (($pp_item->confirmed && $pp_item->is_done_late()) || $pp_item->is_overdue())
                                        text-danger
                                    @elseif (!$pp_item->confirmed && $pp_item->is_done && $pp_item->is_deadline_passed())
                                        text-warning
                                    @else
                                        text-primary @endif
                                    text-uppercase mb-1">
                                        {{ $pp_item->plan_item->deadline }}
                                    </div>
                                </div>
                                <div class="col ml-2">
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ $pp_item->plan_item->title }}
                                    </div>
                                    <div class="card-body">
                                        {{ $pp_item->plan_item->description }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    @endif
@endsection

@section('custom scripts')

@endsection
