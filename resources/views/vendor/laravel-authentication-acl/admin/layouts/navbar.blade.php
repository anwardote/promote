<?php
$current_route = \Request::route()->getName();
$authentication = \App::make('authenticator');
$user = $authentication->getLoggedUser();
if ($user) {
    $user_group = strtolower($user->groups()->first()->name);
    if ($user_group !== "superadmin") {
    }
} else {
    ?>
    <style>
        #addtlLinks .up{visibility: hidden !important;}
    </style>
<?php } ?>
<style>

    .user-menu{display:none;padding: 0 !important;padding:0 !important;list-style:none;position: absolute;  border: 1px solid #ccc;background:#fff;z-index:999;margin:0;}
    #header #addtlLinks .user-menu a{padding:12px 6px;border-bottom: 1px solid #ccc;display:block; line-height: normal;text-align: center;}
    #header #addtlLinks .user-menu a:last-child{border-bottom:none;}
    #addtlLinks .fa{margin-left:5px;}
    #addtlLinks > a {cursor: pointer;}
    .up {background:url(/images/arrowDown.png) no-repeat right 10px;}
    .down {background:url(/images/arrowup.png) no-repeat right 10px;}

    #header #navWrap .sub-menu li:last-child a {
        border-bottom-right-radius: 25px;
    }

</style>
<div id="header">
    <div class="container">
        <a href="/" id="logo" >
            {{ HTML::image('images/website-logo.png', 'alt', array( 'class' => 'image-responsive-width image-responsive-height' )) }}
        </a>
        <div id="hdrRight" class="right">

            <div id="addtlLinks" class="nimbuzz">
                <a class="up">Welcome &nbsp;</a>
                <!--a>Welcome <i class="fa fa-caret-up" aria-hidden="true"></i></a-->
                <div class="user-menu">
                    @if(isset($menu_items))
                    @foreach($menu_items as $item)
                    <a class="{!! LaravelAcl\Library\Views\Helper::get_active_route_name($item->getRoute()) !!}" href="{!! $item->getLink() !!}">{!!$item->getName()!!}</a>
                    @endforeach
                    @endif
                    <a href="{!! URL::route('users.selfprofile.edit') !!}">My Account</a>
                    <a href="{!! URL::route('user.logout') !!}">Sign Out</a>
                </div>
            </div>
            <div style="clear:both;"></div>
        </div>
        <div style="clear:both;"></div>
    </div>
    <div class="gradTop">
        <div id="navWrap">
            <div class="container">
                <div id="mobileMenuBtn"><i class="fa fa-bars"></i></div>
                <div id="navigation-container">
                    <div id="navMiniMobile"> <a href="{!! URL::route('users.selfprofile.edit') !!}">My Account</a><span> | </span><a href="{!! URL::route('user.logout') !!}">Sign Out</a></div>
                    <ul class="menu">
                        <li <?php if (isset($current_route) && $current_route == "home"): ?>class="active"<?php endif; ?>><a href="/">Home</a><li>
                        <li <?php if (isset($current_route) && $current_route == "howtouse"): ?>class="active" <?php endif; ?>><a href="{{ route('howtouse') }}">How to Use</a><li>
                        <li <?php if (isset($current_route) && $current_route == "howtorecharge"): ?>class="active" <?php endif; ?>><a href="{{ route('howtorecharge') }}">How to Recharge</a><li>
                        <li <?php if (isset($current_route) && $current_route == "contact.form"): ?>class="active" <?php endif; ?>><a href="{!! URL::route('contact.form') !!}">Contact Us</a><li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>