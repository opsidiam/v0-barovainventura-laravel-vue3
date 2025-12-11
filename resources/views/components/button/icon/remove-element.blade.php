{{-- Remove element. If data-parent is set to 1, only parent element will be removed. --}}
<button
    type="button"
    class="btn {{ $class ?? 'btn-danger' }} btn-sm"
    title="@lang('app.delete.')"
    data-remove-element
    data-url="{{ $url ?? '' }}"
    data-target="{{ $target ?? 'div' }}"
    data-content-replace="{{ $contentReplace ?? '' }}"
    data-parent="{{ $parent ?? 0 }}"
    data-type="{{ $type ?? 'error' }}"
    data-title="{{ $title ?? __('app.are_you_sure') }}"
    data-description="{{ $description ?? __('app.ask_delete_this_item') }}"
    data-cancel="{{ $cancel ?? __('app.cancel') }}"
    data-confirm="{{ $confirm ?? __('app.delete.') }}"
    data-update-client-warnings="{{ $updateClientWarnings ?? 0 }}"
>
    <i class="{{ $icon ?? 'fas fa-times-circle' }}"></i>
    {{ $text ?? '' }}
</button>
