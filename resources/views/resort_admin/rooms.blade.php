@extends('resort_admin.layout')

@section('title', session('resort')['resort_name'] . ' | Admin')

@section('css', '/css/resort_admin/room.css')

@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Allerta+Stencil&display=swap" rel="stylesheet">

    <div class="allrooms">
        <a href="" class="icon"></a>
        <h1>All Rooms</h1>
    </div>
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <hr>
    <br>
    <table border="1">
        <thead>
            <th>ID</th>
            <th>Room ID</th>
            {{-- <th>resortID</th>remove lang ang resort id kay di ni siya need --}}
            <th>Room Type</th>
            <th>Capacity</th>
            <th colspan="2">Actions</th>
            <th>Status</th>
        </thead>
        <tbody>
            @foreach ($rooms as $room)
                <tr>
                    <td>{{ $room->id }}</td>
                    <td>{{ $room->roomID }}</td>
                    {{-- <td>{{ $room->resortID }}</td> --}}
                    <td>{{ $room->room_type }}</td>
                    <td>{{ $room->capacity }}</td>

                    <td>
                        <div class="action-button">
                            <button class="openModalButton" data-room="{{ json_encode($room) }}">
                                Edit
                            </button>
                        </div>
                    </td>
                    <td>
                        <div class="action-button">
                            <form action="{{ route('resort_admin.rooms.destroy', ['id' => $room->id]) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to remove this room?')">
                                @csrf
                                @method('delete')
                                <input type="submit" name="" id="delete" value="Remove">
                            </form>
                        </div>
                    </td>
                    <td>
                        <div class="action-button">
                            <form
                                action="{{ route('resort_admin.rooms.status', ['id' => $room->id, 'status' => $room->status == 1 ? 0 : 1]) }}"
                                method="POST">
                                @csrf
                                @method('put')

                                <button type="submit"
                                    style="background-color: {{ $room->status == 0 ? 'rgb(254, 21, 21)' : 'rgb(1, 193, 42)' }};">
                                    {{ $room->status == 0 ? 'Disabled' : 'Enabled' }}
                                </button>

                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <dialog id="roomeditmodal">
        <form action="{{ route('resort_admin.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <input type="hidden" name="id" id="id">

            <h1 class="text-center my-4">Edit Room</h1>

            <div class="container">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="roomID" class="form-label">Room ID:</label>
                        <input type="text" name="roomID" id="roomID" class="form-control" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="resortID" class="form-label">Resort ID:</label>
                        <input type="text" name="resortID" id="resortID" class="form-control" readonly>
                    </div>
                </div>

                <div class="row mb-3 d-flex align-items-center justify-content-center">
                    <div class="col-12 d-flex align-items-center">
                        <img src="{{ $room->image ? asset($room->image) : asset('images/room_images/default.jpg') }}"
                            alt="{{ $room->name }}" class="img-thumbnail me-3" width="100%" id="image-preview">
                        <input type="file" name="room_image" id="image" accept="image/jpeg, image/png"
                            class="form-control" />
                    </div>
                    <label for="image" class="col-12 col-form-label"
                        style="width: 90%; text-align: center; padding: 5px; border: 1px solid black; border-radius: 6px; margin-top: 10px; cursor: pointer;">Upload
                        Image</label>
                </div>

                <div class="row mb-3">
                    <label for="room_type" class="col-sm-3 col-form-label">Room Type:</label>
                    <div class="col-sm-9">
                        <select name="room_type" id="room_type" class="form-select">
                            <option value="" disabled selected>Select a Room Type</option>
                            <option value="King Size Bed">King Size Bed</option>
                            <option value="Queen Size Bed">Queen Size Bed</option>
                            <option value="Suite">Suite</option>
                            <option value="Double Bed">Double Bed</option>
                            <option value="Single Bed">Single Bed</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="description" class="col-sm-3 col-form-label">Description:</label>
                    <div class="col-sm-9">
                        <input type="text" name="description" id="description" class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inclusions" class="col-sm-3 col-form-label">Inclusion:</label>
                    <div class="col-sm-9">
                        <input type="text" name="inclusions" id="inclusions" class="form-control" placeholder="Inclusion 1, Inclusion 2, Inclusion 3">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="capacity" class="col-sm-3 col-form-label">Capacity:</label>
                    <div class="col-sm-9">
                        <input type="text" name="capacity" id="capacity" class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="amenities" class="col-sm-3 col-form-label">Amenities:</label>
                    <div class="col-sm-9">
                        <input type="text" name="amenities" id="amenities" class="form-control" placeholder="Amenity 1, Amenity 2, Amenity 3">
                    </div>
                </div>

                <div class="row g-2">
                    <div class="col-sm-4">
                        <button type="button" id="closeEditModal" class="btn btn-secondary w-100">Cancel</button>
                    </div>
                    <div class="col-sm-8">
                        <input type="submit" value="Update" class="btn btn-primary w-100">
                    </div>
                </div>
            </div>

        </form>
    </dialog>

    <script src="/js/resort_admin/room.js"></script>


@endsection
