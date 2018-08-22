<div class="banner" style="background: url('{{ url('banners/'.$banner->path) }}'); max-width: {{ $container->width }}px; background-size: cover; background-position: center center; background-repeat: no-repeat;">
    <span class="bubble main">{{ $banner->description }}</span>

    <div class="description">
        <div class="text">
            <span class="long-text">{{ $banner->adv_text }}</span>
            <span class="short-text">{{ $banner->description }}</span>
        </div>

        <a href='#' class="button" target="_blank">@php echo str_limit($banner->adv_url, 20); @endphp</a>
    </div>

    <div class="hover">

        <div class="description">
            <span class="bubble inner">Sale of roller skates roller skates Sale of rollerroller</span>
            <div class="text">
                <span class="long-text">{{ $banner->adv_text }}</span>
                <span class="short-text">{{ $banner->description }}</span>
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

            <a href='{{ $banner->adv_url }}' class="button" target="_blank">@php echo str_limit($banner->adv_url, 20); @endphp</a>
        </div>

    </div>
</div>