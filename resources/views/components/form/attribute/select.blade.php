{{ Form::bsSelect('attributes[' . $attribute->name . ']', $attribute->options(), isset($model) ? $model->getProperty($attribute->name) : null, false, [], $attribute->label) }}
