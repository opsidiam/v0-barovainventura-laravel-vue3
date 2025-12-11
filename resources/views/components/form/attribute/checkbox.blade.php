<div class="form-group">
    <label>{{ $attribute->label }}</label>

    @foreach ($attribute->options as $option)

        {{ Form::bsCheckbox('attributes[' . $attribute->name . '][' . $option['value'] . ']',  $option['value'], isset($model) ? $model->getProperty($attribute->name,  $option['value']) : false, [], $option['name'] ?: $option['value']) }}

    @endforeach
</div>
