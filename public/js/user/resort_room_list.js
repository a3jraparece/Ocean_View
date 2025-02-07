let bookingTotalHolder;

let currentRoomHolder;

document.addEventListener("keydown", function (event) {
    if (event.key === "Escape") {
        document.body.classList.remove("no-scroll");
        closeImageView();
    }
});

function updateBudgetValue(value) {
    const budgetValue = document.querySelector(".slider-value");
    budgetValue.textContent = `₱${new Intl.NumberFormat().format(
        value
    )} - ₱40,000+`;
}

document.addEventListener("DOMContentLoaded", () => {

    // SA PREFERENCE DATE NI HA

    // Get today's date in YYYY-MM-DD format
    const today = new Date().toISOString().split("T")[0];

    // Set the default value and minimum allowed value
    const checkinDateInput = document.getElementById("checkinDate");
    // checkinDateInput.value = today;
    checkinDateInput.min = today;

    // SA PREFERENCE DATE NI HA (END)

    const modal = document.getElementById("roomOpenModalBooking");
    const buttons = document.querySelectorAll(".openRoomInfoButton");

    buttons.forEach((button) => {
        button.addEventListener("click", function () {
            const roomData = JSON.parse(this.getAttribute("data-room"));
            const room_rate = JSON.parse(this.getAttribute("data-room_rate"));
            const resort = JSON.parse(this.getAttribute("data-resort"));

            currentRoomHolder = roomData;

            document.getElementById("roomID").textContent =
                "Room " + roomData.roomID;
            document.getElementById("room_image").src = roomData.room_image
                ? `${window.location.origin}/images/room_images/${roomData.room_image}`
                : `${window.location.origin}/images/room_images/default.jpg`;
            document.getElementById("room_description").textContent =
                roomData.description;

            const ulInclusions = document.getElementById("inclusions");
            ulInclusions.replaceChildren();
            if (
                roomData.inclusions &&
                typeof roomData.inclusions === "string"
            ) {
                roomData.inclusions.split(",").forEach((inclusion) => {
                    const li = document.createElement("li");
                    li.textContent = inclusion.trim();
                    ulInclusions.appendChild(li);
                });
            }

            document.getElementById("capacity").textContent = roomData.capacity;

            const ulAmenities = document.getElementById("amenities");
            ulAmenities.replaceChildren();
            if (roomData.amenities && typeof roomData.amenities === "string") {
                roomData.amenities.split(",").forEach((amenities) => {
                    const li = document.createElement("li");
                    li.textContent = amenities.trim();
                    ulAmenities.appendChild(li);
                });
            }

            // if ta drig room type then e reutn ang roomtype then ang iyang PerformanceEntry, also ang subtotal pud if e compute napu basing ating percent then gi pasa nga room_rate()or yung orice per night

            const roomTypes = {
                "King Size Bed": { percentage: 20, multiplier: 1.2 },
                "Queen Size Bed": { percentage: 15, multiplier: 1.15 },
                Suite: { percentage: 10, multiplier: 1.1 },
                "Double Bed": { percentage: 5, multiplier: 1.05 },
                "Single Bed": { percentage: 0, multiplier: 1.0 },
            };

            const roomTypeData = roomTypes[roomData.room_type];

            if (roomTypeData) {
                document.getElementById("room_type").textContent =
                    roomData.room_type;
                document.getElementById(
                    "room_percentage"
                ).textContent = `${roomTypeData.percentage}%`;
                document.getElementById("sub-total").textContent =
                    "₱" +
                    (room_rate * roomTypeData.multiplier).toLocaleString(
                        "en-US",
                        {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2,
                        }
                    );

                const sub_total = room_rate * roomTypeData.multiplier;

                const totalTax =
                    sub_total * 0.1 +
                    sub_total * (Number(resort["taxRate"]) / 100);
                document.getElementById("total").textContent =
                    "₱" +
                    (sub_total + totalTax).toLocaleString("en-US", {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2,
                    });
            }

            document.getElementById("service_charge").textContent =
                resort["taxRate"];

            modal.showModal();
            document.body.classList.add("no-scroll");
        });
    });

    const openRoomBookNowButton = document.querySelectorAll(
        ".openRoomBookNowButton"
    );

    openRoomBookNowButton.forEach((buttons) => {
        buttons.addEventListener("click", function () {
            if (!document.getElementById("consent").checked) {
                alert(
                    "Please Check the consent first that can be found on update preferences"
                );
                return;
            }

            if (checkFormUpdateChanged()) {
                return;
            }

            const resort = JSON.parse(this.getAttribute("data-resort"));
            const roomData = currentRoomHolder
                ? currentRoomHolder
                : JSON.parse(this.getAttribute("data-room"));
            const roomRate = JSON.parse(this.getAttribute("data-room_rate"));
            const user = this.getAttribute("data-user")
                ? JSON.parse(this.getAttribute("data-user"))
                : null;
            const loginURL = this.getAttribute("data-loginURL");
            const events = JSON.parse(this.getAttribute("data-events"));

            if (!user) {
                window.location.href = loginURL;
                return;
            }

            // SET Stay total
            document.getElementById("currentStayTotalRoomRate").textContent =
                "₱" +
                roomRate.toLocaleString("en-US", {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2,
                });
            // END SET

            document.getElementById("firstName").value = user?.f_name ?? "";
            document.getElementById("middleName").value = user["m_name"];
            document.getElementById("surname").value = user["l_name"];
            document.getElementById("contactNumber").value =
                user["phone_number"];
            document.getElementById("checkIn").value =
                document.getElementById("checkinDate").value;
            document.getElementById("daysStay").value =
                document.getElementById("daysOfStay").value;
            document.getElementById("numGuests").value =
                document.getElementById("maxGuests").value;

            document.getElementById("bookingROOMimage").src =
                roomData.room_image
                    ? `${window.location.origin}/images/room_images/${roomData.room_image}`
                    : `${window.location.origin}/images/room_images/default.jpg`;
            document.getElementById("bookingROOMID").textContent =
                roomData["roomID"];
            document.getElementById("bookingRESORTNAME").textContent =
                resort["resort_name"];
            document.getElementById("bookingROOMTYPE").textContent =
                roomData["room_type"];
            document.getElementById("bookingNumOfGuest").textContent =
                document.getElementById("maxGuests").value;
            document.getElementById("bookingCheckInDate").textContent =
                document.getElementById("checkinDate").value;
            // document.getElementById('bookingCheckOutDate').textContent = document.getElementById('checkinDate').value.setDate(parsedDate.getDate() + 5);

            const checkinDateValue =
                document.getElementById("checkinDate").value;

            let parsedDateCheckOutDate;
            if (checkinDateValue) {
                parsedDateCheckOutDate = new Date(checkinDateValue);
                parsedDateCheckOutDate.setDate(
                    parsedDateCheckOutDate.getDate() +
                    Number(document.getElementById("daysStay").value) -
                    1
                );
                document.getElementById("bookingCheckOutDate").textContent =
                    parsedDateCheckOutDate.toLocaleDateString("en-CA");
            }

            const ulAmenities = document.getElementById("bookingAmenities");
            ulAmenities.replaceChildren();
            if (roomData.amenities && typeof roomData.amenities === "string") {
                roomData.amenities.split(",").forEach((amenities) => {
                    const li = document.createElement("li");
                    li.textContent = amenities.trim();
                    ulAmenities.appendChild(li);
                });
            }

            const bookingStartDate = new Date(
                document.getElementById("checkinDate").value
            );
            const totalDaysOfStay = Number(
                document.getElementById("daysStay").value
            );
            const bookingEndDate = new Date(
                new Date(document.getElementById("checkinDate").value).setDate(
                    new Date(
                        document.getElementById("checkinDate").value
                    ).getDate() +
                    (totalDaysOfStay - 1)
                )
            );
            // const bookingEndDate = new Date(bookingStartDate);
            // bookingEndDate.setDate(bookingStartDate.getDate() + 3);

            let dailyRate = 0;

            const roomTypes = {
                "King Size Bed": { percentage: 20, multiplier: 1.2 },
                "Queen Size Bed": { percentage: 15, multiplier: 1.15 },
                Suite: { percentage: 10, multiplier: 1.1 },
                "Double Bed": { percentage: 5, multiplier: 1.05 },
                "Single Bed": { percentage: 0, multiplier: 1.0 },
            };

            const roomTypeData = roomTypes[roomData["room_type"]];

            // SET STAY TOTAL
            document.getElementById("currentStayTotalBedType").textContent =
                roomData["room_type"];

            document.getElementById(
                "currentStayTotalBedTypePercent"
            ).textContent = roomTypes[roomData["room_type"]].percentage + "%";

            document.getElementById("currentStaySubTotal").textContent =
                "₱" +
                (
                    roomTypes[roomData["room_type"]].multiplier * roomRate
                ).toLocaleString("en-US", {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2,
                });

            if (roomTypeData) {
                dailyRate = roomRate * roomTypeData.multiplier;
            }

            let totalDiscount = 0;
            let totalDiscountPercet = 0;

            let tbody = document.getElementById("specialDayTBody");
            while (tbody.rows.length > 0) {
                tbody.deleteRow(0); // Remove the first row until there are no more rows
            }

            for (
                let date = new Date(bookingStartDate);
                date <= bookingEndDate;
                date.setDate(date.getDate() + 1)
            ) {
                events.some((event) => {
                    if (
                        date >= new Date(event["start_date"]) &&
                        date <= new Date(event["end_date"])
                    ) {
                        // console.log(
                        //     "booking:",
                        //     date.toLocaleDateString("en-CA"),
                        //     "event",
                        //     event["start_date"]
                        // );
                        // console.log(
                        //     "booking: ",
                        //     bookingEndDate.toLocaleDateString("en-CA"),
                        //     "event",
                        //     event["end_date"]
                        // );
                        // console.log(event["name"]);

                        totalDiscount += dailyRate * 0.08;
                        totalDiscountPercet += 10;

                        // so if mag true ni deri ang himoon is mag add og isa ka row with the date price discount_percentage tas total

                        let newRow = document
                            .getElementById("specialDayTBody")
                            .insertRow();

                        newRow.insertCell(0).textContent =
                            date.toLocaleDateString("en-CA");
                        newRow.insertCell(1).textContent = event["name"];
                        newRow.insertCell(2).textContent =
                            "₱" +
                            dailyRate.toLocaleString("en-US", {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2,
                            });
                        newRow.insertCell(3).textContent = "8%";

                        newRow.insertCell(4).textContent =
                            "₱" +
                            (dailyRate * 0.08).toLocaleString("en-US", {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2,
                            });

                        return true;
                    }
                    return false;
                });
            }

            let days = Number(document.getElementById("daysOfStay").value);
            let percent = 0;

            if (days >= 7) {
                percent =
                    Math.floor(days / 7) * 2 >= 20
                        ? 20
                        : Math.floor(days / 7) * 2;

                document.getElementById("currentStayTotalInWeeks").textContent =
                    Math.floor(days / 7);
            } else {
                document.getElementById(
                    "currentStayTotalInWeeks"
                ).textContent = 0;
            }

            document.getElementById("stayTotalDiscount").textContent =
                "₱" +
                totalDiscount.toLocaleString("en-US", {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2,
                });

            // console.log(percent);

            // console.log(dailyRate);
            // console.log('-------------------------------------');
            // console.log('Start Date:', bookingStartDate.toLocaleDateString('en-CA'));
            // console.log('End Date:', bookingEndDate.toLocaleDateString('en-CA'));
            // console.log('Total Days', totalDaysOfStay);

            // console.log('total discount: ', totalDiscount);
            // console.log('percent', totalDiscountPercet);

            const stayTotalDiscount =
                totalDaysOfStay * dailyRate * (percent / 100);

            const subTotalCost =
                totalDaysOfStay * dailyRate - totalDiscount - stayTotalDiscount;

            document.getElementById("bookingSTAYTOTAL").textContent =
                subTotalCost.toLocaleString("en-US", {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2,
                });

            // SET Stay Total

            document.getElementById("currentStayTotalDaysOfStay").textContent =
                days;

            document.getElementById("STsubtotal").textContent =
                "₱" +
                (totalDaysOfStay * dailyRate).toLocaleString("en-US", {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2,
                });

            document.getElementById("STtotalStayPercentDiscount").textContent =
                percent.toLocaleString("en-US", {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2,
                }) + "%";

            document.getElementById("STFinalTotalPaymentBefore").textContent =
                "₱" +
                (totalDaysOfStay * dailyRate).toLocaleString("en-US", {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2,
                });

            document.getElementById("STFinalSpecialDays").textContent =
                "₱" +
                totalDiscount.toLocaleString("en-US", {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2,
                });

            document.getElementById("STtotalStayDiscount").textContent =
                "₱" +
                (totalDaysOfStay * dailyRate * (percent / 100)).toLocaleString(
                    "en-US",
                    {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2,
                    }
                );

            document.getElementById("STFinalLongStayDiscount").textContent =
                "₱" +
                (totalDaysOfStay * dailyRate * (percent / 100)).toLocaleString(
                    "en-US",
                    {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2,
                    }
                );

            document.getElementById("STFinalTotalPayment").textContent =
                "₱" +
                subTotalCost.toLocaleString("en-US", {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2,
                });

            // END STAY TOTAl

            const totalTaxes =
                subTotalCost * 0.1 +
                subTotalCost * (Number(resort["taxRate"]) / 100);
            document.getElementById("bookingTAXES").textContent =
                totalTaxes.toLocaleString("en-US", {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2,
                });

            const bookingTotal = subTotalCost + totalTaxes;
            bookingTotalHolder = bookingTotal;
            document.getElementById("bookingTOTAL").textContent =
                bookingTotal.toLocaleString("en-US", {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2,
                });

            document.getElementById("bookingTOTALPAYMENTTOAPAY").textContent =
                "₱" +
                (bookingTotal - bookingTotal * 0.1).toLocaleString("en-US", {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2,
                });

            document.getElementById("bookingOpenModal").showModal();
            document.body.classList.add("no-scroll");
            // ang kulang dri is yung mag pop up ka for details atong tax and stay total

            document.getElementById("bookingUSERID").value = user["guestID"];
            document.getElementById("bookingRESORTID").value =
                resort["resortID"];
            document.getElementById("bookingROOMIDpost").value =
                roomData["roomID"];
            document.getElementById("bookingSTARTDATEpost").value =
                bookingStartDate.toLocaleDateString("en-CA");
            document.getElementById("bookingENDDATEpost").value =
                bookingEndDate.toLocaleDateString("en-CA");
            document.getElementById("bookingTOTALAMOUNTpost").value = (
                bookingTotal -
                bookingTotal * 0.1
            ).toFixed(2);

            // SET Taxes POPUPMODAL

            document.getElementById("serviceCharge").textContent =
                resort["taxRate"] + "%";

            document.getElementById("BFTstayingfee").textContent =
                "₱" +
                subTotalCost.toLocaleString("en-US", {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2,
                });

            document.getElementById("BFTserviceCharge").textContent =
                resort["taxRate"] + "%";

            document.getElementById("BFTtaxtotal").textContent =
                "₱" +
                (
                    subTotalCost * 0.1 +
                    subTotalCost * (resort["taxRate"] / 100)
                ).toLocaleString("en-US", {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2,
                });
            //


            // // SET BOOKING SUCCESSCFULL

            // let formattedCheckInDate = new Date(document.getElementById("checkinDate").value)
            //     .toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });

            // let formattedCheckOutDate = parsedDateCheckOutDate.toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });

            // document.getElementById("veryFinalBookingCheckIn").textContent = formattedCheckInDate;
            // document.getElementById("veryFinalBookingCheckOut").textContent = formattedCheckOutDate;
            // document.getElementById("veryFinalBookingCovered").textContent = "₱" + (
            //     bookingTotal -
            //     bookingTotal * 0.1
            // ).toLocaleString("en-US", {
            //     minimumFractionDigits: 2,
            //     maximumFractionDigits: 2,
            // });;
            // document.getElementById("veryFinalBookingTotal").textContent = "₱" + (
            //     bookingTotal -
            //     bookingTotal * 0.1
            // ).toLocaleString("en-US", {
            //     minimumFractionDigits: 2,
            //     maximumFractionDigits: 2,
            // });
            // // END
        });
    });

    document.querySelectorAll(".closeModal").forEach((close) => {
        close.addEventListener("click", function () {
            document.getElementById("bookingOpenModal").close();
            modal.close();
            document.body.classList.remove("no-scroll");
        });
    });
});

