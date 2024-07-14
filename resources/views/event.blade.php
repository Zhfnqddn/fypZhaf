<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css" integrity="sha512-O03ntXoVqaGUTAeAmvQ2YSzkCvclZEcPQu1eqloPaHfJ5RuNGiS4l+3duaidD801P50J28EHyonCV06CUlTSag==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

     <!---box icons--->	
     <link rel="stylesheet"
    href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" 
    rel="stylesheet">

    <!---google fonts--->	
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?
    family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <style>

        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            list-style: none;
            text-decoration: none;
            scroll-behavior: smooth;
            scroll-padding-top: 3rem;
        }
        :root {
            --main-color: #8A00FF;
            --text-color: #fff;
            --other-color: #212121;
            --second-color: #1C1C1C;
            --bg-color: #111111;

            --big-font: 4.5rem;
            --h2-font: 2.6rem;
            --p-font: 1.1rem;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-color);
        }

        .row {
            color: var(--text-color);
        }

        /* Custom styles for FullCalendar */
        .fc-toolbar-title {
            color: var(--text-color);
        }

        .fc-daygrid-day {
            background-color: var(--second-color)
            color: var(--text-color);
        }

        .fc-daygrid-day:hover {
            background-color: var(--main-color);
            color: var(--text-color);
        }

        .fc-event {
            background-color: var(--main-color);
            color: black;
        }

        .fc-button {
            background-color: var(--main-color);
            color: black;
        }

        .fc-button:hover {
            background-color: black;
            color: var(--text-color);
        }

        .modal-content {
            background-color: var(--second-color);
            color: var(--text-color);
        }

        .modal-header, .modal-footer {
            border: none;
        }

        .modal-title {
            font-size: var(--h2-font);
        }

        .modal-body p {
            font-size: var(--p-font);
        }

        /* Event colors based on service type */
        .event-photographer {
            background-color: green !important;
        }

        .event-videographer {
            background-color: blue !important;
        }

        .container {
            margin-top: 140px
        }

        header{
            position:fixed;
            width: 100%;
            top: 0;
            right: 0;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: transparent;
            padding: 30px 3%;
            transition: all .50s ease;	
        }

        header a {
        text-decoration: none;
        }


        .logo{
            display: flex;
            align-items: center;
            color: var(--text-color);
            font-size: 20px;
            font-weight: 700;
        }

        .logo img{
            vertical-align: middle;
            margin-right: 8px;
            color: var(--second-color);
            width: 100px;
            height: auto;
        }

        .navlist{
            display: flex;
        }

        .navlist a{
            color: var(--text-color);
            font-size: var(--p-font);
            font-weight: 600;
            margin: 0 30px;
            transition: all .50s ease;
        }
        .navlist a:hover{
            color: #8A00FF;
        }
        .navlist a.active{
            color: #8A00FF;
        }
        .nav{
            display: flex;
        }

        .nav a{
            color: black;
            font-size: var(--p-font);
            font-weight: 600;
            margin: 0 13px;
            transition: all .50s ease;
            align-items: center;
            padding: 8px 15px;
            background: var(--main-color);
            border-radius: 3rem;
            box-shadow: #B026FF 0px 1px 15px;
        }

        .nav a:hover {
            background-color: black;
            color: black;
            box-shadow: #B026FF 0px 1px 15px;
        }
        
        .nav a.active{
            background-color: var(--bg-color);
        }
        
        #menu-icon{
            font-size: 32px;
            color: black;
            z-index: 10001;
            cursor: pointer;
            padding: 8px 15px;
            display: none;
        }
        .nav a:hover{
            transform: scale(1.1);
            color: var(--text-color);
        }

        section{
            padding: 70px 5% 40px;
        }

        header.sticky{
            padding: 18px 6%;
            background: var(--second-color);
            color: #F1F1F2;
        }

        /*Dropdown*/
        /* Dropdown Button */
        .hi {
            cursor: pointer;
        }

        /* Dropdown Content (Hidden by Default) */
        .dropdown-content {
            display: none;
            position: absolute;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            margin-top: 10px;
        }

        /* Links inside the dropdown */
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            margin-top: 10px;
            font-size: 15px;
        }

        /* Change color of dropdown links on hover */
        .dropdown-content a:hover {
            background-color: var(--bg-color);
        }

        /* Show the dropdown content on hover */
        .dropdown:hover .dropdown-content {
            display: block;
        }

        /*dropdown1*/
        .dropdown-content-New {
            display: none;
            position: absolute;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            margin-top: 10px;
            background-color: white;
            border-radius: 10px;
        }

        /* Links inside the dropdown */
        .dropdown-content-New a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            margin-top: 10px;
            font-size: 15px;
        }

        .calendar-container {
            background-color: var(--other-color);
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }

        h3{
        color: var(--main-color);
        margin-left: -150px;
        margin-top: 1px;
        font-size: var(--p-font);
        background: var(--other-color);
        font-weight: 500;
        letter-spacing: 1px;
        border-radius: 3rem;
        box-shadow: #B026FF 0px 1px 10px;
        padding: 4px 10px;
        }
        /*end of header*/
    </style>

