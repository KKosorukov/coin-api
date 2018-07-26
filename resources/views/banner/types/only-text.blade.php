<style>
    .overlay:hover {
        background-color: #d1d1d1;
        opacity: 0.9;
    }
</style>
<div style="position: relative;">
    <div class="overlay" style="width: 100%; height: 100%; position: absolute; top: 0; left: 0; transition: background 0.5s linear; text-align: left; opacity: 0;">
        <a href="{{ $banner->adv_url }}" class="overlay-link" style="position: relative; top: 0; left: 0; color: #000; font-weight: bold; text-decoration: none; display: block; height: 100%; width: 100%;">{{ $banner->adv_text }}</a>
    </div>
</div>