function paymentmethod(x) {
    if (x == 1) {
        document.getElementById("bookingTOTALPAYMENTTOAPAY").textContent = "₱" + (
            bookingTotalHolder -
            bookingTotalHolder * 0.1
        ).toLocaleString("en-US", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
        });
        document.getElementById("bookingSUBTOTALpost").value = null;
        document.getElementById("bookingPAYMENTMETHODpost").value =
            "Full Payment";
        document.getElementById("bookingSTATUSpost").value = "Fully Paid";
        document.getElementById("bookingTOTALAMOUNTpost").value = bookingTotalHolder - (bookingTotalHolder * .10);
    } else {
        document.getElementById("bookingTOTALPAYMENTTOAPAY").textContent = "₱" + (
            bookingTotalHolder / 2
        ).toLocaleString("en-US", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
        });
        document.getElementById("bookingSUBTOTALpost").value = (
            bookingTotalHolder / 2
        ).toFixed(2);
        document.getElementById("bookingPAYMENTMETHODpost").value =
            "Down Payment";
        document.getElementById("bookingSTATUSpost").value = "Partially Paid";
        document.getElementById("bookingTOTALAMOUNTpost").value = bookingTotalHolder;
    }
}

document.getElementById("consent").onclick = () => {
    const update_input = document.querySelectorAll(".update_input");
    if (!document.getElementById("consent").checked) {
        update_input.forEach((input) => {
            input.removeAttribute("disabled");
        });
        document.getElementById("updated_button").removeAttribute("disabled");
    } else {
        update_input.forEach((input) => {
            input.setAttribute("disabled", true);
        });
        document
            .getElementById("updated_button")
            .setAttribute("disabled", true);
    }
};

