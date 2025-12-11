<li class="nav-main-item">

    {!! Form::open(['url'=>$url,'method'=>'POST','class'=>'inline', 'data-submit-selected'=>$target]) !!}

    @isset($variables)
        @foreach ($variables as $key => $value)
            {{ Form::hidden($key, $value) }}
        @endforeach
    @endisset

    <button type="submit" class="nav-main-link">
        <i class="nav-main-link-icon {{ $icon ?? 'fas fa-file-excel' }}"></i>
        <span class="nav-main-link-name">{{ $text ?? __('app.download.xls') }}</span>
    </button>

    {!! Form::close() !!}

</li>
