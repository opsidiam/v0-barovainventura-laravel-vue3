<div class="form-group">
    @if ($label !== '')
        <label class="control-label">
            {{ $label ?? __('app.' . $name) }}
            @isset($attributes['required'])
                <span class="text-danger">*</span>
            @endisset
        </label>
    @endif
    {{-- Flatpickr --}}
    {{ Form::text(
		$name,
		$value,
		array_merge([
			'class' => 'js-flatpickr form-control form-control-sm',
			'data-date-format' => config('system.datepicker_time_format'),
			'data-enable-time' => 'true',
			'data-no-calendar' => 'true',
			'data-time_24hr' => 'true',
			'placeholder' => config('system.datepicker_time_placeholder'),
		], (array)$attributes))
	}}
</div>
