<?php
$variables= json_decode($variables_values[1], true);
$result = (Object) $variables;
?>

<footer id="footer-bottom">
    <div class="container">
        <div class="row">
            <!--            <div class="col-md-6 col-sm-5">                
                            {{ HTML::image('images/footer-logo.jpg') }}
                        </div>-->
            <div class="col-md-6 col-sm-5">
                <p><strong>FOR INTERNAL USE ONLY</strong><br>
                @if(isset($result->copy_right) && !empty($result->copy_right))
                    {{ $result->copy_right }}
                @else
                    COPYRIGHT &copy; {{ date("Y") }} {!!Config::get('acl_base.app_name')!!} ALL RIGHTS RESERVED</p>
                @endif
                @if(isset($result->footer_address) && !empty($result->footer_address))
                    <div style="">

                        <?php echo  $result->footer_address; ?>
                    </div>
                @endif

            </div>
            <div class="col-md-6 col-sm-7">
                <p> <strong>Developed and Designed by <a href="https://www.facebook.com/rb.anwar" alt="Muhammad Anwar Hossen">Muhammad Anwar Hossen</a></strong></p>
                {{--<ul>--}}
                    {{--<li><a href="/consumer/privacy.html" target="_blank">Privacy Policy</a></li>--}}
                    {{--<li><a href="/consumer/terms.html" target="_blank">Terms of Use</a></li>--}}
                    {{--<li><a href="/consumer/disclaimers.html" target="_blank">Disclaimer</a></li>--}}
                    {{--<li><a href="/consumer/informed_consent.html" target="_blank">Informed Consent</a></li>--}}
                {{--</ul>--}}
            </div>
        </div>      
    </div><!-- /container -->
</footer>     
<!--/Footer-->
