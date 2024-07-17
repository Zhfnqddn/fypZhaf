<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="AccRej.css">
    <!---box icons--->    
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-dpuaG1suU0eT09tx5plTaGMLBsfDLzUCCUXOY2j/LSvXYuG6Bqs43ALlhIqAJVRb" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!---google fonts--->    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

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
            padding: 15px 3%;
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

        .font h2{
        text-align: center;
        color: var(--main-color);
        font-size: 40px;
        background-color: var(--other-color);
        width: 390px;
        border-radius: 20px;
        box-shadow: black 0px 1px 15px;
        margin-bottom: -30px;
        margin-left: 570px;
        margin-top: 120px;
        }

                /* Table Styles */
        .container {
            background-color: var(--text-color);
            padding: 20px;
            border-radius: 10px;
            box-shadow: #B026FF 0px 1px 13px;
            margin-top: 50px;
        }
        

        .table{
            background-color: #8A00FF;
            color: #8A00FF;
        }

        .table th, .table td {
            padding: 1rem;
            vertical-align: top;
            border-top: 1px solid var(--second-color);
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid var(--second-color);
            color: var(--bg-color);
            background-color: var(--main-color);
        }

        .table tbody + tbody {
            border-top: 2px solid var(--second-color);
        }

        .table-hover tbody tr:hover {
            color: var(--bg-color);
            background-color: rgba(138, 0, 255, 0.2);
        }

        .table-hover{
            color: #8A00FF;
            background-color: #8A00FF;
        }
    
</style>
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
        <h2>BOOKING STATUS</h2>
        </div>
          
        <section class="container">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Booking ID</th>
                    <th scope="col">Package Name</th>
                    <th scope="col">Service Type</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>   
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                    <tr>
                        <td>{{ $booking->booking_ID }}</td>
                        <td>{{ $booking->package->package_Name }}</td>
                        <td>{{ $booking->package->service_Type }}</td>
                        <td>RM{{ $booking->total_Price }}</td>
                        <td>{{ $booking->booking_Status }}</td>
                        <td>
                            @if ($booking->booking_Status == 'Pending')
                                <form action="{{ route('customer.cancelBooking', $booking->booking_ID) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-secondary btn-sm">CANCEL BOOKING</button>
                                </form>
                                <form action="{{ route('customer.makePayment', $booking->booking_ID) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm">MAKE PAYMENT</button>
                                </form>
                            @elseif ($booking->booking_Status == 'Accepted')
                                <form action="{{ route('customer.cancelBooking', $booking->booking_ID) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-secondary btn-sm">CANCEL BOOKING</button>
                                </form>
                                <form action="{{ route('customer.makePayment', $booking->booking_ID) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm">MAKE PAYMENT</button>
                                </form>
                            @else
                                <span>No actions available</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
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

        $(document).ready(function() {
            $('#table').DataTable();
        });
    </script>
</body>
</html>