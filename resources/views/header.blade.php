<div data-elementor-type="header" data-elementor-id="33182"
class="elementor elementor-33182 elementor-location-header">
<div class="elementor-section-wrap">
    <header
        class="elementor-section elementor-top-section elementor-element elementor-element-ae6062b elementor-section-content-middle elementor-section-boxed elementor-section-height-default elementor-section-height-default"
        data-id="ae6062b" data-element_type="section"
        data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;sticky&quot;:&quot;top&quot;,&quot;sticky_on&quot;:[&quot;desktop&quot;,&quot;tablet&quot;,&quot;mobile&quot;],&quot;sticky_offset&quot;:0,&quot;sticky_effects_offset&quot;:0}">
        <div class="elementor-container elementor-column-gap-default">
            <div class="elementor-row">
                <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-fb9cab7"
                    data-id="fb9cab7" data-element_type="column">
                    <div class="elementor-column-wrap elementor-element-populated">
                        <div class="elementor-widget-wrap">
                            <div class="elementor-element elementor-element-d336270 elementor-widget elementor-widget-image"
                                data-id="d336270" data-element_type="widget" id="redirectLangHome"
                                data-widget_type="image.default">
                                <div class="elementor-widget-container">
                                    <div class="elementor-image"> <a href="{{route('home')}}"> <img width="154"
                                                height="40"
                                                src="https://www.btaskee.com/wp-content/uploads/2020/11/logo_btaskee_ver_3.png"
                                                class="attachment-full size-full" alt="logo_btaskee_ver_3"
                                                > </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <nav class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-d50051f"
                    data-id="d50051f" data-element_type="column">
                    <div class="elementor-column-wrap elementor-element-populated">
                        <div class="elementor-widget-wrap">
                            <div class="elementor-element elementor-element-1131842 elementor-nav-menu__align-justify elementor-nav-menu--stretch menu_mobile elementor-nav-menu--dropdown-tablet elementor-nav-menu__text-align-aside elementor-nav-menu--toggle elementor-nav-menu--burger elementor-widget elementor-widget-nav-menu"
                                data-id="1131842" data-element_type="widget"
                                data-settings="{&quot;full_width&quot;:&quot;stretch&quot;,&quot;submenu_icon&quot;:{&quot;value&quot;:&quot;&lt;i class=\&quot;fas fa-chevron-down\&quot;&gt;&lt;\/i&gt;&quot;,&quot;library&quot;:&quot;fa-solid&quot;},&quot;layout&quot;:&quot;horizontal&quot;,&quot;toggle&quot;:&quot;burger&quot;}"
                                data-widget_type="nav-menu.default">
                                <div class="elementor-widget-container">
                                   @include('menu')
                                    <div class="elementor-menu-toggle" role="button" tabindex="0"
                                        aria-label="Menu Toggle" aria-expanded="false"> <img src="{{asset('/images/menu.png')}}" alt=""> <span
                                            class="elementor-screen-only">Menu</span></div>
                                    <nav class="elementor-nav-menu--dropdown elementor-nav-menu__container"
                                        role="navigation" aria-hidden="true">
                                        <ul id="menu-2-1131842" class="elementor-nav-menu">
                                            <li
                                                class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-30780">
                                                <a class="elementor-item" tabindex="-1">Về bTaskee <span class="mt-2"><img src="{{asset('/images/down.png')}}" alt=""></span></a>
                                                <ul class="sub-menu elementor-nav-menu--dropdown">
                                                    <style>
                                                        .menu-item {
                                                            cursor: pointer;
                                                        }
                                                    </style>
                                                    <li
                                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-30781">
                                                        <a href="/about" class="elementor-sub-item">Giới thiệu</a>
                                                    </li>
                                                    <li
                                                        class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-44882">
                                                        <a href="/info" class="elementor-sub-item">Thông cáo báo chí</a>
                                                    </li>
                                                    <li
                                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-30782">
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
                                            <li
                                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-30797">
                                                <a href="https://www.btaskee.com/brewards/"
                                                    class="elementor-item" tabindex="-1">bRewards</a>
                                            </li>
                                            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-30797">
                                                <a href="/booking" class="elementor-item">Đặt dịch vụ</a>
                                            </li>
                                            @auth
                                                <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-30780" style="display:flex;align-items: center;justify-content: center;">
                                                    <a class="elementor-item">{{Auth::user()->username}}</a>
                                                    <ul class="sub-menu elementor-nav-menu--dropdown">
                                                        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-30781">
                                                            <a href="{{route('switch-voucher')}}" class="elementor-sub-item">Đổi voucher</a>
                                                        </li>
                                                        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-30781">
                                                            Bạn đang có: {{}} point
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
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>
</div>
</div>
