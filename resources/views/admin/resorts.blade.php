@extends('admin.layout')
@section('title', 'Ocean View | Resorts')
@section('css', '/css/admin/resorts.css')

@section('content')

    <div class="container-fluid">

        @if ($errors->any())
            <div class="alert alert-warning alert-dismissible fade show " role="alert">
                <i class="bi bi-info-circle"></i>
                <ul class="list-unstyled">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <h3>List of Resorts</h3>
        <br>
        <div class="d-flex justify-content-between align-items-center flex-wrap mb-1">
            <div>
                <div class="row g-1">
                    <div class="col custom-col">
                        <div class="status-box resort-count bg-warning">Resort Count - {{ $resortsCount }}</div>
                    </div>
                    <div class="col custom-col">
                        <div class="status-box active-resort">Active Resort - {{ $activeResorts }}</div>
                    </div>
                    <div class="col custom-col">
                        <div class="status-box deactivated-resort">Deactivated Resort - {{ $deactivatedResorts }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <form action="{{ route('admin.resortswithlimit') }}" class="me-1" method="POST">
                @csrf
                @method('POST')
                <label for="">Entries per page: </label>
                <select name="pagination_limit" id="pagination_limit" onchange="this.form.submit()">
                    <option value="1" {{ request('pagination_limit') == 1 ? 'selected' : '' }}>1</option>
                    <option value="2" {{ request('pagination_limit') == 2 ? 'selected' : '' }}>2</option>
                    <option value="3" {{ request('pagination_limit') == 3 ? 'selected' : '' }}>3</option>
                    <option value="10" {{ request('pagination_limit') == 10 ? 'selected' : '' }}>10</option>
                    <option value="100" {{ request('pagination_limit') == 100 ? 'selected' : '' }}>100
                    </option>
                </select>
            </form>
            <button class="btn btn-primary" onclick="showCreateResortModal()" style="width: 130px; padding:5px 10px">Add
                Resort</button>
        </div>

        <div class="table-responsive mt-1">
            <table class="table table-striped table-bordered table-blue-header">
                <thead>
                    <tr>
                        <th style=" border-top-left-radius: 7px;">
                            Resort
                        </th>
                        <th>Resort Name</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Location</th>
                        <th>Floor Count</th>
                        <th>Rooms/Floor</th>
                        <th>Tax Rate</th>
                        <th>Room Rate</th>
                        <th>Status</th>
                        <th colspan="2" style=" border-top-right-radius: 7px;">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($resorts as $resort)
                        <tr>
                            <td>{{ $resort['resortID'] }}</td>
                            <td>{{ $resort['resort_name'] }}</td>
                            <td>{{ $resort['username'] }}</td>
                            <td>{{ $resort['password'] }}</td>
                            <td>{{ $resort['location'] }}</td>
                            <td>{{ $resort['floorCount'] }}</td>
                            <td>{{ $resort['roomPerFloor'] }}</td>
                            <td>{{ $resort['taxRate'] }}</td>
                            <td>₱{{ number_format($resort['room_rate'], 2) }}</td>
                            <td class="fw-bold {{ $resort['status'] == 0 ? 'text-danger' : 'text-success' }}"
                                style="letter-spacing: 1px">
                                {{ $resort['status'] == 0 ? 'Deactivated' : 'Active' }}
                            </td>
                            <td>
                                <button class="btn btn-warning text-white openModalButton"
                                    data-resort="{{ json_encode($resort) }}">Edit</button>
                            </td>
                            <td>
                                <form action="{{ route('admin.resorts.destroy', ['resortID' => $resort['resortID']]) }}"
                                    method="post" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" class="btn btn-danger" value="Delete">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        <dialog id="create-resort-dialog">
            <form action="{{ route('admin.resorts.store') }}" method="post" class="needs-validation" novalidate>
                @csrf
                @method('post')

                <h3 class="text-center bg-primary text-white"
                    style="border-top-left-radius: 10px; border-top-right-radius: 10px; padding:15px 5px;">Add
                    Resort</h3>

                <div id="resort_add_form" class="row g-3">
                    <div class="col-sm-5">
                        <label for="resort_name" class="form-label">Resort Name</label>
                        <input type="text" name="resort_name" class="form-control" value="{{ old('resort_name') }}"
                            required>
                    </div>

                    <div class="col-sm-3">
                        <label for="taxRate" class="form-label">Tax Rate in %</label>
                        <input type="number" name="taxRate" class="form-control" value="{{ old('taxRate') }}"
                            step="0.01" required>
                    </div>

                    <div class="col-sm-4">
                        <label for="contactDetails" class="form-label">Contact Details</label>
                        <input type="text" name="contactDetails" class="form-control"
                            value="{{ old('contactDetails') }}" required>
                    </div>

                    <div class="col-sm-4">
                        <label for="location" class="form-label">Resort Location</label>
                        <input type="text" name="location" class="form-control" value="{{ old('location') }}" required>
                    </div>


                    <div class="col-sm-8">
                        <label for="location_coordinates" class="form-label">Location Coordinates</label>
                        <input type="text" name="location_coordinates" class="form-control"
                            value="{{ old('location_coordinates') }}">
                    </div>

                    <div class="col-sm-4">
                        <label for="floorCount" class="form-label">Number of Floors</label>
                        <input type="number" name="floorCount" class="form-control" value="{{ old('floorCount') }}"
                            required>
                    </div>

                    <div class="col-sm-4">
                        <label for="roomPerFloor" class="form-label">Rooms per Floor</label>
                        <input type="number" name="roomPerFloor" class="form-control"
                            value="{{ old('roomPerFloor') }}"required>
                    </div>

                    <div class="col-sm-4">
                        <label for="room_rate" class="form-label">Room Rate</label>
                        <input type="number" name="room_rate" class="form-control" value="{{ old('room_rate') }}"
                            step="0.01" required>
                    </div>

                    <div class="col-sm-6">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" value="{{ old('username') }}"
                            required>
                    </div>

                    <div class="col-sm-6">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" value="{{ old('password') }}"
                            required>
                    </div>

                    <div class="col-sm-4">
                        <button type="button" class="btn btn-secondary  w-100"
                            onclick="closeCreateResortModal()">Cancel</button>
                    </div>

                    <div class="col-sm-8">
                        <input type="submit" class="btn btn-primary  w-100" value="Create Resort">
                    </div>

                    <input type="hidden" name="status" value="0">
                </div>
            </form>
        </dialog>

        <dialog id="resort_edit_modal">
            <form method="POST" action="{{ route('admin.resorts.update') }}">
                @csrf
                @method('PUT')
                <div class="row g-2 ">
                    <input type="hidden" name="resortID" id="resortID">
                    <div class="col-sm-5 p-2 " id="imgHolder">
                        <img src="" alt="" style="width: 100%; object-fit:cover;" height="100%"
                            id="mainImage">
                    </div>
                    <div class="col-sm-7">
                        <div class="row g-2">
                            <div class="col-sm-8">
                                <label for="resort_name" class="form-label">Resort Name</label>
                                <input type="text" name="resort_name" class="form-control" id="resort_name">
                            </div>

                            <div class="col-sm-4">
                                <label for="" class="form-label">Status</label>
                                {{-- <input type="text" name="status" id="status" class="form-control"> --}}
                                <select class="form-select" name="status" aria-label="Default select example">
                                    <option value="1" id="status-1">Active</option>
                                    <option value="0" id="status-0">Deactivated</option>
                                </select>
                            </div>

                            <div class="col-sm-5">
                                <label for="" class="form-label">Contact Details</label>
                                <input type="text" name="contactDetails" id="contactDetails" class="form-control">
                            </div>
                            <div class="col-sm-7">
                                <label for="" class="form-label">Resort Location</label>
                                <input type="text" name="location" id="location" class="form-control">
                            </div>
                            <div class="col-sm-12">
                                <label for="" class="form-label">Location Coordinates</label>
                                <input type="text" name="location_coordinates" id="location_coordinates"
                                    class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <label for="" class="form-label">Number of Floors</label>
                        <input type="number" name="floorCount" id="floorCount" class="form-control">
                    </div>

                    <div class="col-sm-3">
                        <label for="" class="form-label">Rooms per Floor</label>
                        <input type="number" name="roomPerFloor" id="roomPerFloor" class="form-control">
                    </div>

                    <div class="col-sm-3">
                        <label for="" class="form-label">Room Rate in ₱</label>
                        <input type="number" name="room_rate" id="room_rate" step="0.01" min="0"
                            max="999999" class="form-control">
                    </div>

                    <div class="col-sm-3">
                        <label for="" class="form-label">Tax Rate in %</label>
                        <input type="number" name="taxRate" id="taxRate" step="0.01" class="form-control">
                    </div>

                    <div class="col-sm-6">
                        <label for="" class="form-label">Username</label>
                        <input type="text" name="username" id="username" class="form-control">
                    </div>

                    <div class="col-sm-6">
                        <label for="" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>

                    <div class="col-sm-4">
                        <button type="button" class="btn btn-secondary  w-100" id="closeModalButton">Cancel</button>
                    </div>

                    <div class="col-sm-8">
                        <input type="submit" class="btn btn-primary  w-100" value="Update Resort">
                    </div>
                </div>
            </form>
        </dialog>
    </div>

    <div class="row-css mt-5">
        @foreach ($resorts as $resort)
            <div class="card-css">
                <div class="card-header bg-primary">
                    <p class="card-title text-white">{{ $resort['resort_name'] }}</p>
                    <div class="actions">
                        <span class="edit bg-warning">Edit</span>
                        <span class="delete">Delete</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="contact-info">
                        <p class="phone">{{ $resort['username'] }}</p>
                        <p class="status text-white"
                            style="background-color: {{ $resort['status'] == 0 ? '#f44336   ' : 'rgb(1, 193, 42)' }};letter-spacing:2px; border-radius:10px;">
                            {{ $resort['status'] == 0 ? 'Deactived' : 'Active' }}</p>
                    </div>
                    <div class="additional-info">
                        <p class="email">{{ $resort['location'] }}</p>
                        <p class="price">{{ $resort['taxRate'] }}%</p>
                    </div>
                    <div class="additional-info">
                        <p class="email">{{ $resort['floorCount'] }} Floors</p>
                        <p class="price">{{ $resort['roomPerFloor'] }} Rooms</p>
                    </div>
                    <div class="additional-info">
                        <p class="email"></p>
                        <p class="price">₱{{ $resort['room_rate'] }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <script src="/js/admin/resort.js"></script>

@endsection
