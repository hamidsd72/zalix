{{--slider && menu--}}
<header class="header_index_2 p-md-3">
    <div class="container-fluid slider_menu_2">
        <div class="row row_header_mobile">
            <div class="col-md-4">
                @if($setting->logo3_active=='active')
                    <a href="{{url('/')}}">
                        <img loading="lazy" class="float-left ml-3 logo bg-none h-60" src="{{url($setting->logo3)}}" alt="{{$sitename}}">
                    </a>
                @else
                <a href="{{url('/')}}">
                    <img loading="lazy" class="float-left ml-3 logo rounded-circle" src="{{$logo}}" alt="{{$sitename}}">
                </a>
                <h5 class="float-right" style="height: 60px;display: flex;align-items: center;">
                    <img loading="lazy" class="float-left ml-3 rounded-circle" src="{{$logo2}}" alt="{{$sitename}}" style="height: 100%">
                </h5>
                    @endif
            </div>
            <div class="col-md-8 p-2">
                @if(Auth::check())
                    <div id="profile-menu" class="loggedin">
                        <div class="d-flex align-items-center justify-content-between">
                            <div><i class="fas fa-user"></i><span>{{Auth::user()->first_name}}، welcome</span>
                            </div>
                            <i class="fas fa-angle-down mr-5"></i>
                        </div>
                        <ul>
                                <li><a href="{{route('index')}}"><i class="fas fa-home ml-1"></i><span>control panel</span></a></li>
                                <li><a href="{{route('profile-show',Auth::user()->id)}}"><i class="fas fa-user"></i><span>profile</span></a></li>
                            @if(auth()->user()->hasRole('User'))
                                <li><a href="{{route('order-list')}}"><i class="fas fa-shopping-cart"></i><span>Track orders</span></a></li>
                            @endif
                            <li><a href="{{route('favorites.list')}}"><i class="fas fa-heart"></i><span>Favorites list</span></a></li>
                         {{--   @if($count_slot && auth()->check() && auth()->user()->hasRole('User') && auth()->user()->can('slot_game_active'))
                                <li><a href="{{route('slot.page')}}"><img loading="lazy" src="{{url('source/assets/slot_img/3.png')}}" class="slot_page" alt="add_slot"><span>بازی اسلات</span></a></li>
                            @endif--}}
                            <li>
                                <form action="{{route('logout')}}" class="d-none" id="logout" method="post">{{ csrf_field() }}</form>
                                <a href="javascript:void(0)" onclick="$('#logout').submit()"><i class="fas fa-sign-out-alt"></i><span>Sign out </span></a>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{route('auth')}}" class="login_2 float-right mr-4 border border-light">
                        <i class="far fa-user fa-2x"></i>
                    </a>
                @endif
                <a href="{{route('level_1')}}" class="cart_2 float-right mr-4 border border-light">
                    <i class="fas fa-shopping-cart fa-2x"></i>
                        <div class="count_basket_2 count_basket_ajax {{$basket_count>0?'':'d-none'}}">{{$basket_count}}</div>
                </a>
                <form method="get" action="{{route('search')}}" id="search-form_2" class="float-left">
                    <input type="text" name="search" placeholder="searching in site" autocomplete="off">
                    <button type="submit">
                        <i style="margin-top: 5px;" class="fas fa-search"></i>
                    </button>
                </form>
            </div>
            <div class="col-12 div_menu pt-3">
                <ul class="ul_menu d-flex mb-0">
                    @foreach($categories as $category)
                    <li class="li_menu">
                        <a class="a_menu" href="{{route('products',$category->slug)}}">
                            {{$category->name}}
                            @if(count($category->children_act)>0)
                                <i class="fas fa-chevron-down i_menu"></i>
                            @endif
                        </a>
                        @if(count($category->children_act)>0)
                        <div class="container_fluid div_menu_in_1">
                            <ul class="ul_menu_in_1">
                                @foreach($category->children_act as $child1)
                                <li class="li_menu_in_1">
                                    <a class="a_menu_in_1" href="{{route('products',$child1->slug)}}">{{$child1->name}}</a>
                                    @if(count($child1->children_act)>0)
                                    <ul class="ul_menu_in_2">
                                        <li class="li_menu_in_2">
                                            @foreach($child1->children_act as $child2)
                                            <a class="a_menu_in_2" href="{{route('products',$child2->slug)}}">_{{$child2->name}}</a>
                                            @endforeach
                                        </li>
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
    </div>
</header>
