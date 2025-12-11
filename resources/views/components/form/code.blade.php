<div class="form-group">
    @if ($label !== '')
        <label class="control-label">
            {{ $label ?? __('app.' . $name) }}
            @isset($attributes['required'])
                <span class="text-danger">*</span>
            @endisset
        </label>
    @endif

    <div class="code-editor">
        <div
            id="{{ $attributes['id'] }}"
            class="code-editor"
            data-code-editor
            data-language="{{ $attributes['language'] ?? 'html' }}"
            data-theme="{{ $attributes['theme'] ?? 'monokai' }}"
        ></div>
    </div>
    {!! Form::textarea($name, $value, ['id' => $attributes['id'] . '_textarea', 'class'=>'d-none']) !!}
</div>
