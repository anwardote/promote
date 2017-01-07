<footer id="footer-bottom">
    <div class="container">
        <div class="row">
            <!--            <div class="col-md-6 col-sm-5">                
                            {{ HTML::image('images/footer-logo.jpg') }}
                        </div>-->
            <div class="col-md-6 col-sm-5">
                <p><strong>FOR INTERNAL USE ONLY</strong><br>COPYRIGHT &copy; {{ date("Y") }} {!!Config::get('acl_base.app_name')!!} ALL RIGHTS RESERVED</p>
            </div>
            <div class="col-md-6 col-sm-7">
                <ul>
                    <li><a href="/consumer/privacy.html" target="_blank">Privacy Policy</a></li>
                    <li><a href="/consumer/terms.html" target="_blank">Terms of Use</a></li>
                    <li><a href="/consumer/disclaimers.html" target="_blank">Disclaimer</a></li>
                    <li><a href="/consumer/informed_consent.html" target="_blank">Informed Consent</a></li>
                </ul>
            </div>
        </div>      
    </div><!-- /container -->
</footer>     
<!--/Footer-->


<?php
print_r($status_values);
?>