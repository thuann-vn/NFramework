@if(!empty(setting('site.promo_message')))
    <div class="promo-information">
        <div class="container">
            {!!  setting('site.promo_message') !!}
        </div>
    </div>
@endif