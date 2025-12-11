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
    <div class="input-daterange input-group"
         data-date-format="{{ config('system.datepicker_date_format') }}"
         data-date-language="{{ config('system.datepicker_language') }}"
         data-today-hilight="true"
         data-week-start="{{ config('system.datepicker_week_start') }}"
         data-date-keep-empty-values="true"
    >
        {{ Form::text(
            $nameFrom,
            $valueFrom,
             array_merge([
                'class' => 'form-control form-control-sm',
                'data-autoclose' => 'true',
                'data-date-format' => config('system.datepicker_date_format'),
                'data-date-language' => config('system.datepicker_language'),
                'data-today-highlight' => 'true',
                'data-week-start' => config('system.datepicker_week_start'),
                'placeholder' => __('app.from'),
            ], (array)$attributes)
        ) }}
        <div class="input-group-prepend input-group-append">
            <span class="input-group-text font-w600">
                <i class="fa fa-fw fa-arrow-right"></i>
            </span>
        </div>
        {{ Form::text(
            $nameTo,
            $valueTo,
            array_merge([
                'class' => 'form-control form-control-sm',
                'data-autoclose' => 'true',
                'data-date-format' => config('system.datepicker_date_format'),
                'data-date-language' => config('system.datepicker_language'),
                'data-today-highlight' => 'true',
                'data-week-start' => config('system.datepicker_week_start'),
                'placeholder' => __('app.to'),
            ], (array)$attributes)
        ) }}
    </div>

</div>
