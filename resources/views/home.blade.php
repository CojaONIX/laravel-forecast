@extends('layout')

@section('title', 'Home')

@section('content')
    <div id="carouselExampleIndicators" class="carousel slide">
        <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="https://picsum.photos/id/41/300/100.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="https://picsum.photos/id/42/300/100.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="https://picsum.photos/id/43/300/100.jpg" class="d-block w-100" alt="...">
        </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
        </button>
    </div>

    <hr>
    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iste nam earum asperiores! Exercitationem quis impedit a repudiandae in voluptas porro dolorum unde non officiis facere maxime labore ea nisi placeat dolore tempore tempora, sint quibusdam, fugiat explicabo accusamus distinctio. Laudantium corrupti aperiam odio atque tempora cumque? Illo iure laudantium ex eligendi maxime ab quis beatae aut sint, magni necessitatibus atque fuga corporis quia? Ea architecto accusantium atque ullam laborum consequatur, id repellendus earum distinctio! Aspernatur ad odio blanditiis officia harum quod vero eaque, qui fugit, provident sed velit nam repellat dolor alias perspiciatis doloremque dolorem recusandae suscipit temporibus voluptates quo! Ea doloremque, aliquid iste fugiat quia, ex sed vero quasi nobis exercitationem magnam obcaecati esse id cupiditate! Dicta, aperiam ut.</p>
    <hr>

    <ul>
        <li><a href="/forecast/Beograd">Beograd</a></li>
        <li><a href="/forecast/Novi Sad">Novi Sad</a></li>
        <li><a href="/forecast/Aleksinac">Aleksinac</a></li>
    </ul>

@endsection
