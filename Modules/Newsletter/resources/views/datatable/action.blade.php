<div class="btn-group">
    @if($newsletter->ready_to_send == 0)
        @include('components.button.icon.send', [
            'url' => route('newsletter.allow.send', $newsletter),
            'text' => 'Povoliť odoslanie',
            'class' => 'btn-warning',
            'icon' => 'fas fa-rotate',
            'modal' => $newsletter->id
        ])
    @endif
    @if($newsletter->sending_done == 0)
        @include('components.button.icon.delete', [
            'url' => route('newsletter.destroy', $newsletter),
            'modal' => $newsletter->id
        ])
    @endif

</div>
