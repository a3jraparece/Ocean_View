@extends('resort_admin.layout')

@section('title', session('resort')['resort_name'] . ' | Admin')

@section('css', '/css/resort_admin/manage.css')

@section('content')

    @if (session('success'))
        <script>
            alert(`{{ session('success') }}`);
        </script>
    @endif

    <div class="container-fluid mt-4">
        <form action="{{ route('resort_admin.manage_update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="row">
                <div class="col d-flex justify-content-between align-items-center gap-1 bg-light">
                    <div class="text-primary"><h3>Manage {{ $resort['resort_name'] }}</h3></div>
                    <div>
                        <div id="edit">
                            <dbutton class="btn btn-warning text-white" type="button" onclick="editclicked()">Edit</button>
                        </div>
                        <div id="cancel" style="display: none">
                            <button class="btn btn-secondary" type="button" onclick="cancelclicked()">Cancel</button>
                            <button class="btn btn-success">Update</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-sm-4">
                    <h5 class="mb-3">Main Images</h5>
                    <div class="upload-box h-auto p-0">
                        <img src="{{ $resort['mainImage'] ? asset('/images/resort_images/' . $resort['mainImage']) : asset('/images/resort_images/default.jpg') }}"
                            alt="" id="mainImage_prev" style="height:400px; min-width:100%; object-fit:cover;">
                    </div>
                    <div class="mb-3 inputs">
                        <label for="mainImage" class="form-label">Update Image</label>
                        <input class="form-control bg-primary" type="file" id="mainImage"
                            style="color: rgb(255, 255, 255)" name="mainImage">
                    </div>
                    <div class="mt-4"></div>
                    <div class="row">
                        <div class="col-md-12 col-xl-6">
                            <h5 class="mb-3">Sub Image</h5>
                            <div class="upload-box h-auto p-0">
                                <img src="{{ $resort['image2'] ? asset('/images/resort_images/' . $resort['image2']) : asset('/images/resort_images/default.jpg') }}"
                                    alt="" id="image2_prev" style="height:250px; min-width:100%; object-fit:cover;">
                            </div>
                            <div class="mb-3 inputs">
                                <label for="image2" class="form-label">Update Image</label>
                                <input class="form-control bg-primary" type="file" id="image2"
                                    style="color: rgb(255, 255, 255)" name="image2">
                            </div>
                        </div>
                        <div class="col-md-12 col-xl-6">
                            <h5 class="mb-3">Sub Image</h5>
                            <div class="upload-box h-auto p-0">
                                <img src="{{ $resort['image3'] ? asset('/images/resort_images/' . $resort['image3']) : asset('/images/resort_images/default.jpg') }}"
                                    alt="" id="image3_prev" style="height:250px; min-width:100%; object-fit:cover;">
                            </div>
                            <div class="mb-3 inputs">
                                <label for="image3" class="form-label">Update Image</label>
                                <input class="form-control bg-primary" type="file" id="image3"
                                    style="color: rgb(255, 255, 255)" name="image3">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-8">
                    <h5 class="mb-3">Resort Images</h5>
                    <div class="row g-3">
                        <div class="col-sm-6 col-xl-4">
                            <div class="upload-box h-auto p-0">
                                <img src="{{ $resort['image1'] ? asset('/images/resort_images/' . $resort['image1']) : asset('/images/resort_images/default.jpg') }}"
                                    alt="" id="image1_prev" style="height:240px; min-width:100%; object-fit:cover;">
                            </div>
                            <div class="mb-3 inputs">
                                <label for="image1" class="form-label">Update Image</label>
                                <input class="form-control bg-primary" type="file" id="image1"
                                    style="color: rgb(255, 255, 255)" name="image1">
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-4">
                            <div class="upload-box h-auto p-0">
                                <img src="{{ $resort['image1_2'] ? asset('/images/resort_images/' . $resort['image1_2']) : asset('/images/resort_images/default.jpg') }}"
                                    alt="" id="image1_2_prev"
                                    style="height:240px; min-width:100%; object-fit:cover;">
                            </div>
                            <div class="mb-3 inputs">
                                <label for="image1_2" class="form-label">Update Image</label>
                                <input class="form-control bg-primary" type="file" id="image1_2"
                                    style="color: rgb(255, 255, 255)" name="image1_2">
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-4">
                            <div class="upload-box h-auto p-0">
                                <img src="{{ $resort['image1_3'] ? asset('/images/resort_images/' . $resort['image1_3']) : asset('/images/resort_images/default.jpg') }}"
                                    alt="" id="image1_3_prev"
                                    style="height:240px; min-width:100%; object-fit:cover;">
                            </div>
                            <div class="mb-3 inputs">
                                <label for="image1_3" class="form-label">Update Image</label>
                                <input class="form-control bg-primary" type="file" id="image1_3"
                                    style="color: rgb(255, 255, 255)" name="image1_3">
                            </div>
                        </div>
                    </div>

                    <h5 class="mt-4">Room Images</h5>
                    <div class="row g-3">
                        <div class="col-sm-6  col-xl-4">
                            <div class="upload-box h-auto p-0">
                                <img src="{{ $resort['room_image_1'] ? asset('/images/resort_images/' . $resort['room_image_1']) : asset('/images/resort_images/default.jpg') }}"
                                    alt="" id="room_image_1_prev"
                                    style="height:240px; min-width:100%; object-fit:cover;">
                            </div>
                            <div class="mb-3 inputs">
                                <label for="room_image_1" class="form-label">Update Image</label>
                                <input class="form-control bg-primary" type="file" id="room_image_1"
                                    style="color: rgb(255, 255, 255)" name ="room_image_1">
                            </div>
                        </div>
                        <div class="col-sm-6  col-xl-4">
                            <div class="upload-box h-auto p-0">
                                <img src="{{ $resort['room_image_2'] ? asset('/images/resort_images/' . $resort['room_image_2']) : asset('/images/resort_images/default.jpg') }}"
                                    alt="" id="room_image_2_prev"
                                    style="height:240px; min-width:100%; object-fit:cover;">
                            </div>
                            <div class="mb-3 inputs">
                                <label for="room_image_2" class="form-label">Update Image</label>
                                <input class="form-control bg-primary" type="file" id="room_image_2"
                                    style="color: rgb(255, 255, 255)" name="room_image_2">
                            </div>
                        </div>
                        <div class="col-sm-6  col-xl-4">
                            <div class="upload-box h-auto p-0">
                                <img src="{{ $resort['room_image_3'] ? asset('/images/resort_images/' . $resort['room_image_3']) : asset('/images/resort_images/default.jpg') }}"
                                    alt="" id="room_image_3_prev"
                                    style="height:240px; min-width:100%; object-fit:cover;">
                            </div>
                            <div class="mb-3 inputs">
                                <label for="room_image_3" class="form-label">Update Image</label>
                                <input class="form-control bg-primary" type="file" id="room_image_3"
                                    style="color: rgb(255, 255, 255)" name="room_image_3">
                            </div>
                        </div>
                    </div><br>

                    <div class="textarea-section">
                        <div class="mb-3">
                            <label for="resort_description" class="form-label">Resort Description</label>
                            <textarea class="form-control text_editable" id="resort_description" rows="3" name="resort_description"
                                readonly>{{ $resort['resort_description'] }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="room_description" class="form-label">Room Description</label>
                            <textarea class="form-control text_editable" id="room_description" rows="3" name="room_description" readonly>{{ $resort['room_description'] }}</textarea>
                        </div>
                        <div id="amenitiesHolder">
                            <label for="amenities" class="form-label">Amenities</label>

                            @php
                                $amenities = !empty($resort['amenities']) ? explode('|', $resort['amenities']) : [];
                            @endphp

                            @isset($amenities)
                                @foreach ($amenities as $amenity)
                                    <div class="d-flex mt-2">
                                        <input type="text" class="form-control me-2 text_editable" name="amenities[]"
                                            readonly value="{{ $amenity }}"
                                            placeholder="Aminities 1/ame 1, ame 2, ame 3">
                                        <button class="btn btn-danger ameneties" type="button" style="display: none"
                                            onclick="deleteInputAmenity(this)">Delete</button>
                                    </div>
                                @endforeach
                            @endisset
                        </div>
                        <div class="d-flex mt-2 justify-content-end">
                            <button class="btn btn-success ameneties" type="button" style="display: none"
                                onclick="addAmenities()">Add</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('/js/resort_admin/manage.js') }}"></script>

@endsection
