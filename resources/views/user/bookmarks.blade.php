@extends('user.layout')

@section('title', 'Ocean View | Bookmarks')
@section('css', '/css/user/bookmarks.css')

@section('content')
    <section class="bookmarks mx-5">
        <div class="navlink-container col-12 d-flex align-items-center gap-3 ps-3">
            <img src="{{ asset('/images/icons/user/back.png') }}" alt="" onclick="goBack()" width="30px" style="cursor: pointer;">
            <span style="font-size: 30px">Bookmarks</span>
        </div>
        <hr>
        <script>
            function goBack() {
                window.history.back();
            }
        </script>

        @foreach ($bookmarks as $bookmark)
            <div class="row mt-3 rounded" style="background-color: rgba(199, 199, 199, 0.5)">
                <div class="col-lg-4 col-sm-4 col-md-5 p-0">
                    <img src="{{ $bookmark['resort']['mainImage'] ? asset('/images/resort_images/' . $bookmark['resort']['mainImage']) : asset('/images/resort_images/default.jpg') }}"
                        alt="Punta Verde Resort" class="bookmark-image" style="width:100%; height:200px;object-fit:cover;">
                </div>
                <div class="col-lg-8 col-sm-8 col-md-7">
                    <div class="d-flex justify-content-between p-3">
                        <div class="bookmark-info">
                            <a href="{{ route('user.resort.details', ['resortID' => $bookmark['resort']['resortID']]) }}"
                                style="font-size:30px; color:rgb(53, 53, 53);font-weight:bold; text-decoration:none">
                                {{ $bookmark['resort']['resort_name'] }}
                            </a>
                            <div class="container pt-4">
                                <p>{{ $bookmark['resort']['location'] }}</p>
                                <p>{{ \Carbon\Carbon::parse($bookmark['created_at'])->format('F j, Y') }}</p>
                            </div>
                        </div>
                        <form action="{{ route('user.bookmarks.destroy', ['id' => $bookmark['id']]) }}" method="post"
                            onsubmit="return confirm('Are you sure you want to delete this bookmark?');">
                            @csrf
                            @method('delete')
                            <button class="delete-btn">
                                <img src="{{ asset('/images/icons/user/delete.png') }}" alt="Delete">
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        @endforeach
    </section>
@endsection