function checkFormUpdateChanged() {
    let currentStartDate = document.getElementById("currentStartDate").value;
    let currentDaysOfStay = document.getElementById("currentDaysOfStay").value;

    let checkinDate = document.getElementById("checkinDate").value;
    let daysOfStay = document.getElementById("daysOfStay").value;

    if (currentStartDate != checkinDate || currentDaysOfStay != daysOfStay) {
        alert(
            "We have noticed that you have made some changes to your booking preferences. We kindly request that you update your preferences accordingly."
        );
        return true;
    }
    return false;
}

function openStayTotalInfo(x) {
    if (x == 1) {
        document.getElementById("stayTotalPopUp").showModal();
        return;
    }
    document.getElementById("stayTotalPopUp").close();
}

function taxesTotalPopUp(x) {
    if (x == 1) {
        document.getElementById("taxesTotalPopUp").showModal();
        return;
    }
    document.getElementById("taxesTotalPopUp").close();
}

function bookingreadyOpenModal(x) {
    if (x == 1) {
        document.getElementById('bookingready').showModal();
    } else {
        document.getElementById('bookingready').close();
    }
}

function bookingreadyProcessOpenModal(x) {
    if (x == 1) {
        document.getElementById('bookNowFormSubmit').submit();
    } else {
        document.getElementById('bookingreadyProcess').close();
        document.body.classList.remove("no-scroll");
    }
}

function bookingreadyProcessFailedOpenModal(x) {
    if (x == 1) {
        // document.getElementById('bookNowFormSubmit').submit();
    } else {
        document.getElementById('bookingreadyProcessFailed').close();
        document.body.classList.remove("no-scroll");
    }
}

function viewImage(imgElement) {
    document.getElementById('imageToSwap').src = imgElement.src;
    document.getElementById('userImageView').style.display = "flex";
    document.body.classList.add("no-scroll");
}

function closeImageView() {
    document.getElementById('userImageView').style.display = "none";
    document.body.classList.remove("no-scroll");
}


