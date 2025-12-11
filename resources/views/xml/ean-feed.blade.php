@php echo '<?xml version="1.0" encoding="utf-8"?>'; @endphp
<products>
    @foreach($eans as $ean)
    <ean>{{ $ean }}</ean>
    @endforeach
</products>
