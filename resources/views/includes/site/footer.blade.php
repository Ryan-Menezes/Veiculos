<!-- Footer Section Begin -->
<footer class="footer set-bg" data-setbg="{{ asset('assets/images/site/footer-bg.jpg') }}">
    <div class="container">
        <div class="footer__contact">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="footer__contact__title">
                        <h2>Entre em contato conosco</h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="footer__contact__option">
                        <div class="option__item"><i class="fa fa-phone"></i> (11)99999-9999</div>
                        <div class="option__item email"><i class="fa fa-envelope-o"></i> hvac@gmail.com</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="footer__about">
                    <div class="footer__logo">
                        <a href="#"><img src="{{ asset(config('app.logo')) }}"></a>
                    </div>
                    <p>99999-999 | Rua Teste, 15, Jardim Teste, São Paulo - SP</p>
                    <div class="footer__social">
                        <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                        <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                        <a href="#" class="google"><i class="fa fa-google"></i></a>
                        <a href="#" class="skype"><i class="fa fa-skype"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 offset-lg-1 col-md-3">
                <div class="footer__widget">
                    <h5>Menu</h5>
                    <ul>
                        <li><a href="{{ route('site') }}"><i class="fa fa-angle-right"></i> Início</a></li>
                        <li><a href="{{ route('site.vehicles') }}"><i class="fa fa-angle-right"></i> Veículo</a></li>
                        <li><a href="{{ route('site.contact') }}"><i class="fa fa-angle-right"></i> Contato</a></li>
                        @auth
                        <li><a href="{{ route('panel') }}"><i class="fa fa-angle-right"></i> Painel</a></li>
                        @else
                        <li><a href="{{ route('login') }}"><i class="fa fa-angle-right"></i> Login</a></li>
                        <li><a href="{{ route('register') }}"><i class="fa fa-angle-right"></i> Cadastre-se</a></li>
                        @endauth
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-3">
                <div class="footer__widget">
                    <h5>Infomation</h5>
                    <ul>
                        <li><a href="#"><i class="fa fa-angle-right"></i> Hatchback</a></li>
                        <li><a href="#"><i class="fa fa-angle-right"></i> Sedan</a></li>
                        <li><a href="#"><i class="fa fa-angle-right"></i> SUV</a></li>
                        <li><a href="#"><i class="fa fa-angle-right"></i> Crossover</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer__brand">
                    <h5>Top Brand</h5>
                    <ul>
                        <li><a href="#"><i class="fa fa-angle-right"></i> Abarth</a></li>
                        <li><a href="#"><i class="fa fa-angle-right"></i> Acura</a></li>
                        <li><a href="#"><i class="fa fa-angle-right"></i> Alfa Romeo</a></li>
                        <li><a href="#"><i class="fa fa-angle-right"></i> Audi</a></li>
                    </ul>
                    <ul>
                        <li><a href="#"><i class="fa fa-angle-right"></i> BMW</a></li>
                        <li><a href="#"><i class="fa fa-angle-right"></i> Chevrolet</a></li>
                        <li><a href="#"><i class="fa fa-angle-right"></i> Ferrari</a></li>
                        <li><a href="#"><i class="fa fa-angle-right"></i> Honda</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
        <div class="footer__copyright__text">
            <p>{{ config('app.name') }} &copy;<script>document.write(new Date().getFullYear());</script> Todos os direitos reservados | Site desenvolvido por <a target="_blank" href="https://github.com/Ryan-Menezes">Ryan Menezes</a></a></p>
        </div>
        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
    </div>
</footer>
<!-- Footer Section End -->

<!-- Search Begin -->
<div class="search-model">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="search-close-switch">+</div>
        <form class="search-model-form">
            <input type="text" id="search-input" placeholder="Search here.....">
        </form>
    </div>
</div>
<!-- Search End -->