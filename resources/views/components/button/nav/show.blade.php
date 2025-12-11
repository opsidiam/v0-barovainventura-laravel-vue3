<li class="nav-main-item">
    <a class="nav-main-link" href="{{ $url }}" {{ isset($blank) ? 'target=_blank' : '' }}>
        <i class="nav-main-link-icon {{ $icon ?? 'fa fa-eye' }}"></i>
        <span class="nav-main-link-name">{{ $text ?? __('app.show') }}</span>
    </a>
</li>
