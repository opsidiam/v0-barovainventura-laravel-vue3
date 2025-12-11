{{($user->name ?? null) . ' ' . ($user->surname ?? null)}}
@if($user->reference)
    <span class="info-icon text-warning pl-2"
          data-toggle="popover"
          data-html="true"
          data-title="Odkiaľ ste sa o nás dozvedeli?"
          data-content="{{$user->reference}}">
            <i class="fa-solid fa-asterisk"></i>
    </span>
@endif
@if($user->invoice_phone)
    <span class="info-icon text-success pl-2"
          data-toggle="popover"
          data-html="true"
          data-title="Telefónne číslo"
          data-content="{{$user->invoice_phone}}">
            <i class="fa-solid fa-mobile-phone"></i>
    </span>
@endif
