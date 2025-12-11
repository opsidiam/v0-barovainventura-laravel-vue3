<div class="custom-control custom-checkbox custom-control-lg custom-control-primary">
    {{ Form::checkbox($name, $value, $checked, array_merge(['class' => 'custom-control-input check-multiple'], (array)$attributes)) }}
    <label class="custom-control-label" data-toggle="collapse" data-target="{{ $target }}"
           for="{{ $attributes['id'] ?? '' }}">{{ $label }}</label>
</div>
