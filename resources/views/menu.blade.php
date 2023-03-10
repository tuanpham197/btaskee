<nav migration_allowed="1" migrated="0" role="navigation"
    class="elementor-nav-menu--main elementor-nav-menu__container elementor-nav-menu--layout-horizontal e--pointer-none">
    <ul id="menu-1-1131842" class="elementor-nav-menu">
        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-30780">
            <a class="elementor-item">Về bTaskee</a>
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
            <a class="elementor-item">Dịch vụ</a>
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
            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-32048" style="display:flex;align-items: center;justify-content: center;">
                <p class="elementor-item" style="margin:0">{{Auth::user()->username}}</p>
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
