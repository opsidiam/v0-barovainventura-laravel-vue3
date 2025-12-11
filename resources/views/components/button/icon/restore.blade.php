{!! Form::open(['url'=>$url,'method'=>'POST','class'=>'inline']) !!}

@isset($variables)
    @foreach ($variables as $key => $value)
        {{ Form::hidden($key, $value) }}
    @endforeach
@endisset

<button
    type="submit"
    class="btn {{ $class ?? 'btn-success' }} btn-sm"
    title="@lang('app.restore')"
    data-swal-confirm-form
    data-type="{{ $type ?? 'warning' }}"
    data-title="{{ $title ?? __('app.are_you_sure') }}"
    data-description="{{ $description ?? __('app.ask_restore_this_item') }}"
    data-cancel="{{ $cancel ?? __('app.cancel') }}"
    data-confirm="{{ $confirm ?? __('app.restore') }}"
>
    <i class="{{ $icon ?? 'fas fa-trash-restore' }}"></i>
    {{ $text ?? '' }}
</button>
{!! Form::close() !!}
