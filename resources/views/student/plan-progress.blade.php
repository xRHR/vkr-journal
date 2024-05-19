@extends('components.layout')

@section('title', 'План работ по ВКР')

@section('custom styles')
<!-- Custom styles for this page -->
<link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="http://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section('content')
@if( is_null( auth()->user->plan ) )

<h1>У вас Отсутствует план работ</h1>

@else

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">План работ по ВКР</h6>
    </div>

</div>
@endif
@endsection

@section('custom scripts')

@endsection