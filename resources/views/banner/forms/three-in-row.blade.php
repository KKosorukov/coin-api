<ul style="list-style: none; margin: 0; overflow: scroll;">
    @if ($num_banners > 0)
    <li style="width: {{ ($container->width / 3 - 5) }}px; height: auto;">
        {!! $banners[0]  !!}
    </li>
    @endif
    @if ($num_banners > 1)
    <li style="width: {{ ($container->width / 3 - 5) }}px; height: auto;">
        {!! $banners[1]  !!}
    </li>
    @endif
    @if($num_banners > 2)
    <li style="width: {{ ($container->width / 3 - 5) }}px; height: auto;">
        {!! $banners[2]  !!}
    </li>
    @endif
</ul>