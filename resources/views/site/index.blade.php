@extends('templates.site')

@section('title', 'Início')

@section('content')
<!-- Hero Section Begin -->
<section class="hero spad set-bg" data-setbg="{{ asset('assets/images/site/hero-bg.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="hero__text">
                    <div class="hero__text__title">
                        <span>FIND YOUR DREAM CAR</span>
                        <h2>Porsche Cayenne S</h2>
                    </div>
                    <div class="hero__text__price">
                        <div class="car-model">Model 2019</div>
                        <h2>$399<span>/Month</span></h2>
                    </div>
                    <a href="#" class="primary-btn"><img src="{{ asset('assets/images/site/wheel.png') }}" alt=""> Test Drive</a>
                    <a href="#" class="primary-btn more-btn">Learn More</a>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="hero__tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Car Rental</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Buy Car</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="hero__tab__form">
                                <h2>Find Your Dream Car</h2>
                                <form>
                                    <div class="select-list">
                                        <div class="select-list-item">
                                            <p>Select Year</p>
                                            <select>
                                                <option data-display=" ">Select Year</option>
                                                <option value="">2020</option>
                                                <option value="">2019</option>
                                                <option value="">2018</option>
                                                <option value="">2017</option>
                                                <option value="">2016</option>
                                                <option value="">2015</option>
                                            </select>
                                        </div>
                                        <div class="select-list-item">
                                            <p>Select Brand</p>
                                            <select>
                                                <option data-display=" ">Select Brand</option>
                                                <option value="">Acura</option>
                                                <option value="">Audi</option>
                                                <option value="">Bentley</option>
                                                <option value="">BMW</option>
                                                <option value="">Bugatti</option>
                                            </select>
                                        </div>
                                        <div class="select-list-item">
                                            <p>Select Model</p>
                                            <select>
                                                <option data-display=" ">Select Model</option>
                                                <option value="">Q3</option>
                                                <option value="">A4 </option>
                                                <option value="">AVENTADOR</option>
                                            </select>
                                        </div>
                                        <div class="select-list-item">
                                            <p>Select Mileage</p>
                                            <select>
                                                <option data-display=" ">Select Mileage</option>
                                                <option value="">27</option>
                                                <option value="">25</option>
                                                <option value="">15</option>
                                                <option value="">10</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="car-price">
                                        <p>Price Range:</p>
                                        <div class="price-range-wrap">
                                            <div class="price-range"></div>
                                            <div class="range-slider">
                                                <div class="price-input">
                                                    <input type="text" id="amount">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="site-btn">Searching</button>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-2" role="tabpanel">
                            <div class="hero__tab__form">
                                <h2>Buy Your Dream Car</h2>
                                <form>
                                    <div class="select-list">
                                        <div class="select-list-item">
                                            <p>Select Year</p>
                                            <select>
                                                <option data-display=" ">Select Year</option>
                                                <option value="">2020</option>
                                                <option value="">2019</option>
                                                <option value="">2018</option>
                                                <option value="">2017</option>
                                                <option value="">2016</option>
                                                <option value="">2015</option>
                                            </select>
                                        </div>
                                        <div class="select-list-item">
                                            <p>Select Brand</p>
                                            <select>
                                                <option data-display=" ">Select Brand</option>
                                                <option value="">Acura</option>
                                                <option value="">Audi</option>
                                                <option value="">Bentley</option>
                                                <<option value="">BMW</option>
                                                <option value="">Bugatti</option>
                                            </select>
                                        </div>
                                        <div class="select-list-item">
                                            <p>Select Model</p>
                                            <select>
                                                <option data-display=" ">Select Model</option>
                                                <option value="">Q3</option>
                                                <option value="">A4 </option>
                                                <option value="">AVENTADOR</option>
                                            </select>
                                        </div>
                                        <div class="select-list-item">
                                            <p>Select Mileage</p>
                                            <select>
                                                <option data-display=" ">Select Mileage</option>
                                                <option value="">27</option>
                                                <option value="">25</option>
                                                <option value="">15</option>
                                                <option value="">10</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="car-price">
                                        <p>Price Range:</p>
                                        <div class="price-range-wrap">
                                            <div class="price-range"></div>
                                            <div class="range-slider">
                                                <div class="price-input">
                                                    <input type="text" id="amount">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="site-btn">Searching</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<!-- Services Section Begin -->
