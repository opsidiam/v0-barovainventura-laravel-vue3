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
            $attributes['id'] = '_wysiwyg_' . $name;
        }

    @endphp

    {{ Form::hidden($name, $value, ['data-wysiwyg-copy'=>$attributes['id']]) }}
    {{ Form::textarea('_wysiwyg_' . $name, $value, array_merge(['class' => 'form-control form-control-sm', 'data-wysiwyg'], (array)$attributes)) }}

</div>
