<div class="form-group">
    @if ($label !== '')
        <label class="control-label">
            {{ $label ?? __('app.' . $name) }}
            @isset($attributes['required'])
                <span class="text-danger">*</span>
            @endisset
        </label>
    @endif
    {{ Form::select(
		$name,
		$options,
		$value, array_merge([
			'class' => 'js-select2 form-control form-control-sm w-100',
			'multiple',
			'data-placeholder' => $placeholder
		],
		(array)$attributes)
	) }}
</div>
