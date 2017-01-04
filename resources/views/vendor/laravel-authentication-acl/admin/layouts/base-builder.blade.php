{{-- Layout base admin panel --}}
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="">


        {!! HTML::style('packages/jacopo/laravel-authentication-acl/css/bootstrap.min.css') !!}
        {!! HTML::style('css/modify.css') !!}
        {!! HTML::style('css/global.css') !!}
        {!! HTML::style('packages/jacopo/laravel-authentication-acl/css/style.css') !!}
        {!! HTML::style('packages/jacopo/laravel-authentication-acl/css/baselayout.css') !!}
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
        @include('laravel-authentication-acl::admin.layouts.navbar')

        {{-- content --}}

        @yield('container')


        {{-- Start footer scripts --}}
        @yield('before_footer_scripts')

        {!! HTML::script('packages/jacopo/laravel-authentication-acl/js/vendor/jquery-1.10.2.min.js') !!}
        {{-- HTML::script('packages/jacopo/laravel-authentication-acl/js/vendor/bootstrap.min.js') --}}
        {!! HTML::script('http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js') !!}
{!! HTML::script('js/script.js') !!}
        @yield('footer_scripts')
        @include('laravel-authentication-acl::admin.layouts.footer')
        {{-- End footer scripts --}}
        <script>
            function sizeLeftMenuFiller() {
                var tmpOffset = jQuery("#navigation-container").offset();
                var newW = tmpOffset.left;
                jQuery("#navWrapLeftFiller").width(newW);
            }
            jQuery(document).ready(function () {
                jQuery(".gradTop").append('<div id="navWrapLeftFiller"></div>');
                sizeLeftMenuFiller();
            });
            jQuery(window).resize(function (e) {
                if (window.outerWidth > 850) {
                    sizeLeftMenuFiller();
                }
            });
        </script>
    </body>
</html>