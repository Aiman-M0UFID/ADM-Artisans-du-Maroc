@extends('Front.app.app')

@section('title','ADM')

@section('content')
    <section class="home section" id="home">
        <div class="home__container container grid">
            <div class="home__data">
                <h1 class="home__title">
                    Discover <br> Most Suitable <br> Property
                </h1>
                <p class="home__description">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur ea minima, aliquid nobis sequi possimus impedit perferendis corporis laudantium.
                     Est unde iusto reiciendis repellendus soluta ratione distinctio ullam voluptates dolore.
                </p>
                <form action="{{route('search')}}" method="POST" >
                    @csrf

                    {{-- <i class='bx bxs-map'></i> --}}
                    <input type="search" placeholder="Rechereche dans votre ville" name="ville" class="home__search-input">

                    <select class="home__search-input" name="categorie" id="">
                        <option value="">choisissez la catégorie que vous voulez</option>
                      
                        @foreach ($categories as $item)
                        <option value="{{$item->id}}">{{$item->title}}</option>
                        @endforeach

                    </select>
                    <button class="home__search-button">rechereche</button>
                </form>

                <div class="home__value">
                    <div>
                        <h1 class="home__value-number">
                            9K <span>+</span>
                        </h1>
                        <span class="home__value-description">
                            Premium <br> Proudact
                        </span>
                    </div>
                    <div>
                        <h1 class="home__value-number">
                            2K <span>+</span>
                        </h1>
                        <span class="home__value-description">
                            Happy <br> Customer
                        </span>
                    </div>
                    <div>
                        <h1 class="home__value-number">
                            28K <span>+</span>
                        </h1>
                        <span class="home__value-description">
                            Awards <br> Winning
                        </span>
                    </div>
                </div>
            </div>

            <div class="home__images">
                <div class="home__orbe">

                </div>
                <div class="home__img">
                    <img style="height:450px;widht:auto" src="{{asset('image/img_home.jpg')}}" alt="">
                </div>
            </div>
        </div>
    </section>

    <section class="logos section">
        <div class="logos__container container grid">
            <div class="logos__img">
                <img src="{{asset('image/logo.png')}}" alt="">
            </div>
            <div class="logos__img">
                <img src="{{asset('image/logo_4.jpg')}}" alt="">
            </div>
            <div class="logos__img">
                <img src="{{asset('image/logo_5.png')}}" alt="">
            </div>
            <div class="logos__img">
                <img src="{{asset('image/logo_6.png')}}" alt="">
            </div>
        </div>
    </section>

    <section class="popular section" id="popular">
        <div class="container">
            <span class="section__subtitle">Best choise</span>
            <h2 class="section__title">
                Artistes populaires
            </h2>

            <div class="popular__container swiper">
                <div class="swiper-wrapper">

                   @foreach ($categories as $item)
                    <article class="popular__card swiper-slide">
                        <img class="popular__img" style="height: 200px" src="{{asset('images_categorie/'.$item->image)}}" alt="">

                        <div class="popular__data">
                            <h2 class="popular__price"><span>{{$item->title}}</span></h2>
                           
                            <p class="popular__description">
                                {{$item->sub_title}}
                            </p>
                        </div>
                    </article>
                   @endforeach

                    {{-- <article class="popular__card swiper-slide">
                        <img class="popular__img" src="{{asset('image/img_home.jpg')}}" alt="">

                        <div class="popular__data">
                            <h2 class="popular__price"><span>$</span>65,33</h2>
                            <h3 class="popular__title">Quis quaerat</h3>
                            <p class="popular__description">
                                culpa quidem, labore beatae earum? Quis quaerat modi repellat, ex exercitationem impedit veniam?
                            </p>
                        </div>
                    </article>

                    <article class="popular__card swiper-slide">
                        <img class="popular__img" src="{{asset('image/img_home.jpg')}}" alt="">

                        <div class="popular__data">
                            <h2 class="popular__price"><span>$</span>65,33</h2>
                            <h3 class="popular__title">culpa quidem</h3>
                            <p class="popular__description">
                                culpa quidem, labore beatae earum? Quis quaerat modi repellat, ex exercitationem impedit veniam?
                            </p>
                        </div>
                    </article> --}}
                </div>

                <div class="swiper-button-next">
                    <i class='bx bx-chevron-right'></i>
                </div>
                <div class="swiper-button-prev">
                    <i class='bx bx-chevron-left'></i>
                </div>

            </div>

            <span class="section__subtitle">Best choise</span>
            <h2 class="section__title">
                Artistes Services
            </h2>

            <div class="service_conatiner grid">
                @foreach ($users as $user)

                @foreach ($services as $item)
                        
                @if ($item->user_id == $user->id)

                <article class="popular__card swiper-slide">
                    <img class="popular__img" style="height: 200px" src="{{asset('images_service/'.$item->image)}}" alt="">

                    <div class="popular__data">

                        
                            <h2 class="popular__price"> <span>{{$user->name}}</span> <i>{{$user->ville}}</i></h2>
                       
                        <h4> <span>experience ( {{$item->experience}} ans)</span></h4>
                        <h3 class="popular__title">{{$item->nom}} </h3>
                        <p class="popular__description">
                            {{$item->details}}
                        </p>
                    </div>
                    <a href="chatify/{{$item->user_id}}" class="button__contact"><i class='bx bx-chat nav__icon' ></i> Contact</a>
                </article>

                @endif
                @endforeach
            @endforeach

            </div>
        </div>
    </section>

    <section class="value section" id="value">
        <div class="value__container container grid">
            <div class="value__images">
                <div class="value__orbe"></div>

                <div class="value__img">
                    <img src="{{asset('image/logo-la-maison-dartisanat-final.png')}}" alt="">
                </div>
            </div>

            <div class="value__content">
                <div class="value__data">
                    <span class="section__subtitle">Our Value</span>
                    <h2 class="section__title">
                        value We Give To you <span>.</span>
                    </h2>
                    <p class="value__description">
                        Lorem ipsum dolor sit amet obcaecati quam temporibus totam sequi, repellendus pariatur rem assumenda accusantium eaque vitae!
                    </p>
                </div>

                <div class="value___accordion">
                    <div class="value__accordion-item">
                        <header class="value__accordion-header">
                            <i class='bx bxs-shield-x value__accordion-icon'></i>
                            <h3 class="value__accordion-title">  Lorem Delectus dolor</h3>

                            <div class="value__accordion-arrow">
                                <i class='bx bxs-down-arrow'></i>
                            </div>
                        </header>

                        <div class="value__accordion-content">
                            <p class="value__accordion-description">
                                Lorem Delectus dolor commodi quod autem quae, velit soluta odit eum deserunt?
                            </p>
                        </div>
                    </div>

                    <div class="value__accordion-item">
                        <header class="value__accordion-header">
                            <i class='bx bxs-x-square value__accordion-icon'></i>
                            <h3 class="value__accordion-title">  Lorem Delectus dolor</h3>

                            <div class="value__accordion-arrow">
                                <i class='bx bxs-down-arrow'></i>
                            </div>
                        </header>

                        <div class="value__accordion-content">
                            <p class="value__accordion-description">
                                Lorem Delectus dolor commodi quod autem quae, velit soluta odit eum deserunt?
                            </p>
                        </div>
                    </div>

                    <div class="value__accordion-item">
                        <header class="value__accordion-header">
                            <i class='bx bxs-bar-chart-square value__accordion-icon'></i>
                            <h3 class="value__accordion-title">  Lorem Delectus dolor</h3>

                            <div class="value__accordion-arrow">
                                <i class='bx bxs-down-arrow'></i>
                            </div>
                        </header>

                        <div class="value__accordion-content">
                            <p class="value__accordion-description">
                                Lorem Delectus dolor commodi quod autem quae, velit soluta odit eum deserunt?
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="subscribe section">
        <div class="subscribe__container container">
            <h1 class="subscribe__title">Get Started whit</h1>
            <p class="subscribe__description">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora exercitationem sequi dolorem at animi minima similique, asperiores unde qui repellat rerum officiis totam perferendis laudantium, possimus nihil consequuntur blanditiis ducimus.
            </p>
            <a href="#" class="button subscribe__button">Get Started</a>
        </div>
    </section>

@endsection