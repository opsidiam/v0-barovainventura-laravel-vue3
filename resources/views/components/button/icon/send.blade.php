<!-- Reset Button Trigger -->
<button
    type="button"
    data-toggle="modal"
    data-target="#resetModal{{ $modal ?? '' }}"
    class="btn {{ $class ?? 'btn-danger' }} btn-sm"
    title="{{ $text ?? 'Odoslať' }}"
    style="margin-right: 10px"
>
    <i class="{{ $icon ?? 'fas fa-trash' }}"></i>
    {{ $text ?? '' }}
</button>

<div class="modal fade" id="resetModal{{ $modal ?? '' }}" tabindex="-1" role="dialog" aria-labelledby="resetModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resetModalLabel">Potvrdenie odoslania</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Zavrieť">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Ste si istý, že chcete odoslať newsletter? Táto akcia je nezvratná.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zrušiť</button>
                <form method="POST" action="{{ $url }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-success">Odoslať newsletter</button>
                </form>
            </div>
        </div>
    </div>
</div>
