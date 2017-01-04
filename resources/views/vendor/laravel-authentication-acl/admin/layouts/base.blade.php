{{-- Layout base admin panel --}}
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" lang="en-US" >
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" lang="en-US">
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html lang="en-US">
    <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        {!! HTML::style('packages/jacopo/laravel-authentication-acl/css/bootstrap.min.css') !!}
        {!! HTML::style('packages/jacopo/laravel-authentication-acl/css/style.css') !!}
        {!! HTML::style('css/fonts.css') !!}
        {!! HTML::style('css/global.css') !!}
        {!! HTML::style('css/modify.css') !!}
        {!! HTML::style('packages/jacopo/laravel-authentication-acl/css/baselayout.css') !!}
        {!! HTML::style('packages/jacopo/laravel-authentication-acl/css/style_new.css') !!}
        {!! HTML::style('packages/jacopo/laravel-authentication-acl/css/fonts.css') !!}
        {!! HTML::style('//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css') !!}


        @yield('head_css')
        {{-- End head css --}}

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>       
        <![endif]-->
    </head>

    <body>
        {{-- navbar --}}
        @include('admin.layouts.navbar')

        {{-- content --}}
        <div class="container-fluid">
            @yield('container')
        </div>
        {{-- footer --}}
        @include('admin.layouts.footer')

        {{-- Start footer scripts --}}
        @yield('before_footer_scripts')

        {!! HTML::script('packages/jacopo/laravel-authentication-acl/js/vendor/jquery-1.10.2.min.js') !!}
        {!! HTML::script('packages/jacopo/laravel-authentication-acl/js/vendor/bootstrap.min.js') !!}
        {!! HTML::script('packages/jacopo/laravel-authentication-acl/js/vendor/custom-global.js') !!}
        {!! HTML::script('js/script.js') !!}
        @yield('footer_scripts')
        {{-- End footer scripts --}}

        @include('laravel-authentication-acl::admin.layouts.footer')
        <script>
            function sizeLeftMenuFiller() {
                var tmpOffset = jQuery("#navigation-container").offset();
                var newW = tmpOffset.left;
                jQuery("#navWrapLeftFiller").width(newW);
            }
            jQuery(document).ready(function () {
                jQuery(".gradTop").append('<div id="navWrapLeftFiller"></div>');
                sizeLeftMenuFiller();
                jQuery('#navWrap .sub-menu').hide();
                jQuery("#navWrap li:has(ul)").hover(function () {
                    jQuery(" ul", this).toggle('slow');
                });
            });
            jQuery(window).resize(function (e) {
                if (window.outerWidth > 850) {
                    sizeLeftMenuFiller();
                }
            });
        </script>
        <?php
        $current_route = \Request::route()->getName();
        $authentication = \App::make('authenticator');
        $user = $authentication->getLoggedUser();
        if (!$user) {
            ?>
            <script>
                $(document).ready(function () {
                    var loginurl = '<a href="{!! URL::route('user.login') !!}">Login</a>'
                    $("#addtlLinks").html(loginurl)
                })
            </script>

            <?php
        }
        ?>
    </body>
</html>