{{$user->created_at? $user->created_at->format(config('system.datetime_format')): null;}}
@if($user->last_seen_at)
    <span class="info-icon text-warning pl-2"
          data-toggle="popover"
          data-html="true"
          data-title="Dátum posledného prihlásenia"
          data-content="{{$user->last_seen_at->format(config('system.datetime_format'))}}">
            <i class="fa-solid fa-right-to-bracket"></i>
    </span>
@endif
