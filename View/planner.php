

<?php
// Check if user_id is set in the URL
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : (isset($_GET['user_id']) ? $_GET['user_id'] : '');

if (isset($_GET['user_id'])) {
  $userId = $_GET['user_id'];
  // Use $userId as needed
  echo "User ID: " . htmlspecialchars($userId);
} else {
  echo "User ID not provided.";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<title>Umrah Travel Guide</title>
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<meta content="" name="keywords">
<meta content="" name="description">

<!-- Favicon -->
<link href="img/favicon.ico" rel="icon">

<!-- Google Web Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">

<!-- Icon Font Stylesheet -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

<!-- Libraries Stylesheet -->
<link href="../css/lib/animate/animate.min.css" rel="stylesheet">
<link href="../css/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

<!-- Customized Bootstrap Stylesheet -->
<link href="../css/bootstrap.min.css" rel="stylesheet">

<!-- Template Stylesheet -->
<link href="../css/indexStyles.css" rel="stylesheet">
<link href="../css/plannerStyles.css" rel="stylesheet">

</head>

<body>
<div class="container-xxl bg-white p-0">
<!-- Spinner Start -->
<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
<div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
<span class="sr-only">Loading...</span>
</div>
</div>
<!-- Spinner End -->


<!-- Navbar Start -->
<div class="container-fluid nav-bar bg-transparent">
<nav class="navbar navbar-expand-lg bg-white navbar-light py-0 px-4">
<a href="index.php" class="navbar-brand d-flex align-items-center text-center">
<div class="icon p-2 me-2">
<img class="img-fluid" src="../img/kaaba.png" alt="Icon" style="width: 30px; height: 30px;">
</div>
<h1 class="m-0 text-primary">Umrah Travel Guide</h1>
</a>
<button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarCollapse">
<div class="navbar-nav ms-auto">
<a href="about.php" class="nav-item nav-link">PLANNER</a>
<div class="nav-item dropdown">
<a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Guides</a>
<div class="dropdown-menu rounded-0 m-0">
<a href="../View/Umrah Guide/umrah-timeline-step1.php" class="dropdown-item">Umrah Guide</a>
<a href="../View/Historical Places Guide/historicIndex.php" class="dropdown-item">Historical Places Guide</a>
</div>
</div>
<div class="nav-item dropdown">
<a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Contact</a>
<div class="dropdown-menu rounded-0 m-0">
<a href="testimonial.php" class="dropdown-item">Emergency Contacts<br> in Saudi Arabia</a>
<a href="404.php" class="dropdown-item">Contact Us</a>
</div>
</div>
</div>
<a href="login.php" class="nav-item nav-link active">LOGOUT</a>
</div>
</nav>
</div>
<!-- Navbar End -->

<!-- Header Start -->
<div class="text-center">
<div class="row g-0 align-items-center flex-column-reverse flex-md-row">
<div class="text-center">
<br>
<br>
<h1>Book a flight</h1>
<br>
<br>
</div>

</div>
</div>
<!--Header End-->
<!-- Planner Start -->


<div class='text-center'>
<section class="section__container booking__container">
<form>
<div class="form__group">
<span><i class="ri-calendar-line"></i></span>
<div class="input__content">
<div class="input__group">
<input type="date" id="departure_date" name="departure_date">
</div>
<p>Select Flight Date</p>
</div>
</div>

<div class="form__group">
<span><i class="ri-map-pin-line"></i></span>
<div class="input__content">
<div class="input__group">
<select id="departure" name="departure" onchange="updateDestinations()">
<option value="" disabled selected>Select Departure</option>
<option value="Dhaka">Dhaka</option>
<option value="Madinah">Madinah</option>
<option value="Jeddah">Jeddah</option>
</select>
</div>
<p>Choose Departure City</p>
</div>
</div>

<div class="form__group">
<span><i class="ri-map-pin-line"></i></span>
<div class="input__content">
<div class="input__group">
<select id="destination" name="destination" disabled onfocus="showWarning()">
<option value="" disabled selected>Select Destination</option>
</select>
<small id="warningMessage" style="color: red; display: none;">Please choose departure first.</small>
</div>
<p>Choose Destination</p>
</div>
</div>

<button class="btn" type="button" onclick="searchFlights(<?php echo $userId; ?>)">GO</button>
</form>

<div class="col-md-7 p-5 mt-lg-5" id="results-container" style="display:none;">
<h3>Flight Results</h3>
<p>Please select an option:</p>
<table id="resultsTable" class="table section__container booking__container">
<thead>
<tr>
<th>Date</th>
<th>Airline</th>
<th>Time</th>
<th>Departure</th>
<th>Destination</th>
<th>Price (USD)</th>
<th>Quantity</th>
<th>Total Price (USD)</th>
</tr>
</thead>
<tbody id="resultsBody">
<!-- JavaScript inserts flight data here -->
</tbody>
</table>

<!-- Confirm Button -->
<div>

</div>
<button class="btn btn-primary" type="button" onclick="">Confirm Selection</button>

</div>

</section>
</div>


<div >
  <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
    <div class="text-center">
      <br>
      <br>
      <h1>Book a Hotel</h1>
      <br>
      <br>
    </div>
  </div>
</div>


<div class='text-center'>
  <section class="section__container booking__container">

  <h2>Hotels in Makkah</h2>
  <?php
$apiKey = "AIzaSyD3eTWVwrn8jWq6MlCaKWMxOIWH0hCYFcM";
$location = "21.3891,39.8579"; // Makkah
$radius = "5000";
$type = "lodging";
$url = "https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=$location&radius=$radius&type=$type&key=$apiKey";

$response = file_get_contents($url);
$data = json_decode($response, true);
?>

<table border="1" class="table section__container booking__container">
    <tr>
        <th>Name</th>
        <th>Rating</th>
        <th>Address</th>
    </tr>

    <?php foreach ($data['results'] as $hotel): ?>
    <tr>
        <td><?php echo $hotel['name']; ?></td>
        <td><?php echo isset($hotel['rating']) ? $hotel['rating'] : "No rating"; ?></td>
        <td><?php echo isset($hotel['vicinity']) ? $hotel['vicinity'] : "No address"; ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<br>
<br>

<h2>Hotels in Madinah</h2>
  <?php
$apiKey = "AIzaSyD3eTWVwrn8jWq6MlCaKWMxOIWH0hCYFcM";
$location = "24.4709,39.6122"; // Makkah
$radius = "5000";
$type = "lodging";
$url = "https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=$location&radius=$radius&type=$type&key=$apiKey";

$response = file_get_contents($url);
$data = json_decode($response, true);
?>

<table border="1" class="table section__container booking__container">
    <tr>
        <th>Name</th>
        <th>Rating</th>
        <th>Address</th>
    </tr>

    <?php foreach ($data['results'] as $hotel): ?>
    <tr>
        <td><?php echo $hotel['name']; ?></td>
        <td><?php echo isset($hotel['rating']) ? $hotel['rating'] : "No rating"; ?></td>
        <td><?php echo isset($hotel['vicinity']) ? $hotel['vicinity'] : "No address"; ?></td>
    </tr>
    <?php endforeach; ?>
</table>

</div>

</section>
</div>
<script>
function updateDestinations() {
  const departure = document.getElementById("departure").value;
  const destinationSelect = document.getElementById("destination");
  const warningMessage = document.getElementById("warningMessage");
  
  destinationSelect.innerHTML = '<option value="" disabled selected>Select Destination</option>';
  destinationSelect.disabled = !departure;
  
  if (departure) {
    warningMessage.style.display = "none"; // Hide warning when departure is selected
  }
  
  const options = ["Dhaka", "Madinah", "Jeddah"].filter(city => city !== departure);
  
  options.forEach(city => {
    const option = document.createElement("option");
    option.value = city;
    option.textContent = city;
    destinationSelect.appendChild(option);
  });
}

function showWarning() {
  const departure = document.getElementById("departure").value;
  const warningMessage = document.getElementById("warningMessage");
  
  if (!departure) {
    warningMessage.style.display = "block"; // Show warning message
    setTimeout(() => {
      warningMessage.style.display = "none"; // Hide message after 3 seconds
    }, 3000);
  }
}
</script>



<!-- Planner End -->



<!-- Footer Start -->
<div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
<div class="container py-5">
<div class="row g-5">
<div class="col-lg-3 col-md-6">
<h5 class="text-white mb-4">Get In Touch</h5>
<p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>123 Street, New York, USA</p>
<p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
<p class="mb-2"><i class="fa fa-envelope me-3"></i>info@example.com</p>
</div>
</div>
</div>
</div>
<!-- Footer End -->


<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="../css/lib/wow/wow.min.js"></script>
<script src="../css/lib/easing/easing.min.js"></script>
<script src="../css/lib/waypoints/waypoints.min.js"></script>
<script src="../css/lib/owlcarousel/owl.carousel.min.js"></script>
<script src="../js/flightAPI.js"></script>
<script src="../js/confirmSelection.js"></script>

<!-- Template Javascript -->
<script src="../js/main.js"></script>
</body>

</html>