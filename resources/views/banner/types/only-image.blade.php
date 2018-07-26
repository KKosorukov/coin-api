<div style="position: relative;">
    <a href="{{ $banner->adv_url }}" style="display:block;">
        <img src="{{ url('banners/'.$banner->path) }}" style="max-width: {{ $container->width }}px; max-height: {{ $container->height }}px;"/>
    </a>
</div>