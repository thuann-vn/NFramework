<div class="language-bar">
    @if(isVietnamese())
        <a class="language-toggle" href="{{route('lang.switch', ['lang'=> 'en'])}}">
            <img src="/img/languages/US.gif" height="20"/> English
        </a>
    @else
        <a class="language-toggle" href="{{route('lang.switch', ['lang'=> 'vi'])}}">
            <img src="/img/languages/VN.gif" height="20"/> Tiếng Việt
        </a>
    @endif
</div>

@if(isVietnamese() && !empty(setting('site.site_top_message_vi')))
    <div class="top-information">
        <div class="container">
            {!!  setting('site.site_top_message_vi') !!}
        </div>
    </div>
@elseif(!isVietnamese() && !empty(setting('site.site_top_message')))
    <div class="top-information">
        <div class="container">
            {!!  setting('site.site_top_message') !!}
        </div>
    </div>
@endif