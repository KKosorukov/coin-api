<style>
    .vertical li, .vertical div {
        float: none;
    }
</style>
<div class="vertical" style="width: {{ $container->width }}px;  height: {{ $container->height }}px;">
    {!! $content !!}
</div>