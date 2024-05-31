<div>
    <div class="text-center">
        <a href="{{ $attachment_path }}" target="_blank">
            <div class="text-center">
                <div>
                    @if (pathinfo($attachment_path, PATHINFO_EXTENSION) == 'doc' || pathinfo($attachment_path, PATHINFO_EXTENSION) == 'docx')
                        <i class="fa-sharp fa-solid fa-file-word fa-5x"></i>
                    @elseif (pathinfo($attachment_path, PATHINFO_EXTENSION) == 'pdf')
                        <i class="fa-sharp fa-solid fa-file-pdf fa-5x"></i>
                    @elseif (pathinfo($attachment_path, PATHINFO_EXTENSION) == 'jpg' || pathinfo($attachment_path, PATHINFO_EXTENSION) == 'jpeg' || pathinfo($attachment_path, PATHINFO_EXTENSION) == 'png')
                        <div class="d-flex justify-content-center">
                            <img src="{{ $attachment_path }}" alt="Не удалось получить изображение"
                                style="max-width: 200px; max-height: 200px;">
                        </div>
                    @else
                        <i class="fa-sharp fa-solid fa-file fa-5x"></i>
                    @endif
                </div>
                <label>
                    {{ basename($attachment_path) }}
                </label>
            </div>
        </a>
        @if ($can_delete)
            <button onclick="Livewire.dispatch('openModal', { component: 'delete-attachment-modal', arguments: {attachment_id: {{ $attachment_id }}}})" type="button"
                 class="btn btn-danger btn-circle btn-sm">
                <i class="fas fa-trash"></i>
            </button>
        @endif
    </div>
</div>
