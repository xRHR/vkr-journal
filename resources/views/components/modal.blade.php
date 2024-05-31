@props(['formAction' => false])

<div>
    @if ($formAction)
        <form wire:submit.prevent="{{ $formAction }}">
    @endif

    <div class="row align-items-center justify-content-beetween">
        <div class="card-header py-3 row col-12">
            <div class="col-10 align-items-center d-flex">
                <h6 class="ml-2 font-weight-bold text-primary">
                    @if (isset($title))
                        {{ $title }}
                    @endif
                </h6>
            </div>
            <div class="col-2">
                <div class="row">
                    @if (isset($tools))
                        <div class="col">
                            {{ $tools }}
                        </div>
                    @endif
                    <div class="col">
                        <button wire:click="$dispatch('closeModal')" class="btn btn-sm">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-sm-12 col-lg-12">

            <div class=" px-1 sm:p-1">
                <div class="card-body">
                    {{ $content }}
                </div>
            </div>

        </div>

        <div class="col-12 col-sm-5 col-lg-5">
            <div class="bg-gray px-1 pb-1 sm:px-1 m-3">
                {{ $buttons }}
            </div>
        </div>
    </div>
    @if ($formAction)
        </form>
    @endif
</div>
