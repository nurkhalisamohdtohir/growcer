@extends('front.layouts.app')

@section('content')
<section class="section-5 pt-3 pb-3 mb-3 bg-white">
    <div class="container">
        <div class="light-font">
            <ol class="breadcrumb primary-color mb-0">
                <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.home') }}">Home</a></li>
                <li class="breadcrumb-item active">Shop</li>
            </ol>
        </div>
    </div>
</section>

<section class="section-6 pt-5">
    <div class="container">
        <div class="row">            
            <div class="col-md-3 sidebar">
                <div class="sub-title">
                    <h2>Categories</h3>
                </div>
                
                <div class="card">
                    <div class="card-body">
                        @if(getCategories()->isNotEmpty())
                        @foreach (getCategories() as $category)
                        <div class="form-check mb-2">
                            <input {{ (in_array($category->id, $categoriesArray)) ? 'checked': '' }} class="form-check-input category-label" type="checkbox" name="category[]" value="{{ $category->id }}" id="brand-{{ $category->id }}">
                            <label class="form-check-label" for="flexCheckDefault">
                                {{ $category->name }}
                            </label>
                        </div>
                        @endforeach
                        @endif                 
                    </div>
                </div>

                <div class="sub-title mt-5">
                    <h2>Brand</h3>
                </div>
                
                <div class="card">
                    <div class="card-body" style="max-height: 300px; overflow-y: auto;">
                        @if($brands->isNotEmpty())
                        @foreach ($brands as $brand)
                        <div class="form-check mb-2">
                            <input {{ (in_array($brand->id, $brandsArray)) ? 'checked': '' }} class="form-check-input brand-label" type="checkbox" name="brand[]" value="{{ $brand->id }}" id="brand-{{ $brand->id }}">
                            <label class="form-check-label" for="flexCheckDefault">
                                {{ $brand->name }}
                            </label>
                        </div>
                        @endforeach
                        @endif                 
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row pb-3">

                    @if ($products->isNotEmpty())
                    @foreach ($products as $product)
                    <div class="col-md-3">
                        <div class="card product-card" style="height: 320px;">
                            <div class="product-image position-relative">
                                <a href="" class="product-img"><img class="card-img-top" src="{{ asset('admin-assets/image/' . $product->image) }}" alt=""></a>
                                <a class="whishlist" href="222"><i class="far fa-heart"></i></a>                            

                                <div class="product-action">
                                    <a class="btn btn-dark" href="javascript:void(0);" onclick="addToCart({{ $product->id }});">
                                        <i class="fa fa-shopping-cart"></i> Add To Cart
                                    </a>                            
                                </div>
                            </div>                        
                            <div class="card-body text-center mt-3">
                                <a class="h6 link" href="product.php">{{ $product->name }}</a>
                                <div class="price mt-2">
                                    <span class="h6"><strong>RM {{ number_format($product->price, 2) }}</strong></span>
                                </div>
                            </div>                        
                        </div>                                               
                    </div> 
                    @endforeach
                    @endif

                    <div class="col-md-12 pt-5">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('customJs')
<script>
    $(".category-label").change(function(){
        apply_filter_categories();
    });

    function apply_filter_categories() {
        var categories = [];

        $(".category-label").each(function(){
            if ($(this).is(":checked") == true) {
                categories.push($(this).val());
            }
        });

        var url = '{{ url()->current() }}?';
        window.location.href = url+'&category='+categories.toString();
    }

    $(".brand-label").change(function(){
        apply_filter_brands();
    });

    function apply_filter_brands() {
        var brands = [];

        $(".brand-label").each(function(){
            if ($(this).is(":checked") == true) {
                brands.push($(this).val());
            }
        });

        var url = '{{ url()->current() }}?';
        window.location.href = url+'&brand='+brands.toString();
    }
    
</script>
@endsection