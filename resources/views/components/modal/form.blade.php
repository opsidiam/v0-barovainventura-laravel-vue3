<!-- Normal Block Modal -->
<div class="modal" id="{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="#{{ $id }}" aria-hidden="true"
     data-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog {{ $class ?? 'modal-dialog-centered' }}" role="document">
        <div class="modal-content">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title text-white">{{ $title }}</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal"
                                aria-label="@lang('app.close')">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                @isset($formAttributes)
                    {{ Form::open(array_merge(['route' => $route, 'data-validate', 'autocomplete' => 'off'], (array)$formAttributes)) }}
                @else
                    {{ Form::open(['route' => $route, 'data-validate', 'autocomplete' => 'off']) }}
                @endisset
                <div class="block-content">
                    {{ $slot }}
                </div>
                <div class="block-content block-content-full text-right bg-light">
                    <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">@lang('app.close')</button>
                    <button type="submit" name="_open" value="0" class="btn btn-sm btn-primary">
                        {{ $submitBtn ?? __('app.save')}}
                    </button>
                    @unless (isset($submitBtnOpen) && $submitBtnOpen === false)
                        <button type="submit" name="_open" value="1" class="btn btn-sm btn-primary">
                            {{ $submitBtnOpen ?? __('app.save_and_open')}}
                        </button>
                    @endunless
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
<!-- END Normal Block Modal -->
