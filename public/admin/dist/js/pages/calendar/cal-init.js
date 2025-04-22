/*========Calender Js=========*/
/*==========================*/

document.addEventListener("DOMContentLoaded", function () {
    /*=================*/
    //  Calender Date variable
    /*=================*/
    var newDate = new Date();
    function getDynamicMonth() {
      getMonthValue = newDate.getMonth();
      _getUpdatedMonthValue = getMonthValue + 1;
      if (_getUpdatedMonthValue < 10) {
        return `0${_getUpdatedMonthValue}`;
      } else {
        return `${_getUpdatedMonthValue}`;
      }
    }
    /*=================*/
    // Calender Modal Elements
    /*=================*/
    var getModalTitleEl = document.querySelector("#event-title");
    var getModalDateEl = document.querySelector("#event-date");
    var getModalStartDateEl = document.querySelector("#event-start-date");
    var getModalEndDateEl = document.querySelector("#event-end-date");
    var getModalAddBtnEl = document.querySelector(".btn-add-event");
    var getModalUpdateBtnEl = document.querySelector(".btn-update-event");
    var myModal = new bootstrap.Modal(document.getElementById("eventModal"));
    var calendarsEvents = {
      Danger: "danger",
      Success: "success",
      Primary: "primary",
      Warning: "warning",
    };
    /*=====================*/
    // Calendar Elements and options
    /*=====================*/
    var calendarEl = document.querySelector("#calendar");
    var checkWidowWidth = function () {
      if (window.innerWidth <= 1199) {
        return true;
      } else {
        return false;
      }
    };
    var calendarHeaderToolbar = {
      left: "prev next addEventButton",
      center: "title",
      right: "dayGridMonth,timeGridWeek,timeGridDay",
    };



    /*=====================*/
    // Fetch Events from Database
    /*=====================*/

    async function fetchEvents() {
        const response = await fetch(calendarEventsRoute);  // Update with your endpoint
        const events = await response.json();
        return events;
    }

    /*=====================*/
    // Calendar Select fn.
    /*=====================*/
    var calendarSelect = function (info) {
      getModalAddBtnEl.style.display = "block";
      getModalUpdateBtnEl.style.display = "none";
      myModal.show();
      getModalStartDateEl.value = info.startStr;
      getModalEndDateEl.value = info.endStr;
    };
    /*=====================*/
    // Calendar AddEvent fn.
    /*=====================*/
    function resetModalFields() {

        var getModalDateEl = document.querySelector("#event-date");
        var getModalCommentsEl = document.getElementById('event-comments');
        var getModalDriverEl = document.getElementById('driver');
        var getModalCustomerEl = document.getElementById('assigned_employee');
        var getModalStartTimeEl = document.getElementById('event-start-time');
        var getModalEndTimeEl = document.getElementById('event-end-time');
        getModalCommentsEl.value = "";
        getModalDriverEl.value = "";
        getModalCustomerEl.value = "";
        getModalStartTimeEl.value = "";
        getModalEndTimeEl.value = "";

        getModalDateEl.value = "";
        var getModalIfCheckedRadioBtnEl = document.querySelector(
            'input[name="event-level"]:checked'
        );

        if (getModalIfCheckedRadioBtnEl !== null) {

            getModalIfCheckedRadioBtnEl.checked = false;
        }
    }
    var calendarAddEvent = function () {
        resetModalFields();


      getModalAddBtnEl.style.display = "block";
      getModalUpdateBtnEl.style.display = "none";
      myModal.show();

    };

    /*=====================*/
    // Modal Close Event
    /*=====================*/

    /*=====================*/
    // Calender Event Function
    /*=====================*/
    var calendarEventClick = function(info) {
        var eventObj = info.event;


        // Ensure the modal elements exist before attempting to set values
        var getModalTitleEl = document.getElementById('event-title');
        var getModalDateEl = document.getElementById('event-date');
        var getModalStartTimeEl = document.getElementById('event-start-time');
        var getModalEndTimeEl = document.getElementById('event-end-time');
        var getModalCommentsEl = document.getElementById('event-comments');
        var getModalDriverEl = document.getElementById('driver');
        var getModalCustomerEl = document.getElementById('assigned_employee');


        var getModalUpdateBtnEl = document.querySelector('.btn-update-event');
        var getModalAddBtnEl = document.querySelector('.btn-add-event');
        var getModalCheckedRadioBtnEl = document.querySelector(`input[value="${eventObj.extendedProps['calendar']}"]`);
// Add event ID to hidden input field
document.getElementById('event-id').value = eventObj.id;
        if (eventObj.url) {
            window.open(eventObj.url);
            info.jsEvent.preventDefault();  // Prevent default behavior if it's an external link
        } else {
            // Populate modal fields with event data
            if (getModalTitleEl) getModalTitleEl.value = eventObj.title;
            if (getModalDateEl) getModalDateEl.value = eventObj.startStr ? eventObj.startStr.split('T')[0] : ''; // Extract date
            if (getModalStartTimeEl) getModalStartTimeEl.value = eventObj.startStr ? eventObj.startStr.split('T')[1]?.slice(0, 5) : ''; // Extract start time
            if (eventObj.endStr && getModalEndTimeEl) getModalEndTimeEl.value = eventObj.endStr ? eventObj.endStr.split('T')[1]?.slice(0, 5) : ''; // Extract end time
            if (getModalCommentsEl) getModalCommentsEl.value = eventObj.extendedProps.comments || '';
            // Set the driver in the dropdown
        if (getModalDriverEl) {
            getModalDriverEl.value = eventObj.extendedProps.assigned_driver || ''; // Set the driver
            console.log(getModalDriverEl.value);
        }
        if (getModalCustomerEl) {
            getModalCustomerEl.value = eventObj.extendedProps.assigned_employee || ''; // Set the driver
            console.log('customer',getModalCustomerEl.value);
        }


            // Set the correct radio button for event color
            if (getModalCheckedRadioBtnEl) getModalCheckedRadioBtnEl.checked = true;

             // Set event ID for updating purposes
        if (getModalUpdateBtnEl) getModalUpdateBtnEl.setAttribute('data-fc-event-public-id', eventObj.id);

            // Toggle buttons visibility: show update button, hide add button
            if (getModalAddBtnEl) getModalAddBtnEl.style.display = 'none';
            if (getModalUpdateBtnEl) getModalUpdateBtnEl.style.display = 'block';

            // Show the modal
            var eventModal = new bootstrap.Modal(document.getElementById('eventModal'));
            eventModal.show();
        }
    };


    /*=====================*/
    // Active Calender
    /*=====================*/
    fetchEvents().then(events => {
        var calendar = new FullCalendar.Calendar(calendarEl, {
            selectable: true,
            height: checkWidowWidth() ? 900 : 1052,
            initialView: checkWidowWidth() ? "listWeek" : "dayGridMonth",
            initialDate: `${newDate.getFullYear()}-${getDynamicMonth()}-07`,
            headerToolbar: calendarHeaderToolbar,
            events: events, // Use fetched events here
            select: calendarSelect,
            unselect: function () {
                console.log("unselected");
            },
            customButtons: {
                addEventButton: {
                    text: "Add Event",
                    click: calendarAddEvent,
                },
            },
            eventClassNames: function ({ event: calendarEvent }) {
                const getColorValue = calendarsEvents[calendarEvent._def.extendedProps.calendar];
                return ["event-fc-color fc-bg-" + getColorValue];
            },
            eventClick: calendarEventClick,
            windowResize: function () {
                if (checkWidowWidth()) {
                    calendar.changeView("listWeek");
                    calendar.setOption("height", 900);
                } else {
                    calendar.changeView("dayGridMonth");
                    calendar.setOption("height", 1052);
                }
            },
        });

        /*=====================*/
        // Calendar Init
        /*=====================*/
        calendar.render();

        // Modal Handling
        var myModal = new bootstrap.Modal(document.getElementById("eventModal"));
        var getModalStartDateEl = document.getElementById("event-date");


        document
            .getElementById("eventModal")
            .addEventListener("hidden.bs.modal", function () {
                getModalTitleEl.value = "";
                getModalStartDateEl.value = "";

                var getModalIfCheckedRadioBtnEl = document.querySelector('input[name="event-level"]:checked');
                if (getModalIfCheckedRadioBtnEl !== null) {
                    getModalIfCheckedRadioBtnEl.checked = false;
                }
            });
    });

    /*=====================*/
    // Update Calender Event
    /*=====================*/
    getModalUpdateBtnEl.addEventListener("click", function () {
        var getPublicID = this.dataset.fcEventPublicId;
        var getTitleUpdatedValue = getModalTitleEl.value;
        var getEventID = document.getElementById('event-id').value;  // Get the event ID from hidden field
        var getEvent = calendar.getEventById(getEventID);  // Get the event object by ID
        // Get the updated values from the modal
        var getModalUpdatedCheckedRadioBtnEl = document.querySelector(
            'input[name="event-level"]:checked'
        );
        var getModalUpdatedCheckedRadioBtnValue =
            getModalUpdatedCheckedRadioBtnEl ? getModalUpdatedCheckedRadioBtnEl.value : "";

        var getUpdatedDate = getModalDateEl.value;
        var getUpdatedStartTime = getModalStartTimeEl.value;
        var getUpdatedEndTime = getModalEndTimeEl.value;
        var getUpdatedComments = getModalCommentsEl.value;
        var getUpdatedDriver = getModalDriverEl.value;
        var getUpdatedCustomer = getModalCustomerEl.value;

        // Set the event properties
        getEvent.setProp("title", getTitleUpdatedValue);
        getEvent.setExtendedProp("calendar", getModalUpdatedCheckedRadioBtnValue);
        getEvent.setExtendedProp("comments", getUpdatedComments);
        getEvent.setExtendedProp("driver", getUpdatedDriver);
        getEvent.setExtendedProp("assigned_employee", getUpdatedCustomer);

        // Update the event's start and end times
        var updatedStart = new Date(`${getUpdatedDate}T${getUpdatedStartTime}`);
        var updatedEnd = new Date(`${getUpdatedDate}T${getUpdatedEndTime}`);

        getEvent.setStart(updatedStart);
        getEvent.setEnd(updatedEnd);

        // Hide the modal after updating
        var myModal = bootstrap.Modal.getInstance(document.getElementById('eventModal'));
        myModal.hide();
    });
    /*=====================*/
    // Add Calender Event
    /*=====================*/
    getModalAddBtnEl.addEventListener("click", function () {
      var getModalCheckedRadioBtnEl = document.querySelector(
        'input[name="event-level"]:checked'
      );

      var getTitleValue = getModalTitleEl.value;
      var setModalStartDateValue = getModalStartDateEl.value;
      var setModalEndDateValue = getModalEndDateEl.value;
      var getModalCheckedRadioBtnValue =
        getModalCheckedRadioBtnEl !== null ? getModalCheckedRadioBtnEl.value : "";

      calendar.addEvent({
        id: 12,
        title: getTitleValue,
        start: setModalStartDateValue,
        end: setModalEndDateValue,
        allDay: true,
        extendedProps: { calendar: getModalCheckedRadioBtnValue },
      });
      myModal.hide();
    });
    /*=====================*/
    // Calendar Init
    /*=====================*/
    calendar.render();
    var myModal = new bootstrap.Modal(document.getElementById("eventModal"));
    var modalToggle = document.querySelector(".fc-addEventButton-button ");
    document
      .getElementById("eventModal")
      .addEventListener("hidden.bs.modal", function (event) {
        getModalTitleEl.value = "";
        getModalStartDateEl.value = "";
        getModalEndDateEl.value = "";
        var getModalIfCheckedRadioBtnEl = document.querySelector(
          'input[name="event-level"]:checked'
        );
        if (getModalIfCheckedRadioBtnEl !== null) {
          getModalIfCheckedRadioBtnEl.checked = false;
        }
      });
  });
