<div>
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">

                    <a class="nav-link" href="{{ route('dashboard') }}">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-house"></i></div>
                        Dashboard
                    </a>
                    <div class="sb-sidenav-menu-heading">Home</div>

                    <a class="nav-link" href="{{ route('category.list') }}"
                        data-bs-target="#collapseLayouts" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-list"></i>
                        </div>
                        Categories
                       
                    </a>
                    


                    <a class="nav-link collapsed" href="{{ route('product.list') }}"
                        data-bs-target="#collapsePages" aria-controls="collapsePages">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-cart-plus"></i></div>
                        Product
                    </a>
                   

                    <a class="nav-link" href="{{ route('order.list') }}">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-cart-plus"></i></div>
                        Orders
                    </a>

                    <a class="nav-link" href="{{ route('users') }}">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-cart-plus"></i></div>
                        Users
                    </a>

                    <a class="nav-link" href="{{ route('logo.list') }}">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-ribbon"></i></div>
                        Logo
                    </a>

                    <a class="nav-link" href="{{ route('contact.list') }}">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-comment"></i></div>
                        Messages
                    </a>


                    <hr>
                    <a class="nav-link collapsed" href="" data-bs-toggle="collapse"
                        data-bs-target="#collapseBanners" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-cog"></i></div>
                        Settings
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>

                    <div class="collapse" id="collapseBanners" aria-labelledby="headingOne"
                        data-bs-parent="#sidenavAccordion">

                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="{{ route('hero.list') }}">Advertising Banner</a>
                        </nav>
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="{{ route('banner.list.one') }}">Advertising Poster 1</a>
                        </nav>
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="{{ route('banner.list.two') }}">Advertising Poster 2</a>
                        </nav>
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="{{ route('banner.list') }}">Advertising Poster 3</a>

                        </nav>
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="{{ route('website.form') }}">Website name</a>

                        </nav>

                    </div>

                    <a class="nav-link" href="{{ route('report') }}">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-print"></i></div>
                        Print Report
                    </a>

                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                {{ auth()->user()->name }}
            </div>
        </nav>
    </div>

</div>
