<!-- Page Header -->
<div class="bg-body-light">
    <div class="content content-full py-2">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h3 font-w400 mt-2 mb-0 mb-sm-2">
                {{ Str::limit($title) }}
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                @isset($model)
                    {{ Breadcrumbs::render(request()->route()->getName(), $model) }}
                @endisset
                @empty($model)
                    {{ Breadcrumbs::render(request()->route()->getName()) }}
                @endempty
            </nav>
        </div>

        {{ $slot ?? '' }}

    </div>
</div>
<!-- END Page Header -->

@include('components.page.alerts')
