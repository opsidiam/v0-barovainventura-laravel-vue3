<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#{{ $modalId ?? 'uploadMedia' }}">
    <i class="fa fa-cloud-upload-alt"></i>
    {{ $text ?? __('app.upload_media') }}
</button>
