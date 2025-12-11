{{ Form::bsTextarea('attributes[' . $attribute->name . ']', isset($model) ? $model->getProperty($attribute->name) : null, [], $attribute->label) }}
