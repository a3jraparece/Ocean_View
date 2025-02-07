@extends('admin.layout')
@section('title', 'Ocean View | Accounts')
@section('css', '/css/admin/accounts.css')
@section('content')

    <div class="table-responsive mt-1">
        <hr>
        <table class="userTable table-striped table-bordered table-blue-header">
            <thead>
                <tr>
                    <th style=" border-top-left-radius: 7px;">User ID</th>
                    <th>Name</th>
                    <th>Email Address</th>
                    <th>Contact Number</th>
                    <th>Balance</th>
                    <th class="text-center">Booking Status</th>
                    <th colspan="2" class="last text-center" style=" border-top-right-radius: 7px;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($guests as $guest)
                    <tr style="cursor: pointer;">
                        <td>{{ $guest['guestID'] }}</td>
                        <td>{{ $guest['f_name'] }} {{ $guest['l_name'] }} {{ $guest['m_name'] }}</td>
                        <td>{{ $guest['email'] }}</td>
                        <td>{{ $guest['phone_number'] }}</td>
                        <td>{{ $guest['balance'] }}</td>
                        <td class="checked-in text-center text-white">
                            <span class="p-2"
                                style="background-color: {{ $guest['status'] == 0 ? 'rgb(254, 21, 21)' : 'rgb(1, 193, 42)' }};letter-spacing:2px; border-radius:10px;">{{ $guest['status'] == 0 ? 'Deactived' : 'Active' }}
                            </span>
                        </td>

                        <td class="action-buttons">
                                <button class="edit bg-warning"
                                data-resort="{{ json_encode($guest) }}">Edit</button>                             

                        </td>
                        <td>
                            <form action=""
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

    <div class="row-css mt-5">
        <div class="card-css">
            <div class="card-header bg-primary">
                <p class="card-title text-white">{{ $guest['f_name'] }} {{ $guest['l_name'] }}
                    {{ $guest['m_name'] }}</p>
                <div class="actions">
                    <span class="edit">Edit</span>
                    <span class="delete">Delete</span>
                </div>
            </div>
            <div class="card-body">
                <div class="contact-info">
                    <p class="phone">{{ $guest['email'] }}</p>
                    <p class="status text-white"
                        style="background-color: {{ $guest['status'] == 0 ? 'rgb(254, 21, 21)' : 'rgb(1, 193, 42)' }};letter-spacing:2px; border-radius:10px;">
                        {{ $guest['status'] == 0 ? 'Deactived' : 'Active' }}</p>
                </div>
                <div class="additional-info">
                    <p class="email">{{ $guest['phone_number'] }}</p>
                    <p class="price">₱{{ $guest['balance'] }}</p>
                </div>
            </div>
        </div>
    </div>

@endsection
