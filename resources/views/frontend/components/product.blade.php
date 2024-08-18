
<!-- Featured Section Begin -->
<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>ALL PRODUCTS</h2>
                </div>
                <div class="featured__controls">

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
                                <button type="submit" class="btn btn-black{{ $inWishlist ? ' in-wishlist' : '' }}">
                                    <small>WISHLIST</small>
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
        <div class="pagination justify-content-end">
            {{ $products->links() }}
        </div>

    </div>


    {{-- Wishlist Button --}}
<style>
    /* Custom styles for the pink button */
    .btn-black {
        background-color: #14030b;
        color: white;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 6px 16px;
        font-size: 16px;
        border-radius: 25px;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
        position: relative; /* Added to position the count correctly */
    }
    
    .btn-black:hover {
        background-color: #cc4383;
        color: white;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    /* Custom styles for the cart icon and count */
    .fa-shopping-bag {
        margin-right: 10px; /* Added space between icon and text */
    }
    
    .cart-count {
        background-color: rgb(189, 41, 66);
        color: #be0f67; 
        border-radius: 50%;
        padding: 2px 8px;
        font-size: 14px;
        font-weight: bold;
        position: absolute; 
        top: -10px; 
        right: -10px; 
    }
    
    /* Add some spacing around the button */
    li {
        list-style: none;
        margin: 10px 0;
    }
    
    /* Adjust link hover effect */
    a:hover .btn-black {
        text-decoration: none;
    }
    
    </style>
</section>
<!-- Featured Section End -->
