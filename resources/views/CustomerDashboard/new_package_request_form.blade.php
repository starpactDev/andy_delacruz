@extends('CustomerDashboard.layout.master')

@section('content')
    <style>
        .title {
            color: rgb(10, 78, 99);
        }

        .pickup-container {
            max-width: 1024px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: #00AEEF;
            color: #fff;
            text-align: center;
            font-size: 22px;
            padding: 15px;
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .calendar-container {
            text-align: center;
            background-color: white!important;
        }

        .calendar-container table {
            width: 100%;
            border-collapse: collapse;
        }

        .calendar-container th, .calendar-container td {
            border: 1px solid #000;
            padding: 10px;
            text-align: center;
            font-size: 18px;
            cursor: pointer;
        }

        .calendar-container th {
            background: #000;
            color: #fff;
        }
        .calendar-controls {
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 20px 0;
    gap: 15px;
}

.calendar-nav {
    background-color: #00AEEF; /* Blue background */
    color: white; /* White text */
    border: 2px solid #00AEEF; /* Same blue border */
    padding: 8px 20px;
    font-size: 16px;
    font-weight: bold;
    border-radius: 25px; /* Rounded corners */
    cursor: pointer;
    transition: background-color 0.3s, border-color 0.3s, transform 0.2s;
}

.calendar-nav:hover {
    background-color: #008B8F; /* Darker blue on hover */
    border-color: #008B8F; /* Darker border color */
    transform: scale(1.05); /* Slightly enlarge button */
}

.calendar-nav:focus {
    outline: none; /* Remove default focus outline */
    box-shadow: 0 0 8px rgba(0, 174, 239, 0.6); /* Soft focus glow */
}

select {
    padding: 8px 15px;
    font-size: 16px;
    border-radius: 5px;
    border: 1px solid #ddd;
    cursor: pointer;
    transition: border-color 0.3s;
}

select:hover {
    border-color: #00AEEF;
}

select:focus {
    border-color: #00AEEF;
    outline: none;
}
        .selected-date {
    background-color: #ffcc00 !important;
    color: #000;
    font-weight: bold;

    padding: 5px;
    display: inline-block;

    text-align: center;
    line-height: 30px;
}

        .note {
            font-size: 14px;
            color: red;
            margin-top: 10px;
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .btn-edit {
            background: red;
            color: white;
            font-size: 16px;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

        .btn-save {
            background: green;
            color: white;
            font-size: 16px;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

        .btn-update {
            background: #00AEEF;
            color: white;
            font-size: 16px;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

    </style>
<style>
    .editable[readonly] {
    background-color: #f0f0f0 !important; /* Light gray background */
    color: rgba(0, 0, 0, 0.5) !important; /* Opaque text */
    cursor: not-allowed;
}
    .past-date {
    opacity: 0.5;
    cursor: not-allowed;!important
    pointer-events: none;
    background-color: #f0f0f0; /* Light gray */
    color: #aaa;
}
</style>
    <div class="container-fluid">
        <div class="pickup-container">
            <div class="header">BOOK A NEW PICKUP REQUEST</div>

            <div class="form-group mt-3 mb-5">
                <label><strong>DATE:</strong> <span id="selectedDate" style="color:black; font-weight:600">02/20/2025</span></label>
            </div>
<?php
$sender = auth('sender')->user();
?>
 <form id="updateSenderForm">
    @csrf
    <div class="row">
        <div class="col-md-6 form-group">
            <label class="fw-bold mb-2">Full Name</label>
            <input type="text" class="form-control editable" name="full_name" value="{{ $sender->first_name }} {{ $sender->last_name }}" readonly>
        </div>
        <div class="col-md-6 form-group">
            <label class="fw-bold mb-2">Email Address</label>
            <input type="email" class="form-control editable" name="email" value="{{ $sender->email }}" readonly>
        </div>
        <div class="col-md-6 form-group">
            <label class="fw-bold mb-2">Phone Number</label>
            <input type="text" class="form-control editable" name="telephone" value="{{ $sender->telephone }}" readonly>
        </div>
        <div class="col-md-6 form-group">
            <label class="fw-bold mb-2">Street Address</label>
            <input type="text" class="form-control editable" name="street_address" value="{{ $sender->street_address }}" readonly>
        </div>
        <div class="col-md-6 form-group">
            <label class="fw-bold mb-2">City</label>
            <input type="text" class="form-control editable" name="city" value="{{ $sender->city }}" readonly>
        </div>
        <div class="col-md-6 form-group">
            <label class="fw-bold mb-2">Apartment #</label>
            <input type="text" class="form-control editable" name="apt" value="{{ $sender->apt }}" readonly>
        </div>
        <div class="col-md-6 form-group">
            <label class="fw-bold mb-2">State</label>
            <input type="text" class="form-control editable" name="state" value="{{ $sender->state }}" readonly>
        </div>
        <div class="col-md-6 form-group">
            <label class="fw-bold mb-2">Zip Code</label>
            <input type="text" class="form-control editable" name="zip" value="{{ $sender->zip }}" readonly>
        </div>
    </div>
<style>
    .btn-save[disabled] {
    cursor: not-allowed !important;
    pointer-events: auto !important; /* Allow cursor styles on disabled buttons */
}

</style>
    <div class="btn-container mt-3">
        <button type="button" class="btn btn-primary btn-edit">EDIT</button>
        <button type="submit" style="cursor:not-allowed"class="btn btn-success btn-save" disabled  title="Enable edit mode to save changes">SAVE</button>
    </div>
</form>

<div class="calendar-container mt-4">
    <h4 class="mb-5 notranslate" style="font-weight:600;color:rgb(11, 45, 95); font-size:25px;">
        SELECT THE DAY YOU WANT US TO PICK UP YOUR PACKAGE.
    </h4>
    <div class="calendar-controls">
        <button class="calendar-nav prev" onclick="prevMonth()">&#9664; Prev</button>
        <select id="monthSelect" class="notranslate" onchange="changeMonthYear()"></select>
        <select id="yearSelect" class="notranslate" onchange="changeMonthYear()"></select>
        <button class="calendar-nav next" onclick="nextMonth()">Next &#9654;</button>
    </div>
    <div id="calendar" class="notranslate"></div>
</div>

            <div class="calendar-container mt-4">
                <h4 class="mb-3" style="font-weight:600;color:rgb(11, 45, 95); font-size:25px;">SELECT THE TIME YOU WANT YOUR PACKAGES TO BE PICKED UP.</h4>
                <p class="note" style="font-weight:500">NOTE: YOUR PACKAGE WILL BE PICKED UP WITHIN A FOUR-HOUR TIME FRAME, DEPENDING ON YOUR LOCATION.</p>
                <div class="form-group">
                    <label class="fw-bold">Start Time</label>
                    <input type="time" class="form-control time-picker">
                </div>
                <div class="form-group">
                    <label  class="fw-bold">End Time</label>
                    <input type="time" class="form-control time-picker">
                </div>
            </div>

            <div class="form-group mt-2">
                <label class="fw-bold">Comments</label>
                <textarea class="form-control" rows="3">Quiero que me llamen antes de venir ,</textarea>
            </div>

            <div class="btn-container">
                <a href="{{ route('customer.dashboard') }}" class="btn btn-primary">BACK TO DASHBOARD</a>
                <button class="btn-update" style="background-color:rgb(20, 190, 20)">Submit Request</button>
            </div>
        </div>
    </div>


@endsection
@push('script')
<script>
    document.querySelectorAll('.time-picker').forEach(input => {
        input.addEventListener('click', function () {
            this.showPicker(); // Opens the time picker when clicked anywhere inside
        });
    });
</script>
<script>
   document.addEventListener("DOMContentLoaded", function () {
    let currentDate = new Date();
    let selectedMonth = currentDate.getMonth();
    let selectedYear = currentDate.getFullYear();
    let selectedDay = currentDate.getDate();

    generateMonthYearSelectors();
    generateCalendar(selectedMonth, selectedYear, selectedDay);
    function getLanguage() {
    let langCookie = getCookie("googtrans");
    console.log("googtrans Cookie:", langCookie); // Debugging

    if (langCookie) {
        let langCode = langCookie.split("/")[2]; // Extract the translated language
        console.log("Extracted Language Code:", langCode); // Debugging
        return langCode || "en"; // Default to English if undefined
    }

    let storedLang = localStorage.getItem("selectedLanguage");
    console.log("Stored Language in localStorage:", storedLang); // Debugging

    let defaultLang = document.documentElement.lang || "en";
    console.log("Default HTML Language:", defaultLang);

    return storedLang || defaultLang;
}

// Function to get a specific cookie value
function getCookie(name) {
    let match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
    return match ? decodeURIComponent(match[2]) : null;
}

function getMonthNames() {
    const monthNames = {
        en: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
        es: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"]
    };
    const lang = getLanguage();
    console.log("Detected Language for Months:", lang); // Debugging
    return monthNames[lang] || monthNames["en"];
}

function getDayNames() {
    const dayNames = {
        en: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
        es: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"]
    };
    const lang = getLanguage();
    console.log("Detected Language for Days:", lang); // Debugging
    return dayNames[lang] || dayNames["en"];
}

// Test language detection
console.log("Final Detected Language:", getLanguage());
console.log("Month Names:", getMonthNames());
console.log("Day Names:", getDayNames());

    function generateMonthYearSelectors() {
        let monthSelect = document.getElementById("monthSelect");
        let yearSelect = document.getElementById("yearSelect");
        let months = getMonthNames();

        monthSelect.innerHTML = "";
        months.forEach((month, index) => {
            let option = document.createElement("option");
            option.value = index;
            option.text = month;
            if (index === selectedMonth) option.selected = true;
            monthSelect.appendChild(option);
        });

        yearSelect.innerHTML = "";
        let startYear = selectedYear - 5;
        let endYear = selectedYear + 5;
        for (let year = startYear; year <= endYear; year++) {
            let option = document.createElement("option");
            option.value = year;
            option.text = year;
            if (year === selectedYear) option.selected = true;
            yearSelect.appendChild(option);
        }
    }

    function generateCalendar(month, year, highlightDay) {
    let calendar = document.getElementById("calendar");
    let daysInMonth = new Date(year, month + 1, 0).getDate();
    let firstDay = new Date(year, month, 1).getDay();
    let dayNames = getDayNames();
    let today = new Date();
    let isCurrentMonthYear = month === today.getMonth() && year === today.getFullYear();

    let table = '<table>';
    table += `<tr>${dayNames.map(day => `<th>${day}</th>`).join('')}</tr>`;

    let date = 1;
    for (let i = 0; i < 6; i++) {
        table += "<tr>";
        for (let j = 0; j < 7; j++) {
            if (i === 0 && j < firstDay) {
                table += "<td></td>";
            } else if (date > daysInMonth) {
                break;
            } else {
                let isPastDate = year < today.getFullYear() ||
                                 (year === today.getFullYear() && month < today.getMonth()) ||
                                 (isCurrentMonthYear && date < today.getDate());

                let isSelected = (date === highlightDay && month === selectedMonth && year === selectedYear);
                table += `<td class="calendar-day ${isSelected ? 'selected-date' : ''} ${isPastDate ? 'past-date' : ''}"
                              onclick="${isPastDate ? '' : `selectDate(this, ${date}, ${month}, ${year})`}"
                              style="${isPastDate ? 'opacity: 0.5; pointer-events: none; cursor: default;' : ''}">
                              ${date}
                          </td>`;
                date++;
            }
        }
        table += "</tr>";
    }
    table += "</table>";
    calendar.innerHTML = table;

    document.getElementById("selectedDate").innerText = `${highlightDay} ${getMonthNames()[month]} ${year}`;
}

    window.prevMonth = function () {
        selectedMonth--;
        if (selectedMonth < 0) {
            selectedMonth = 11;
            selectedYear--;
        }
        updateCalendar();
    };

    window.nextMonth = function () {
        selectedMonth++;
        if (selectedMonth > 11) {
            selectedMonth = 0;
            selectedYear++;
        }
        updateCalendar();
    };

    window.changeMonthYear = function () {
        selectedMonth = parseInt(document.getElementById("monthSelect").value);
        selectedYear = parseInt(document.getElementById("yearSelect").value);
        updateCalendar();
    };

    function updateCalendar() {
        let dayToHighlight = selectedDay;
        if (selectedMonth !== currentDate.getMonth() || selectedYear !== currentDate.getFullYear()) {
            dayToHighlight = 1;
        }
        generateCalendar(selectedMonth, selectedYear, dayToHighlight);
        generateMonthYearSelectors();
    }

    window.selectDate = function (element, day, month, year) {
        document.querySelectorAll(".calendar-day").forEach(dayElem => {
            dayElem.classList.remove("selected-date");
        });
        element.classList.add("selected-date");
        selectedDay = day;
        document.getElementById("selectedDate").innerText = `${selectedDay} ${getMonthNames()[month]} ${year}`;
    };

    // Detect language change and update calendar
    const observer = new MutationObserver(() => {
        let lang = getLanguage();
        if (document.getElementById("selectedDate").dataset.lang !== lang) {
            document.getElementById("selectedDate").dataset.lang = lang;
            generateMonthYearSelectors();
            generateCalendar(selectedMonth, selectedYear, selectedDay);
        }
    });

    observer.observe(document.documentElement, { attributes: true, attributeFilter: ["lang"] });
});

    </script>
<script>
   $(document).ready(function () {
    $(".btn-edit").on("click", function () {
        Swal.fire({
            title: "Edit Mode Enabled!",
            text: "You can now edit your address details.",
            icon: "info",
            confirmButtonText: "OK"
        });

        $(".editable").removeAttr("readonly");
        $(".btn-save").removeAttr("disabled").removeAttr("title"); // Enable button and remove tooltip
    });

    $("#updateSenderForm").on("submit", function (e) {
        e.preventDefault();

        $.ajax({
            url: "{{ route('update.sender') }}",
            type: "POST",
            data: $(this).serialize(),
            success: function (response) {
                Swal.fire({
                    title: "Success!",
                    text: response.message,
                    icon: "success",
                    confirmButtonText: "OK"
                });

                $(".editable").attr("readonly", true);
                $(".btn-save")
                    .attr("disabled", true)
                    .attr("title", "Enable edit mode to save changes"); // Add tooltip again when disabled
            },
            error: function (xhr) {
                Swal.fire({
                    title: "Error!",
                    text: "Something went wrong. Please try again.",
                    icon: "error",
                    confirmButtonText: "OK"
                });
            }
        });
    });

    // Optional: Show a hand icon on hover for disabled buttons
    $(".btn-save").hover(function () {
        if ($(this).is(":disabled")) {
            $(this).css("cursor", "not-allowed");
        } else {
            $(this).css("cursor", "pointer");
        }
    });
});

</script>
@endpush

