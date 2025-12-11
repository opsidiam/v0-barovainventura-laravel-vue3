<!-- Delete Button Trigger -->
<button
    type="button"
    data-toggle="modal"
    data-target="#deleteModal{{ $modal ?? '' }}"
    class="btn {{ $class ?? 'btn-danger' }} btn-sm"
    title="@lang('app.delete.')"
    style="margin-right: 10px"
>
    <i class="{{ $icon ?? 'fas fa-trash' }}"></i>
    {{ $text ?? '' }}
</button>


<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal{{ $modal ?? '' }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Potvrdenie vymazania</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Ste si istý, že chcete vymazať tento záznam? Táto akcia je nezvratná.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zrušiť</button>
                <form method="POST" action="{{ $url }}" class="d-inline">
                    @csrf
                    @method('DELETE')

                    @isset($variables)
                        @foreach ($variables as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                    @endisset

                    <button type="submit" class="btn btn-danger">Vymazať</button>
                </form>
            </div>
        </div>
    </div>
</div>
