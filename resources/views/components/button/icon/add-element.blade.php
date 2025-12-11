<button
    type="button"
    class="btn btn-sm {{ $class ?? 'btn-primary' }}"
    title="{{ $title ?? '' }}"
    data-add-element
    data-target="{{ $target ?? '' }}"
    data-template="{{ $template ?? '' }}"
>
    <i class="{{ $icon ?? 'fas fa-plus-circle' }}"></i>
    {{ $text ?? '' }}
</button>
