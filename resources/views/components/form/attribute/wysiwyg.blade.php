{{ Form::wysiwyg('attributes[' . $attribute->name . ']', isset($model) ? $model->getProperty($attribute->name) : null, ['data-height'=>500,], $attribute->label) }}

