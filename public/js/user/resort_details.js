function checkLoginAndSubmit(isLoggedIn) {
    if (!isLoggedIn) {
        alert("You must be logged in to submit this form.");
        return;
    }

    if (!confirm('Are you sure you want to submit your comment?')) {
        return;
    }

    document.getElementById("addReviewForm").submit();
}

//Star rating
const stars = document.querySelectorAll(".star-rating .fa-star");
let selectedRating = 0;

document.addEventListener('DOMContentLoaded', () => {
    stars.forEach((star) => {
        star.addEventListener("click", function () {
            selectedRating = parseInt(star.getAttribute("data-index"));
            document.getElementById('formRating').value = selectedRating;
            updateStars(selectedRating);
        });
    });

    function updateStars(rating) {
        stars.forEach((star) => {
            const index = parseInt(star.getAttribute("data-index"));
            if (index <= rating) {
                star.classList.add("checked");
            } else {
                star.classList.remove("checked");
            }
        });
    }
});

//Add div
const cardTexts = document.querySelectorAll(".card-text");
const seeMoreLinks = document.querySelectorAll(".seemore");

// New div add
function addCard() {
    var container = document.getElementById("card-container");

    var colDiv = document.createElement("div");
    colDiv.classList.add("col");

    var cardDiv = document.createElement("div");
    cardDiv.classList.add("card");

    var userInfoDiv = document.createElement("div");
    userInfoDiv.classList.add("userinfo", "d-flex", "mt-2", "ms-3");

    var userImg = document.createElement("img");
    userImg.setAttribute("src", "otenialex/logo.jpg");
    userImg.setAttribute("alt", "");
    userImg.classList.add("rounded-circle");
    userImg.style.height = "60px";
    userImg.style.width = "60px";

    var nameDiv = document.createElement("div");
    nameDiv.classList.add("nameofUser", "ms-2");

    var userName = document.createElement("h6");
    userName.classList.add("card-subtitle", "mt-0", "text-muted", "ms-2");
    userName.textContent = "Alex Apache";

    var userNickname = document.createElement("h7");
    userNickname.classList.add("card-subtitle", "mb-1", "text-muted", "ms-2");
    userNickname.textContent = "Alex";

    nameDiv.appendChild(userName);
    nameDiv.appendChild(userNickname);

    userInfoDiv.appendChild(userImg);
    userInfoDiv.appendChild(nameDiv);

    var cardBody = document.createElement("div");
    cardBody.classList.add("card-body");

    var cardTitle = document.createElement("h5");
    cardTitle.classList.add("card-title");
    cardTitle.textContent = "Card title";

    var cardText = document.createElement("p");
    cardText.classList.add("card-text");
    cardText.textContent =
        "Some quick example text to build on the card title and make up the bulk of the card's content.";

    var seeMoreLink = document.createElement("p");
    seeMoreLink.classList.add("card-link", "text-primary", "seemore");
    seeMoreLink.textContent = "See more";

    cardBody.appendChild(cardTitle);
    cardBody.appendChild(cardText);
    cardBody.appendChild(seeMoreLink);

    cardDiv.appendChild(userInfoDiv);
    cardDiv.appendChild(cardBody);

    colDiv.appendChild(cardDiv);

    container.appendChild(colDiv);
}

// See more
function checkLine() {
    cardTexts.forEach((cardText, index) => {
        cardText.style.overflow = "hidden";
        cardText.style.textOverflow = "ellipsis";
        cardText.style.display = "-webkit-box";
        cardText.style.WebkitLineClamp = 3;
        cardText.style.WebkitBoxOrient = "vertical";

        const seeMoreLink = seeMoreLinks[index];

        const originalHeight = cardText.offsetHeight;

        cardText.style.WebkitLineClamp = "none";
        const fullHeight = cardText.scrollHeight;

        cardText.style.WebkitLineClamp = 3;

        if (fullHeight > originalHeight) {
            seeMoreLink.style.display = "block";
        } else {
            seeMoreLink.style.display = "none";
        }

        seeMoreLink.addEventListener("click", () => {
            if (cardText.style.WebkitLineClamp === "3") {
                cardText.style.WebkitLineClamp = "none";
                seeMoreLink.textContent = "See less";
            } else {
                cardText.style.WebkitLineClamp = "3";
                seeMoreLink.textContent = "See more";
            }
        });
    });
}
window.onload = checkLine;
