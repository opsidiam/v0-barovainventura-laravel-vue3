<div class="js-pw-strength-container form-group">
    @if ($label !== '')
        <label class="control-label">
            {{ $label ?? __('app.' . $name) }}
            @isset($attributes['required'])
                <span class="text-danger">*</span>
            @endisset
        </label>
    @endif
    <div class="input-group">
        {{ Form::text($name, null, array_merge(['class' => 'js-pw-strength form-control form-control-sm'], (array)$attributes)) }}
        <div class="input-group-append">
            <button type="button" data-generate-password class="btn btn-secondary btn-sm">@lang('app.generate')</button>
        </div>
    </div>
    <div class="js-pw-strength-progress pw-strength-progress mt-1"></div>
    <p class="js-pw-strength-feedback form-text font-size-sm mb-0"></p>
</div>
