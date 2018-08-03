@if(isVietnamese() && !empty(setting('home.promo_message_vi')))
    <div class="promo-information">
        <div class="container">
            {!!  setting('home.promo_message_vi') !!}
        </div>
    </div>
@elseif(!empty(setting('home.promo_message')))
    <div class="promo-information">
        <div class="container">
            {!!  setting('home.promo_message') !!}
        </div>
    </div>
@endif