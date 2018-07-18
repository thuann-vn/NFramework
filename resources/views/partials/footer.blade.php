<footer>
    <div class="footer-top-row">
        <div class="container">
            <div class="footer-top-wrap">
                <div class="email-us">
                    <i class="fas fa-envelope"></i>
                    <div class="inner-pad">
                        <a href="{{route('contact')}}">
                            <h4>Email Us</h4>
                        </a>
                        <p>We’ll reply within one business day.</p>
                    </div>
                </div>

                <div class="live-chat">
                    <i class="far fa-comments"></i>
                    <div class="inner-pad">
                        <a href="#">
                            <h4>Live Chat</h4>
                        </a>
                        <p>The quickest way to get help.</p>
                    </div>
                </div>

                <div class="customer-help-center">
                    <i class="fas fa-headset"></i>
                    <div class="inner-pad">
                        <a href="/help">
                            <h4>Customer Help Center</h4>
                        </a>
                        <p>Find answers online.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-content container">
        <div class="made-with">Made with <i class="fa fa-heart heart"></i> by Andre Madarang</div>
        {{ menu('footer', 'partials.menus.footer') }}
    </div> <!-- end footer-content -->
</footer>
