<div class="pt-3 pb-3">
    <div class="row justify-content-center">
        <div class="row col-12 align-items-center">
            <div class="@if ($with_comment && $attachment->getCustomProperty('comment') != '') col-6 text-right @else col-12 text-center @endif">
                <div class="text-center d-inline-block">
                    <a style="max-width: 200px" href="{{ $attachment->getUrl() }}" target="_blank">
                        <div class="text-center">
                            <div>
                                @if (pathinfo($attachment->getUrl(), PATHINFO_EXTENSION) == 'doc' ||
                                        pathinfo($attachment->getUrl(), PATHINFO_EXTENSION) == 'docx')
                                    <i class="fa-sharp fa-solid fa-file-word fa-5x"></i>
                                @elseif (pathinfo($attachment->getUrl(), PATHINFO_EXTENSION) == 'pdf')
                                    <i class="fa-sharp fa-solid fa-file-pdf fa-5x"></i>
                                @elseif (pathinfo($attachment->getUrl(), PATHINFO_EXTENSION) == 'jpg' ||
                                        pathinfo($attachment->getUrl(), PATHINFO_EXTENSION) == 'jpeg' ||
                                        pathinfo($attachment->getUrl(), PATHINFO_EXTENSION) == 'png')
                                    <div class="d-flex justify-content-center">
                                        <img src="{{ $attachment->getUrl() }}" alt="Не удалось получить изображение"
                                            style="max-width: 200px; max-height: 200px;">
                                    </div>
                                @else
                                    <i class="fa-sharp fa-solid fa-file fa-5x"></i>
                                @endif
                            </div>
                            <label class="text-wrap" style="max-width: 100%">
                                {{ basename($attachment->getUrl()) }}
                            </label>
                        </div>
                    </a>
                    @if ($can_delete)
                        <div class="d-flex flex-column justify-content-center">
                            <button
                                onclick="Livewire.dispatch('openModal', { component: 'delete-attachment-modal', arguments: {attachment_id: {{ $attachment->id }}}})"
                                type="button" class="d-block btn btn-sm btn-danger shadow-sm mb-1">
                                <i class="fas fa-trash"></i>
                                Удалить файл
                            </button>
                            <button
                                onclick="Livewire.dispatch('openModal', { component: 'version-modal', arguments: {media_id: {{ $attachment->id }}}})"
                                type="button" class="d-block btn btn-sm btn-primary shadow-sm mb-1">
                                <i class="fas fa-pen-to-square"></i>
                                Изменить комментарий
                            </button>
                        </div>
                    @endif
                    <label>
                        Загрузил: <a
                            href="{{ route('profile', ['user' => $attachment->uploaded_by]) }}">{{ $attachment->uploader->fullnameShort() }}</a>
                        <br>
                        {{-- {{ $attachment->created_at->format('d.m.Y H:i') }} --}}
                        {{ $attachment->created_at_diff() }}
                    </label>
                </div>
            </div>
            @if ($with_comment && $attachment->getCustomProperty('comment') != '')
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            {{ $attachment->getCustomProperty('comment') }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
