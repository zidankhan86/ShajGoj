<!-- Header Section Begin -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__left">
                        <ul>
                            @php
                                $title = App\Models\Title::latest()->first();
                            @endphp
                            <li><i class="fa fa-envelope"></i>{{ optional($title)->title }}</li>
                            <li>ORDER NOW</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__right">
                        <div class="header__top__right__social">
                            <a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a>
                            <a href="https://twitter.com/"><i class="fa fa-twitter"></i></a>
                            <a href="https://www.facebook.com/"><i class="fa fa-linkedin"></i></a>
                            <a href="https://www.linkedin.com/"><i class="fa fa-instagram"></i></a>
                            <a href="https://www.youtube.com"><i class="fa fa-youtube"></i></a>
                        </div>
                        <div class="header__top__right__language">


                            @guest
                                <a href="{{ route('registration') }}">
                                    <div>Registration</div>
                                </a>
                            @endguest

                            @auth
                                @if (auth()->user()->role == 'customer')
                                    <a href="{{ url('/profile') }}">
                                        <div>Profile</div>
                                    </a>
                                @endif
                            @endauth


                        </div>


                        <div class="header__top__right__auth">
                            @auth
                                @if (auth()->user()->role == 'customer')
                                    <a href="{{ route('logout') }}"><i class="fa fa-user"></i> Logout</a>
                                @endif
                            @endauth


                            @auth
                            @else
                                <a href="{{ route('login.frontend') }}"><i class="fa fa-user"></i> Login</a>
                            @endauth
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                @php
                    $logo = App\Models\CompanyLogo::latest()->first();
                @endphp
                <div class="header__logo">
                    @if ($logo)
                        <a href="{{ route('home') }}"><img src="{{ url('/public/uploads/', $logo->image) }}"
                                alt=""></a>
                    @else
                        <a href="{{ route('home') }}" style="color: red">Inseart a logo</a>
                    @endif
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="header__menu">
                    <ul>
                        <li class="active"><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ url('/product') }}">Products</a></li>
                        <li><a href="{{ route('about') }}">About</a></li>
                        <li><a href="{{ url('/contact') }}">Contact</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__cart">
                    <ul>
                        <li>
                            <a href="{{ route('wishlist.index') }}">
                                <button class="btn btn-black">
                                    WISHLIST
                                    @auth
                                        <span class="wishlist-count">{{ Auth::user()->wishlistProducts->count() }}</span>
                                    @else
                                        <span class="wishlist-count">0</span>
                                    @endauth
                                </button>
                            </a>
                        </li>
                        
                                <li>
                                    <a href="{{ url('/view-cart') }}">
                                        <button class="btn btn-pink">
                                            <i class="fa fa-shopping-bag"></i>
                                            <span class="cart-count">{{ session()->has('cart') ? count(session()->get('cart')) : 0 }}</span>
                                            BAG
                                        </button>
                                    </a>
                                </li>
                                
                    </ul>
                </div>
            </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
<!-- Header Section End -->
<style>
/* Custom styles for the pink button *//* Custom styles for the pink button */
.btn-pink {
    background-color: #e83e8c;
    color: white;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 6px 16px;
    font-size: 16px;
    border-radius: 25px; /* Rounded shapes on left and right sides */
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
    position: relative; /* Added to position the count correctly */
}

.btn-pink:hover {
    background-color: #c7176f;
    color: white;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Custom styles for the cart icon and count */
.fa-shopping-bag {
    margin-right: 10px; /* Added space between icon and text */
}

.cart-count {
    background-color: white;
    color: #e83e8c; 
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
a:hover .btn-pink {
    text-decoration: none;

}

</style>

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
        background-color: #d42e7c;
        color: white;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    /* Custom styles for the cart icon and count */
    .fa-shopping-bag {
        margin-right: 10px; /* Added space between icon and text */
    }
    
    .cart-count {
        background-color: white;
        color: #0a0206; 
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