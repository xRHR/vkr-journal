<div class="row">
    <div class="col-12 m-2">
        <!-- Collapsable Card Example -->
        <div class="card shadow">
            <!-- Card Header - Accordion -->
            <a href="#{{ class_basename($noteable) . $noteable->id . "NotesCard" }}" class="d-block card-header py-3" data-toggle="collapse" role="button"
                aria-expanded="true" aria-controls="{{ class_basename($noteable) . $noteable->id . "NotesCard" }}">
                <h6 class="m-0 font-weight-bold text-primary">{{ $card_title }}</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="{{ class_basename($noteable) . $noteable->id . "NotesCard" }}">
                <div class="card-body">
                    @foreach ($noteable->notes as $note)
                        <div class="mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <p class="card-text">{{ $note->body }}</p>
                                </div>
                                <div class="card-footer align-items-center">
                                    <small class="text-muted">
                                        <a href="{{ route('profile', $note->author) }}">{{ $note->author ? $note->author->fullnameShort() : 'Unknown' }}</a>
                                        {{ $note->created_at->format('Y-m-d H:i') }}
                                        @if ($note->updated_at != $note->created_at)<br>Изменено {{ $note->updated_at->format('Y-m-d H:i') }} @endif
                                    </small>
                                    @if ($note->author && $note->author->id == auth()->user()->id)
                                    <div class="float-right">
                                        <button class="btn btn-sm" onclick="Livewire.dispatch('openModal', { component: 'note-modal', arguments: {noteable_type: '{{ str_replace('\\', '\\\\', $noteable->getMorphClass()) }}', noteable_id: {{ $noteable->id }}, note_id: {{ $note->id }}}})">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @if ($can_create_notes)
                    <button
                        onclick="Livewire.dispatch('openModal', { component: 'note-modal', arguments: {noteable_type: '{{ str_replace('\\', '\\\\', $noteable->getMorphClass()) }}', noteable_id: {{ $noteable->id }}}})"
                        class="btn btn-primary btn-icon-split m-2">
                        <span class="icon text-white-50">
                            <i class="fa-solid fa-note-sticky"></i>
                        </span>
                        <span class="text">Добавить заметку</span>
                    </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>