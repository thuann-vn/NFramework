<footer>
    <div class="footer-top-row">
        <div class="container">
            <div class="footer-top-wrap">
                <div class="email-us">
                    <i class="fas fa-envelope"></i>
                    <div class="inner-pad">
                        <a href="{{route('contact')}}">
                            <h4>{{__('frontend.footer.support.email_us')}}</h4>
                        </a>
                        <p>{{__('frontend.footer.support.email_description')}}</p>
                    </div>
                </div>

                <div class="live-chat">
                    <i class="far fa-comments"></i>
                    <div class="inner-pad">
                        <a href="#">
                            <h4>{{__('frontend.footer.support.live_chat')}}</h4>
                        </a>
                        <p>{{__('frontend.footer.support.live_chat_description')}}</p>
                    </div>
                </div>

                <div class="customer-help-center">
                    <i class="fas fa-headset"></i>
                    <div class="inner-pad">
                        <a href="/help">
                            <h4>{{__('frontend.footer.support.help_center')}}</h4>
                        </a>
                        <p>{{__('frontend.footer.support.help_center_description')}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-content">
        <div class="container">
            <div class="footer-content-row">
                <div class="footer-description">
                    {!! setting('footer.description') !!}
                </div>

                <div class="footer-subscribe-form">
                    <h4>{!! __('footer.subscribe_form.title') !!}</h4>

                    <form>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="email" id="txtEmailAddress" class="form-control input-sm" placeholder="Your Email" autocomplete="off" required="" style="font-size:12px;">
                                <div class="input-group-btn">
                                    <button id="quickSignUp" class="btn btn-sm btn-action-secondary" type="submit"><i class="fas fa-envelope"></i></button>
                                </div>
                            </div>
                            <div class="errorDisplay" style="display:none">Please enter a valid email address (e.g. name@domain.com)</div>
                        </div>
                    </form>
                </div>

                <div class="footer-social-links">
                    <h4>{!! __('footer.social_links.title') !!}</h4>

                    <a href="{{setting('site.facebook_url')}}"><i class="fab fa-facebook-f"></i></a>
                    <a href="{{setting('site.twitter_url')}}"><i class="fab fa-twitter"></i></a>
                    <a href="{{setting('site.youtube_url')}}"><i class="fab fa-youtube"></i></a>
                    <a href="{{setting('site.feed_url')}}"><i class="fas fa-rss"></i></a>
                </div>
            </div>

            <div class="footer-content-row">
                {{ menu('footer', 'partials.menus.footer') }}

                <div class="gift-card">
                    <h4>{!! __('footer.gift_cards.title') !!}</h4>
                    <p>{!! __('footer.gift_cards.description') !!}</p>
                </div>
            </div>
        </div>
    </div> <!-- end footer-content -->
</footer>
