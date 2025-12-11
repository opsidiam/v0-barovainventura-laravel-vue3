<div class="form-group">
    @if ($label !== '')
        <label class="control-label d-block">
            {{ $label ?? __('app.' . $name) }}
            @isset($attributes['required'])
                <span class="text-danger">*</span>
            @endisset
        </label>
    @endif
    {{ Form::file($name, (array)$attributes) }}
</div>
