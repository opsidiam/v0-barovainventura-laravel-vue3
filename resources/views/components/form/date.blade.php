<div class="form-group">
    @if ($label !== '')
        <label class="control-label">
            {{ $label ?? __('app.' . $name) }}
            @isset($attributes['required'])
                <span class="text-danger">*</span>
            @endisset
        </label>
    @endif
    {{-- Bootstrap datepicker --}}
    {{ Form::text(
		$name,
		$value,
		array_merge([
			'class' => 'js-datepicker form-control form-control-sm',
			'data-autoclose' => 'true',
			'data-date-format' => config('system.datepicker_date_format'),
			'data-date-language' => config('system.datepicker_language'),
			'data-today-highlight' => 'true',
			'data-week-start' => config('system.datepicker_week_start'),
			'placeholder' => config('system.datepicker_date_format'),
		], (array)$attributes))
	}}
</div>
