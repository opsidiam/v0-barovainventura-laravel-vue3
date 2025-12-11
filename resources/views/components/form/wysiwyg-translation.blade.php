<div class="form-group">
    @if ($label !== '')
        <label class="control-label">
            {{ $label ?? __('app.' . $name) }}
            @isset($attributes['required'])
                <span class="text-danger">*</span>
            @endisset
        </label>
    @endif

    @foreach(config('system.allowed_languages') as $i => $l)

        @if ($i && isset($attributes['required']))
            @php
                unset($attributes['required']);
            @endphp
        @endif

        @php

            $attributes['id'] = '_wysiwyg_' . $name . '_' . $l;

        @endphp

        <div class="input-group input-group-sm mb-2">
            <div class="input-group-prepend">
                <span class="input-group-text input-group-text-alt">{{ $l }}</span>
            </div>

            {{ Form::hidden($name . '[' . $l . ']', $value[$l] ?? null, ['data-wysiwyg-copy'=>$attributes['id']]) }}
            {{ Form::textarea('_wysiwyg_' . $name . '[' . $l . ']', $value[$l] ?? null, array_merge(['class' => 'form-control form-control-sm', 'data-wysiwyg'], (array)$attributes)) }}

        </div>

    @endforeach
</div>
