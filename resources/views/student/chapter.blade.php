@extends('components.layout')

@section('title', $chapter->title)

@section('custom styles')

@endsection

@section('content')

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