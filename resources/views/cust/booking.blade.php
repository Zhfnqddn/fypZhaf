<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SNAP.FIND</title>
    <link rel="icon" href="{{ asset('img/cam.png') }}" sizes="96x96" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/booking.css') }}?v={{ time() }}">
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
        <a href="{{ route('dashboard') }}" class="logo"><img src="{{ asset('img/cam.png') }}">SNAP.FIND</a> 
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

    <div class="font">
        <h2>BOOKING</h2>
        </div>
        <section class="container">
        <div class="image-gallery-container">
            <div class="image-gallery">
                @if ($package->service_Type == 'Photographer' && $pictures->count() > 0)
                    @foreach ($pictures as $picture)
                        <div class="slide">
                            <img src="{{ asset($picture->picture_FilePath) }}" alt="{{ $picture->picture_Name }}">
                        </div>
                    @endforeach
                @elseif ($package->service_Type == 'Videographer' && $videos->count() > 0)
                    @foreach ($videos as $video)
                        <div class="slide">
                            <video autoplay muted loop controls>
                                <source src="{{ asset($video->video_FilePath) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    @endforeach
                @else
                    <p>No media available.</p>
                @endif
            </div>
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>
        <div class="info-container">
    <div class="info">
        <div class="info-item">
            <label for="staffName"><strong>Staff Name:</strong></label>
            <input type="text" id="staffName" name="staffName" value="{{ $package->staff->name }}" readonly>
        </div>

        <div class="info-item">
            <label for="packageName"><strong>Package Name:</strong></label>
            <input type="text" id="packageName" name="packageName" value="{{ $package->package_Name }}" readonly>
        </div>

        <div class="info-item">
            <label for="startDate"><strong>Start Date:</strong></label>
            <input type="date" id="startDate" name="startDate" value="{{ $package->start_Date }}" readonly>
        </div>

        <div class="info-item">
            <label for="endDate"><strong>End Date:</strong></label>
            <input type="date" id="endDate" name="endDate" value="{{ $package->end_Date }}" readonly>
        </div>

        <div class="info-item">
            <label for="timeFrom"><strong>Time From:</strong></label>
            <input type="time" id="timeFrom" name="timeFrom" value="{{ $package->time_From }}" readonly>
        </div>

        <div class="info-item">
            <label for="timeTo"><strong>Time To:</strong></label>
            <input type="time" id="timeTo" name="timeTo" value="{{ $package->time_To }}" readonly>
        </div>

        <div class="info-item">
            <label for="location"><strong>Location:</strong></label>
            <input type="text" id="location" name="location" value="{{ $package->location }}" readonly>
        </div>

        <div class="info-item">
            <label for="totalPrice"><strong>Total Price:</strong></label>
            <input type="text" id="totalPrice" name="totalPrice" value="RM{{ $totalPrice }}" readonly>
        </div>

        @if($customizations)
            @if($customizations->add_Hours)
                <div class="info-item">
                    <label for="addHours"><strong>Additional Hours:</strong></label>
                    <input type="text" id="addHours" name="addHours" value="{{ $customizations->add_Hours }} - RM{{ $customizations->add_Hours * 50 }}" readonly>
                </div>
            @endif

            @if($customizations->add_Ons)
                <div class="info-item">
                    <label for="addOns"><strong>Add-ons:</strong></label>
                    <input type="text" id="addOns" name="addOns" value="{{ $customizations->add_Ons }}" readonly>
                </div>
            @endif

            @if($customizations->add_Session)
                <div class="info-item">
                    <label for="addSession"><strong>Additional Sessions:</strong></label>
                    <input type="text" id="addSession" name="addSession" value="{{ $customizations->add_Session }}" readonly>
                </div>
            @endif

            @if($customizations->add_Location)
                <div class="info-item">
                    <label for="addLocation"><strong>Additional Locations:</strong></label>
                    <input type="text" id="addLocation" name="addLocation" value="{{ $customizations->add_Location }}" readonly>
                </div>
            @endif
        @endif
    </div>

    <div class="button-group">
        <form action="{{ route('customizePackageForm', ['packageId' => $package->package_ID]) }}" method="GET">
            <button type="submit" class="custom-package">Custom Package</button>
        </form>
        <form action="{{ route('bookPackage', ['packageId' => $package->package_ID]) }}" method="POST">
            @csrf
            <input type="hidden" name="total_Price" value="{{ $totalPrice }}">
            <input type="hidden" name="cust_ID" value="{{ Auth::guard('customer')->user()->cust_ID }}">
            <input type="hidden" name="package_ID" value="{{ $package->package_ID }}">
            <input type="hidden" name="package_detail_ID" value="{{ $customizations->package_detail_ID ?? null }}">
            <button type="submit" class="book-button" onclick="return myFunction()">Book</button>
        </form>
    </div>
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
            // Manual-sliding functionality
            let slideIndex = 0;
            const slides = document.querySelectorAll('.slide');
            const showSlides = (n) => {
                if (n >= slides.length) {
                    slideIndex = 0;
                }
                if (n < 0) {
                    slideIndex = slides.length - 1;
                }
                slides.forEach((slide, index) => {
                    slide.style.display = index === slideIndex ? 'block' : 'none';
                });
            };
            showSlides(slideIndex);

            window.plusSlides = (n) => {
                showSlides(slideIndex += n);
            };
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
        sr.reveal('.container', { delay: 100 });
        sr.reveal('.contact', { delay: 100 });
        sr.reveal('.scroll', { delay: 100 });
        sr.reveal('.font', { delay: 100 });

        // JavaScript to update the price range value
        const priceRange = document.getElementById('priceRange');
        const priceRangeValue = document.getElementById('priceRangeValue');

        priceRange.addEventListener('input', function() {
            priceRangeValue.textContent = priceRange.value;
        });

        // Add event listener for the book button
        document.getElementById('goToPage').addEventListener('click', function() {
            window.location.href = 'booking3.html';
        });

        document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM fully loaded and parsed');
        @if(session('success'))
            console.log('Success message: {{ session('success') }}');
            alert("{{ session('success') }}");
            window.location.href = '{{ route('dashboard') }}';
        @endif

        @if(session('error'))
            console.log('Error message: {{ session('error') }}');
            alert("{{ session('error') }}");
        @endif
    });

        function myFunction() {
            return confirm("The booking is pending , thank you!");
        }
    </script>
</body>
</html>
