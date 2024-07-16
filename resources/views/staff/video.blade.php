<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Videos</title>
    <link rel="stylesheet" href="{{ asset('css/portfolio.css') }}?v={{ time() }}">
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
        <a href="{{ route('dashboardStaff') }}" class="logo"><img src="img/cam.png">SNAP.FIND</a> 
        <h3>STAFF</h3>
        <ul class="navlist">
            <li><a href="{{ route('dashboardStaff') }}">HOME</a></li>
            <div class="dropdown">
                <a href="#" class="hi & active">SERVICES<i class="bx bx-chevron-down"></i></a>
                <div class="dropdown-content-New">
                    <a href="#">EVENTS</a>
                    <a href="#">BOOKING</a>
                    <a href="#">CUSTOM</a>
                    <a href="#">PAYMENT</a>
                </div>
            </div>
            <div class="dropdown">
                <a href="#" class="hi">PORTFOLIO<i class="bx bx-chevron-down"></i></a>
                <div class="dropdown-content-New">
                    <a href="{{ route('staff.pictures.index') }}">PHOTOGRAPHER</a>
                    <a href="{{ route('staff.videos.index') }}">VIDEOGRAPHER</a>
                </div>
            </div>
        </ul>
        <div class="nav">
            <div class="dropdown">
            <a href="#" class="hi">Hi {{ Auth::guard('staff')->user()->name }} <i class="bx bx-chevron-down"></i></a>
                <div class="dropdown-content">
                    <a href="{{ route('viewStaff') }}">View Profile</a>
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
        <h2>VIDEOGRAPHER</h2>
    </div>
    <section class="container">
        <div class="form-container">
            <form action="{{ route('staff.videos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="video">Video:</label>
                    <input type="file" name="video" id="video" required>
                </div>
                <button type="submit" class="view-button">Upload</button>
            </form>
        </div>
    </section>
    <section class="container">
        @foreach ($videos as $video)
        <div class="container-box">
            <h4>{{ $video->video_Name }}</h4>
            <video width="300" height="300" controls>
                <source src="{{ asset('storage/' . $video->video_FilePath) }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <form action="{{ route('staff.videos.destroy', $video->video_ID) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="view-button">Delete</button>
            </form>
        </div>
        @endforeach
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
        })
        function goToPage(pageUrl) {
            window.location.href = pageUrl;
        }
        sr.reveal ('.home-text',{delay:100});
        sr.reveal ('.home-img',{delay:100});
        sr.reveal ('.container-box',{delay:100});
        sr.reveal ('.about-img',{delay:100});
        sr.reveal ('.about',{delay:100});
        sr.reveal ('.contact',{delay:100});
        sr.reveal ('.scroll',{delay:100});
        sr.reveal ('.search-bar',{delay:100});
    </script>
</body>
</html>
