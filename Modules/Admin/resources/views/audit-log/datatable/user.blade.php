@if(isset($item->user))
{{$item->user->name}} {{$item->user->surname}} ({{$item->user->id}})
@else
-
@endif
