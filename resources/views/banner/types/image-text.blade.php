<div class="banner" style="background: url('{{ url('banners/'.$banner->path) }}'); background-size: cover; background-position: center center; background-repeat: no-repeat;">
    <span class="bubble main">{{ $banner->title }}</span>
    <div class="description">
        <div class="text">
            <span class="long-text">{{ $banner->adv_long_desc }}</span>
            <span class="short-text">{{ $banner->adv_short_desc }}</span>
        </div>
        <a href='#' class="button" onclick="location.href = '{{ $banner->adv_url }}';" data-track-content data-content-name="id-{{ $bannerId }}">@php echo substr($banner->adv_url, 0, 30).'...'; @endphp</a>
    </div>
    <div class="hover">
        <div class="description">
            <span class="bubble inner">{{ $banner->title }}</span>
            <div class="text">
                <span class="long-text">{{ $banner->adv_long_desc }}</span>
                <span class="short-text">{{ $banner->adv_short_desc }}</span>
            </div>
            <div class="links">
                <div class="left-side">
                    <a href="{{ $banner->additional_adv_url_1 }}" target="_blank">{{ $banner->additional_adv_url_desc_1 }}</a>
                    <a href="{{ $banner->additional_adv_url_2 }}" target="_blank">{{ $banner->additional_adv_url_desc_2 }}</a>
                </div>
                <div class="right-side">
                    <a href="{{ $banner->additional_adv_url_3 }}" target="_blank">{{ $banner->additional_adv_url_desc_3 }}</a>
                    <a href="{{ $banner->additional_adv_url_4 }}" target="_blank">{{ $banner->additional_adv_url_desc_4 }}</a>
                </div>
            </div>
            <a href='#' class="button" onclick="location.href = '{{ $banner->adv_url }}';" data-track-content data-content-name="id-{{ $bannerId }}">@php echo substr($banner->adv_url, 0, 30).'...'; @endphp</a>
        </div>
    </div>
</div>