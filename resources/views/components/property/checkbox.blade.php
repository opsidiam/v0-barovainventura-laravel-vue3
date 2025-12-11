<div class="form-group">
    <label>{{ $property['description'] }}</label>

    {{-- If the checkbox has multiple options --}}
    @isset ($property['options'])

        @foreach ($property['options'] as $val => $label)

            {{ Form::bsCheckbox(
                'properties[' . $handle . '][' . $val . ']',
                $val,
                $model ? $model->hasProperty($handle, $val) : false,
                [
                    'id' => 'property-' . $property['group'] . '-' . $handle . '-' . $loop->iteration
                ],
                $label
            ) }}

        @endforeach

        {{-- If the checkbox has no options --}}
    @else

        {{ Form::bsCheckbox(
            'properties[' . $handle . ']',
            1,
            $model ? $model->hasProperty($handle, 1) : false,
            [
                'id' => 'property-' . $property['group'] . '-' . $handle
            ],
            $property['name']
        ) }}

    @endisset

</div>
