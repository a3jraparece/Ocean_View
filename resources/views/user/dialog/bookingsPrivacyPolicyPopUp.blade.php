<dialog id="bookingsPrivacyPolicyPopUp">
    <div class="container">
        <!-- Header Section -->
        <div class="header-container ">
            <!-- Left Section with Title and Last Updated -->
            <div>
                <h1 class="header-title">Privacy Policy</h1>
                <p class="header-updated">Last Updated: December 4th, 2024</p>
                <p class="header-updated">At Ocean View Resort, we are dedicated to protecting and respecting your
                    privacy. Please take the time to read this notice, as it contains essential information about how we
                    collect, use, and safeguard the personal data you provide or that we gather from you..</p>
            </div>
            <!-- Logo Section -->
            <div class="header-logo">
                <img src="{{ asset('/images/icons/user/user.png') }}" alt="Privacy Logo">
            </div>
        </div>

        <!-- Privacy Content -->
        <div class="section-content">
            <p>
                This privacy policy explains how Ocean View collects, uses, and protects your personal information when
                you
                use our website to book your reservations. By accessing or using our services, you consent to the terms
                outlined in this policy.
            </p>
        </div>

        <!-- Information & Consent Section -->
        <h2 class="section-title">Information We Collect</h2>
        <div class="section-content">
            <p>When you book with Ocean View, we may collect the following information:</p>
            <ul>
                <li>Personal details: Name, email address, phone number, and other contact information.</li>
                <li>Payment information: Credit/debit card details and billing addresses.</li>
                <li>Booking preferences: Specific requests or preferences for your reservation.</li>
                <li>Usage data: Information on how you navigate and interact with our website.</li>
            </ul>
        </div>

        <!-- How We Use Your Information -->
        <h2 class="section-title">How We Use Your Information</h2>
        <div class="section-content">
            <p>Ocean View uses your data to provide and improve our services, including:</p>
            <ul>
                <li>Processing and confirming your reservations.</li>
                <li>Communicating with you regarding your bookings or inquiries.</li>
                <li>Improving our website functionality and customer experience.</li>
                <li>Complying with legal and regulatory requirements.</li>
            </ul>
        </div>

        <!-- Data Protection Section -->
        <h2 class="section-title">Data Protection</h2>
        <div class="section-content">
            <p>
                We prioritize the security of your personal data. Our website uses SSL encryption to ensure your data is
                transmitted securely.
                Additionally, we implement strict access controls to protect your information from unauthorized access.
            </p>
            <p>
                Ocean View will never sell or share your data with third parties for marketing purposes without your
                consent.
            </p>
        </div>

        <!-- Your Rights Section -->
        <h2 class="section-title">Your Rights</h2>
        <div class="section-content">
            <p>As a user of our services, you have the following rights regarding your personal data:</p>
            <ul>
                <li>Access your data and request copies of any information we hold about you.</li>
                <li>Correct any inaccurate or incomplete data.</li>
                <li>Request the deletion of your personal information, where applicable.</li>
            </ul>
        </div>

        <!-- Footer Buttons -->
        <div class="d-flex justify-content-end mt-4 gap-2">
            <button class="btn btn-accept bg-primary text-white" style="width: 200px"
                onclick="openBookingPrivacyPolicyModal(0)">Accept</button>
        </div>

        <!-- Footer Section -->
        <div class="policy-footer">
            <p>If you have any questions or concerns about our Privacy Policy, please contact us at:</p>
            <p>
                <strong>Email:</strong> privacy.oceanview@gmail.com<br>
                <strong>Phone:</strong> +1 (800) 123-456969
            </p>
        </div>
    </div>

    <img src="{{ asset('/images/icons/user/close.png') }}" alt="" width="30px"
        style="position: fixed; top:20px; right:20px;cursor: pointer" onclick="openBookingPrivacyPolicyModal(0)">
</dialog>
