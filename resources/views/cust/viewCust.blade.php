<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Profile</title>

    <link rel="stylesheet" href="{{ asset('css/updAcc.css') }}?v={{ time() }}">


<!---box icons--->	
<link rel="stylesheet"
href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" 
rel="stylesheet">

<!---google fonts--->	
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?
family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

    <!---header--->
    <header>
	<a href="{{ (route('dashboard')) }}" class="logo"><img src="img/cam.png">SNAP.FIND</a> 
	
	<ul class="navlist">
		<li><a href="{{ (route('dashboard')) }}">HOME</a></li>
			<div class="dropdown">
				<a href="#" class="hi">BOOKING<i class="bx bx-chevron-down"></i></a>
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
	<a href="#" class="hi">Hi {{ Auth::user()->name }} <i class="bx bx-chevron-down"></i></a>
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


<!-- </section> -->
<div class="form-container">
    <div class="profile-text">
        <h2>MY ACCOUNT</h2>
    </div>  
    <form>
        <div class="container-box">
            <label for="name">Name:</label>
            <input type="text" id="name" name="CustName" value="{{ Auth::user()->cust_Name }}" readonly><br><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="CustEmail" value="{{ Auth::user()->cust_Email }}" readonly><br><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="CustPass" value="{{ Auth::user()->cust_Password }}" readonly><br><br>

            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="CustPhoneNum" value="{{ Auth::user()->cust_PhoneNum }}" pattern="^01[0-9]{8,9}$" readonly><br><br>

            <div class="btn-update">
                <a href="{{ route('updCust') }}" class="btn">UPDATE</a>
            </div>
        </div>
    </form>
</div>
 

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

        button.addEventListener('click', function(event) {
            event.stopPropagation(); // Prevent the click event from bubbling up
            isOpen = !isOpen;
            dropdownContent.style.display = isOpen ? 'block' : 'none';
        });

        // Close dropdown when clicking outside of it
        window.addEventListener('click', function(event) {
            if (!dropdown.contains(event.target)) {
                isOpen = false;
                dropdownContent.style.display = 'none';
            }
        });
    });
});

    //JavaScript to handle confirmation
        function confirmChanges() {
            if (confirm("Are you sure you want to change your details?")) {
                // Submit the form or perform the necessary action
                document.getElementById("profileForm").submit(); // Example: Submitting the form
            }
        }
        function cancelChanges() {
            // Handle cancellation, such as redirecting to another page
            window.location.href = "dashboard.html"; // Example: Redirecting to the dashboard
        }

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

sr.reveal ('.home-text',{delay:100});
sr.reveal ('.home-img',{delay:100});
sr.reveal ('.form-container',{delay:100});
sr.reveal ('.about-img',{delay:100});
sr.reveal ('.about',{delay:100});
sr.reveal ('.contact',{delay:100});
sr.reveal ('.scroll',{delay:100});
sr.reveal ('.search-bar',{delay:100});

	
</script>
    
</body>
</html>