@extends('layouts.user')
@section('css')
    <style>
        #popUpModal img
        {
            width: 100%!important;
            height: auto!important;
            margin: 0!important;
        }
        .modal-body .close
        {
            position: absolute;
            right: 0;
            top: 0;
            border: unset;
            width: 25px;
            height: 25px;
            line-height: 28px;
            z-index: 999;
        }
        .modal-body .close span
        {
            display: inline-block;
            background: #fff;
            color: red;
            width: 25px;
            height: 25px;
            font-size: 20px;
        }
    </style>
<!-- Add the slick-theme.css if you want default styling -->
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<!-- Add the slick-theme.css if you want default styling -->
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
@endsection
@section('body')
    <div class=" mb-50px slider_menu">
        <div class="row row_slider_mobile">
            {{--slider--}}
            <div class="col-md-12">
                <div data-slick='{"slidesToShow": 1, "slidesToScroll": 1}' class="slider">
                    @foreach($sliders as $slider)
                        @if($slider->photo)
                            <div>
                                <a @if($slider->link!='#' and !is_null($slider->link)) href="{{$slider->link}}" {{$slider->new_page=='yes'?'target="_blank"':''}} rel="noopener" @else href="javascript:void(0);" @endif aria-label="{{$slider->title}}" >
                                    <img loading="lazy" src="{{url($slider->photo->path)}}" alt="{{$slider->title}}">
                                    {{--    <img loading="lazy" src="{{url($slider->photo->path)}}" class="img_cover" alt="{{$slider->title}}">--}}
                                </a>
                            </div>
                        @endif
                    @endforeach

                </div>


               {{-- <div class="vertical_slider swiper-container">
                    <div class="swiper-wrapper">
                        @foreach($sliders as $slider)
                            @if($slider->photo)
                                <div class="swiper-slide">
                                    <a @if($slider->link!='#' and !is_null($slider->link)) href="{{$slider->link}}" {{$slider->new_page=='yes'?'target="_blank"':''}} rel="noopener" @else href="javascript:void(0);" @endif aria-label="{{$slider->title}}" >
                                        <img loading="lazy" src="{{url($slider->photo->path)}}" alt="{{$slider->title}}">
                                    --}}{{--    <img loading="lazy" src="{{url($slider->photo->path)}}" class="img_cover" alt="{{$slider->title}}">--}}{{--
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
                </div>--}}

            </div>
        </div>
    </div>

{{--banner--}}
@if(count($banners)>0)
<section class="container-fluid px-md-4 px-2 mb-md-5 mb-3">
    <div class="row">
        @foreach($banners as $banner)
            @if($banner->photo && is_file($banner->photo->path))
                <div class="col-md-3 col-6 mt-2 mx-auto">
                    <a href="{{$banner->link}}" target="_blank" rel="noopener" title="{{$banner->brand}}">
                        <img loading="lazy" class="banner_img" src="{{url($banner->photo->path)}}" alt="{{$banner->brand}}">
                    </a>
                </div>
            @endif
        @endforeach
    </div>
</section>
@endif
{{-- slider_vip--}}
@if($slider_vip and $slider_vip->status=='active' and count($product_slider_vip)>0)
    <section class="container-fluid px-md-4 px-2 mb-md-5 mb-2 mt-md-5 mt-4 slider_sale">
        <div class="row">
            <div class="col-12 position-relative">
                <h3>{{$slider_vip->title}}</h3>
                <p class="p_orginal_color mb-0"></p>
                <!-- Add Arrows -->
                <div class="swiper-button-next s_vip_arrow">
                    <i class="fas fa-arrow-right"></i>
                </div>
                <div class="swiper-button-prev s_vip_arrow">
                    <i class="fas fa-arrow-left"></i>
                </div>
            </div>
            <div class="col-12 s_vip_product mt-4">
                <!-- Swiper -->
                <div class="s_vip_product_slider swiper-container">
                    <div class="swiper-wrapper">
                        @foreach($product_slider_vip as $model)
                            <div class="swiper-slide">
                                @include('includes.product.card_2',['model'=>$model])
                            </div>
                        @endforeach
                    </div>
                </div>

                <a href="{{route('products.vip',str_replace(' ','-',$slider_vip->title))}}" class="btn btn-site"><span>+</span> View more products</a>
            </div>
        </div>
    </section>
@endif
{{--new product--}}
@if(count($new_products)>0)
<section class="container-fluid px-md-4 px-2 mb-md-5 mb-2 mt-md-5 mt-4 slider_sale">
    <div class="row">
        <div class="col-12 position-relative">
            <h3>Latest Products</h3>
            <p class="p_orginal_color mb-0"><a href="{{route('products','all')}}">View all products <span>+</span></a></p>
            <!-- Add Arrows -->
            <div class="swiper-button-next new_arrow">
                <i class="fas fa-arrow-right"></i>
            </div>
            <div class="swiper-button-prev new_arrow">
                <i class="fas fa-arrow-left"></i>
            </div>
        </div>
        <div class="col-12 new_product mt-4">
            <!-- Swiper -->
            <div class="new_product_slider swiper-container">
                <div class="swiper-wrapper">
                    @foreach($new_products as $product)
                        <div class="swiper-slide">
                            @include('includes.product.card_1',['product'=>$product])
                        </div>
                    @endforeach
                </div>
            </div>

{{--            <a href="{{route('products','all')}}" class="btn btn-site"><span>+</span> View more products</a>--}}
        </div>
    </div>
</section>
@endif

    @if(count($banners2)>0)
        <section class="container-fluid px-md-4 px-2 mb-md-5 mb-3">
            <div class="row">
                @foreach($banners2 as $banner)
                    @if($banner->photo && is_file($banner->photo->path))
                        <div class="col-sm-6 mt-2 mx-auto">
                            <a href="{{$banner->link}}" target="_blank" rel="noopener" title="{{$banner->brand}}">
                                <img loading="lazy" class="banner_img" src="{{url($banner->photo->path)}}" alt="{{$banner->brand}}">
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
        </section>
    @endif

{{--why baffco--}}
<!--<section class="container-fluid px-md-4 px-2 mb-md-5 mb-2 mt-md-5 mt-4">-->
<!--    <div class="container-fluid why_digikolah">-->
<!--            <div class="why_div">-->
<!--                <h2 class="why">تولید به مصرف، حذف واسطه</h2>-->
<!--                <h1>{{App\Models\Setting::first()->title}}</h1>-->
<!--            </div>-->
<!--        <div class="row">-->
<!--            <div class="col-lg-6 d-flex align-items-center justify-content-start">-->
<!--                <img loading="lazy" src="{{url('source/assets/front/img/moneybag.svg')}}" alt="اجناس با کیفیت ارزان قیمت">-->
<!--                <div class="d-flex align-items-start justify-content-center flex-column">-->
<!--                    <h3>قیمت بسیار پایین</h3>-->
<!--                    <p>قیمتی که هرگز در جایی دیگر پیدا نخواهید کرد</p>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-lg-6 d-flex align-items-center justify-content-start">-->
<!--                <img loading="lazy" src="{{url('source/assets/front/img/hands.svg')}}" alt="پشتیبانی ۲۴ ساعته">-->
<!--                <div class="d-flex align-items-start justify-content-center flex-column">-->
<!--                    <h3>ساعت پاسخگویی پشتیبانی از  9 صبح تا 6 عصر</h3>-->
<!--                    <p>در هر مرحله‌ای همراه شما هستیم</p>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</section>-->
{{--vip product--}}
@if(count($product_vip)>0)
<section class="container-fluid px-md-4 px-2 mb-md-5 mb-2 mt-md-5 mt-4 slider_sale">
    <div class="row">
        <div class="col-12 position-relative">
            <h3>Special offers</h3>
            <p class="p_orginal_color mb-0"><a href="{{route('products.vip','vip')}}"><span>+</span> View more products</a></p>
            <!-- Add Arrows -->
            <div class="swiper-button-next vip_arrow">
                <i class="fas fa-arrow-right"></i>
            </div>
            <div class="swiper-button-prev vip_arrow">
                <i class="fas fa-arrow-left"></i>
            </div>
        </div>
        <div class="col-12 new_product mt-4">
            <!-- Swiper -->
            <div class="new_product_slider swiper-container">
                <div class="swiper-wrapper">
                    @foreach($product_vip as $product)
                        <div class="swiper-slide">
                            @include('includes.product.card_1',['product'=>$product])
                        </div>
                    @endforeach
                </div>
            </div>

            {{--<a href="{{route('products.vip','vip')}}" class="btn btn-site"><span>+</span> View more products</a>--}}
        </div>
    </div>
</section>
@endif
    @if(count($banners3)>0)
        <section class="container-fluid px-md-4 px-2 mb-md-5 mb-3">
            <div class="row">
                @foreach($banners3 as $banner)
                    @if($banner->photo && is_file($banner->photo->path))
                        <div class="col-sm-6 mt-2 mx-auto">
                            <a href="{{$banner->link}}" target="_blank" rel="noopener" title="{{$banner->brand}}">
                                <img loading="lazy" class="banner_img" src="{{url($banner->photo->path)}}" alt="{{$banner->brand}}">
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
        </section>
    @endif
{{--blog--}}
@if(count($articles)>0)
<section class="container-fluid px-md-4 px-2 mb-md-5 mb-2 mt-md-5 mt-4 articles">
    <div class="row">
        <div class="col-12 position-relative">
            <h3>blog
            {{--<a href="{{route('blogs')}}" class="btn btn-outline-primary"><span>+</span> view all</a>--}}
            </h3>
            <p class="p_orginal_color mb-0 text-center"><a href="{{route('blogs','all')}}">view all <span>+</span></a></p>
        </div>
        <div class="col-12 new_blog mt-4">
            <!-- Swiper -->
            <div class="new_blog_slider swiper-container">
                <div class="swiper-wrapper">
                    @foreach($articles as $article)
                    <div class="swiper-slide">
                        @include('includes.blog.card_1',['article'=>$article])
                    </div>
                    @endforeach
                </div>
                <!-- Add Arrows -->
                <div class="swiper-button-next blog_arrow">
                    <i class="fas fa-arrow-left"></i>
                </div>
                <div class="swiper-button-prev blog_arrow">
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
{{--<section class="container-fluid px-md-4 px-2 mb-md-5 mb-2 mt-md-5 mt-4 slider_sale">--}}
{{--<a href="{{route('sale.page')}}" class="btn btn-site"><i class="fas fa-shopping-cart"></i> خرید سریع </a>--}}
{{--</section>--}}

{{--    popup--}}
    @if($popupShow)

        <!-- Modal -->
        <div class="modal fade" id="popUpModal" data-backdrop="static" data-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {!! $popup->text !!}
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
@section('js')
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>
        $('.slider').slick({autoplay: true});
    </script>
    @if($popupShow)
        <script>
            $('#popUpModal').modal('show')
        </script>
    @endif
@endsection
