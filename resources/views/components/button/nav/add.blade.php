<button id="{{ $id }}" value="confirm-user" type="button" data-target="{{ $target ?? null }}" data-toggle="modal" class="btn btn-sm btn-primary {{ $class ?? null }}">
    <i class="fa fa-plus"></i>
    {{ $text ?? __('app.add') }}
</button>