</head>
<body>

     <!---header--->
     <header>
	<a href="{{ (route('dashboardStaff')) }}" class="logo"><img src="{{ asset('img/cam.png') }}">SNAP.FIND</a> 
    <h3>STAFF</h3>
	
	<ul class="navlist">
		<li><a href="{{ (route('dashboardStaff')) }}">HOME</a></li>
			<div class="dropdown">
				<a href="#" class="hi & active">SERVICES<i class="bx bx-chevron-down"></i></a>
				<div class="dropdown-content-New">
					<a href="{{ (route('events')) }}">EVENTS</a>
					<a href="#">BOOKING</a>
					<a href="#">CUSTOM</a>
					<a href="#">PAYMENT</a>
				</div>
			</div>
			<div class="dropdown">
				<a href="#" class="hi">PORTFOLIO<i class="bx bx-chevron-down"></i></a>
				<div class="dropdown-content-New">
					<a href="#">PHOTOGRAPHER</a>
					<a href="#">VIDEOGRAPHER</a>
				</div>
			</div>
	</ul>
	
	<div class="nav">
	<div class="dropdown">
	<a href="#" class="hi">Hi {{ Auth::guard('staff')->user()->name }} <i class="bx bx-chevron-down"></i></a>
		<div class="dropdown-content">
		<a href="{{ (route('viewStaff')) }}">View Profile</a>
		<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
			<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    		@csrf
			</form>
		</div>
	</div>
		
		<div class="bx bx-menu" id="menu-icon"></div>
	</div>	
    </header>

<div class="container">
    <div class="row">
        <div class="col-12 mt-3">
            <div id='calendar'></div>
        </div>
    </div>
</div>

<div id="modal-action" class="modal" tabindex="-1">

</div>

