<div class="form-group col">
    <div class="card shadow mb-4">
        <a href="#thesisDocuments" class="d-block card-header py-3" data-toggle="collapse" role="button"
            aria-expanded="true" aria-controls="thesisDocuments">
            <h6 class="m-0 font-weight-bold text-primary">Сроки сдачи документов</h6>
        </a>
        <div class="collapse show" id="thesisDocuments">
            <div class="card-body">
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                <form wire:submit.prevent="updateDueDates">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Документ</th>
                                <th>Срок предоставления</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($thesis_documents as $index => $document)
                                <tr>
                                    <td>{{ $document['document']['title'] }}</td>
                                    <td>
                                        @if ($isProfessor)
                                            <input type="date"
                                                wire:model="thesis_documents.{{ $index }}.due_date">
                                            @error('thesis_documents.' . $index . '.due_date')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        @else
                                            {{ $document['due_date'] }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                </form>
            </div>
        </div>
    </div>
</div>
