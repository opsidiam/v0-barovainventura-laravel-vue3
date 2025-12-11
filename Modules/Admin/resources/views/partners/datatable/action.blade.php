<div class="btn-group">
    @include('components.button.icon.add-licence', [
        'user' => $user,
        'modal' => $user->id,
        'text' => 'Licencia',
        'class' => 'btn-success'
    ])
    @include('components.button.icon.detail', [
        'url' => route('admin.users.show', $user),
    ])
    @include('components.button.icon.reset', [
        'url' => route('admin.users.reset.licence', $user),
        'text' => 'Zrušiť licenciu',
        'class' => 'btn-warning',
        'icon' => 'fas fa-rotate',
        'modal' => $user->id
    ])
    @if(Auth::user()->id != $user->id && $user->permission < 2)
        @include('components.button.icon.delete', [
            'url' => route('admin.users.destroy', $user),
            'modal' => $user->id
        ])
    @endif
</div>
