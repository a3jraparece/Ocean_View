@extends('user.layout')

@section('title', 'Ocean View | My Account')
@section('css', '')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<style>
    .form-control{
        border: 2px solid black;
        border-radius: 5px
    }
    .holder input{
        padding: 1px;
    }
</style>

<div class="container">
<div class="row p-5">
    <!-- Left Side Content -->
    <div class="col-lg-6" >
        <div class="row">
            <div class="col-lg-3" >
                <img src="{{ asset('/images/resort_images/' . $guest['prof_pic']) }}" class="h-auto w-100" style="border-radius: 50%;  background-color: rgb(18, 58, 93);" alt="..." />
            </div>
            <div class="col-lg-6">
                <h3>{{ $guest['f_name'] }}</h3>
                <h6>status</h6>
            </div>
            <div class="col-lg-3">
                <h5 class="mt-auto">{{ $guest['balance'] }}</h5>
            </div>
            <div style="border-bottom: 1px solid black; margin-bottom:5px;"></div>
            <div class="col-lg-7 mt-3">
                
                <div class="d-flex align-items-center">
                    <!-- Email Text -->
                    <h6>Email</h6> 
                    <!-- Pen Icon for Editing -->
                    <button class="btn btn-link p-0 ms-auto" id="edit-email-btn">
                        <i class="bi bi-pencil"></i>
                    </button>
                </div>
                    <input type="email" class="form-control mt-2" id="email-input" value="{{$guest['email']}}" disabled/>
            </div>
            <div class="col-lg-5 mt-3">
                <div class="d-flex align-items-center">
                    <!-- Email Text -->
                    <h6>Phone Number</h6> 
                    <!-- Pen Icon for Editing -->
                    <button class="btn btn-link p-0 ms-auto" id="edit-phone-btn">
                        <i class="bi bi-pencil"></i>
                    </button>
                </div>
                <input type="number" class="form-control mt-2" id="phone-input" value="{{$guest['phone_number']}}" disabled/>
            </div>
            <div class="col-lg-12 mt-3">
                <div class="d-flex align-items-center">
                    <!-- Email Text -->
                    <h6>Address</h6> 
                    <!-- Pen Icon for Editing -->
                    <button class="btn btn-link p-0 ms-auto" id="edit-address-btn">
                        <i class="bi bi-pencil"></i>
                    </button>
                </div>
                <input type="text" class="form-control mt-2" id="address-input" value="{{$guest['location']}}" disabled/>
            </div>
            <div id="edit-buttons" class="d-none mt-2 d-flex justify-content-end">

                <button class="btn btn-secondary me-2" id="cancel-btn">Cancel</button>
                
                <button class="btn btn-primary" id="save-btn">Save Changes</button>
            </div>
        </div>
    </div>


    <div class="col-md-6">
        <!-- Add new content here -->
        <h4>Right side content</h4>
        <p>Additional content or elements can go here.</p>
    </div>
</div>
</div>
<div style="border-bottom: 1px solid black; margin-top:1.4rem"></div>
<script>
    // List of all edit buttons (for email, phone, and address)
    var buttonIds = ["edit-email-btn", "edit-phone-btn", "edit-address-btn"];

    // Loop through each button and add event listeners
    buttonIds.forEach(function(buttonId) {
        document.getElementById(buttonId).addEventListener("click", function() {
            // Generate the corresponding input field ID based on the button clicked
            var inputId = buttonId.replace("edit-", "").replace("-btn", "-input"); 
            var input = document.getElementById(inputId);

            if (input) {
                input.disabled = false;  // Enable the input field for editing
            }

            // Show the Cancel and Save buttons, and hide the pen icon
            document.getElementById("edit-buttons").classList.remove("d-none");
            document.getElementById(buttonId).classList.add("d-none");  // Hide the pen icon
        });
    });

    // Cancel button functionality
    document.getElementById("cancel-btn").addEventListener("click", function() {
        // Reset the input values and disable them
        var emailInput = document.getElementById("email-input");
        emailInput.value = "alex@gmail.com";  // Reset to original email
        emailInput.disabled = true;  // Disable the email input field

        var phoneInput = document.getElementById("phone-input");
        phoneInput.value = "1234567890";  // Reset to original phone number
        phoneInput.disabled = true;  // Disable the phone input field

        var addressInput = document.getElementById("address-input");
        addressInput.value = "Panabo Ciy";  // Reset to original address
        addressInput.disabled = true;  // Disable the address input field

        // Hide the Cancel and Save Changes buttons
        document.getElementById("edit-buttons").classList.add("d-none");

        // Show the pen icons again
        document.getElementById("edit-email-btn").classList.remove("d-none");
        document.getElementById("edit-phone-btn").classList.remove("d-none");
        document.getElementById("edit-address-btn").classList.remove("d-none");
    });

    // Save Changes button functionality
    document.getElementById("save-btn").addEventListener("click", function() {
       
        var emailInput = document.getElementById("email-input");
        emailInput.disabled = true; 

        var phoneInput = document.getElementById("phone-input");
        phoneInput.disabled = true; 

        var addressInput = document.getElementById("address-input");
        addressInput.disabled = true;

        document.getElementById("edit-buttons").classList.add("d-none");

        // Show the pen icons again
        document.getElementById("edit-email-btn").classList.remove("d-none");
        document.getElementById("edit-phone-btn").classList.remove("d-none");
        document.getElementById("edit-address-btn").classList.remove("d-none");
    });
</script>


@endsection
