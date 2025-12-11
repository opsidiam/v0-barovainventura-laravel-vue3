<form method="POST" class="inline" @if(isset($user)) data-user="{{ $user->id }}" @endif>
    @csrf

    @if(isset($modal))
        <button
            type="button"
            data-toggle="modal"
            data-target="#licenceModal{{$modal}}"
            class="btn {{ $class ?? 'btn-danger' }} btn-sm"
            title="{{$text}}"
            style="margin-right: 10px"
        >
            {{ $text ?? '' }}
        </button>

        <!-- Licence Assignment Modal -->
        <div class="modal fade" id="licenceModal{{$modal}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Priradiť licenciu</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            @foreach ($user->licence as $licence)
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $licence->name }}</h5>
                                            <p class="card-text">
                                                Cena: {{ $licence->price }} €<br>
                                                Kategória: {{ $licence->kategoria }}<br>
                                                Platnosť: {{ $licence->time / 86400 }} dní
                                            </p>
                                            <button class="btn btn-success" type="button" onclick="assignLicence({{ $user->id }}, {{ $licence->id }})">
                                                Priradiť licenciu
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Zrušiť</button>
                    </div>
                </div>
            </div>
        </div>
    @else
        <button
            type="submit"
            class="btn {{ $class ?? 'btn-danger' }} btn-sm"
            title="@lang('app.delete.')"
            data-swal-confirm-form
            data-type="{{ $type ?? 'error' }}"
            data-title="{{ $title ?? __('app.are_you_sure') }}"
            data-description="{{ $description ?? __('app.ask_delete_this_item') }}"
            data-cancel="{{ $cancel ?? __('app.cancel') }}"
            data-confirm="{{ $confirm ?? __('app.delete.') }}"
        >
            <i class="{{ $icon ?? 'fas fa-trash' }}"></i>
            {{ $text ?? '' }}
        </button>
    @endif
</form>

<script>
    function assignLicence(userId, licenceId) {
        const formData = new FormData();
        formData.append('user', userId);
        formData.append('licence', licenceId);

        fetch('{{ route('admin.users.assign.licence') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                } else {
                    alert('Nepodarilo sa priradiť licenciu.');
                }
            })
            .catch(error => {
                console.error('Chyba pri odosielaní požiadavky:', error);
                alert('Vyskytla sa chyba pri odosielaní požiadavky.');
            });
    }
</script>
