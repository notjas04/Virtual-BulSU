<?php 
require "connect.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bulacan State University</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS\VirtualBulsu_Navbar.css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" />
    <style>
      html,
      body {
        height: 100%;
      }

      body {
        background: /*linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.932)),*/
          url("resources/cover.png");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        display: flex;
        flex-direction: column;
        /*backdrop-filter: blur(2px); */
      }

      #VTIntroduction {
        color: white;
        top: 30%;
      }

      #line-clamp {
        display: -webkit-box;
        -webkit-line-clamp: 6; /* Adjust the number of lines as needed */
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
      }

      .navbar-custom {
        width: 100%;
        background: none;
        background-color: #763435;
        /*border: 1px solid#f7f7f7; */
        font-family: "Roboto";
      }
      .navbar-custom .navbar-brand {
        color: aliceblue;
        text-decoration: none;
        font-family: "Roboto";
        /* Remove underline */
      }

    .navbar-custom .navbar-nav #news-link:before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: rgba(255, 215, 0, 1);
            transition: background-color 0.3s ease;
        }

    .navbar-custom .navbar-nav #news-link {
            color: #ffd700;
        }

      .footer {
        background-color: #763435;
        color: white;
        padding: 5px;
        text-align: center;
        
      }

      #announcementCard {
        text-decoration: none; /* Remove underline */
        color: inherit; /* Inherit text color */
      }

      #announcementCard:hover {
        color: inherit; /* Inherit text color on hover */
      }
@media (max-width: 992px){
    nav {
        display: block;
        width: 100% !important;
    }

    #collegeLogo {
      width: 8em;
    }
}

@media (min-width: 992px){
   #collegeLogo {
    width: 10em;
   }
}

@media (min-width: 1200px){
   #collegeLogo {
    width: 9em;
   }
}


