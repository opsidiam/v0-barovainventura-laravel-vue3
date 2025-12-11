@props([
'modelClass' => null,   // \App\Models\User::class / \App\Models\Bar::class / \App\Models\UserFile::class
'modelId'    => null,   // ID cieľa
'notes'      => collect(), // ak máš už načítané, inak nechaj prázdne
])

<div class="card shadow-sm mb-3">
    <div class="card-header py-2 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Poznámky</h6>
        <small class="text-muted">{{ $notes->count() }} záznamov</small>
    </div>
    <div class="card-body">
        @forelse($notes as $n)
            <div class="media mb-3">
                <div class="mr-2">
                    <i class="fas fa-sticky-note text-muted"></i>
                </div>
                <div class="media-body">
                    <div class="small text-muted">
                        {{ optional($n->author)->name ?? '—' }} • {{ optional($n->created_at)->format('Y-m-d H:i') }}
                    </div>
                    <div>{{ nl2br(e($n->body)) }}</div>
                </div>
                <form action="{{ route('admin.notes.destroy', $n) }}" method="POST" class="ml-2"
                      onsubmit="return confirm('Odstrániť poznámku?');">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-light border" title="Zmazať">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>
            </div>
            <hr>
        @empty
            <div class="text-muted">Zatiaľ žiadne poznámky.</div>
        @endforelse

        <form method="POST" action="{{ route('admin.notes.store') }}" class="mt-2">
            @csrf
            <input type="hidden" name="notable_type" value="{{ $modelClass }}">
            <input type="hidden" name="notable_id"   value="{{ $modelId }}">
            <div class="input-group">
                <textarea name="body" class="form-control" rows="2" placeholder="Pridať poznámku..." required></textarea>
                <div class="input-group-append">
                    <button class="btn btn-primary"><i class="fas fa-plus mr-1"></i>Uložiť</button>
                </div>
            </div>
        </form>
    </div>
</div>
