<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>

<!-- Offcanvas Menu Begin -->
<div class="offcanvas-menu-overlay"></div>
<div class="offcanvas-menu-wrapper">
    <div class="offcanvas__widget">
        <a href="{{ route('site.cart') }}"><i class="fa fa-shopping-cart"></i></a>
        <a href="#" class="search-switch"><i class="fa fa-search"></i></a>
        @auth
        <a href="{{ route('panel') }}" class="primary-btn">Painel</a>
        @endauth
    </div>
    <div class="offcanvas__logo">
        <a href="{{ route('site') }}"><img src="{{ asset(config('app.logo')) }}" alt="{{ config('app.name') }}"></a>
    </div>
    <div id="mobile-menu-wrap"></div>
    <ul class="offcanvas__widget__add">
        <li><i class="fa fa-clock-o"></i> {{ date('d/m/Y H:i:s') }}</li>
        <li><i class="fa fa-envelope-o"></i> hvac@gmail.com</li>
    </ul>
    <div class="offcanvas__phone__num">
        <i class="fa fa-phone"></i>
        <span>(11) 99999-9999</span>
    </div>
    <div class="offcanvas__social">
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-google"></i></a>
        <a href="#"><i class="fa fa-instagram"></i></a>
    </div>
</div>
<!-- Offcanvas Menu End -->

<!-- Header Section Begin -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <ul class="header__top__widget">
                         <li><i class="fa fa-clock-o"></i> {{ date('d/m/Y H:i:s') }}</li>
                        <li><i class="fa fa-envelope-o"></i> hvac@gmail.com</li>
                    </ul>
                </div>
                <div class="col-lg-5">
                    <div class="header__top__right">
                        <div class="header__top__phone">
                            <i class="fa fa-phone"></i>
                            <span>(11) 99999-9999</span>
                        </div>
                        <div class="header__top__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-google"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-2">
                <div class="header__logo">
                    <a href="{{ route('site') }}"><img src="{{ asset(config('app.logo')) }}" alt=""></a>
                </div>
            </div>
            <div class="col-lg-10">
                <div class="header__nav">
                    <nav class="header__menu">
                        <ul>
                            <li><a href="{{ route('site') }}">Início</a></li>
                            <li class="active"><a href="{{ route('site.vehicles') }}">Veículos</a></li>
                            <li><a href="{{ route('site.contact') }}">Contato</a></li>
                        </ul>
                    </nav>
                    <div class="header__nav__widget">
                        <div class="header__nav__widget__btn">
                            <a href="{{ route('site.cart') }}"><i class="fa fa-shopping-cart"></i></a>
                            <a href="#" class="search-switch"><i class="fa fa-search"></i></a>
                        </div>
                        @auth
                        <a href="{{ route('panel') }}" class="primary-btn"><i class="fa fa-cog"></i> Painel</a>
                        @else
                        <a href="{{ route('login') }}" class="primary-btn"><i class="fa fa-sign-in"></i> Login</a>
                        <a href="{{ route('register') }}" class="primary-btn"><i class="fa fa-user"></i> Cadastre-se</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
        <div class="canvas__open">
            <span class="fa fa-bars"></span>
        </div>
    </div>
</header>
<!-- Header Section End -->