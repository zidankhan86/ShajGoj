@extends('frontend.master')

  @section('content')


<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-5">
                <div class="sidebar">
                    <div class="sidebar__item">
                        <h4>Department</h4>
                        <ul>
                            @foreach ($latestCategories as $category)
                            <li><a href="{{ url('/category',$category->id) }}">{{$category->type}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                   
                    <div class="sidebar__item">
                        <div class="latest-product__text">
                            <h4>Latest Products</h4>
                            <div class="latest-product__slider owl-carousel">
                                <div class="latest-prdouct__slider__item">
                                    @foreach ($latestProducts as $item)
                                    <a href="#" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <a href="{{url('/product-details',$item->id)}}"> <img src="{{ asset('/public/uploads/' . $item->image) }}" alt="Product Image"></a>
                                        </div><br><br><br>
                                        <div class="latest-product__item__text">
                                            <h6>{{ $item->name }}</h6>
                                            <span>{{ $item->price }} Tk</span>
                                        </div>
                                    </a>
                                    @endforeach
                                   
                                </div>
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-7">
                <div class="product__discount">
                    <div class="section-title product__discount__title">
                        <h2>Sale Off</h2>
                    </div>
                    <div class="row">
                        <div class="product__discount__slider owl-carousel">

                            @foreach ($products_has_discount as $sale)
                            <div class="col-lg-4">
                                <div class="product__discount__item">
                                    <div class="product__discount__item__pic set-bg"
                                        data-setbg="{{ asset('/public/uploads/' . $sale->image) }}">
                                        <div class="product__discount__percent">-{{$sale->discount}}%</div>
                                        <ul class="product__item__pic__hover">
                                            <li><a href="{{url('/product-details',$sale->id)}}"><i class="fa fa-eye"></i></a></li>
                                            <li><a href="{{route('add.to.cart',$sale->id)}}"><i class="fa fa-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__discount__item__text">
                                        <span>{{$sale->ProductCategory->type}}</span>
                                        <h5>{{$sale->name}}</h5>
                                      
                                   
                                    <h5 style="color: rgb(214, 57, 17)">{{ $sale->price }} Tk.</h5>
                                   
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            
                           
                        </div>
                    </div>
                </div>
                <div class="filter__item">
                    <div class="row">
                        <div class="col-lg-4 col-md-5">
                            <div class="filter__sort">
                                <span>Sort By</span>
                                <select>
                                    <option value="0">Default</option>
                                    <option value="0">Default</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="filter__found">
                                <h6><span>{{$total_products}}</span> Products found</h6>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-3">
                            <div class="filter__option">
                                <span class="icon_grid-2x2"></span>
                                <span class="icon_ul"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row featured__filter">

                    @foreach ($products as $item)
        
                    <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
        
                        <div class="featured__item">
                            <div class="featured__item__pic">
                                <a href="{{url('/product-details',$item->id)}}"> <img src="{{ asset('/public/uploads/' . $item->image) }}" alt="Product Image"></a>
                                <ul class="featured__item__pic__hover">
                               @auth
                                <li>
                                    @php
                                    $inWishlist = Auth::check() && Auth::user()->wishlistProducts->contains('id', $item->id);
                                    @endphp
        
                                    <form method="POST" action="{{ route('add.to.wishlist', ['id' => $item->id]) }}">
                                        @csrf
                                        <button type="submit" class="wishlist-button{{ $inWishlist ? ' in-wishlist' : '' }}">
                                            <i class="fa fa-heart"></i>
                                        </button>
                                    </form>
                                    </li>
                                  @endauth
                                    <li><a href="{{url('/product-details',$item->id)}}"><i class="fa fa-eye"></i></a></li>
                                    <li><a href="{{route('add.to.cart',$item->id)}}"><i class="fa fa-shopping-cart"></i></a></li>
        
                                </ul>
                                     </div>
        
                              
                                <div class="featured__item__text">
        
        
                                    <h6><p>{{ $item->name }}</p></h6>
                                    <div class="star-rating">
                                        @php
                                            $productRatings = App\Models\ProductRating::where('product_id', $item->id)->get();
                                            $averageRating = min($productRatings->avg('rating'), 5);
                                            $fullStars = floor($averageRating);
                                            $hasHalfStar = ($averageRating - $fullStars) >= 0.5;
                                        @endphp
        
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $fullStars)
                                                <span class="star" style="font-size: 18px; color: gold;">&#9733;</span>
                                            @elseif ($hasHalfStar)
                                                <span class="star half" style="font-size: 18px; color: gold;">&#9733;</span>
                                                @php $hasHalfStar = false; @endphp
                                            @else
                                                <span class="star" style="font-size: 18px; color: gray;">&#9733;</span>
                                            @endif
                                        @endfor
                                    </div>
        
                                    @if (empty($item->discount))
                                    <h5 style="color: rgb(214, 57, 17)">{{ $item->price }} Tk.</h5>
                                @else
                                <del style="color: rgb(214, 57, 17)">{{ $item->price }} Tk.</del>
                                    <h5 style="color: rgb(214, 57, 17)">{{ $item->discounted_price }} Tk.</h5>
                                    
                                @endif                    
                                   
                                    
                                </div>

                                <br>
                        </div>
                    </div>
                    @endforeach
                </div >

                <div>
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Section End -->

@endsection
