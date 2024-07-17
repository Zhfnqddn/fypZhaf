<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}?v={{ time() }}">
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
        <a href="{{ (route('dashboard')) }}" class="logo"><img src="img/cam.png">SNAP.FIND</a> 
        <ul class="navlist">
            <li><a href="{{ (route('dashboard')) }}">HOME</a></li>
            <div class="dropdown">
                <a href="#" class="hi & active">BOOKING<i class="bx bx-chevron-down"></i></a>
                <div class="dropdown-content-New">
                    <a href="#">EVENTS</a>
                    <a href="#">VIEW BOOKING</a>
                </div>
            </div>
            <div class="dropdown">
                <a href="#" class="hi">CUSTOMIZE<i class="bx bx-chevron-down"></i></a>
                <div class="dropdown-content-New">
                    <a href="#">STATUS</a>
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
        <h2>CUSTOMIZE PACKAGE</h2>
        </div>
        <section class="container">
            <div class="info-container">
                <div class="info">
                <form action="{{ route('customizePackage', ['packageId' => $package->package_ID]) }}" method="POST">
                @csrf
                <div class="info-item">
                    <label for="addHours"><strong>Add Hours:</strong></label>
                    <select id="addHours" name="addHours">
                        <option value="" selected disabled>Select...</option>
                        <option value="1">1 hour - Add price +RM50</option>
                        <option value="2">2 hours - Add price +RM100</option>
                        <option value="3">3 hours - Add price +RM150</option>
                        <option value="4">4 hours - Add price +RM200</option>
                        <option value="5">5 hours - Add price +RM250</option>
                    </select>
                </div>

                <div class="info-item">
                    <label><strong>Add On:</strong></label>
                    <label><input type="checkbox" name="addOn[]" value="Printing"> Printing - Add price +RM50</label>
                    <label><input type="checkbox" name="addOn[]" value="Editing"> Editing - Add price +RM250</label>
                </div>

                <div class="info-item">
                    <label><strong>Add Session:</strong></label>
                    <label><input type="checkbox" name="addSession[]" value="Indoor"> Indoor - Add price +RM50</label>
                    <label><input type="checkbox" name="addSession[]" value="Outdoor"> Outdoor - Add price +RM150</label>
                </div>

                <div class="info-item">
                    <label><strong>Add Location:</strong></label>
                    <label><input type="checkbox" name="addLocation[]" value="Studio"> Studio - Add price +RM200</label>
                    <label><input type="checkbox" name="addLocation[]" value="CustomerVenue"> Customer Venue - Add price +RM250</label>
                </div>

                <div class="button-group">
                    <button type="button" class="cancel-button">Cancel</button>
                    <button type="submit" class="confirm-button">Confirm</button>
                </div>
                </form>
        </section>
    <!-- contact -->
    <section class="contact" id="contact">
        <div class="contact-text">
            <h2>CONTACT US</h2>
            <p>“The best images are the ones that retain their strength and impact over the years, regardless of <br> the number of times they are viewed.” <br>- Anne Geddes -</p>
            <div class="social">
                <a href="#" class="clr"><i class='bx bxl-whatsapp-square'></i></a>
                <a href="https://www.facebook.com/p/MM-SPORT-POINT-100054418932651/"><i class='bx bxl-facebook-square'></i></a>
                <a href="#"><i class='bx bxl-instagram'></i></a>
                <a href="#"><i class='bx bxl-twitter'></i></a>
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
    </script>
</body>
</html>
