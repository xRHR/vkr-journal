@extends('components.layout')

@section('title', __('Not Found'))

@section('custom styles')

@endsection

@section('content')

    <!-- 404 Error Text -->
    <div class="text-center">
        <div class="error mx-auto" data-text="404">404</div>
        <p class="lead text-gray-800 mb-5">Страница не найдена</p>
        <p class="text-gray-500 mb-0">Страница еще не создана или никогда не будет создана</p>
        <a href="javascript:history.back()">&larr; Вернуться назад</a>
    </div>

@endsection

@section('custom scripts')

@endsection
