@php
    if (!isset($id)) {
        $id = Str::random(8);
    }
@endphp

@push('scripts')
    <script>
        // Turn off auto discovery
        Dropzone.autoDiscover = false;

        $(function () {

            var replace = $('#{{ $replace }}');

            // Attach dropzone on element
            $("#{{ $id }}").dropzone({
                url: "{{ route('admin.attachments.upload.image') }}",
                maxFilesize: {{ isset($maxFileSize) ? $maxFileSize : config('attachment.image.max_size', 1024) / 1024 }},
                acceptedFiles: "{!! isset($acceptedFiles) ? $acceptedFiles : config('attachment.image.allowed') !!}",
                paramName: "file",
                timeout: 0,
                params: {
                    _token: '{{ csrf_token() }}'
                },
                init: function () {
                    this.on("success", function (file, response) {
                        $('#upload-image-{{ $id }}').modal('hide');
                        replace.html(response.html);
                        window.main.initAfterAjaxResponse(replace);
                    });
                }
            });
        })
    </script>
@endpush

@push('modals')
    @component('components.modal.default', [
        'id' => 'upload-image-' . $id,
        'title' => __('app.upload_image'),
    ])

        {{ Form::open([
            'class'=>'dropzone',
            'id' => $id,
        ]) }}
            {{ Form::hidden('model', 'App\\' . class_basename($model)) }}
            {{ Form::hidden('model_id', $model->id) }}
            <div class="dz-message" data-dz-message><span>@lang('app.drop_files_here_to_upload')</span></div>
        {{ Form::close() }}

    @endcomponent
@endpush

@include('components.button.icon.create', [
	'id' => '#upload-image-' . $id,
	'text' => __('app.upload_image')
])

<div id="{{ $replace }}" class="mt-3">
    @include('components.image.edit', ['relpace' => $replace])
</div>

