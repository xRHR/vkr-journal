<div class="form-group col">
    <div class="card shadow mb-4">
        <a href="#{{ class_basename($attachable) . $attachable->id . "AttachmentsCard" }}" class="d-block card-header py-3" data-toggle="collapse" role="button"
            aria-expanded="true" aria-controls="{{ class_basename($attachable) . $attachable->id . "AttachmentsCard" }}">
            <h6 class="m-0 font-weight-bold text-primary">{{ $card_title }}</h6>
        </a>
        <div class="collapse show" id="{{ class_basename($attachable) . $attachable->id . "AttachmentsCard" }}">
            <div class="card-body">
                @if (!$model_exists)
                    <p><i>Вложения недоступны. Создайте объект перед добавлением вложений</i></p>
                @else
                    @if (count($attachable->getMedia('attachments')) == 0)
                        <p><i>Нет вложений</i></p>
                    @else
                        <ul>
                            @foreach ($attachments as $attachment)
                                <li class="mb-3">
                                    @include('components.single-attachment', ['attachment' => $attachment, 'can_delete' => $can_attach, 'with_comment' => true])
                                <hr>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                    @if ($can_attach)
                        <form wire:submit.prevent="addAttachment" class="mb-3">
                            <div x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true"
                                x-on:livewire-upload-finish="uploading = false; progress = 0; $wire.addAttachment();"
                                x-on:livewire-upload-progress="progress = $event.detail.progress">

                                <input class="mb-3" type="file" wire:model="newAttachment" wire:ignore>
                                @error('newAttachment')
                                    <span class="small text-danger">{{ $message }}</span>
                                @enderror

                                <div x-show="uploading" class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div x-text="progress + '%'"
                                            class="h5 mb-0 mr-3 font-weight-bold text-gray-800"></div>
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-success" role="progressbar"
                                                :style="{ width: progress + '%' }" aria-valuenow="progress"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
