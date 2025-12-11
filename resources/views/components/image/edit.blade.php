@if($media = $model->image())

    <div class="row" id="media-{{ $media->id }}">
        <div class="col-md-6 col-lg-4">
            <div class="block block-themed block-bordered">
                <div class="block-header">
                    <h3 class="block-title">{{ Str::limit($media->file_name, 50) }}</h3>
                    <div class="block-options">
                        @include('components.button.icon.remove-element', [
                            'url' => route('media-library.destroy', [$media->id]),
                            'target' => '#media-' . $media->id,
                            'class' => 'btn-block-option',
                            'description' => $media->file_name,
                            'title' => __('app.ask.remove_this_file'),
                        ])
                    </div>
                </div>
                <div class="block-content">
                    <img src="{{ asset($media->getUrl('thumb')) }}" class="{{ $class ?? 'img-fluid w-100' }}" alt="{{ $alt ?? '' }}">
                </div>
            </div>
        </div>
    </div>

@endif
