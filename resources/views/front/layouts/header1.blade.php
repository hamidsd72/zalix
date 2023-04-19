{{--slider && menu--}}
<header class="header_index p-md-3">
    <div class="container-fluid mb-50px slider_menu">
        <div class="row row_header_mobile">
            <div class="col-md-4">
                @if($setting->logo3_active=='active')
                    <a href="{{url('/')}}">
                        <img loading="lazy" class="float-right ml-3 logo bg-none h-60" src="{{url($setting->logo3)}}" alt="{{$sitename}}">
                    </a>
                    @else
                <a href="{{url('/')}}">
                    <img loading="lazy" class="float-right ml-3 logo rounded-circle" src="{{$logo}}" alt="{{$sitename}}">
                </a>
                <h5 class="float-right" style="height: 60px;display: flex;align-items: center;">
                    <img loading="lazy" class="float-right ml-3" src="{{$logo2}}" alt="{{$sitename}}" style="height: 100%">
                </h5>
                    @endif
            </div>
            <div class="col-md-8  p-2">
                @if(Auth::check())
                    <div id="profile-menu" class="loggedin">
                        <div class="d-flex align-items-center justify-content-between">
                            <div><i class="fas fa-user"></i><span>{{Auth::user()->first_name}}، خوش آمدید</span>
                            </div>
                            <i class="fas fa-angle-down mr-5"></i>
                        </div>
                        <ul>
                                <li><a href="{{route('index')}}"><i class="fas fa-home ml-1"></i><span>پنل مدیریت</span></a></li>
                                <li><a href="{{route('profile-show',Auth::user()->id)}}"><i class="fas fa-user"></i><span>پروفایل</span></a></li>
                            @if(auth()->user()->hasRole('User'))
                            <li><a href="{{route('order-list')}}"><i class="fas fa-shopping-cart"></i><span>پیگیری سفارشات</span></a></li>
                            @endif
                            <li><a href="{{route('favorites.list')}}"><i class="fas fa-heart"></i><span>لیست علاقه مندی ها</span></a></li>
                            @if($count_slot && auth()->check() && auth()->user()->hasRole('User') && auth()->user()->can('slot_game_active'))
                            <li><a href="{{route('slot.page')}}"><img loading="lazy" src="{{url('source/assets/slot_img/3.png')}}" class="slot_page" alt="add_slot"><span>بازی اسلات</span></a></li>
                            @endif
                                <li>
                                <form action="{{route('logout')}}" class="d-none" id="logout" method="post">{{ csrf_field() }}</form>
                                <a href="javascript:void(0)" onclick="$('#logout').submit()"><i class="fas fa-sign-out-alt"></i><span>خروج از حساب</span></a>
                            </li>
                        </ul>
                    </div>
                    @else
                <a href="{{route('auth')}}" class="login float-left mr-4 border border-light">
                    <i class="far fa-user fa-2x"></i>
                </a>
                @endif
                <a href="{{route('level_1')}}" class="cart float-left mr-4 border border-light">
                    <i class="fas fa-shopping-cart fa-2x"></i>
                        <div class="count_basket_2 count_basket_ajax {{$basket_count>0?'':'d-none'}}">{{$basket_count}}</div>
                </a>
                <form method="get" action="{{route('search')}}" id="search-form" class="float-left">
                    <input type="text" name="search" placeholder="جستجو در سایت" autocomplete="off">
                    <button type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
        <div class="row px-md-4 py-md-4 py-2 row_slider_mobile">
            {{--menu--}}
            <div class="col-md-3">
                <div class="menu_right">
                    <ul class="ul_menu_right">
                        @foreach($categories as $category)
                        <li>
                            <a href="{{route('products',$category->slug)}}">
                                {{$category->name}}
                                @if(count($category->children_act)>0)
                                    <i class="fas fa-chevron-left float-left"></i>
                                @endif
                            </a>
                            @if(count($category->children_act)>0)
                                    <div class=" container-fluid menu_right_in" style="width: {{count($category->children_act)*215}}px">
                                        <ul class="ul_menu_right_in">
                                            @foreach($category->children_act as $child1)
                                            <li class="li_menu_right_in"><a href="{{route('products',$child1->slug)}}">{{$child1->name}}</a>
                                                @if(count($child1->children_act)>0)
                                                    <ul class="ul_menu_right_in_2">
                                                        @foreach($child1->children_act as $child2)
                                                            <li class="li_menu_right_in_2"><a href="{{route('products',$child2->slug)}}">{{$child2->name}}</a> </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            {{--slider--}}
            <div class="col-md-9">
                <!-- Swiper -->
                <div class="vertical_slider swiper-container">
                    <div class="swiper-wrapper">
                        @foreach($sliders as $slider)
                            @if($slider->photo)
                                <div class="swiper-slide">
                                    <a @if($slider->link!='#' and !is_null($slider->link)) href="{{$slider->link}}" {{$slider->new_page=='yes'?'target="_blank"':''}} rel="noopener" @else href="javascript:void(0);" @endif aria-label="{{$slider->title}}" >
                                        <img loading="lazy" src="{{url($slider->photo->path)}}" alt="{{$slider->title}}">
                                        <img loading="lazy" src="{{url($slider->photo->path)}}" class="img_cover" alt="{{$slider->title}}">
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="swiper-controller">
                        <!-- Add Pagination -->
                        <div class="swiper-pagination"></div>
                        <!-- Add Arrows -->
                        <div class="swiper-button-next vertical_arrow">
                            <i class="fas fa-arrow-up"></i>
                        </div>
                        <div class="swiper-button-prev vertical_arrow">
                            <i class="fas fa-arrow-down"></i>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</header>
