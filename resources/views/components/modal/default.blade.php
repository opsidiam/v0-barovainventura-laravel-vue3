<!-- Normal Block Modal -->
<div class="modal" id="{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="#{{ $id }}" aria-hidden="true"
     data-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog {{ $class ?? 'modal-dialog-centered' }}" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">{{ $title }}</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal"
                                aria-label="@lang('app.close')">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    {{ $slot }}
                </div>
                <div class="block-content block-content-full text-right bg-light">
                    <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">@lang('app.close')</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Normal Block Modal -->
