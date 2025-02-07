function showCreateResortModal() {
    document.getElementById('create-resort-dialog').showModal();
}

function closeCreateResortModal() {
    document.getElementById('create-resort-dialog').close();
}


document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('resort_edit_modal');
    const closeButton = document.getElementById('closeModalButton');
    const openButtons = document.querySelectorAll('.openModalButton');

    openButtons.forEach(button => {
        button.addEventListener('click', function () {
            const resortData = JSON.parse(this.getAttribute('data-resort'));

            document.getElementById('resortID').value = resortData.resortID;
            document.getElementById('resort_name').value = resortData.resort_name;
            document.getElementById('username').value = resortData.username;
            document.getElementById('password').value = resortData.password;
            document.getElementById('location').value = resortData.location;
            document.getElementById('location_coordinates').value = resortData.location_coordinates;
            document.getElementById('floorCount').value = resortData.floorCount;
            document.getElementById('roomPerFloor').value = resortData.roomPerFloor;
            document.getElementById('taxRate').value = resortData.taxRate;
            document.getElementById('room_rate').value = resortData.room_rate;
            document.getElementById('contactDetails').value = resortData.contactDetails;
            document.getElementById('mainImage').src = resortData.mainImage
                ? `${window.location.origin}/images/resort_images/${resortData.mainImage}`
                : `${window.location.origin}/images/room_images/default.jpg`;;

            if (resortData.status == 0) {
                document.getElementById('status-0').setAttribute('selected', true);
                document.getElementById('status-1').removeAttribute('selected')
            } else {
                document.getElementById('status-0').removeAttribute('selected');
                document.getElementById('status-1').setAttribute('selected', true)
            }

            modal.showModal();
        });
    });

    closeButton.addEventListener('click', function () {
        modal.close();
    });
});
