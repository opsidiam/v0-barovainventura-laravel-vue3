<div class="d-flex flex-wrap gap-1" style="max-width: 400px">
    @foreach($data as $key => $value)
        @if($key == 'token') @continue @endif

        <span class="badge badge-light mb-1 mr-2 p-1">
            @if(in_array($key, ['email', 'mail']))
                @php
                    $greeting = 'Dobrý deň' . (isset($data->name) ? ' ' . $data->name : '');
                    $encodedBody = rawurlencode($greeting);
                @endphp
                {{$key}}: <a href="mailto:{{$value}}?subject={{ rawurlencode('Barová inventúra') }}&body={{ $encodedBody }}">{{$value}}</a>
            @elseif(in_array($key, ['phone', 'telefon', 'mobil', 'telephone', 'mobile']))
                {{$key}}: <a href="tel:{{$value}}">{{$value}}</a>
            @elseif($key == 'created_at')
                {{$key}}: {{ \Carbon\Carbon::parse($value)->format('d.m.Y H:i') }}
            @else
                {{$key}}: {{$value}}
            @endif
        </span>
    @endforeach
</div>
