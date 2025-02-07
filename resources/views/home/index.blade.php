@extends('user.layout')

@section('title', 'Ocean View')

@section('content')
    <style>
        .body {
            background-color: rgb(225, 225, 225)
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Allerta+Stencil&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cantarell:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Caladea:wght@400;700&display=swap" rel="stylesheet">
    <div class="body">


        <br>
        <div style="display: flex; justify-content:center; align-items:center; flex-direction:column; margin-bottom:20px;">
            <h4>About Us</h4>
            <a href="{{ route('user.index.about_us') }}">About Us</a>
        </div>


        <!-- Hero Section -->
        <section class="bg-dark text-white text-center py-5"
            style="background: url('{{ asset('/images/home/backgroundaboutus.jpg') }}') center/cover;  height:500px; opacity: 100;">
            <div class="container mt-5">
                <h1 class="display-4" style="font-family: 'Allerta Stencil', sans-serif; font-size:80px;">Ocean View</h1>
                <p class="lead" style="font-family: 'Allerta Stencil', sans-serif;">Join us for an unparalleled beach day,
                    luxuriating in the premium services that complement the natural beauty surrounding you. Book your daybed
                    or table now to ensure your spot in this tropical oasis.</p>
            </div>
        </section>

        <!-- Content Sections -->
        <div class="card" style="max-width: 100%; height:250px;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="{{ asset('/images/home/ambot.jpg') }}" class="img-fluid rounded-start" alt="..."
                        style="height: 100%; width:90%;">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h4 class="card-title" style="font-family: 'Caladea', serif; letter-spacing: 2px; color: #812C2C; font-size:25px;">
                            Seamlessly blending luxury with nature.</h4>
                        <p class="card-text" style="letter-spacing: 2px; font-family: 'Cantarell', sans-serif;">A place to
                            connect while the sun sails from east to west. Walls are not compulsory, organic shapes &
                            composition at every sight. Natural material and earthy tones are dominant. Opening onto
                            gorgeous iconic landscapes and majestic coastlines, welcoming you to a rendition of “Little
                            Bali”.</p>
                            <span style="border: 1px solid black; border-radius:20px; padding: 8px;">
                                <a href="{{ route('user.index.about_us') }}" style="text-decoration: none; font-size:20px;">About Us</a>
                            </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card bg-dark text-white">
            <img src="{{ asset('/images/home/2pak.jpeg') }}" class="card-img" alt="..." style="height:40rem; opacity:50%;">
            <div class="card-img-overlay mt-3">

                <img src="{{ asset('/images/home/3.jpg') }}" class="card-img-top" alt="..."
                    style="width: 22rem; height: 25rem; margin-top: 3rem; margin: 1rem; margin-left:2.8rem; margin-top: -9rem;">
                <img src="{{ asset('/images/home/222.jpg') }}" class="card-img-top"
                    alt="..."style="width: 22rem; height: 25rem;margin-top: 10rem; margin: 1rem; margin-top: 10rem;">
                <img src="{{ asset('/images/home/chix.jpg') }}" class="card-img-top" alt="..."
                    style="width: 22rem; height: 25rem; margin-top: 3rem;margin: 1rem;margin-top: -9rem;">

            </div>
        </div>
        <div class="w-50 mt-5 ms-5 mb-0">
            <h3 class="ms-4" style="font-family: 'Caladea', serif; letter-spacing: 2px; color: #812C2C;">Experience ease, lightness, and
                a warm welcome at Ocean View.</h3>
            <h5 class="ms-4" style="letter-spacing: 2px; font-family: 'Cantarell', sans-serif;">Choose & secure your perfect spot or
                enjoy panoramic ocean views or relish a captivating sunset. Dive into an ambiance where every detail uplifts
                your spirit.</h5>
        </div>
        <div class="row row-cols-1 row-cols-md-3 g-4" style="padding: 4rem">
            <div class="col">
                <div class="card h-50">
                    <img src="{{ asset('/images/home/gal1.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title" style="font-family: 'Caladea', serif; letter-spacing: 2px; color: #812C2C; font-size:25px;">
                            Hof Gorei Beach</h5>
                        <p class="card-text" style="letter-spacing: 2px; font-family: 'Cantarell', sans-serif;">Hof Gorei
                            Beach Resort is a charming beachfront resort in Samal Island, offering a serene escape with its
                            natural beauty, cozy accommodations, and personalized service. It's perfect for a relaxing
                            retreat in nature.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-50">
                    <img src="{{ asset('/images/home/friday.jpeg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h4 class="card-title" style="font-family: 'Caladea', serif; letter-spacing: 2px; color: #812C2C;font-size:25px;">
                            Friday Beach Resort</h4>
                        <p class="card-text" style="letter-spacing: 2px; font-family: 'Cantarell', sans-serif;">Fridays
                            Boracay Beach Resort is a tropical paradise located on the white sandy shores of Boracay. It
                            offers beachfront accommodations, lush surroundings, and a peaceful atmosphere for a perfect
                            island getaway.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-50">
                    <img src="{{ asset('/images/home/fridayss.jpeg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h4 class="card-title" style="font-family: 'Caladea', serif; letter-spacing: 2px; color: #812C2C;font-size:25px;">
                            Punta Verde Resort</h4>
                        <p class="card-text" style="letter-spacing: 1px; font-family: 'Cantarell', sans-serif;">Punta Verde
                            Resort is a tranquil beachfront resort offering a relaxing escape with its white sandy beaches,
                            clear waters, and cozy amenities. Ideal for those seeking a peaceful retreat on the beautiful
                            island.</p>
                    </div>
                </div>
            </div>   
        </div>
        <div class="mt-0 mx-5">
            <div class="text-end mb-5">
                <span class="mb-5 me-5 p-2" style="border: 1px solid black; border-radius: 20px;">
                    <a href="{{ route('user.resorts') }}" style="text-decoration: none; letter-spacing:1px;">View All</a>
                </span>
            </div>
           
            <div class="events" style="display: flex; justify-content: center; gap: 2rem;">
                <img src="{{ asset('/images/home/99.jpg') }}" class="rounded float-start" alt="..."
                    style="width: 356px; height: 440px">
                <img src="{{ asset('/images/home/gal4.jpg') }}" class="rounded float-center" alt="..."
                    style="width: 356px; height: 440px">
                <img src="{{ asset('/images/home/444.jpg') }}" class="rounded float-end" alt="..."
                    style="width: 356px; height: 440px">
            </div>
        </div>
    </div>
    <!--fooer-->



@endsection
