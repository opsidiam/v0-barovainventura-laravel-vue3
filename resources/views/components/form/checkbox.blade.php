@php
    if (!isset($attributes['id'])){
        $attributes['id'] = Str::random(32);
    }
@endphp

<div class="custom-control custom-checkbox custom-control-lg custom-control-{{ $color ?? 'primary' }}">
    {{ Form::checkbox($name, $value, $checked, array_merge(['class' => 'custom-control-input check-multiple'], (array)$attributes)) }}
    <label class="custom-control-label" for="{{ $attributes['id'] ?? '' }}">{!! $label !!}</label>
</div>
