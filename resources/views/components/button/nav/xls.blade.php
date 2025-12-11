<li class="nav-main-item">
    <a href="{{ $url }}"
       class="nav-main-link"
       @isset($dynamic)
           data-xls-dynamic="{{ $url }}"
       @endisset
    >
        <i class="nav-main-link-icon {{ $icon ?? 'fas fa-file-excel' }}"></i>
        <span class="nav-main-link-name">{{ $text ?? __('app.download_xls') }}</span>
    </a>
</li>
