<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <a href="{{ route('home') }}" class="logo"><img src="{{ asset('img/cam.png') }}">SHUTTER SEARCH & BOOKING</a>
        <div class="nav">
            <a href="{{ route('login') }}">LOGIN</a>
            <a href="{{ route('register') }}" class="active">REGISTER</a>
            <div class="bx bx-menu" id="menu-icon"></div>
        </div>
    </header>


    <section class="container">
        <div class="container-box">
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <h1>REGISTER</h1>

                <!-- Display Validation Errors -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Display Success Message -->
                @if (session('status'))
                    <div id="success-message" data-message="{{ session('status') }}"></div>
                @endif

                <div class="input-box">
                    <input type="text" name="name" placeholder="Name" value="{{ old('name') }}" required autofocus autocomplete="name">
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus autocomplete="email">
                    <i class='bx bxs-envelope'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required autocomplete="new-password">
                    <i class='bx bxs-lock'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                    <i class='bx bxs-lock'></i>
                </div>
                <div class="input-box">
                    <input type="tel" name="phone" placeholder="Phone Number" value="{{ old('phone') }}">
                    <i class='bx bxs-phone'></i>
                </div>
                <div class="input-box">
                    <select name="role" required>
                        <option value="" selected disabled>Select...</option>
                        <option value="photographer" {{ old('role') == 'photographer' ? 'selected' : '' }}>Photographer</option>
                        <option value="videographer" {{ old('role') == 'videographer' ? 'selected' : '' }}>Videographer</option>
                        <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>Customer</option>
                    </select>
                </div>
                <button type="submit" class="btn">Register</button>
                <div class="register-link">
                    <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
                </div>
            </form>
        </div>
    </section>

    <section class="contact" id="contact">
        <div class="contact-text">
            <h2>CONTACT US</h2>
            <p>“The best images are the ones that retain their strength and impact over the years, regardless of the number of times they are viewed.”<br>- Anne Geddes -</p>
            <div class="social">
                <a href="#" class="clr"><i class='bx bxl-whatsapp-square'></i></a>
                <a href="https://www.facebook.com/p/MM-SPORT-POINT-100054418932651/"><i class='bx bxl-facebook-square'></i></a>
                <a href="#"><i class='bx bxl-instagram'></i></a>
                <a href="#"><i class='bx bxl-twitter'></i></a>
            </div>
        </div>
    </section>

    <section class="contact" id="contact">
        <div class="contact-text">
            <h2>CONTACT US</h2>
            <p>“The best images are the ones that retain their strength and impact over the years, regardless of the number of times they are viewed.”<br>- Anne Geddes -</p>
            <div class="social">
                <a href="#" class="clr"><i class='bx bxl-whatsapp-square'></i></a>
                <a href="https://www.facebook.com/p/MM-SPORT-POINT-100054418932651/"><i class='bx bxl-facebook-square'></i></a>
                <a href="#"><i class='bx bxl-instagram'></i></a>
                <a href="#"><i class='bx bxl-twitter'></i></a>
            </div>
        </div>
    </section>

    <a href="#" class="scroll">
        <i class='bx bxs-up-arrow-square'></i>
    </a>

    <script src="https://unpkg.com/scrollreveal"></script>
    <!--<script src="{{ asset('js/home.js') }}"></script>-->

    <script>
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

        sr.reveal('.home-text', { delay: 100 });
        sr.reveal('.home-img', { delay: 100 });
        sr.reveal('.container-box', { delay: 100 });
        sr.reveal('.about-img', { delay: 100 });
        sr.reveal('.about', { delay: 100 });
        sr.reveal('.contact', { delay: 100 });
        sr.reveal('.scroll', { delay: 100 });

        // JavaScript to show alert with success message
        document.addEventListener('DOMContentLoaded', function () {
            const successMessageElement = document.getElementById('success-message');
            if (successMessageElement) {
                alert(successMessageElement.getAttribute('data-message'));
                window.location.href = "{{ route('login') }}";
            }
        });

    </script>
</body>
</html>
