<style>
    html, body {
        height: 100%;
    }
    .bannerContainer {
        width: {{ $container->width }}%;
        height: {{ $container->height }}%;
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#299b03+0,8f0222+44,0047ed+100 */
        background: #299b03; /* Old browsers */
        background: -moz-linear-gradient(left, #299b03 0%, #8f0222 44%, #0047ed 100%); /* FF3.6-15 */
        background: -webkit-linear-gradient(left, #299b03 0%,#8f0222 44%,#0047ed 100%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to right, #299b03 0%,#8f0222 44%,#0047ed 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#299b03', endColorstr='#0047ed',GradientType=1 ); /* IE6-9 */
        color: #ffffff;

    }
    .bannerContainer .overlay {
        width: {{ $container->width }}%;
        height: {{ $container->height }}%;
    }
</style>
<div class="bannerContainer">
    <strong>This is adaptive banner. Default size is 100%, but if you squeeze it, you'll see adaptive effect.</strong>
    <div class="overlay">
        <a href="#" class="overlay-link">Link</a>
    </div>
</div>