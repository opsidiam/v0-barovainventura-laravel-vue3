<li class="nav-main-item">

    {!! Form::open(['url'=>$url,'method'=>'DELETE','class'=>'inline']) !!}

    @isset($variables)
        @foreach ($variables as $key => $value)
            {{ Form::hidden($key, $value) }}
        @endforeach
    @endisset

    <button
        type="submit"
        class="nav-main-link w-100 text-left"
        title="@lang('app.delete.')"
        data-swal-confirm-form
        data-type="{{ $type ?? 'error' }}"
        data-title="{{ $title ?? __('app.are_you_sure') }}"
        data-description="{{ $description ?? __('app.ask_delete_this_item') }}"
        data-cancel="{{ $cancel ?? __('app.cancel') }}"
        data-confirm="{{ $confirm ?? __('app.delete.') }}"
    >
        <i class="nav-main-link-icon {{ $icon ?? 'fas fa-trash' }}"></i>
        <span class="nav-main-link-name">{{ $text ?? __('app.delete.') }}</span>
    </button>

    {!! Form::close() !!}

</li>