<section class="services spad pb-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <span>Our Services</span>
                    <h2>What We Offers</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="services__item">
                    <img src="{{ asset('assets/images/site/services/services-1.png') }}" alt="">
                    <h5>Rental A Cars</h5>
                    <p>Consectetur adipiscing elit incididunt ut labore et dolore magna aliqua. Risus commodo
                        viverra maecenas.</p>
                    <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="services__item">
                    <img src="{{ asset('assets/images/site/services/services-2.png') }}" alt="">
                    <h5>Buying A Cars</h5>
                    <p>Consectetur adipiscing elit incididunt ut labore et dolore magna aliqua. Risus commodo
                        viverra maecenas.</p>
                    <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="services__item">
                    <img src="{{ asset('assets/images/site/services/services-3.png') }}" alt="">
                    <h5>Car Maintenance</h5>
                    <p>Consectetur adipiscing elit incididunt ut labore et dolore magna aliqua. Risus commodo
                        viverra maecenas.</p>
                    <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="services__item">
                    <img src="{{ asset('assets/images/site/services/services-4.png') }}" alt="">
                    <h5>Support 24/7</h5>
                    <p>Consectetur adipiscing elit incididunt ut labore et dolore magna aliqua. Risus commodo
                        viverra maecenas.</p>
                    <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Services Section End -->

