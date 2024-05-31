<div>
    <ul>
        @foreach ($chapter->getMedia('versions') as $version)
            <li>
                <div style="
                    @if ($version->uploader->status->title == 'Научный руководитель') background-color: #f8f9fc; @endif">
                    @include('components.single-attachment', [
                        'attachment_path' => $attachment_path,
                        'can_delete' => $can_delete,
                        'attachment_id' => $attachment_id,
                    ])
                </div>
            </li>
        @endforeach
        <li>
            <div style="
                @if (auth()->user()->status->title == 'Научный руководитель') background-color: #f8f9fc; @endif">
                <div>
                    <div class="text-center">
                        <div x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true"
                            x-on:livewire-upload-finish="uploading = false; progress = 0; $wire.addAttachment();"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">

                            <label for="inputFile">
                                <div class="text-center">
                                    <div>
                                        <i class="fa-solid fa-file-circle-plus fa-5x"></i>
                                    </div>
                                    <label>
                                        Загрузить файл
                                    </label>
                                </div>
                            </label>
                            <input type="file" name="attachment" id="inputFile" wire:model="newAttachment"
                                style="opacity: 0; position: absolute; z-index: -1;">
                            @error('newAttachment')
                                <span class="small text-danger">{{ $message }}</span>
                            @enderror

                            <div x-show="uploading" class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div x-text="progress + '%'" class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                    </div>
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
                    </div>
                </div>
            </div>
        </li>
    </ul>
</div>
