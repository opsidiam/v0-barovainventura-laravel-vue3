<div class="custom-control custom-switch custom-control-{{ $color ?? 'primary' }}">
    {{ Form::checkbox($name, $value, $checked, array_merge(['class' => 'custom-control-input', 'id' => $attributes['id']], (array)$attributes)) }}
    <label class="custom-control-label" for="{{ $attributes['id'] ?? '' }}">{{ $label }}</label>
</div>
