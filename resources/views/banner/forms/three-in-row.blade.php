@if ($num_banners > 0 && isset($banners[0]))
    {!! $banners[0] !!}
@endif
@if ($num_banners > 1 && isset($banners[1]))
    {!! $banners[1] !!}
@endif
@if($num_banners > 2 && isset($banners[2]))
    {!! $banners[2] !!}
@endif