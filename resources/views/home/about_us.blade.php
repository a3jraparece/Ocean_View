@extends('user.layout')

@section('title', 'Ocean View')
{{-- @section('css', '/css/admin/dashboard.css') --}}
@section('content')
<link href="https://fonts.googleapis.com/css2?family=Caladea:wght@400;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Cantarell:wght@400;700&display=swap" rel="stylesheet">

  <!-- Hero Section -->
  <section class="bg-dark text-white text-center py-5" style="background: url('{{ asset('/images/home/backgroundaboutus.jpg') }}') center/cover; height:400px; opcacity:1;">
    <div class="container mt-5">
      <h1 class="display-4">About Us</h1>
      <p class="lead">Welcome to Ocean View, your haven of tranquility and luxury. Discover the perfect escape nestled in nature's beauty.</p>
    </div>
  </section>

  <!-- Content Sections -->
  <section class="py-5">
    <div class="container">
      <div class="row mb-4">
        <div class="col-md-3">
          <img src="{{asset('/images/home/2.webp')}}" alt="Enjoy the Moment" class="img-fluid rounded h-100">
        </div>
        <div class="col-md-9 d-flex align-items-left ">
          <div>
            <h2 class="p-2" style="font-family: 'Caladea', serif; letter-spacing: 2px; color: #812C2C;">Enjoy the Moment</h2>
            <p class="p-2" style="letter-spacing: 2px; font-family: 'Cantarell', sans-serif;">It wraps you in a world of simple comforts that make you feel at home and relaxed. Each moment brings out the natural beauty of your getaway,
               helping you enjoy every part of it. With every detail carefully chosen, you can fully relax and enjoy a peaceful,
                refreshing break. Embrace the joy of living in the moment, surrounded by tranquility and charm.</p>
          </div>
        </div>
      </div>
      <div class="row mb-4">
        <div class="col-md-4 order-md-2">
          <img src="{{asset('/images/home/Beach-4.jpg')}}" alt="Enjoy the Moment" class="img-fluid rounded h-150">
        </div>
        <div class="col-md-8 d-flex align-items-left order-md-1">
          <div>
            <h2 style="font-family: 'Caladea', serif; letter-spacing: 2px; color: #812C2C;">Experience the Appeal of Sea View</h2>
            <p style="letter-spacing: 2px; font-family: 'Cantarell', sans-serif;">Wake up to breathtaking seaside vistas and let the gentle sound of waves enhance 
              your stay at Ocean View. Bask in the serene ambiance as the ocean breeze rejuvenates your spirit. Every sunrise and sunset becomes a picturesque memory you'll cherish forever.</p>
          </div>
        </div>
      </div>
      <div class="row mb-4">
        <div class="col-md-4">
          <img src="{{asset('/images/home/otin.jpg')}}" alt="Enjoy the Moment" class="img-fluid rounded h-200">
        </div>
        <div class="col-md-8 d-flex align-items-left">
          <div>
            <h2 class="p-2" style="font-family: 'Caladea', serif; letter-spacing: 2px; color: #812C2C;">The Right Flavor for Every Palate</h2>
            <p class="p-2" style="letter-spacing: 2px; font-family: 'Cantarell', sans-serif;">Indulge in our exquisite cuisine, crafted with fresh local ingredients to create a memorable dining experience. From delightful appetizers to decadent desserts,
               every dish is a celebration of taste and creativity. Savor the harmony of flavors in a setting designed to enhance your culinary journey.</p>
          </div>
        </div>
      </div>
      <div class="row mb-4">
        <div class="col-md-4 order-md-2">
          <img src="{{asset('/images/home/Cat.webp')}}" alt="Enjoy the Moment" class="img-fluid rounded h-150">
        </div>
        <div class="col-md-8 d-flex align-items-center order-md-1">
          <div>
            <h2 style="font-family: 'Caladea', serif; letter-spacing: 2px; color: #812C2C;">Pets Are Allowed</h2>
            <p style="letter-spacing: 2px; font-family: 'Cantarell', sans-serif;">Bring your furry friends along to enjoy the adventure with you. We make sure everyone in the family feels at home.  From cozy pet-friendly accommodations to spacious 
              outdoor areas, your pets will love it here too. Experience the perfect getaway where your whole family, including your pets, can create unforgettable memories.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Gallery Section -->
  <section class="py-5 bg-light">
    <div class="container">
      <h2 class="text-center mb-4" style="font-family: 'Caladea', serif; letter-spacing: 2px; color: #812C2C; font-size:35px;">Gallery</h2>
      <div class="row g-3">
        <style>
          .img-fluid{
            object-fit: cover;
            max-height: 350px
          }
        </style>
        <div class="col-md-4 col-sm-5 col-12">
          <img src="{{ asset('/images/home/gal1.jpg') }}" alt="Gallery Image 1" class="img-fluid rounded h-100 w-100">
        </div>
        <div class="col-md-3 col-sm-7 col-12">
          <img src="{{ asset('/images/home/gal2.jpg') }}" alt="Gallery Image 2" class="img-fluid rounded h-100 w-100">
        </div>
        <div class="col-md-5 col-sm-7 col-12">
          <img src="{{ asset('/images/home/gal3.jpg') }}" alt="Gallery Image 3" class="img-fluid rounded h-100 w-100">
        </div>
        <div class="col-md-5 col-sm-5 col-12">
          <img src="{{ asset('/images/home/gal4.jpg') }}" alt="Gallery Image 4" class="img-fluid rounded h-100 w-100">
        </div>
        <div class="col-md-3 col-sm-5 col-12">
          <img src="{{ asset('/images/home/gal5.jpg') }}" alt="Gallery Image 5" class="img-fluid rounded h-100 w-100">
        </div>
        <div class="col-md-4 col-sm-7 col-12">
          <img src="{{ asset('/images/home/gal6.jpeg') }}" alt="Gallery Image 6" class="img-fluid rounded h-100 w-100">
        </div>
        <div class="col-md-4 col-sm-5 col-12">
          <img src="{{ asset('/images/home/gal7.jpg') }}" alt="Gallery Image 1" class="img-fluid rounded h-100 w-100">
        </div>
        <div class="col-md-3 col-sm-7 col-12">
          <img src="{{ asset('/images/home/gal8.jpg') }}" alt="Gallery Image 2" class="img-fluid rounded h-100 w-100">
        </div>
        <div class="col-md-5 col-sm-5 col-12">
          <img src="{{ asset('/images/home/gal9.jpeg') }}" alt="Gallery Image 3" class="img-fluid rounded h-100 w-100">
        </div>
        <!-- Add more images as needed -->
      </div>
    </div>
  </section>

 
@endsection
