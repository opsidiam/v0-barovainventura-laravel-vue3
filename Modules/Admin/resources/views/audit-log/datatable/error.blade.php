{{$item->error}}
@if(!empty($item->error_trace))
    <span class="hover-pop trace-pop ml-2"
          data-id="{{ $item->id }}"
          title="Error trace"
          data-popover-url="{{ route('admin.data-table.auditLogErrorTrace',$item->id) }}">
    <i class="fa-solid fa-bug text-danger"></i>
  </span>
@endif
