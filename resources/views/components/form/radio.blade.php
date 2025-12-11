<div class="custom-control custom-radio custom-control-lg custom-control-primary">
    {{ Form::radio($name, $value, $checked, array_merge(['class' => 'custom-control-input'], (array)$attributes)) }}
    <label class="custom-control-label" for="{{ $attributes['id'] ?? '' }}">{{ $label }}</label>
</div>
