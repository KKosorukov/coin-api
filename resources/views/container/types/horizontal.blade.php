<style>
    .horizontal li, .horizontal div {
        float: left;
    }
</style>
<div class="horizontal" style="width: {{ $container->width }}px;  height: {{ $container->height }}px;">
    {!! $content !!}
</div>