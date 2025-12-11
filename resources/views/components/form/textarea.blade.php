<div class="form-group">
    @if ($label !== '')
        <label class="control-label">
            {{ $label ?? __('app.' . $name) }}
            @isset($attributes['required'])
                <span class="text-danger">*</span>
            @endisset
        </label>
    @endif
    {{ Form::textarea($name, $value, array_merge(['class' => 'form-control form-control-sm'], (array)$attributes)) }}
</div>
