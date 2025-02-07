document.getElementById('image').onchange = function (event) {
    const [file] = event.target.files;
    if (file) {
        document.getElementById('image-preview').src = URL.createObjectURL(file);
    }
};

document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('roomeditmodal');
    const closeEditModal = document.getElementById('closeEditModal');
    const openButtons = document.querySelectorAll('.openModalButton');

    openButtons.forEach(button => {

        button.addEventListener('click', function () {
            const roomData = JSON.parse(this.getAttribute('data-room'));

            document.getElementById('id').value = roomData.id;
            document.getElementById('roomID').value = roomData.roomID;
            document.getElementById('resortID').value = roomData.resortID;
            // resortData.room_type != null ? document.getElementById('room_type').value = resortData.room_type : null;
            document.getElementById('room_type').value = roomData.room_type || '';
            document.getElementById('image-preview').src = roomData.room_image ? `${window.location.origin}/images/room_images/${roomData.room_image}` : `${window.location.origin}/images/room_images/default.jpg`;
            document.getElementById('description').value = roomData.description;
            document.getElementById('inclusions').value = roomData.inclusions;
            document.getElementById('capacity').value = roomData.capacity;
            document.getElementById('amenities').value = roomData.amenities;

            modal.showModal();
        });
    });

    closeEditModal.addEventListener('click', function () {
        modal.close();
    });

});