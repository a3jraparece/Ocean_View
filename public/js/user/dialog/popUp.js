
function openBookingTermModal() {
    document.getElementById('bookingsTermsPopUp').showModal();
}


function closePopUpModal() {
    document.getElementById('bookingsTermsPopUp').close();
}

function openBookingPrivacyPolicyModal(x) {
    if (x == 1) {
        document.getElementById('bookingsPrivacyPolicyPopUp').showModal();
    } else {
        document.getElementById('bookingsPrivacyPolicyPopUp').close();
    }
}