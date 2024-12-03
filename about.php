<?php
// about.php

// You can add any PHP logic here if needed, such as session handling or database calls.
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Coffee Shop</title>

    <!-- External CSS -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        #about h2, #team h3 {
            font-weight: 700;
            color: #6f4e37; /* Coffee-inspired color */
            text-align: center;
            animation: fadeIn 2s ease-out;
        }

        #about p, #team p {
            color: #555;
            font-size: 1.1rem;
            line-height: 1.7;
            animation: slideIn 1.5s ease-out;
        }

        #about .highlight {
            color: #c49a6c; /* Highlight color */
            font-weight: bold;
            text-transform: uppercase;
        }

        #about img, #team .card img {
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        #team .card {
            border: none;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        #team .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        #about {
            background-color: #f9f5f0;
            padding: 60px 0;
        }

        #team {
            background-color: #ece8e1;
            padding: 60px 0;
        }

        #scrollToTopBtn {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 30px;
            z-index: 99;
            border: none;
            outline: none;
            background-color: #6f4e37;
            color: white;
            cursor: pointer;
            padding: 15px;
            border-radius: 10px;
            font-size: 18px;
        }

        #scrollToTopBtn:hover {
            background-color: #4a2f21;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
    </style>
</head>

<body>

    <!-- Scroll to Top Button -->
    <button id="scrollToTopBtn" title="Go to top">Top</button>

    <div class="all-content">

        <!-- Navigation Bar -->
        <nav class="navbar navbar-expand-lg" id="navbar">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php" id="logo"><img src="./images/logo.png" alt="Coffee Shop Logo"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span><i class="fa-solid fa-bars" style="color: white; font-size: 23px;"></i></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link active" href="about.php">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="menu.php">Menu</a></li>
                        <li class="nav-item"><a class="nav-link" href="order.php">Order</a></li>
                        <li class="nav-item"><a class="nav-link" href="gallery.php">Gallery</a></li>
                        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                    </ul>
                    <form class="d-flex" id="search-form">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="search-input">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>

        <!-- About Us Section -->
        <section id="about" class="py-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h2 class="text-uppercase">Tentang Kami</h2>
                        <p>
                            Selamat datang di <span class="highlight">KOPI-LIH DIA</span>, tempat di mana setiap tegukan membawa kehangatan dan kebahagiaan.
                            Kami menyajikan kopi pilihan dengan cita rasa otentik yang menggugah selera.
                        </p>
                        <p>
                            Dengan suasana nyaman dan pelayanan ramah, kami hadir untuk menemani momen istimewa Anda. Bergabunglah bersama kami untuk menikmati kopi yang diracik dengan <span class="highlight">cinta</span> dan <span class="highlight">dedikasi</span>.
                        </p>
                    </div>
                    <div class="col-md-6">
                        <img src="./images/about.png" alt="Interior Coffee Shop" class="img-fluid">
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- JavaScript & Bootstrap Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>

    <script>
        // Scroll to Top Button functionality
        window.onscroll = function () { toggleScrollButton() };
        function toggleScrollButton() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                document.getElementById("scrollToTopBtn").style.display = "block";
            } else {
                document.getElementById("scrollToTopBtn").style.display = "none";
            }
        }

        document.getElementById("scrollToTopBtn").onclick = function () {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>

</body>

</html>
