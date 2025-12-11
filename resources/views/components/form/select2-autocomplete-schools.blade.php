<div class="form-group">
    @if ($label !== '')
        <label class="control-label">
            {{ $label ?? __('app.school') }}
            @isset($attributes['required'])
                <span class="text-danger">*</span>
            @endisset
        </label>
    @endif

    {{ Form::select(
		$name ?? 'school_id',
		isset($options) ? ['0'=>__('app.start_typing_school_name_or_address')] + $options : ['0'=>__('app.start_typing_school_name_or_address')],
		$value ?? null,
		array_merge([
			'class' => 'form-control form-control-sm w-100',
			'data-placeholder' => __('app.start_typing_school_name_or_address'),
			'data-autocomplete-schools' => route('schools.autocomplete'),
		],
		(array)$attributes)
	) }}
</div>
