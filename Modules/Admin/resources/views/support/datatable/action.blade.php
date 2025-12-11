<div class="btn-group">
    @if(!$item->status)
        @include('components.button.icon.show', [
            'url' => route('admin.support.done', $item),
        ])
    @endif
    @include('components.button.icon.delete', [
        'url' => route('admin.support.destroy', $item),
        'modal' => $item->id, // Unique ID for modal
        'variables' => ['id' => $item->id], // Optional
        'class' => 'btn-danger', // Optional
        'icon' => 'fas fa-trash', // Optional
    ])

</div>
