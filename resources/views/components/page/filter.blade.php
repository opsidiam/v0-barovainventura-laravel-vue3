@push('modals')
    @isset($saveFilter)
        @include('filters.create')
        @include('filters.list')
    @endisset
@endpush

<div class="block block-rounded block-bordered">
    <div class="block-header block-header-default">
        <h3 class="block-title">@lang('app.search')</h3>
    </div>
    <div class="block-content block-content-full">
        <form action="" method="{{ $filterMethod ?? 'post' }}" id="filter" autocomplete="off">

            {{ Form::hidden('f',1) }}

            <div class="row filter">
                {{ $slot }}
            </div>

            <hr>

            <div class="row">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-hero btn-primary btn-sm">
                        <i class="fa fa-search"></i>
                        {{ $searchBtn ?? __('app.search') }}
                    </button>
                    <button type="button" data-reset-filter class="btn btn-hero btn-secondary btn-sm">
                        <i class="fa fa-times"></i>
                        @lang('app.reset')
                    </button>
                </div>
                <div class="col-md-6 text-md-right mt-3 mt-md-0">
                    @isset($saveFilter)
                        <button type="button" data-save-filter="{{ $saveFilter }}"
                                class="btn btn-hero btn-success btn-sm">
                            <i class="fa fa-save"></i>
                            @lang('app.save_filter')
                        </button>
                        <button type="button" data-toggle="modal" data-target="#list-filters"
                                class="btn btn-hero btn-info btn-sm">
                            <i class="fa fa-filter"></i>
                            @lang('app.saved_filters')
                        </button>
                    @endisset
                </div>
            </div>

        </form>
    </div>
</div>
