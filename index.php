<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<title>PrimeDwell</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<div class="main">

<!-- NAVBAR -->

<div class="navbar">

<div class="logo">
<span class="house">🏠</span>
<span class="brand">Prime<span class="highlight">Dwell</span></span>
</div>

<ul class="nav-links">
<li><a href="about.php">ABOUT</a></li>
<li><a href="contact_form.php">CONTACT</a></li>
<li><a href="services.php">SERVICES</a></li>
<li><a href="show_property.php">PROPERTIES</a></li>
<li><a href="login.php">LOGIN</a></li>
</ul>

</div>


<!-- HERO TEXT -->

<div class="content">

<h1>Find Your <br><span>Dream</span> Home in Lucknow</h1>

<p class="par">
Discover the best rental homes in Lucknow. From Gomti Nagar to Hazratganj,
find properties that match your lifestyle, budget and comfort.
</p>

<a href="register.php" class="reg-btn">Register Here</a>

</div>


<!-- SEARCH BAR -->

<div class="index-search-container">

<form action="show_property.php" method="GET" class="index-search-form">

<input
type="text"
name="location"
placeholder="Select or Type Location"
list="locations"
class="index-search-input"
required>

<datalist id="locations">

<option value="Gomti Nagar">
<option value="Rajajipuram">
<option value="Vikas Nagar">
<option value="Hazratganj">
<option value="Aliganj">
<option value="Indira Nagar">

</datalist>

<button type="submit" class="index-search-btn">Search</button>

</form>

</div>

</div>


<!-- POPULAR AREAS -->

<section class="areas">

<h2>Popular Areas in Lucknow</h2>

<div class="area-grid">

<a href="show_property.php?location=Gomti Nagar" class="area-btn">🏡 Gomti Nagar</a>
<a href="show_property.php?location=Aliganj" class="area-btn">🏢 Aliganj</a>
<a href="show_property.php?location=Indira Nagar" class="area-btn">🏠 Indira Nagar</a>
<a href="show_property.php?location=Hazratganj" class="area-btn">📍 Hazratganj</a>
<a href="show_property.php?location=Vikas Nagar" class="area-btn">🏘 Vikas Nagar</a>
<a href="show_property.php?location=Rajajipuram" class="area-btn">🏡 Rajajipuram</a>

</div>

</section>


<!-- FEATURED PROPERTIES -->

<section class="featured">

<h2>Featured Properties</h2>

<div class="property-grid">

<div class="property-card">
<img src="uploads/1.jpg">
<h3>2 BHK Apartment</h3>
<p>Location: Gomti Nagar</p>
<p>Rent: ₹15000</p>
<a href="show_property.php" class="view-btn">View Details</a>
</div>

<div class="property-card">
<img src="uploads/2.jpg">
<h3>3 BHK House</h3>
<p>Location: Indira Nagar</p>
<p>Rent: ₹22000</p>
<a href="show_property.php" class="view-btn">View Details</a>
</div>

<div class="property-card">
<img src="uploads/3.jpg">
<h3>Luxury Villa</h3>
<p>Location: Hazratganj</p>
<p>Rent: ₹35000</p>
<a href="show_property.php" class="view-btn">View Details</a>
</div>

</div>

</section>


<!-- MAP SECTION -->

<section class="map-section">

<h2>Find Properties on Map</h2>

<div class="map-container">

<iframe
src="https://www.google.com/maps?q=Lucknow&output=embed"
width="100%"
height="450"
style="border:0;"
allowfullscreen=""
loading="lazy">
</iframe>

</div>

</section>


<!-- WHY CHOOSE US -->

<section class="why">

<h2>Why Choose PrimeDwell</h2>

<div class="why-grid">

<div>
<h3>Verified Properties</h3>
<p>All rental homes are verified for better trust and security.</p>
</div>

<div>
<h3>Direct Owner Contact</h3>
<p>Connect directly with property owners without brokers.</p>
</div>

<div>
<h3>Affordable Rentals</h3>
<p>Find homes that suit your budget and lifestyle.</p>
</div>

<div>
<h3>Easy Property Search</h3>
<p>Search houses quickly by location across Lucknow.</p>
</div>

</div>

</section>


<!-- FOOTER -->

<footer>

<p>© 2026 PrimeDwell | Rental Homes in Lucknow</p>

</footer>

</body>
</html>