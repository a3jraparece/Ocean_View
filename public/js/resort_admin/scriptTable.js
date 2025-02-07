
document.addEventListener("DOMContentLoaded", function () {
  const table = document.getElementById("reservationTable");
  const tooltip = document.getElementById("tooltip");
  let isTooltipPinned = false;

  table.addEventListener("mouseover", function (e) {
    if (!isTooltipPinned && e.target.tagName === "TD") {
      const info = JSON.parse(e.target.getAttribute("data-info"));
      const roomData = JSON.parse(e.target.getAttribute("data-roomlists"));
      if (info) {

        console.log(info);
        console.log(roomData);

        document.getElementById('tooltipName').textContent = info['guest']['f_name'] + " " + info['guest']['m_name'] + " " + info['guest']['l_name'];

        info['payment_method'] === "Down Payment" ? document.getElementById('toolDown').checked = true : document.getElementById('toolFull').checked = true;

        roomData.forEach(roomIDtoCheck => {
          if (roomIDtoCheck['roomID'] == info['roomID']) {
            document.getElementById('tooltipRoomIMG').src = `${window.location.origin}/images/room_images/${roomIDtoCheck.room_image}`;
            document.getElementById('tooltipRoomType').textContent = roomIDtoCheck['room_type'];
            document.getElementById('tooltipGuest').textContent = roomIDtoCheck['capacity'];
            return;
          }
        });

        document.getElementById('tooltipRoom').textContent = "Floor " + info['roomID'].split('-')[0] + " - " + "Room " + info['roomID'].split('-')[1];

        const startdate = new Date(info['start_date']);
        const startreadableDate = startdate.toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });

        const enddate = new Date(info['end_date']);
        const endreadableDate = enddate.toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });

        document.getElementById('tooltipCheckIn').textContent = startreadableDate;
        document.getElementById('tooltipCheckOut').textContent = endreadableDate;
        document.getElementById('tooltipTotalStay').textContent = "₱" + (Number(info['total_amount'])).toLocaleString("en-US", {
          minimumFractionDigits: 2,
          maximumFractionDigits: 2,
        });

        tooltip.classList.remove("hidden");

        setTooltipPosition(e.pageX);
      }
    }
  });

  table.addEventListener("mousemove", function (e) {
    if (!isTooltipPinned) {
      setTooltipPosition(e.pageX);
    }
  });

  table.addEventListener("mouseout", function (e) {
    if (!isTooltipPinned && e.target.tagName === "TD") {
      tooltip.classList.add("hidden");
    }
  });

  table.addEventListener("click", function (e) {
    if (e.target.tagName === "TD") {
      const info = e.target.getAttribute("data-info");
      if (info) {
        isTooltipPinned = true;
        setTooltipPosition(e.pageX);
      }
    }
  });

  document.addEventListener("click", function (e) {
    if (!table.contains(e.target)) {
      isTooltipPinned = false;
      tooltip.classList.add("hidden");
    }
  });

  function setTooltipPosition(mouseX) {
    const tooltipRect = tooltip.getBoundingClientRect();
    const screenWidth = window.innerWidth;
    let tooltipX = mouseX + 10;

    if (tooltipX + tooltipRect.width > screenWidth) {
      tooltipX = mouseX - tooltipRect.width - 10;
    }

    tooltip.style.top = "8px";
    tooltip.style.left = `${tooltipX}px`;
  }

});