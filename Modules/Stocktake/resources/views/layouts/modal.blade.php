@if(isset($open_stocktakes))
    @foreach($open_stocktakes as $open)
        <div class="modal fade" id="deleteInventureModal_{{$open->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteInventureModal_{{$open->id}}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Si si istí/a??</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Týmto vymažeš inventúru (ID: {{$open->id}}) aj s dátamy.</div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="button" data-dismiss="modal">Zrušiť</button>
                        <a class="btn btn-danger" href="{{ route('stocktake.destroy', $open->id) }}" onclick="event.preventDefault();document.getElementById('deletebar-form-inv_{{$open->id}}').submit();">{{ __('Vymazať') }}</a>
                        <form id="deletebar-form-inv_{{ $open->id }}"
                              action="{{ route('stocktake.destroy', $open->id) }}"
                              method="POST"
                              class="d-none">
                            @method('DELETE')
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif
