@extends('front.layouts.app')

@section('content')
<section class="section-1">
    <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel" style="border-bottom: 3px solid tomato;">
        <div class="carousel-inner" style="height:420px">
            <div class="carousel-item active">
                <picture>
                    <img src="{{ asset('front-assets/images/carousel1.jpg') }}" alt="" />
                </picture>
            </div>
            <div class="carousel-item">
                <picture>
                    <img src="{{ asset('front-assets/images/carousel2.jpg') }}" alt="" />
                </picture>
            </div>
            <div class="carousel-item">
                <picture>
                    <img src="{{ asset('front-assets/images/carousel3.jpg') }}" alt="" />
                </picture>
            </div>
            <div class="carousel-item">
                <picture>
                    <img src="{{ asset('front-assets/images/carousel4.jpg') }}" alt="" />
                </picture>
            </div>
            <div class="carousel-item">
                <picture>
                    <img src="{{ asset('front-assets/images/carousel5.jpg') }}" alt="" />
                </picture>
            </div>
            <div class="carousel-item">
                <picture>
                    <img src="{{ asset('front-assets/images/carousel6.jpg') }}" alt="" />
                </picture>
            </div>
        </div>
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="5"></button>
          </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true" ></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>
<section class="section-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="box shadow-lg">
                    <div class="fa icon fa-check text-primary m-0 mr-3"></div>
                    <h2 class="font-weight-semi-bold m-0">Quality Product</h5>
                </div>                    
            </div>
            <div class="col-lg-3 ">
                <div class="box shadow-lg">
                    <div class="fa icon fa-shipping-fast text-primary m-0 mr-3"></div>
                    <h2 class="font-weight-semi-bold m-0">Free Shipping</h2>
                </div>                    
            </div>
            <div class="col-lg-3">
                <div class="box shadow-lg">
                    <div class="fa icon fa-exchange-alt text-primary m-0 mr-3"></div>
                    <h2 class="font-weight-semi-bold m-0">14-Day Return</h2>
                </div>                    
            </div>
            <div class="col-lg-3 ">
                <div class="box shadow-lg">
                    <div class="fa icon fa-phone-volume text-primary m-0 mr-3"></div>
                    <h2 class="font-weight-semi-bold m-0">24/7 Support</h5>
                </div>                    
            </div>
        </div>
    </div>
</section>
<section class="section-3">
    <div class="container">
        <div class="section-title">
            <h2>Categories</h2>
        </div>           
        <div class="row pb-3">
            <div class="col-lg-3">
                <div class="cat-card">
                    <div class="left">
                        <img src="{{ asset('admin-assets/image/fresh1.jpg') }}" alt="" class="img-fluid">
                    </div>
                    <div class="right">
                        <div class="cat-data">
                            <h2>Fresh Food</h2>
                            <p>100 Products</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="cat-card">
                    <div class="left">
                        <img src="{{ asset('admin-assets/image/frozen1.jpg') }}" alt="" class="img-fluid">
                    </div>
                    <div class="right">
                        <div class="cat-data">
                            <h2>Frozen & Chilled</h2>
                            <p>100 Products</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="cat-card">
                    <div class="left">
                        <img src="{{ asset('admin-assets/image/grocery1.jpg') }}" alt="" class="img-fluid">
                    </div>
                    <div class="right">
                        <div class="cat-data">
                            <h2>Groceries</h2>
                            <p>100 Products</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="cat-card">
                    <div class="left">
                        <img src="{{ asset('admin-assets/image/hb1.jpg') }}" alt="" class="img-fluid">
                    </div>
                    <div class="right">
                        <div class="cat-data">
                            <h2>Health & Beauty</h2>
                            <p>100 Products</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="cat-card">
                    <div class="left">
                        <img src="{{ asset('admin-assets/image/hh1.jpg') }}" alt="" class="img-fluid">
                    </div>
                    <div class="right">
                        <div class="cat-data">
                            <h2>Household</h2>
                            <p>100 Products</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection