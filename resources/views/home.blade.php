<section class="home" id="home">
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ url('/assets/img/background-4.png') }}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5 class="text-light" style="background-color: rgba(0, 0, 0, 0.3)">{{__('Get Tutorials Register now, for free.')}}</h5>
                    <button type="button" class="btn btn-secondary">{{ __('Get Start') }}</button>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ url('/assets/img/background-8.png') }}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5 class="text-light" style="background-color: rgba(0, 0, 0, 0.3)">{{__('Get Tutorials Register now, for free.')}}</h5>
                    <button type="button" class="btn btn-secondary">{{ __('Get Start') }}</button>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ url('/assets/img/background-7.png') }}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5 class="text-light" style="background-color: rgba(0, 0, 0, 0.3)">{{__('Get Tutorials Register now, for free.')}}</h5>
                    <button type="button" class="btn btn-secondary">{{ __('Get Start') }}</button>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">{{__('Previous')}}</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">{{__('Next')}}</span>
        </button>
    </div>
</section>
<section class="services" id="services">
    <div class="header">
        <div class="icon"><i class="fa-solid fa-gear"></i></div>
        <h1 class="title">
            {{ __('Services') }}
        </h1>
    </div>
    <div class="main">
        <div class="card">
            <div class="header-card">
                <div class="icon"><i class="fa-solid fa-user-graduate"></i></div>
                <h2 class="title">
                    {{ __('Learning in groups') }}
                </h2>
            </div>
            <div class="body">
                <p class="text">
                    {{ __('The Teacher can Create Learning Groups and Add More than One Users') }}
                </p>
            </div>
        </div>
        <div class="card">
            <div class="header-card">
                <div class="icon"><i class="fa-solid fa-chalkboard"></i></div>
                <h2 class="title">
                    {{ __('Discussion Board') }}
                </h2>
            </div>
            <div class="body">
                <p class="text">
                    {{ __('The Site Contains a Chat for Communication Between the Student and The Teacher in The Group') }}
                </p>
            </div>
        </div>
        <div class="card">
            <div class="header-card">
                <div class="icon"><i class="fa-solid fa-users"></i></div>
                <h2 class="title">
                    {{ __('Supports a Number of Users') }}
                </h2>
            </div>
            <div class="body">
                <p class="text">
                    {{ __('The Site Supports Teachers and Students and Everyone has Different Features') }}
                </p>
            </div>
        </div>
    </div>
</section>
<section class="about" id="about">
    <div class="header">
        <div class="icon"><i class="fa-solid fa-address-card"></i></div>
        <h1 class="title">
            {{ __('About us') }}
        </h1>
    </div>
    <div class="main">
        <div class="text">
            {{ __('An educational site that makes it easier for the learner to find information in a faster and easier way, as students struggle  to search for educational materials to study and learn, not to access the desired content. This site provides this feature where  any teacher can upload educational content and anyone looking for the same content by submitting an application to join the course, the teacher is free to accept and decline.') }}
        </div>
        <img src="{{ url('/assets/img/background-3.png') }}" alt="">
    </div>
</section>
