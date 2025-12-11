@if (session('primary'))
    <div class="content content-full pb-0">
        @include('components.alert', [
            'type' => 'primary',
            'message' => session('primary'),
        ])
    </div>
@endif

@if (session('success'))
    <div class="content content-full pb-0">
        @include('components.alert', [
            'type' => 'success',
            'message' => session('success'),
        ])
    </div>
@endif

@if (session('warning'))
    <div class="content content-full pb-0">
        @include('components.alert', [
            'type' => 'warning',
            'message' => session('warning'),
        ])
    </div>
@endif

@if (session('danger'))
    <div class="content content-full pb-0">
        @include('components.alert', [
            'type' => 'danger',
            'message' => session('danger'),
        ])
    </div>
@endif

@if (session('info'))
    <div class="content content-full pb-0">
        @include('components.info', [
            'type' => 'danger',
            'message' => session('info'),
        ])
    </div>
@endif

@if ($errors->any())
    <div class="content content-full pb-0">
        @include('components.alert', [
            'type' => 'danger',
            'message' => implode('<br />', $errors->all()),
        ])
    </div>
@endif


