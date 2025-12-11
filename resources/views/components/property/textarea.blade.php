{{ Form::bsTextarea(
	'properties[' . $handle . ']',
	$model ? $model->getProperty($handle) : false,
	['rows' => 3],
	$property['name']
) }}