<style>
    .overlay:hover {
        background-color: #d1d1d1;
        opacity: 0.9;
    }
</style>
<div style="position: relative; width: {{ $container->width }}px; height: {{ $container->height }}px;">
    <img src="{{ url('banners/'.$banner->path) }}" style="max-width: {{ $container->width }}px; max-height: {{ $container->height }}px;"/>
    <div class="overlay" style="width: 100%; height: 100%; position: absolute; top: 0; left: 0; transition: background 0.5s linear; text-align: left; opacity: 0; z-index: 100;">
        <a href="{{ $banner->adv_url }}" class="overlay-link" style="position: relative; top: 0; left: 0; color: #000; font-weight: bold; text-decoration: none; display: block; height: 100%; width: 100%;">{{ $banner->adv_text }}</a>
    </div>
</div>