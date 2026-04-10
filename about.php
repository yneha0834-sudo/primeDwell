<!DOCTYPE html>
<html>
<head>
    <title>About Us</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f2f2f2;
        }

        .header {
            background: url('images/about-header.jpg') center/cover no-repeat;
            height: 250px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            text-shadow: 2px 2px 5px rgba(0,0,0,0.7);
        }

        .header h1 {
            font-size: 48px;
        }

        .about-container {
            max-width: 900px;
            margin: 30px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        .section {
            margin-bottom: 30px;
        }

        .section h2 {
            color: #007bff;
            margin-bottom: 15px;
        }

        .team {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .team-member {
            flex: 1 1 200px;
            text-align: center;
        }

        .team-member img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .team-member h3 {
            margin: 5px 0;
        }

        .team-member p {
            color: #555;
            font-size: 14px;
        }
    </style>
</head>
<body>

<!-- Header -->
<div class="header">
    <h1>About Us</h1>
</div>

<!-- Main Content -->
<div class="about-container">

    <!-- Mission Section -->
    <div class="section">
        <h2>Our Mission</h2>
        <p>Our mission is to provide a simple, transparent, and reliable platform for property search. We aim to connect users with their dream homes and investments efficiently.</p>
    </div>

    <!-- Vision Section -->
    <div class="section">
        <h2>Our Vision</h2>
        <p>We envision becoming the most trusted real estate portal in the city, providing comprehensive property listings, verified information, and seamless user experience.</p>
    </div>

    <!-- Team Section -->
    <div class="section">
        <h2>Meet Our Team</h2>
        <div class="team">
            <div class="team-member">
                <img src="images/team1.jpg" alt="Team Member 1">
                <h3>Saurabh Yadav</h3>
                <p>Founder & CEO</p>
            </div>
            <div class="team-member">
                <img src="images/team2.jpg" alt="Team Member 2">
                <h3>Neha Yadav</h3>
                <p>Property Manager</p>
            </div>
            <div class="team-member">
                <img src="images/team3.jpg" alt="Team Member 3">
                <h3>Priya Singh</h3>
                <p>Marketing Head</p>
            </div>
        </div>
    </div>

</div>

</body>
</html>
