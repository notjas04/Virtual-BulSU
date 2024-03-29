<?php
require "connect.php"
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Virtual BulSU</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/styles.css">
    <link rel="stylesheet" href="CSS/mobileView.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
</head>
<style>
    .navbar-custom {
        font-family: 'Roboto';
    }

    #tour {
        width: 100%;
        height: 800px;
        min-height: 562px;
        margin: 0 auto;
    }

    #announcementTab {
        color: black;
    }

    #campuses {
        color: black;
    }

    #offcanvasNavbar,
    #announcementPanel {
        position: fixed;
        top: 0;
        left: 0;
        padding: 30px 15px;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(5px);
        display: flex;
        justify-content: space-between;
        flex-direction: column;
        transition: width 0.5s;
    }

    .offcanvas-header h5 {
        color: black;
        width: 550px;
        height: 30px;
        margin: 0;
    }

    #announcementTab {
        box-shadow: inset 0 0 0 0 #763435;
        color: #763435;
        padding: 0 .25rem;
        margin: 0 -.25rem;
        transition: color .3s ease-in-out, box-shadow .3s ease-in-out;
        color: white;
        font-family: 'Roboto';
        font-size: 18px;
        font-weight: 500;
        line-height: 1.5;
        text-decoration: none;
        margin-bottom: 8px;
    }

    #announcementTab:hover {
        color: #d09b00;
        box-shadow: inset 150px 0 0 0 #763435;
        ;
    }

    #campuses {
        box-shadow: inset 0 0 0 0 #763435;
        color: #763435;
        padding: 0 .25rem;
        margin: 0 -.25rem;
        transition: color .3s ease-in-out, box-shadow .3s ease-in-out;
        color: white;
        font-family: 'Roboto';
        font-weight: 500;
        line-height: 1.5;
        text-decoration: none;
        font-size: 18px;
    }

    #campuses:hover {
        color: #d09b00;
        box-shadow: inset 150px 0 0 0 #763435;
        ;
    }

    #offcanvasNavbarLabel {
        color: white;
        font-size: larger;
        margin-left: 5px;
        padding-top: 3px;
        font-family: 'Roboto';
    }

    .dropdown-menu {
        background-color: #763435;
    }

    .dropdown-item {
        color: white;
    }

    #offcanvasScrollingLabel {
        color: white;
        font-family: 'Roboto';
    }

    .btn-close {
        color: white;
    }
</style>

<body>
    <div>
        <!-- Navigation Bar -->
        <nav id="navBar" class="navbar navbar-lg navbar-custom">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand custom-brand mx-auto" href="VirtualBulsu_Tour_HomePage.php">
                    <img src="resources\BSU_Logo.png" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
                    BULACAN STATE UNIVERSITY - Malolos Campus
                </a>
                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <box-icon name='menu' color='#ffffff' size=25px></box-icon>
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">MENU</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav">
                            <li class="nav-item " id="nav-item">
                                <a class="nav-link" aria-current="page" id="announcementTab" type="button" data-bs-toggle="offcanvas" data-bs-target="#announcementPanel" aria-controls="offcanvasScrollingLabel">Announcements</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="campuses" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Campuses
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="VirtualBulsu_Tour_Malolos.php">Malolos Campus</a></li>
                                    <li><a class="dropdown-item" href="VirtualBulsu_Tour_Bustos.php">Bustos Campus</a></li>
                                    <li><a class="dropdown-item" href="VirtualBulsu_Tour_Meneses.php">Meneses Campus</a></li>
                                    <li><a class="dropdown-item" href="VirtualBulsu_Tour_Sarmiento.php">Sarmiento Campus</a></li>
                                    <li><a class="dropdown-item" href="VirtualBulsu_Tour_Hagonoy.php">Hagonoy Campus</a></li>
                                    <li><a class="dropdown-item" href="VirtualBulsu_Tour_SanRafael.php">San Rafael Campus</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="true" tabindex="-1" id="announcementPanel" aria-labelledby="offcanvasScrollingLabel">
            <div class="offcanvas-header">
                <box-icon name='news' color='#ffffff'></box-icon>
                <h4 class="offcanvas-title" id="offcanvasScrollingLabel">CAMPUS NEWS</h4>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <?php
                // Query to fetch announcements from your database
                $query = "SELECT * FROM announcements";
                $result = mysqli_query($con, $query);

                if (!$result) {
                    die("Database query failed."); // Handle the error appropriately
                }

                while ($row = mysqli_fetch_assoc($result)) {
                    echo '
                            <div class="card mb-3" id=' . $row['announcement_id'] . '>
                                <img src="uploads/' . $row['file_input'] . '" class="card-img-top" alt="Unable to load image">
                                <div class="card-body">
                                    <h5 class="card-title">' . htmlspecialchars($row['headline']) . '</h5>
                                    <p class="card-text">' . htmlspecialchars($row['description']) . '</p>
                                    <p class="card-text"><small class="text-body-secondary">' . $row['event_date'] . '</small></p>
                                </div>
                            </div>
                            ';
                }
                // Release the result set
                mysqli_free_result($result);
                ?>
            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</body>

</html>