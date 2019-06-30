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
