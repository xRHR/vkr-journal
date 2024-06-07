@extends('components.layout')

@section('title', $chapter->title)

@section('custom styles')

@endsection

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ $chapter->thesis->title }}
    </h1>
</div>

<a href="{{ route('viewThesis', $chapter->thesis->id) }}" class="btn btn-primary btn-icon-split mb-3 mr-3">
<span class="icon text-white-50">
    <i class="fa-solid fa-arrow-left"></i>
</span>
<span class="text">Вернуться к ВКР</span>
</a>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">{{ $chapter->title }}</h6>
    </div>
    <div class="card-body">
        <livewire:chapter-versions :chapter_id="$chapter->id" />
    </div>
</div>

@endsection

@section('custom scripts')

@endsection