<!DOCTYPE html>
<html>
<head>
    <title>Our Services</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f2f2f2; margin:0; padding:0; }
        .container { max-width: 1000px; margin:50px auto; padding:20px; }
        h1 { text-align:center; color:#007bff; margin-bottom:40px; }
        .service-cards { display:flex; flex-wrap:wrap; gap:20px; justify-content:center; }
        .card { background:#fff; padding:20px; border-radius:10px; width:300px; box-shadow:0 2px 5px rgba(0,0,0,0.2); text-align:center; }
        .card img { width:100%; height:200px; object-fit:cover; border-radius:10px; margin-bottom:15px; }
        .card h3 { margin:10px 0; color:#007bff; }
        .card p { color:#555; }
        .card a { display:inline-block; margin-top:10px; padding:8px 15px; background:#007bff; color:white; text-decoration:none; border-radius:5px; }
        .card a:hover { background:#0056b3; }
    </style>
</head>
<body>

<div class="container">
    <h1>Our Services</h1>
    <div class="service-cards">
        <div class="card">
            <img src="uploads/house.jpg" alt="House Rentals">
            <h3>House/Flat Rentals</h3>
            <p>Find 1BHK, 2BHK, 3BHK flats and independent houses for rent.</p>
            <a href="show_property.php">View Properties</a>
        </div>
        <div class="card">
            <img src="uploads/pg.jpg" alt="PG Rentals">
            <h3>PG & Hostel Rentals</h3>
            <p>Affordable PGs and hostels with verified listings and flexible terms.</p>
            <a href="show_property.php">View Listings</a>
        </div>
        <div class="card">
            <img src="uploads/consult.jpg" alt="Consultation">
            <h3>Property Consultation</h3>
            <p>Get expert advice to buy, sell or rent properties quickly and easily.</p>
            <a href="contact_form.php">Contact Us</a>
        </div>
    </div>
</div>
                  
</body>
</html>
