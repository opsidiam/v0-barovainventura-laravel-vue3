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

        <div class="input-group input-group-sm mb-2">
            <div class="input-group-prepend">
                <span class="input-group-text input-group-text-alt">{{ $l }}</span>
            </div>

            {{ Form::textarea($name . '[' . $l . ']', $value[$l] ?? null, array_merge(['class' => 'form-control form-control-sm'], (array)$attributes)) }}

        </div>

    @endforeach
</div>