</style>
</head>
<body>
    <?php include "includes/tour_navbar.php"; ?>

    <div class="container my-3">
      <h1 class="text-white text-center" id="heading" >Malolos Campus News</h1>
      <div class="row row-cols-lg-3 justify-content-center gy-3 mt-1">
        <div class="col">
          <div type="button" class="card h-100" data-bs-toggle="modal" data-bs-target="#announcementListModal" data-bs-id="College of Architecture and Fine Arts">
            <img src="resources/cover.png" class="card-img-top" alt="...">
            <div class="card-body">
              <img src="resources/CAFA.png" alt="" class="position-absolute top-50 start-50 translate-middle" id="collegeLogo">
              <h5 class="card-title text-center mt-5">College of Architecture and Fine Arts</h5>
            </div>
          </div>
        </div>
        <div class="col">
          <div type="button" class="card h-100" data-bs-toggle="modal" data-bs-target="#announcementListModal" data-bs-id="College of Arts and Letters">
            <img src="resources/cover.png" class="card-img-top" alt="...">
            <div class="card-body">
              <img src="resources/CAL.png" alt="" class="rounded-circle position-absolute top-50 start-50 translate-middle" id="collegeLogo">
              <h5 class="card-title text-center mt-5">College of Arts and Letters</h5>
            </div>
          </div>
        </div>
        <div class="col">
          <div type="button" class="card h-100" data-bs-toggle="modal" data-bs-target="#announcementListModal" data-bs-id="College of Business Administration">
            <img src="resources/cover.png" class="card-img-top" alt="...">
            <div class="card-body">
              <img src="resources/CBA.png" alt="" class="rounded-circle position-absolute top-50 start-50 translate-middle" id="collegeLogo">
              <h5 class="card-title text-center mt-5">College of Business Administration</h5>
            </div>
          </div>
        </div>
        <div class="col">
          <div type="button" class="card h-100" data-bs-toggle="modal" data-bs-target="#announcementListModal" data-bs-id="College of Criminal Justice Education">
            <img src="resources/cover.png" class="card-img-top" alt="...">
            <div class="card-body">
              <img src="resources/CCJE.png" alt="" class="rounded-circle position-absolute top-50 start-50 translate-middle" id="collegeLogo">
              <h5 class="card-title text-center mt-5">College of Criminal Justice Education</h5>
            </div>
          </div>
        </div>
        <div class="col">
          <div type="button" class="card h-100" data-bs-toggle="modal" data-bs-target="#announcementListModal" data-bs-id="College of Education">
            <img src="resources/cover.png" class="card-img-top" alt="...">
            <div class="card-body">
              <img src="resources/COED.png" alt="" class="rounded-circle position-absolute top-50 start-50 translate-middle" id="collegeLogo">
              <h5 class="card-title text-center mt-5">College of Education</h5>
            </div>
          </div>
        </div>
        <div class="col">
          <div type="button" class="card h-100" data-bs-toggle="modal" data-bs-target="#announcementListModal" data-bs-id="College of Engineering">
            <img src="resources/cover.png" class="card-img-top" alt="...">
            <div class="card-body">
              <img src="resources/COE.png" alt="" class="rounded-circle position-absolute top-50 start-50 translate-middle" id="collegeLogo">
              <h5 class="card-title text-center mt-5">College of Engineering</h5>
            </div>
          </div>
        </div>
        <div class="col">
          <div type="button" class="card h-100" data-bs-toggle="modal" data-bs-target="#announcementListModal" data-bs-id="College of Hospitality and Tourism Management">
            <img src="resources/cover.png" class="card-img-top" alt="...">
            <div class="card-body">
              <img src="resources/CHTM.png" alt="" class="rounded-circle position-absolute top-50 start-50 translate-middle" id="collegeLogo">
              <h5 class="card-title text-center mt-5">College of Hospitality and Tourism Management</h5>
            </div>
          </div>
        </div>
        <div class="col">
          <div type="button" class="card h-100" data-bs-toggle="modal" data-bs-target="#announcementListModal" data-bs-id="College of Industrial Technology">
            <img src="resources/cover.png" class="card-img-top" alt="...">
            <div class="card-body">
              <img src="resources/CIT.png" alt="" class="rounded-circle position-absolute top-50 start-50 translate-middle" id="collegeLogo">
              <h5 class="card-title text-center mt-5">College of Industrial Technology </h5>
            </div>
          </div>
        </div>
        <div class="col">
          <div type="button" class="card h-100" data-bs-toggle="modal" data-bs-target="#announcementListModal" data-bs-id="College of Information and Communications Technology">
            <img src="resources/cover.png" class="card-img-top" alt="...">
            <div class="card-body">
              <img src="resources/CICT.png" alt="" class="rounded-circle position-absolute top-50 start-50 translate-middle" id="collegeLogo">
              <h5 class="card-title text-center mt-5">College of Information and Communications Technology</h5>
            </div>
          </div>
        </div>
        <div class="col">
          <div type="button" class="card h-100" data-bs-toggle="modal" data-bs-target="#announcementListModal" data-bs-id="College of Law">
            <img src="resources/cover.png" class="card-img-top" alt="...">
            <div class="card-body">
              <img src="resources/CLaw.png" alt="" class="rounded-circle position-absolute top-50 start-50 translate-middle" id="collegeLogo">
              <h5 class="card-title text-center mt-5">College of Law</h5>
            </div>
          </div>
        </div>
        <div class="col">
          <div type="button" class="card h-100" data-bs-toggle="modal" data-bs-target="#announcementListModal" data-bs-id="College of Nursing">
            <img src="resources/cover.png" class="card-img-top" alt="...">
            <div class="card-body">
              <img src="resources/CICT.png" alt="" class="rounded-circle position-absolute top-50 start-50 translate-middle" id="collegeLogo">
              <h5 class="card-title text-center mt-5">College of Nursing</h5>
            </div>
          </div>
        </div>
        <div class="col">
          <div type="button" class="card h-100" data-bs-toggle="modal" data-bs-target="#announcementListModal" data-bs-id="College of Education">
            <img src="resources/cover.png" class="card-img-top" alt="...">
            <div class="card-body">
              <img src="resources/COED.png" alt="" class="rounded-circle position-absolute top-50 start-50 translate-middle" id="collegeLogo">
              <h5 class="card-title text-center mt-5">College of Education</h5>
            </div>
          </div>
        </div>
        <div class="col">
          <div type="button" class="card h-100" data-bs-toggle="modal" data-bs-target="#announcementListModal" data-bs-id="College of Science">
            <img src="resources/cover.png" class="card-img-top" alt="...">
            <div class="card-body">
              <img src="resources/CS.png" alt="" class="rounded-circle position-absolute top-50 start-50 translate-middle" id="collegeLogo">
              <h5 class="card-title text-center mt-5">College of Science</h5>
            </div>
          </div>
        </div>
        <div class="col">
          <div type="button" class="card h-100" data-bs-toggle="modal" data-bs-target="#announcementListModal" data-bs-id="College of Sports, Exercise and Recreation">
            <img src="resources/cover.png" class="card-img-top" alt="...">
            <div class="card-body">
              <img src="resources/CSER.png" alt="" class="rounded-circle position-absolute top-50 start-50 translate-middle" id="collegeLogo">
              <h5 class="card-title text-center mt-5">College of Sports, Exercise and Recreation</h5>
            </div>
          </div>
        </div>
        <div class="col">
          <div type="button" class="card h-100" data-bs-toggle="modal" data-bs-target="#announcementListModal" data-bs-id="College of Social Sciences and Philosophy">
            <img src="resources/cover.png" class="card-img-top" alt="...">
            <div class="card-body">
              <img src="resources/CSSP.png" alt="" class="rounded-circle position-absolute top-50 start-50 translate-middle" id="collegeLogo">
              <h5 class="card-title text-center mt-5">College of Social Sciences and Philosophy </h5>
            </div>
          </div>
        </div>
        <div class="col">
          <div type="button" class="card h-100" data-bs-toggle="modal" data-bs-target="#announcementListModal" data-bs-id="Graduate School">
            <img src="resources/cover.png" class="card-img-top" alt="...">
            <div class="card-body">
              <img src="resources/GS.png" alt="" class="rounded-circle position-absolute top-50 start-50 translate-middle" id="collegeLogo">
              <h5 class="card-title text-center mt-5">Graduate School</h5>
            </div>
          </div>
        </div>
      </div>
    </div>


    <footer class="footer">
      <!-- &copy; 2023 Bulacan State University.  -->All rights reserved.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

    <script>

    var announcementListModal = document.getElementById('announcementListModal');
    announcementListModal.addEventListener('show.bs.modal', function (event) {
      // Button that triggered the modal
      var button = event.relatedTarget;
      // Extract info from data-bs-* attributes
      var college = button.getAttribute('data-bs-id');

      var modalTitle = announcementListModal.querySelector('.modal-title');
      var modalBody = announcementListModal.querySelector('.modal-body');

      modalTitle.textContent = college;

      console.log(college);

      // Construct and execute a SQL query to retrieve content based on announcementId
      var xhr = new XMLHttpRequest();
      xhr.open('GET', 'college_announcements.php?college=' + college + '&campus=Malolos Campus');
      xhr.onload = function() {
        if (xhr.status === 200 && xhr.responseText) {
          var announcements = JSON.parse(xhr.responseText);

          if (announcements.length > 0) {
            var html = '';
            for (var i = 0; i < announcements.length; i++) {
              var announcement = announcements[i];

              html += '<a href="VirtualBulsu_AnnouncementPage.php?id=' + announcement.announcement_id + '" class="text-decoration-none" id="announcementCard">';
              html += '<div class="card mb-3">';
              html += '<img src="resources/'+ announcement.file_input +'" class="card-img-top" alt="...">';
              html += '<div class="card-body">';
              html += '<h5 class="card-title">' + announcement.headline + '</h5>';
              html += '</div>';
              html += '</div>';
              html += '</a>';

              console.log(announcement);
            } 

            modalBody.innerHTML = html;
          } else {
            modalBody.textContent = 'No announcements found.';
          }
        } else if (xhr.status !== 200) {
          modalBody.textContent = 'Request failed.  Returned status of ' + xhr.status;

        } else {
          modalBody.textContent = 'Error fetching data.';
        }
      };
    });

    </script>
    
  </body>
</html>