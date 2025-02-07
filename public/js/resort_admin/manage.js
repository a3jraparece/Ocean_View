const edit = document.getElementById('edit');
const cancel = document.getElementById('cancel');

let inputs;
let text_editable;
let ameneties;

function reAssignDate() {
    inputs = document.querySelectorAll('.inputs');
    text_editable = document.querySelectorAll('.text_editable');
    ameneties = document.querySelectorAll('.ameneties');
}

function editclicked() {
    reAssignDate();
    edit.style.display = 'none';
    cancel.style.display = 'block';
    inputs.forEach(input => input.style.display = 'block');
    text_editable.forEach(editable => editable.removeAttribute('readonly'));
    ameneties.forEach(amenetiy => amenetiy.style.display = 'block');
}

function cancelclicked() {
    reAssignDate();
    edit.style.display = 'block';
    cancel.style.display = 'none';
    inputs.forEach(input => input.style.display = 'none');
    text_editable.forEach(editable => editable.setAttribute('readonly', true));
    ameneties.forEach(amenetiy => amenetiy.style.display = 'none');
}

document.getElementById('mainImage').onchange = function (event) {
    const [file] = event.target.files;
    if (file) {
        document.getElementById('mainImage_prev').src = URL.createObjectURL(file);
    }
};

document.getElementById('image2').onchange = function (event) {
    const [file] = event.target.files;
    if (file) {
        document.getElementById('image2_prev').src = URL.createObjectURL(file);
    }
};

document.getElementById('image3').onchange = function (event) {
    const [file] = event.target.files;
    if (file) {
        document.getElementById('image3_prev').src = URL.createObjectURL(file);
    }
};

document.getElementById('image1').onchange = function (event) {
    const [file] = event.target.files;
    if (file) {
        document.getElementById('image1_prev').src = URL.createObjectURL(file);
    }
};

document.getElementById('image1_2').onchange = function (event) {
    const [file] = event.target.files;
    if (file) {
        document.getElementById('image1_2_prev').src = URL.createObjectURL(file);
    }
};

document.getElementById('image1_3').onchange = function (event) {
    const [file] = event.target.files;
    if (file) {
        document.getElementById('image1_3_prev').src = URL.createObjectURL(file);
    }
};


document.getElementById('room_image_1').onchange = function (event) {
    const [file] = event.target.files;
    if (file) {
        document.getElementById('room_image_1_prev').src = URL.createObjectURL(file);
    }
};

document.getElementById('room_image_2').onchange = function (event) {
    const [file] = event.target.files;
    if (file) {
        document.getElementById('room_image_2_prev').src = URL.createObjectURL(file);
    }
};

document.getElementById('room_image_3').onchange = function (event) {
    const [file] = event.target.files;
    if (file) {
        document.getElementById('room_image_3_prev').src = URL.createObjectURL(file);
    }
};

function deleteInputAmenity(deleteButton) {
    var inputDiv = deleteButton.parentNode; // Get the parent div of the button
    inputDiv.remove(); // Remove the div (input field, edit, and delete buttons)
}

function addAmenities() {
    var container = document.getElementById("amenitiesHolder");

    var newInputDiv = document.createElement("div");


    newInputDiv.setAttribute("class", "d-flex mt-2");

    var newInput = document.createElement("input");
    newInput.setAttribute("type", "text");
    newInput.setAttribute("class", "form-control me-2 text_editable");
    newInput.setAttribute("name", "amenities[]");
    newInput.setAttribute("placeholder", "Aminities 1/ame 1, ame 2, ame 3");

    var deleteButton = document.createElement("button");
    deleteButton.textContent = "Delete";
    deleteButton.setAttribute("type", "button");
    deleteButton.setAttribute("class", "btn btn-danger ameneties");
    deleteButton.setAttribute("onclick", "deleteInputAmenity(this)");

    newInputDiv.appendChild(newInput);
    newInputDiv.appendChild(deleteButton);

    container.appendChild(newInputDiv);
}