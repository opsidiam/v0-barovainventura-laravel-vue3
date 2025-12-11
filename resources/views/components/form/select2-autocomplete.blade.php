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
			'class' => 'form-control form-control-sm w-100',
			'data-placeholder' => $placeholder,
			'data-autocomplete' => $url,
		],
		(array)$attributes)
	) }}
</div>
