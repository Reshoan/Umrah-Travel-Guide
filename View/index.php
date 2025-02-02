<?php
// Check if user_id is set in the URL
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

    <!-- Add Font Awesome for the light bulb icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    

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
                        <div class><a href="../control/chat.php" class="btn futuristic-button nav-link" style="height: 20px;"><i class="fas fa-lightbulb"></i> Chat</a></div>
                    
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
        <div class="container-fluid header bg-white p-0">
            <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
                <div class="col-md-6 p-5 mt-lg-5">
                    <br><br>
                    <h1 class="display-5 animated fadeIn mb-4">Plan  A <span class="text-primary">Perfect Umrah</span> For Your Family</h1>
                    <p class="animated fadeIn mb-4 pb-2">Join Us on a Spiritual Journey of a Lifetime! 🌙🕋✨</p>

                        
                        <?php
                            $city = "Makkah";
                            $city2 = "Madinah";
                            $country = "Saudi Arabia";
                            $method = 2; // ISNA Calculation Method

                            // Properly encode query parameters
                            $city = urlencode($city);
                            $country = urlencode($country);

                            $url = "https://api.aladhan.com/v1/timingsByCity?city=$city&country=$country&method=$method";
                            $url2 = "https://api.aladhan.com/v1/timingsByCity?city=$city2&country=$country&method=$method";

                            $response = file_get_contents($url);
                            $response2 = file_get_contents($url2);

                            if ($response === false) {
                                die("Error fetching prayer times.");
                            }
                            if ($response2 === false) {
                                die("Error fetching prayer times.");
                            }

                            $data = json_decode($response, true);
                            $data2 = json_decode($response2, true);

                            echo "<style>
                                    .small-tabler, .small-tabler th, .small-tabler td {
                                        
                                        border-collapse: collapse;
                                        font-size: small;
                                        font-weight:900;
                                        max-width: var(--max-width);
                                        margin: auto;
                                    }
                                  </style>";
                            echo "<table class='table small-tabler' style='font-size: smaller;'>";

                            if (isset($data["data"]["timings"])) {
                                echo "<h5>Prayer Times for Makkah</h5>";
                                echo "<table class='table small-tabler' style='font-size: smaller;'>";
                                
                                // First Row: Prayer Times
                                echo "<tr>";
                                foreach ($data["data"]["timings"] as $prayer => $time) {
                                    echo "<th>$time</th>";
                                }
                                echo "</tr>";

                                // Second Row: Prayer Names
                                echo "<tr>";
                                foreach ($data["data"]["timings"] as $prayer => $time) {
                                    echo "<td>$prayer</td>";
                                }
                                echo "</tr>";

                                echo "</table>";
                            } else {
                                echo "Error: Could not fetch prayer times.";
                            }
                            if (isset($data2["data"]["timings"])) {
                                echo "<h5>Prayer Times for Madinah</h5>";
                                echo "<table class='table small-tabler' style='font-size: smaller;'>";
                                
                                // First Row: Prayer Times
                                echo "<tr>";
                                foreach ($data2["data"]["timings"] as $prayer => $time) {
                                    echo "<th>$time</th>";
                                }
                                echo "</tr>";

                                // Second Row: Prayer Names
                                echo "<tr>";
                                foreach ($data2["data"]["timings"] as $prayer => $time) {
                                    echo "<td>$prayer</td>";
                                }
                                echo "</tr>";

                                echo "</table>";
                            } else {
                                echo "Error: Could not fetch prayer times.";
                            }
                            ?>



                </div>
                <div class="col-md-6 animated fadeIn">
                    <div class="owl-carousel header-carousel">
                        <div class="owl-carousel-item">
                            <img class="img-fluid" src="../img/madina_carousel.jpg" alt="">
                        </div>
                        <div class="owl-carousel-item">
                            <img class="img-fluid" src="../img/kaaba_carousel.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->


        
         <!--`Guide` Start -->
         <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-0 gx-5 align-items-end">
                    <div class="col-12">
                        <div class="text-start mx-auto mb-5 wow slideInLeft" data-wow-delay="0.1s">
                            <h1 class="mb-3">Guides</h1>
                        </div>
                    </div>
                   
                </div>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <div class="row g-4">
                            <div class=" col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="property-item rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        <a href="../View/Umrah Guide/umrah-timeline-step1.php"><img class="img-fluid" src="../img/Umrahguide.png" alt=""></a>
                                        
                                    </div>
                                    <div class="p-4 pb-0">
                                        <a class="d-block h5 mb-2" href="umrah-timeline-step1.php">Complete Guide to Completeing Umrah</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                                <div class="property-item rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        <a href="../View/Historical Places Guide/historicIndex.php"><img class="img-fluid" src="../img/historicalguide.png" alt=""></a>
                                        
                                    </div>
                                    <div class="p-4 pb-0">
                                        <a class="d-block h5 mb-2" href="../View/Historical Places Guide/historicIndex.php">Explore Historical Landmarks</a>
                                    </div>
                                    
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- Property List End -->



        <!-- Planner Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                        <div class="about-img position-relative overflow-hidden p-5 pe-0">
                            <img class="img-fluid w-100" src="../img/planner.png">
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                        <h1 class="mb-4">User our planner to keep track of every step of your Umrah</h1>
                        
                        <p><i class="fa fa-check text-primary me-3"></i>Umrah</p>
                        <p><i class="fa fa-check text-primary me-3"></i>Flight dates</p>
                        <p><i class="fa fa-check text-primary me-3"></i>Hotels</p>
                        <p><i class="fa fa-check text-primary me-3"></i>Taxis</p>
                        <p><i class="fa fa-check text-primary me-3"></i>Plan visits to historical places</p>
                        <a class="btn btn-primary py-3 px-5 mt-3" href="planner.php?user_id=<?php echo htmlspecialchars($userId); ?>">Go to Planner</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Planner End -->

 <!-- Testimonial Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3">Noticed something we could improve? Leave a review!</h1>

                    <div id="review-form">
                        <textarea id="review-text" class="form-control mb-3" rows="3" placeholder="Write your review here..."></textarea>
                        <button id="save-review" class="btn btn-primary">Save Review</button>
                    </div>
                    <div id="reviews-container" class="mt-3">
                        <!-- Reviews will be displayed here -->
                    </div>

                    <h3>Read about other users expericence with our services.</h3>
                </div>
                <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
                    <div class="testimonial-item bg-light rounded p-3">
                        <div class="bg-white border rounded p-4">
                            <p>Tempor stet labore dolor clita stet diam amet ipsum dolor duo ipsum rebum stet dolor amet diam stet. Est stet ea lorem amet est kasd kasd erat eos</p>
                            <div class="d-flex align-items-center">
                                <img class="img-fluid flex-shrink-0 rounded" src="img/testimonial-1.jpg" style="width: 45px; height: 45px;">
                                <div class="ps-3">
                                    <h6 class="fw-bold mb-1">Client Name</h6>
                                    <small>Profession</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item bg-light rounded p-3">
                        <div class="bg-white border rounded p-4">
                            <p>Tempor stet labore dolor clita stet diam amet ipsum dolor duo ipsum rebum stet dolor amet diam stet. Est stet ea lorem amet est kasd kasd erat eos</p>
                            <div class="d-flex align-items-center">
                                <img class="img-fluid flex-shrink-0 rounded" src="img/testimonial-2.jpg" style="width: 45px; height: 45px;">
                                <div class="ps-3">
                                    <h6 class="fw-bold mb-1">Client Name</h6>
                                    <small>Profession</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item bg-light rounded p-3">
                        <div class="bg-white border rounded p-4">
                            <p>Tempor stet labore dolor clita stet diam amet ipsum dolor duo ipsum rebum stet dolor amet diam stet. Est stet ea lorem amet est kasd kasd erat eos</p>
                            <div class="d-flex align-items-center">
                                <img class="img-fluid flex-shrink-0 rounded" src="img/testimonial-3.jpg" style="width: 45px; height: 45px;">
                                <div class="ps-3">
                                    <h6 class="fw-bold mb-1">Client Name</h6>
                                    <small>Profession</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <!-- Testimonial End -->

        <!-- Add this HTML where you want the button to appear -->
        

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
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Quick Links</h5>
                        <a class="btn btn-link text-white-50" href="">About Us</a>
                        <a class="btn btn-link text-white-50" href="">Contact Us</a>
                        <a class="btn btn-link text-white-50" href="">Our Services</a>
                        <a class="btn btn-link text-white-50" href="">Privacy Policy</a>
                        <a class="btn btn-link text-white-50" href="">Terms & Condition</a>
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

    <!-- Template Javascript -->
    <script src="../js/main.js"></script>

    <!-- Add this script at the end of the body section in index.html -->
    <script>
    document.getElementById('save-review').addEventListener('click', function() {
        const reviewText = document.getElementById('review-text').value;
        if (reviewText.trim() === '') {
            alert('Please write a review before saving.');
            return;
        }

        // Placeholder for saving the review to the database
        console.log('Saving review to the database:', reviewText);

        // Display the review
        const reviewsContainer = document.getElementById('reviews-container');
        const reviewElement = document.createElement('div');
        reviewElement.className = 'review-item mb-3 p-3 border';
        reviewElement.innerHTML = `
            <p>${reviewText}</p>
            <button class="btn btn-secondary btn-sm edit-review">Edit</button>
        `;
        reviewsContainer.appendChild(reviewElement);

        // Clear the textarea
        document.getElementById('review-text').value = '';

        // Add event listener for the edit button
        reviewElement.querySelector('.edit-review').addEventListener('click', function() {
            const newReviewText = prompt('Edit your review:', reviewText);
            if (newReviewText !== null) {
                reviewElement.querySelector('p').textContent = newReviewText;
                // Placeholder for updating the review in the database
                console.log('Updating review in the database:', newReviewText);
            }
        });
    });
    </script>
</body>

</html>