<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.14/index.global.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/bootstrap5@6.1.14/index.global.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js" integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  
<script>
   const modal = $('#modal-action');
   const csrfToken = $('meta[name="csrf-token"]').attr('content');

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        themeSystem: 'bootstrap5',
        events: '{{ route('events.list') }}',
        editable: true,
        timeZone: 'UTC',
        dateClick: function(info) {
            $.ajax({
                url: '{{ route('events.create') }}',
                data: {
                    start_date: info.dateStr,
                    end_date: info.dateStr
                },
                success: function(res) {
                    modal.html(res).modal('show');

                    $('.datepicker').datepicker({
                        todayHighlight: true,
                        format: 'yyyy-mm-dd'
                    });

                    $('#form-action').off('submit').on('submit', function(e) {
                        e.preventDefault();
                        const form = this;
                        const formData = new FormData(form);
                        formData.append('_token', csrfToken);

                        $.ajax({
                            url: form.action,
                            method: 'POST', // For creating a new event
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(res) {
                                if (res.status === 'success') {
                                    modal.modal('hide');
                                    calendar.refetchEvents();
                                } else {
                                    alert('Failed to save the event');
                                }
                            },
                            error: function(xhr, status, error) {
                                alert('Error saving the event: ' + xhr.responseText);
                            }
                        });
                    });
                },
                error: function(xhr, status, error) {
                    alert('Error loading the form: ' + xhr.responseText);
                }
            });
        },
        eventClick: function(info) {
            $.ajax({
                url: '{{ url('events') }}/' + info.event.id + '/edit',
                success: function(res) {
                    modal.html(res).modal('show');
                    console.log(" info.event.id " +  info.event.id);
                    $('#form-action').attr('action', '{{ url('events') }}/' + info.event.id);
                    $('#form-action').attr('method', 'POST');
                    // Remove any existing _method hidden input to avoid duplication
                    $('#form-action input[name="_method"]').remove();
                    $('<input>').attr({
                        type: 'hidden',
                        name: '_method',
                        value: 'PUT'
                    }).appendTo('#form-action');

                    $('#form-action').off('submit').on('submit', function(e) {
                        e.preventDefault();
                        const form = this;
                        const formData = new FormData(form);
                        formData.append('_token', csrfToken);

                        $.ajax({
                            url: form.action,
                            method: 'POST', // Always POST, as we are adding _method=PUT for updates
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(res) {
                                if (res.status === 'success') {
                                    modal.modal('hide');
                                    calendar.refetchEvents();
                                } else {
                                    alert('Failed to update the event');
                                }
                            },
                            error: function(xhr, status, error) {
                                alert('Error updating the event: ' + xhr.responseText);
                            }
                        });
                    });

                    const deleteButton = document.getElementById('delete-event');
                    if (deleteButton) {
                        deleteButton.addEventListener('click', function() {
                            if (confirm('Are you sure you want to delete this event?')) {
                                $.ajax({
                                    url: '{{ url('events') }}/' + info.event.id,
                                    method: 'DELETE',
                                    headers: {
                                        'X-CSRF-TOKEN': csrfToken
                                    },
                                    success: function(res) {
                                        if (res.status === 'success') {
                                            modal.modal('hide');
                                            calendar.refetchEvents();
                                        } else {
                                            alert('Failed to delete the event');
                                        }
                                    },
                                    error: function(xhr, status, error) {
                                        alert('Error deleting the event: ' + xhr.responseText);
                                    }
                                });
                            }
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                    alert('Error loading the form');
                }
            });
        },
        eventDrop: function(info) {
            const event = info.event;
            const startDate = event.start.toISOString().split('T')[0];
            let endDate = event.end ? event.end.toISOString().split('T')[0] : startDate;

            if (event.allDay && event.end) {
                let adjustedEnd = new Date(event.end);
                adjustedEnd.setDate(adjustedEnd.getDate() - 1);
                endDate = adjustedEnd.toISOString().split('T')[0];
            }

            $.ajax({
                url: '{{ url('events') }}/' + event.id,
                method: 'PUT',
                data: {
                    _token: csrfToken,
                    id: event.id,
                    start_date: startDate,
                    end_date: endDate,
                    time_from: event.extendedProps.timeFrom,
                    time_to: event.extendedProps.timeTo,
                    location: event.extendedProps.location,
                    package_name: event.extendedProps.packageName,
                    service_type: event.extendedProps.serviceType,
                    price_range: event.extendedProps.priceRange,
                },
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                success: function(res) {
                    calendar.refetchEvents();
                    iziToast.success({
                        title: 'Success',
                        message: res.message,
                        position: 'topRight'
                    });
                },
                error: function(xhr, status, error) {
                    alert('Error updating the event: ' + xhr.responseText);
                }
            });
        },
        eventResize: function(info) {
            const { event } = info;
            const startDate = event.start.toISOString().split('T')[0];
            let endDate = event.end.toISOString().split('T')[0];

            if (event.allDay) {
                let adjustedEnd = new Date(event.end);
                adjustedEnd.setDate(adjustedEnd.getDate() - 1);
                endDate = adjustedEnd.toISOString().split('T')[0];
            }

            $.ajax({
                url: '{{ url('events') }}/' + event.id,
                method: 'PUT',
                data: {
                    _token: csrfToken,
                    id: event.id,
                    start_date: startDate,
                    end_date: endDate,
                    time_from: event.extendedProps.timeFrom,
                    time_to: event.extendedProps.timeTo,
                    location: event.extendedProps.location,
                    package_name: event.extendedProps.packageName,
                    service_type: event.extendedProps.serviceType,
                    price_range: event.extendedProps.priceRange,
                },
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                success: function(res) {
                    calendar.refetchEvents();
                    iziToast.success({
                        title: 'Success',
                        message: res.message,
                        position: 'topRight'
                    });
                },
                error: function(xhr, status, error) {
                    alert('Error updating the event: ' + xhr.responseText);
                }
            });
        }
    });
    calendar.render();
});



    document.addEventListener('DOMContentLoaded', function() {
        var dropdowns = document.querySelectorAll('.dropdown');

        dropdowns.forEach(function(dropdown) {
            var isOpen = false;
            var button = dropdown.querySelector('.hi');
            var dropdownContent = dropdown.querySelector('.dropdown-content');
            var dropdownContentNew = dropdown.querySelector('.dropdown-content-New');

            button.addEventListener('click', function(event) {
                event.stopPropagation(); // Prevent the click event from bubbling up
                isOpen = !isOpen;
                if (dropdownContent) {
                    dropdownContent.style.display = 'block';
                }
                if (dropdownContentNew) {
                    dropdownContentNew.style.display = 'block';
                }
            });

            // Close dropdown when clicking outside of it
            window.addEventListener('click', function(event) {
                if (!dropdown.contains(event.target)) {
                    isOpen = false;
                    if (dropdownContent) {
                        dropdownContent.style.display = 'none';
                    }
                    if (dropdownContentNew) {
                        dropdownContentNew.style.display = 'none';
                    }
                }
            });
        });
    });

    const header = document.querySelector("header");

    window.addEventListener("scroll", function(){
        header.classList.toggle("sticky", window.scrollY > 80);
    });

    let menu = document.querySelector('#menu-icon');
    let navlist = document.querySelector('.navlist');

    menu.onclick = () => {
        menu.classList.toggle('bx-x');
        navlist.classList.toggle('open');
    }

    window.onscroll = () => {
        menu.classList.remove('bx-x');
        navlist.classList.remove('open');
    }

    const sr = ScrollReveal({
        origin: 'top',
        distance: '85px',
        duration: 2500,
        reset: true
    });

    sr.reveal('.home-text', {delay: 100});
    sr.reveal('.home-img', {delay: 100});
    sr.reveal('.container-box', {delay: 100});
    sr.reveal('.about-img', {delay: 100});
    sr.reveal('.about', {delay: 100});
    sr.reveal('.contact', {delay: 100});
    sr.reveal('.scroll', {delay: 100});
    sr.reveal('.search-bar', {delay: 100});
</script>


</body>
</html>