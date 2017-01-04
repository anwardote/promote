<div class="gradTop">
    <div id="navWrap">
        <div class="container">
            <div id="mobileMenuBtn"><i class="fa fa-bars"></i></div>
            <div id="navigation-container">
                <div id="navMiniMobile"> <span> | <a href="{!! URL::route('users.selfprofile.edit') !!}">My Account</a><span> | </span><a href="#">Contact Us</a><span> | </span><a href="{!! URL::route('user.logout') !!}">Sign Out</a></div>
                <ul class="menu">                            
                    @if(isset($menu_items))
                    @foreach($menu_items as $item)
                    <li class="{!! LaravelAcl\Library\Views\Helper::get_active_route_name($item->getRoute()) !!}"> <a href="{!! $item->getLink() !!}">{!!$item->getName()!!}</a></li>
                    @endforeach
                    @endif
                </ul>    
            </div>
        </div>				
    </div>
</div>
</div>