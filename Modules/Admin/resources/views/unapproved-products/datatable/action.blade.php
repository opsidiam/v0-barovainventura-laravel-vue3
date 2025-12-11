<div class="btn-group">
    @if($item->original === 0)
        @include('components.button.icon.hide', [
            'url' => route('admin.unapproved-products.hide', $item),
        ])
    @else
        @include('components.button.icon.unhide', [
            'url' => route('admin.unapproved-products.unhide', $item),
        ])
    @endif
    @include('components.button.icon.edit', [
        'url' => route('admin.unapproved-products.edit', $item),
    ])
        @include('components.button.icon.delete', [
            'url' => route('admin.unapproved-products.destroy', $item),
            'modal' => $item->id, // Unique ID for modal
            'variables' => ['id' => $item->id], // Optional
            'class' => 'btn-danger', // Optional
            'icon' => 'fas fa-trash', // Optional
        ])

</div>
