<a href="{{ $url }}" class="btn {{ $class ?? 'btn-info' }} btn-sm" title="{{ $title ?? __('app.show') }}"{{ isset($modal) ? ' data-toggle=modal' : '' }} {{ isset($target) ? ' target=' . $target : '' }}>
    <i class="{{ $icon ?? 'fas fa-eye' }}"></i>
</a>