<!-- Car Section Begin -->
<section class="car spad pt-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <span>Our Car</span>
                    <h2>Best Vehicle Offers</h2>
                </div>
                <ul class="filter__controls">
                    <li class="active" data-filter="*">Most Researched</li>
                    <li data-filter=".sale">Latest on sale</li>
                </ul>
            </div>
        </div>
        <div class="row car-filter">
            <div class="col-lg-3 col-md-4 col-sm-6 mix">
                <div class="car__item">
                    <div class="car__item__pic__slider owl-carousel">
                        <img src="{{ asset('assets/images/site/cars/car-1.jpg') }}" alt="">
                        <img src="{{ asset('assets/images/site/cars/car-8.jpg') }}" alt="">
                        <img src="{{ asset('assets/images/site/cars/car-6.jpg') }}" alt="">
                        <img src="{{ asset('assets/images/site/cars/car-3.jpg') }}" alt="">
                    </div>
                    <div class="car__item__text">
                        <div class="car__item__text__inner">
                            <div class="label-date">2016</div>
                            <h5><a href="#">Porsche cayenne turbo s</a></h5>
                            <ul>
                                <li><span>35,000</span> mi</li>
                                <li>Auto</li>
                                <li><span>700</span> hp</li>
                            </ul>
                        </div>
                        <div class="car__item__price">
                            <span class="car-option">For Rent</span>
                            <h6>$218<span>/Month</span></h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mix sale">
                <div class="car__item">
                    <div class="car__item__pic__slider owl-carousel">
                        <img src="{{ asset('assets/images/site/cars/car-2.jpg') }}" alt="">
                        <img src="{{ asset('assets/images/site/cars/car-8.jpg') }}" alt="">
                        <img src="{{ asset('assets/images/site/cars/car-6.jpg') }}" alt="">
                        <img src="{{ asset('assets/images/site/cars/car-4.jpg') }}" alt="">
                    </div>
                    <div class="car__item__text">
                        <div class="car__item__text__inner">
                            <div class="label-date">2020</div>
                            <h5><a href="#">Toyota camry asv50l-jeteku</a></h5>
                            <ul>
                                <li><span>35,000</span> mi</li>
                                <li>Auto</li>
                                <li><span>700</span> hp</li>
                            </ul>
                        </div>
                        <div class="car__item__price">
                            <span class="car-option sale">For Sale</span>
                            <h6>$73,900</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mix">
                <div class="car__item">
                    <div class="car__item__pic__slider owl-carousel">
                        <img src="{{ asset('assets/images/site/cars/car-3.jpg') }}" alt="">
                        <img src="{{ asset('assets/images/site/cars/car-8.jpg') }}" alt="">
                        <img src="{{ asset('assets/images/site/cars/car-6.jpg') }}" alt="">
                        <img src="{{ asset('assets/images/site/cars/car-5.jpg') }}" alt="">
                    </div>
                    <div class="car__item__text">
                        <div class="car__item__text__inner">
                            <div class="label-date">2017</div>
                            <h5><a href="#">Bmw s1000rr 2019 m</a></h5>
                            <ul>
                                <li><span>35,000</span> mi</li>
                                <li>Auto</li>
                                <li><span>700</span> hp</li>
                            </ul>
                        </div>
                        <div class="car__item__price">
                            <span class="car-option">For Rent</span>
                            <h6>$299<span>/Month</span></h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mix sale">
                <div class="car__item">
                    <div class="car__item__pic__slider owl-carousel">
                        <img src="{{ asset('assets/images/site/cars/car-4.jpg') }}" alt="">
                        <img src="{{ asset('assets/images/site/cars/car-8.jpg') }}" alt="">
                        <img src="{{ asset('assets/images/site/cars/car-2.jpg') }}" alt="">
                        <img src="{{ asset('assets/images/site/cars/car-1.jpg') }}" alt="">
                    </div>
                    <div class="car__item__text">
                        <div class="car__item__text__inner">
                            <div class="label-date">2019</div>
                            <h5><a href="#">Lamborghini huracan evo</a></h5>
                            <ul>
                                <li><span>35,000</span> mi</li>
                                <li>Auto</li>
                                <li><span>700</span> hp</li>
                            </ul>
                        </div>
                        <div class="car__item__price">
                            <span class="car-option sale">For Sale</span>
                            <h6>$120,000</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mix">
                <div class="car__item">
                    <div class="car__item__pic__slider owl-carousel">
                        <img src="{{ asset('assets/images/site/cars/car-5.jpg') }}" alt="">
                        <img src="{{ asset('assets/images/site/cars/car-8.jpg') }}" alt="">
                        <img src="{{ asset('assets/images/site/cars/car-7.jpg') }}" alt="">
                        <img src="{{ asset('assets/images/site/cars/car-2.jpg') }}" alt="">
                    </div>
                    <div class="car__item__text">
                        <div class="car__item__text__inner">
                            <div class="label-date">2018</div>
                            <h5><a href="#">Audi q8 2020</a></h5>
                            <ul>
                                <li><span>35,000</span> mi</li>
                                <li>Auto</li>
                                <li><span>700</span> hp</li>
                            </ul>
                        </div>
                        <div class="car__item__price">
                            <span class="car-option">For Rent</span>
                            <h6>$319<span>/Month</span></h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mix sale">
                <div class="car__item">
                    <div class="car__item__pic__slider owl-carousel">
                        <img src="{{ asset('assets/images/site/cars/car-6.jpg') }}" alt="">
                        <img src="{{ asset('assets/images/site/cars/car-8.jpg') }}" alt="">
                        <img src="{{ asset('assets/images/site/cars/car-3.jpg') }}" alt="">
                        <img src="{{ asset('assets/images/site/cars/car-1.jpg') }}" alt="">
                    </div>
                    <div class="car__item__text">
                        <div class="car__item__text__inner">
                            <div class="label-date">2016</div>
                            <h5><a href="#">Mustang shelby gt500</a></h5>
                            <ul>
                                <li><span>35,000</span> mi</li>
                                <li>Auto</li>
                                <li><span>700</span> hp</li>
                            </ul>
                        </div>
                        <div class="car__item__price">
                            <span class="car-option sale">For Sale</span>
                            <h6>$730,900</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mix">
                <div class="car__item">
                    <div class="car__item__pic__slider owl-carousel">
                        <img src="{{ asset('assets/images/site/cars/car-7.jpg') }}" alt="">
                        <img src="{{ asset('assets/images/site/cars/car-2.jpg') }}" alt="">
                        <img src="{{ asset('assets/images/site/cars/car-4.jpg') }}" alt="">
                        <img src="{{ asset('assets/images/site/cars/car-1.jpg') }}" alt="">
                    </div>
                    <div class="car__item__text">
                        <div class="car__item__text__inner">
                            <div class="label-date">2020</div>
                            <h5><a href="#">Lamborghini aventador A90</a></h5>
                            <ul>
                                <li><span>35,000</span> mi</li>
                                <li>Auto</li>
                                <li><span>700</span> hp</li>
                            </ul>
                        </div>
                        <div class="car__item__price">
                            <span class="car-option">For Rent</span>
                            <h6>$422<span>/Month</span></h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mix">
                <div class="car__item">
                    <div class="car__item__pic__slider owl-carousel">
                        <img src="{{ asset('assets/images/site/cars/car-8.jpg') }}" alt="">
                        <img src="{{ asset('assets/images/site/cars/car-3.jpg') }}" alt="">
                        <img src="{{ asset('assets/images/site/cars/car-5.jpg') }}" alt="">
                        <img src="{{ asset('assets/images/site/cars/car-2.jpg') }}" alt="">
                    </div>
                    <div class="car__item__text">
                        <div class="car__item__text__inner">
                            <div class="label-date">2017</div>
                            <h5><a href="#">Porsche cayenne turbo s</a></h5>
                            <ul>
                                <li><span>35,000</span> mi</li>
                                <li>Auto</li>
                                <li><span>700</span> hp</li>
                            </ul>
                        </div>
                        <div class="car__item__price">
                            <span class="car-option">For Rent</span>
                            <h6>$322<span>/Month</span></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Car Section End -->

<!-- Cta Begin -->
<div class="cta">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="cta__item set-bg" data-setbg="{{ asset('assets/images/site/cta/cta-1.jpg') }}">
                    <h4>Do You Want To Buy A Car</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod</p>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="cta__item set-bg" data-setbg="{{ asset('assets/images/site/cta/cta-2.jpg') }}">
                    <h4>Do You Want To Rent A Car</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cta End -->
@endsection