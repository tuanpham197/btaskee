<nav migration_allowed="1" migrated="0" role="navigation"
    class="elementor-nav-menu--main elementor-nav-menu__container elementor-nav-menu--layout-horizontal e--pointer-none">
    <ul id="menu-1-1131842" class="elementor-nav-menu">
        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-30780">
            <style>
                .sub-arrow {
                    display: none !important;
                }
                .elementor-item {
                    display: flex;
                    align-items: center;
                }
                .mt-2 {
                    margin-top: 8px;
                    margin-left: 4px;

                }
            </style>
            <a class="elementor-item">Về bTaskee <span class="mt-2"><img src="{{asset('/images/down.png')}}" alt=""></span></a>
            <ul class="sub-menu elementor-nav-menu--dropdown">
                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-30781">
                    <a href="/about" class="elementor-sub-item">Giới thiệu</a>
                </li>
                <li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-44882">
                    <a href="/info" class="elementor-sub-item">Thông cáo báo chí</a>
                </li>
                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-30782">
                    <a href="/contact" class="elementor-sub-item">Liên hệ</a>
                </li>
            </ul>
        </li>
        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-30783">
            <a class="elementor-item">Dịch vụ  <span class="mt-2"><img src="{{asset('/images/down.png')}}" alt=""></span></a>
            <ul class="sub-menu elementor-nav-menu--dropdown">
                @foreach ($services as $item)
                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-30784">
                        <a href="/services/{{$item->id}}" class="elementor-sub-item">{{$item->name}}<sup class="tet_service">Hot</sup></a>
                    </li>
                @endforeach
            </ul>
        </li>
        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-30797">
            <a href="/reward" class="elementor-item">bRewards</a>
        </li>
        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-30797">
            <a href="/booking" class="elementor-item">Đặt dịch vụ</a>
        </li>
        @auth
            <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-30780" style="display:flex;align-items: center;justify-content: center;">
                <a class="elementor-item">{{Auth::user()->username}}</a>
                <ul class="sub-menu elementor-nav-menu--dropdown" style="text-align:center;">
                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-30781">
                        <a href="{{route('switch-voucher')}}" class="elementor-sub-item">Đổi voucher</a>
                    </li>
                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-30781">
                        <p class="elementor-sub-item">Bạn đang có {{$point ?? 0}} điểm</p>
                    </li>
                </ul>
            </li>


            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-32048" style="display:flex;align-items: center;">
                <a href="/logout" class="elementor-item">Đăng xuất</a>
            </li>
        @endauth
        @guest
            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-32048" style="display:flex;align-items: center;">
                <a href="/login" class="elementor-item">Đăng nhập</a>
            </li>
        @endguest
    </ul>
</nav>
<style>
    . elementor-nav-menu--dropdown li:hover p{
        background: none;
    }

    .elementor-nav-menu--dropdown .elementor-item.elementor-item-active, .elementor-nav-menu--dropdown .elementor-item.highlighted, .elementor-nav-menu--dropdown .elementor-item:focus, .elementor-nav-menu--dropdown .elementor-item:hover, .elementor-sub-item.elementor-item-active, .elementor-sub-item.highlighted, .elementor-sub-item:focus, .elementor-sub-item:hover {
        background-color: #fff !important;
        color: #333;
    }
</style>
