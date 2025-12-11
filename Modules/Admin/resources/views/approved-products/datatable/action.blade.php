<div class="btn-group">
    @if($item->original === 0)
        @include('components.button.icon.hide', [
            'url' => route('admin.approved-products.hide', $item),
        ])
    @else
        @include('components.button.icon.unhide', [
            'url' => route('admin.approved-products.unhide', $item),
        ])
    @endif
    @include('components.button.icon.edit', [
        'url' => route('admin.approved-products.edit', $item),
    ])
</div>
