{{$item->name}}
@if($item->created_by_parser)
    <span class="info-icon text-warning pl-2"
          data-toggle="popover"
          data-html="true"
          data-title="AI generované"
          data-content="Obsah produktu bol nájdený a uložený pomocou AI">
            <i class="fa-solid fa-wand-magic-sparkles"></i>
    </span>
@endif
