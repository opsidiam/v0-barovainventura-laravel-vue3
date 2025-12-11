{{$item->method}} ({{$item->status}}) ({{$item->type}})
@if($item->success)
    <i class="fa-solid fa-circle-check text-success"></i>
@else
    <i class="fa-solid fa-circle-xmark text-danger"></i>
@endif
@if($item->request)
    <span class="hover-pop req-pop"
          data-id="{{ $item->id }}"
          title="Request"
          data-popover-url="{{ route('admin.data-table.auditLogPopover',$item->id) }}">
    <i class="fa-solid fa-code-pull-request text-success"></i>
  </span>
@endif
