<li class="nav-main-item">
    <button
        type="button"
        data-pdf-preview="{{ $url }}"
        class="nav-main-link"
    >
        <i class="nav-main-link-icon {{ $icon ?? 'far fa-file-pdf' }}"></i>
        <span class="nav-main-link-name">{{ $text ?? __('app.preview') }}</span>
    </button>
</li>
