<div>
    <div class="m-1">
        <div class="form-group">
            <button wire:click="$dispatch('openModal', { component: 'edit-plan-item-modal', arguments: {plan_id: {{ $plan->id }}}})" id="add_item" type="button" class="btn btn-primary btn-icon-split mt-3">
                <span class="icon text-white-50">
                    <i class="fa-solid fa-circle-plus"></i>
                </span>
                <span class="text">Добавить</span>
            </button>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Содержание плана</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table name="plan_table" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Дедлайн</th>
                            <th>Название пункта</th>
                            <th>Описание</th>
                            <th>Вложения</th>
                            <th style="display:none;">ID</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Дедлайн</th>
                            <th>Название пункта</th>
                            <th>Описание</th>
                            <th>Вложения</th>
                            <th style="display:none;">ID</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($plan->items as $item)
                            <tr wire:click="$dispatch('openModal', { component: 'edit-plan-item-modal', arguments: {plan_id: {{ $plan->id }}, plan_item_id: {{ $item->id }}}})">
                                <td>{{ $item->deadline }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->description }}</td>
                                <td>@foreach ($item->getMedia('attachments') as $attachment)
                                    <a href="{{ $attachment->getUrl() }}" target="_blank"
                                        rel="noopener noreferrer">{{ basename($attachment->getUrl()) }}</a>
                                    @if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach</td>
                                <td style="display:none;">{{ $item->id }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
