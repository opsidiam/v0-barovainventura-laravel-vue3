<li class="nav-main-item">

    {!! Form::open(['url'=>$url,'method'=>'POST','class'=>'inline']) !!}

    @isset($variables)
        @foreach ($variables as $key => $value)
            {{ Form::hidden($key, $value) }}
        @endforeach
    @endisset

    <button
        type="submit"
        class="nav-main-link"
        title="@lang('app.restore')"
        data-swal-confirm-form
        data-submit-selected="1"
        data-target="{{ $target ?? '' }}"
        data-type="{{ $type ?? 'warning' }}"
        data-title="{{ $title ?? __('app.are_you_sure') }}"
        data-description="{{ $description ?? __('app.ask_restore_selected_items') }}"
        data-cancel="{{ $cancel ?? __('app.cancel') }}"
        data-confirm="{{ $confirm ?? __('app.restore') }}"
    >
        <i class="nav-main-link-icon {{ $icon ?? 'fas fa-trash-restore' }}"></i>
        <span class="nav-main-link-name">{{ $text ?? __('app.restore') }}</span>

    {!! Form::close() !!}

</li>
