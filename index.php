<?php
// index.php

// You can add any PHP logic here, for example, session handling or database calls.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Shop</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Scroll to Top Button -->
<button id="scrollToTopBtn" title="Go to top">Top</button>

<style>
  /* Style for scroll to top button */
  #scrollToTopBtn {
    display: none; /* Hidden by default */
    position: fixed; /* Fixed/sticky position */
    bottom: 20px; /* Place the button at the bottom */
    right: 30px; /* Place the button 30px from the right */
    z-index: 99; /* Make sure it does not overlap */
    border: none; /* Remove borders */
    outline: none; /* Remove outline */
    background-color: #555; /* Set a background color */
    color: white; /* Text color */
    cursor: pointer; /* Add a mouse pointer on hover */
    padding: 15px; /* Some padding */
    border-radius: 10px; /* Rounded corners */
    font-size: 18px; /* Increase font size */
  }

  #scrollToTopBtn:hover {
    background-color: #333; /* Add a dark-grey background on hover */
  }

  /* Navbar change style when scrolling */
  .scrolled-navbar {
    background-color: #333 !important;
    transition: background-color 0.3s;
  }
</style>

    <div class="all-content">
        <nav class="navbar navbar-expand-lg" id="navbar">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php" id="logo"><img src="./images/logo.png" alt=""></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span><i class="fa-solid fa-bars" style="color: white; font-size: 23px;"></i></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="menu.php">Menu</a></li>
                        <li class="nav-item"><a class="nav-link active" href="order.php">Order</a></li>
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
        <section id="home">
            <div class="content">
                <h3 id="morning-message"></h3>
                <p id="philosophy-message"></p>
            </div>
        </section>

        <section class="favorite-items">
            <div class="heading2">Favorite <span>Items</span></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-4 py-3 py-md-0">
                        <div class="card favorite-card">
                            <img src="./images/cappucino.jpg" alt="Cappuccino">
                            <h4>Cappuccino</h4>
                        </div>
                    </div>
                    <div class="col-md-4 py-3 py-md-0">
                        <div class="card favorite-card">
                            <img src="./images/Flat white coffee tin.jpg" alt="Flat white">
                            <h4>Flat White</h4>
                        </div>
                    </div>
                    <div class="col-md-4 py-3 py-md-0">
                        <div class="card favorite-card">
                            <img src="./images/americanooo.jpg" alt="Americano">
                            <h4>Americano</h4>
                        </div>
                    </div>


                    <div class="col-md-4 py-3 py-md-0">
                        <div class="card favorite-card">
                            <img src="./images/belgia.jpg" alt="Berlgia liege waffle">
                            <h4>Berlgia Liege Waffle</h4>
                        </div>
                    </div>
                    <div class="col-md-4 py-3 py-md-0">
                        <div class="card favorite-card">
                            <img src="./images/roti panggang.jpg" alt="Roti Panggang">
                            <h4>Roti Panggang</h4>
                        </div>
                    </div>
                    <div class="col-md-4 py-3 py-md-0">
                        <div class="card favorite-card">
                            <img src="./images/pisang.jpg" alt="Pisang Nugget">
                            <h4>Pisang Nugget</h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    
        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="searchModalLabel">Hasil Pencarian</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="search-results">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>

    <script>
        document.getElementById("morning-message").innerHTML = "Awali Harimu <br> Dengan Secangkir <br> Kenikmatan";
        document.getElementById("philosophy-message").innerHTML = "Hidup ini diibaratkan secangkir kopi hitam.<br>Di mana rasa manis dan pahit akan bertemu di dalam sebuah kehangatan.";

        const menuItems = ["Cappuccino", "Flat White", "Americano", "Espresso", "Latte", "Mocha", "Iced Coffee", "Cold Brew", "Affogato", "Berlgia Liege Waffle", "Roti Panggang", "Churros", "French Fries", "Bakso Crispy", "Pisang Nugget"];

        document.getElementById("search-form").addEventListener("submit", function(e) {
            e.preventDefault(); 
            const query = document.getElementById("search-input").value.toLowerCase();
            const resultsDiv = document.getElementById("search-results");
            resultsDiv.innerHTML = ""; 

            const filteredItems = menuItems.filter(item => item.toLowerCase().includes(query));
            
            if (filteredItems.length > 0) {
                resultsDiv.innerHTML = "<ul>" + filteredItems.map(item => `<li>${item}</li>`).join("") + "</ul>";
            } else {
                resultsDiv.innerHTML = "<p>Tidak ada hasil ditemukan.</p>";
            }

            const searchModal = new bootstrap.Modal(document.getElementById('searchModal'));
            searchModal.show();
        });
    </script>
</body>
</html>
