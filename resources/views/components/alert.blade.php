<div class="alert alert-{{ $type }} d-flex align-items-center m-0" role="alert">
    <div class="flex-00-auto">
        @switch($type)
            @case('primary')
            <i class="fa fa-fw fa-globe"></i>
            @break

            @case('success')
            <i class="fa fa-fw fa-check"></i>
            @break

            @case('warning')
            <i class="fa fa-fw fa-exclamation-circle"></i>
            @break

            @case('danger')
            <i class="fa fa-fw fa-times-circle"></i>
            @break

            @case('info')
            <i class="fa fa-fw fa-info-circle"></i>
            @break
        @endswitch
    </div>
    <div class="flex-fill ml-3">
        <p class="mb-0">{{ $message }}</p>
    </div>
    {{-- <div class="flex-00-auto">
        <button type="button" class="close" data-dismiss="alert" aria-label="@lang('app.close')">
            <span aria-hidden="true">×</span>
        </button>
    </div> --}}
</div>
