<button
    type="button"
    class="btn {{ $class ?? 'btn-primary' }} btn-sm"
    title="@lang('app.edit.')"
    data-toggle="modal-ajax"
    data-target="#{{ $id }}"
    data-url="{{ $url }}"
>
    <i class="{{ $icon ?? 'fas fa-pen-square' }}"></i>
    {{ $text ?? '' }}
</button>
