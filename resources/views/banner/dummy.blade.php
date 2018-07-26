<style>
    .dummy-template {
        width: {{$width}}px;
        height: {{$height}}px;
        z-index: 100;
        position: absolute;
        top: 0;
        background: -moz-linear-gradient(45deg, rgba(255,0,0,1) 0%, rgba(255,255,0,1) 25%, rgba(5,193,255,1) 50%, rgba(255,255,0,1) 75%, rgba(255,0,0,1) 100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left bottom, right top, color-stop(0%, rgba(255,0,0,1)), color-stop(25%, rgba(255,255,0,1)), color-stop(50%, rgba(5,193,255,1)), color-stop(75%, rgba(255,255,0,1)), color-stop(100%, rgba(255,0,0,1))); /* safari4+,chrome */
        background: -webkit-linear-gradient(45deg, rgba(255,0,0,1) 0%, rgba(255,255,0,1) 25%, rgba(5,193,255,1) 50%, rgba(255,255,0,1) 75%, rgba(255,0,0,1) 100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(45deg, rgba(255,0,0,1) 0%, rgba(255,255,0,1) 25%, rgba(5,193,255,1) 50%, rgba(255,255,0,1) 75%, rgba(255,0,0,1) 100%); /* opera 11.10+ */
        background: -ms-linear-gradient(45deg, rgba(255,0,0,1) 0%, rgba(255,255,0,1) 25%, rgba(5,193,255,1) 50%, rgba(255,255,0,1) 75%, rgba(255,0,0,1) 100%); /* ie10+ */
        background: linear-gradient(45deg, rgba(255,0,0,1) 0%, rgba(255,255,0,1) 25%, rgba(5,193,255,1) 50%, rgba(255,255,0,1) 75%, rgba(255,0,0,1) 100%); /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ff0000', endColorstr='#ff0000',GradientType=1 ); /* ie6-9 */
    }
</style>
<div class="dummy-template">
    {{ $text }}
</div>