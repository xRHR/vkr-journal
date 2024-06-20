@extends('components.layout')

@section('title', 'Регистрация пользователей')

@section('custom styles')
<!-- Custom styles for this page -->
<link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="http://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet">

<meta name="csrf-token" content="{{ csrf_token() }}" />

@endsection

@section('content')

<livewire:registration :chosen_status="$chosen_status ?? null" />

@endsection

@section('custom scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    Livewire.on('setUrl', param => {
        window.history.replaceState(null, null, param);
    });
});
</script>
@endsection