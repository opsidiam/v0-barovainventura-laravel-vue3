<div class="form-group">
    @if ($label !== '')
        <label class="control-label">
            {{ $label ?? __('app.' . $name) }}
            @isset($attributes['required'])
                <span class="text-danger">*</span>
            @endisset
        </label>
    @endif

    @php

        if (!isset($attributes['id'])) {
            $attributes['id'] = '_json_editor_' . $name;
        }

    @endphp

    <textarea name="{{ $name }}" data-json-editor="{{ $attributes['id'] }}" class="d-none">{!! $value !!}</textarea>
    <div id="{{ $attributes['id'] }}"></div>
</div>
