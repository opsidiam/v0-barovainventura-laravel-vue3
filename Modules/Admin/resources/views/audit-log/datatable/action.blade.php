<div class="btn-group">
    @if(!$item->status)
        @include('components.button.icon.show', [
            'url' => route('admin.leads.done', $item),
        ])
    @endif
    @include('components.button.icon.delete', [
        'url' => route('admin.leads.destroy', $item),
        'modal' => $item->id, // Unique ID for modal
        'variables' => ['id' => $item->id], // Optional
        'class' => 'btn-danger', // Optional
        'icon' => 'fas fa-trash', // Optional
    ])

</div>
