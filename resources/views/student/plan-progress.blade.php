@extends('components.layout')

@section('title', 'План работ по ВКР')

@section('custom styles')
    <!-- Custom styles for this page -->
    <link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="http://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section('content')
    @if (is_null($user->plan))
        <h1>План работ отсутствует</h1>
    @else
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                Прогресс выполнения плана "{{ $user->plan->title }}" студентом {{ $user->fullname() }}
            </h1>
        </div>
        @foreach ($user->planProgress as $pp_item)
            <div class="mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto text-center">
                                <i class="fa-solid fa-circle-xmark fa-2x text-red-300"></i>
                                <div class="mt-4 text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    {{ $pp_item->planItem->deadline }}
                                </div>
                            </div>
                            <div class="col ml-2">
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $pp_item->planItem->title }}
                                </div>
                                <div class="card-body">
                                    {{ $pp_item->planItem->description }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
@endsection

@section('custom scripts')

@endsection
