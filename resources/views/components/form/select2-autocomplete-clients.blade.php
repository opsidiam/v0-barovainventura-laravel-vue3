<div class="form-group">
    @if ($label !== '')
        <label class="control-label">
            {{ $label ?? __('app.client') }}
            @isset($attributes['required'])
                <span class="text-danger">*</span>
            @endisset
        </label>
    @endif

    {{ Form::select(
		$name ?? 'client_id',
		isset($options) ? ['0'=>__('app.start_typing_client_name_or_number')] + $options : ['0'=>__('app.start_typing_client_name_or_number')],
		$value ?? null,
		array_merge([
			'class' => 'form-control form-control-sm w-100',
			'data-placeholder' => __('app.start_typing_client_name_or_number'),
			'data-autocomplete-clients' => route('clients.autocomplete'),
		],
		(array)$attributes)
	) }}
</div>
