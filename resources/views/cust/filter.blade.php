<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filter Events</title>
    <link rel="stylesheet" href="{{ asset('css/filter.css') }}?v={{ time() }}">
    <!---box icons--->    
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!---google fonts--->    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>
    <!---header--->
    <header>
        <a href="{{ route('dashboard') }}" class="logo"><img src="img/cam.png">SNAP.FIND</a> 
        <ul class="navlist">
		<li><a href="{{ (route('dashboard')) }}">HOME</a></li>
			<div class="dropdown">
				<a href="#" class="hi & active">BOOKING<i class="bx bx-chevron-down"></i></a>
				<div class="dropdown-content-New">
					<a href="{{ (route('filter')) }}">EVENTS</a>
					<a href="{{ (route('customer.bookings')) }}">VIEW BOOKING</a>
				</div>
			</div>
			<div class="dropdown">
				<a href="#" class="hi">CUSTOMIZE<i class="bx bx-chevron-down"></i></a>
				<div class="dropdown-content-New">
					<a href="{{ (route('customer.customizations')) }}">STATUS</a>
				</div>
			</div>
	</ul>

        <div class="nav">
            <div class="dropdown">
                <a href="#" class="hi">Hi Zhafri <i class="bx bx-chevron-down"></i></a>
                <div class="dropdown-content">
                    <a href="{{ route('viewCust') }}">View Profile</a>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
            <div class="bx bx-menu" id="menu-icon"></div>
        </div>    
    </header>

    <!-- Filter Form Section -->
    <section class="container">
        <div class="filter-section">
            <div class="font">
                <h2>Filter</h2>
            </div>
            <form id="filter-form" class="flex-container" method="GET" action="{{ route('listBooking') }}">
                <div class="form-group">
                    <label for="packageName">Package Name</label>
                    <select id="packageName" name="packageName">
                        <option value="" selected disabled>Select...</option>
                        <option value="Wedding">Wedding</option>
                        <option value="Graduation">Graduation</option>
                        <option value="Birthday Party">Birthday Party</option>
                        <option value="Engagement">Engagement</option>
                        <option value="Studio Photoshoot">Studio Photoshoot</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="serviceType">Service Type</label>
                    <select id="serviceType" name="serviceType">
                        <option value="" selected disabled>Select...</option>
                        <option value="Photographer">Photographer</option>
                        <option value="Videographer">Videographer</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="startDate">Start Date</label>
                    <input type="date" id="startDate" name="startDate">
                </div>
                <div class="form-group">
                    <label for="endDate">End Date</label>
                    <input type="date" id="endDate" name="endDate">
                </div>
                <div class="form-group">
                    <label for="timeFrom">Time From</label>
                    <input type="time" id="timeFrom" name="timeFrom">
                </div>
                <div class="form-group">
                    <label for="timeTo">Time To</label>
                    <input type="time" id="timeTo" name="timeTo">
                </div>
                <div class="form-group">
                    <label for="location">Location</label>
                    <select id="location" name="location">
                        <option value="" selected disabled>Select...</option>
                        <option value="Cheras">Cheras</option>
                        <option value="Ampang">Ampang</option>
                        <option value="Kajang">Kajang</option>
                        <option value="Semenyih">Semenyih</option>
                        <option value="Batu Caves">Batu Caves</option>
                        <option value="Rawang">Rawang</option>
                        <option value="Setapak">Setapak</option>
                        <option value="Dengkil">Dengkil</option>
                        <option value="Sepang">Sepang</option>
                        <option value="Petaling Jaya">Petaling Jaya</option>
                        <option value="Shah Alam">Shah Alam</option>
                        <option value="Damansara">Damansara</option>
                        <option value="Sungai Buloh">Sungai Buloh</option>
                        <option value="Subang">Subang</option>
                        <option value="Puchong">Puchong</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="priceRange">Price Range (RM)</label>
                    <input type="range" id="priceRange" name="priceRange" min="0" max="10000" step="100">
                    <span id="priceRangeValue">5000</span>
                </div>
                <button type="submit" class="btn">Search</button>
            </form>
        </div>
    </section>

    <!--- scroll top --->
    <a href="#" class="scroll">
        <i class='bx bxs-up-arrow-square'></i>
    </a>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <!---link to js---> 
    <script src="home.js"></script>

    <script>
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
                        dropdownContent.style.display = isOpen ? 'block' : 'none';
                    }
                    if (dropdownContentNew) {
                        dropdownContentNew.style.display = isOpen ? 'block' : 'none';
                    }
                });
                // Close dropdown when clicking outside of it
                window.addEventListener('click', function(event) {
                    if (!dropdown.contains(event.target)) {
                        isOpen = false;
                        dropdownContent.style.display = 'none';
                    }
                    if (dropdownContentNew) {
                        dropdownContentNew.style.display = 'none';
                    }
                });
            });
        });

        const header = document.querySelector("header");
        window.addEventListener("scroll", function() {
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

        sr.reveal('.home-text', { delay: 100 });
        sr.reveal('.home-img', { delay: 100 });
        sr.reveal('.container-box', { delay: 100 });
        sr.reveal('.about-img', { delay: 100 });
        sr.reveal('.about', { delay: 100 });
        sr.reveal('.contact', { delay: 100 });
        sr.reveal('.scroll', { delay: 100 });
        sr.reveal('.search-bar', { delay: 100 });

        // JavaScript to update the price range value
        const priceRange = document.getElementById('priceRange');
        const priceRangeValue = document.getElementById('priceRangeValue');

        priceRange.addEventListener('input', function() {
            priceRangeValue.textContent = priceRange.value;
        });
    </script>
</body>
</html>
