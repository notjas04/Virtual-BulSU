<?php
require "includes/sessionEnd.php";
require "connect.php";

// Assuming you have a user_id in your session
$user_id = $_SESSION["user"];

$campusAdminQuery = "SELECT * FROM campus_admin WHERE faculty_id = ?";
$collegeAdminQuery = "SELECT * FROM college_admin WHERE faculty_id = ?";

// Prepare and execute the query for campus_admin
$stmt = $con->prepare($campusAdminQuery);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $adminData = mysqli_fetch_assoc($result);
    $author = $adminData["first_name"] . ' ' . $adminData["last_name"];
    $currentAdminLevel = $adminData["admin_level"];
    $currentAdminCampus = $adminData["campus"];
} else {
    // If user is not found in campus_admin, check college_admin
    $stmt = $con->prepare($collegeAdminQuery);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $adminData = mysqli_fetch_assoc($result);
        $author = $adminData["first_name"] . ' ' . $adminData["last_name"];
        $currentAdminLevel = $adminData["admin_level"];
        $currentAdminCampus = $adminData["campus"];
        $currentCollege = $adminData["college"];
    } else {
    }
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="includes\VirtualBulsu_Navbar.css">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <title>Announcement Panel</title>
  <style>
    .announcement-panel {
      border: 1px solid #763435;
      padding: 20px;
      border-radius: 5px;
      color: #ffff;
      background-color: #763435;
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    #viewAnnouncementImage {
      width: 100%;
      height: auto;
    }

    td button {
      margin: 0 3px;
    }

    body {
      background:
        url("resources/try.png");
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      background-attachment: fixed;
      display: flex;
      flex-direction: column;
    }

    #addAnnouncement {
      color: #d09b00;
      background-color: aliceblue;
      border: white;
    }

    #addAnnouncement:hover {
      background-color: #d09b00;
      border: white;
      color: #ffff;
    }
  </style>
</head>

<body>
  
  <?php include "includes/navbar.php" ?>

  <div class="container mt-5">
    <!-- Announcement Panel -->
    <div class="announcement-panel">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Announcement Panel</h2>
        <button class="btn btn-primary" id="addAnnouncement" data-toggle="modal" data-target="#announcementModal">Add
          Announcement</button>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="announcement-list">
            <table class="table table-striped table-hover">
              <thead>
                <tr class="table">
                  <th>Headline</th>
                  <th>Author</th>
                  <th>Faculty ID</th>
                  <th>Actions</th>
                  </trc>
              </thead>
              <tbody>
                <?php

                if ($currentAdminLevel == "super_admin") {
                  $query2 = "SELECT announcement_id, headline, author, faculty_id FROM announcements";
                } else if ($currentAdminLevel == "admin") {
                  $query2 = "SELECT announcement_id, headline, author, faculty_id FROM announcements WHERE campus_assignment = '$currentAdminCampus'";
                } else if ($currentAdminLevel == "college_admin") {
                  $query2 = "SELECT announcement_id, headline, author, faculty_id FROM announcements WHERE campus_assignment = '$currentAdminCampus' AND college_assignment = '$currentCollege'";
                }

                $result2 = mysqli_query($con, $query2);

                if (!$result2) {
                  die("Database query failed."); // Handle the error appropriately
                }

                while ($row = mysqli_fetch_assoc($result2)) {
                  echo "<tr id=" . $row['announcement_id'] . ">";
                  echo "<td>" . htmlspecialchars($row['headline']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['author']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['faculty_id']) . "</td>";
                  echo "<td>";
                  echo "<button type='button' class='btn btn-primary' id='editBtn' data-toggle='modal' data-target='#viewAnnouncementModal' onclick='editAnnouncement(" . $row['announcement_id'] . ")'>Edit</button>";
                  echo "<button type='button' class='btn btn-secondary' id='viewAnnouncement' data-toggle='modal' data-target='#viewAnnouncementModal' onclick='viewAnnouncementModal(" . $row['announcement_id'] . ")'>View</button>";
                  echo "<button type='button' class='btn btn-danger' onclick='deleteAnnouncement(" . $row['announcement_id'] . ")' data-announcement-id='" . $row['announcement_id'] . "'>Archive</button>";
                  echo "</td>";
                  echo "</tr>";
                }

                // Release the result set
                mysqli_free_result($result2);

                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- View Announcement Modal -->
    <div class="modal fade" id="viewAnnouncementModal" tabindex="-1" role="dialog" aria-labelledby="announcementModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header ">
            <h5 class="modal-title" id="announcementModalLabel">Announcement Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post" id="viewAnnouncementForm" enctype="multipart/form-data">
              <input type="text" class="form-control" id="announcementId" name="announcementId" value="" hidden>
              <?php if($currentAdminLevel == "super_admin"): 
              echo "
                <div class='form-group'>
                  <label for='campusAssignment'>Campus Assignment</label>
                  <select class='form-control' name='viewCampusAssignment' id='viewCampusAssignment'>
                    <option value='Malolos Campus'>Malolos Campus</option>
                    <option value='Bustos Campus'>Bustos Campus</option>
                    <option value='Sarmiento Campus'>Sarmiento Campus</option>
                    <option value='San Rafael Campus'>San Rafael Campus</option>
                    <option value='Hagonoy Campus'>Hagonoy Campus</option>
                    <option value='Meneses Campus'>Meneses Campus</option>
                  </select>
                </div>
                <div class='form-group'>
                  <label for='college'>College Assignment</label>
                  <select class='form-control' name='viewCollegeAssignment' id='viewCollegeAssignment'>
                    <option value='' disabled selected>-- Select College --</option>
                    <option value='College of Architecture and Fine Arts'>College of Architecture and Fine Arts</option>
                    <option value='College of Arts and Letters'>College of Arts and Letters</option>
                    <option value='College of Business Administration'>College of Business Administration</option>
                    <option value='College of Criminal Justice Education'>College of Criminal Justice Education</option>
                    <option value='College of Hospitality and Tourism Management'>College of Hospitality and Tourism Management</option>
                    <option value='College of Information and Communications Technology'>College of Information and Communications Technology</option>
                    <option value='College of Industrial Technology'>College of Industrial Technology</option>
                    <option value='College of Law'>College of Law</option>
                    <option value='College of Nursing'>College of Nursing</option>
                    <option value='College of Engineering'>College of Engineering</option>
                    <option value='College of Education'>College of Education</option>
                    <option value='College of Science'>College of Science</option>
                    <option value='College of Sports, Exercise and Recreation'>College of Sports, Exercise and Recreation</option>
                    <option value='College of Social Sciences and Philosophy'>College of Social Sciences and Philosophy</option>
                    <option value='Graduate School'>Graduate School</option>
                  </select>
                </div>
              "; endif; ?>
              <?php if($currentAdminLevel == "admin"): 
              echo "
                <input type='text' class='form-control' id='viewCampusAssignment' name='viewCampusAssignment' value='$currentAdminCampus' hidden>
                <div class='form-group'>
                  <label for='college'>College Assignment</label>
                  <select class='form-control' name='viewCollegeAssignment' id='viewCollegeAssignment'>
                    <option value='' disabled selected>-- Select College --</option>
                    <option value='College of Architecture and Fine Arts'>College of Architecture and Fine Arts</option>
                    <option value='College of Arts and Letters'>College of Arts and Letters</option>
                    <option value='College of Business Administration'>College of Business Administration</option>
                    <option value='College of Criminal Justice Education'>College of Criminal Justice Education</option>
                    <option value='College of Hospitality and Tourism Management'>College of Hospitality and Tourism Management</option>
                    <option value='College of Information and Communications Technology'>College of Information and Communications Technology</option>
                    <option value='College of Industrial Technology'>College of Industrial Technology</option>
                    <option value='College of Law'>College of Law</option>
                    <option value='College of Nursing'>College of Nursing</option>
                    <option value='College of Engineering'>College of Engineering</option>
                    <option value='College of Education'>College of Education</option>
                    <option value='College of Science'>College of Science</option>
                    <option value='College of Sports, Exercise and Recreation'>College of Sports, Exercise and Recreation</option>
                    <option value='College of Social Sciences and Philosophy'>College of Social Sciences and Philosophy</option>
                    <option value='Graduate School'>Graduate School</option>
                  </select>
                </div>
              "; endif; ?>
              <?php if($currentAdminLevel == "college_admin"): 
              echo "
                <input type='text' class='form-control' id='viewCampusAssignment' name='viewCampusAssignment' value='".$adminData["campus"]."' hidden>
                <input type='text' class='form-control' id='viewCollegeAssignment' name='viewCollegeAssignment' value='$currentCollege' hidden>
              "; endif; ?>
              <div class="form-group">
                <label for="eventDate">Event Date</label>
                <input type="date" class="form-control" id="viewEventDate" name="viewEventDate">
              </div>
              <div class="form-group">
                <label for="headline">Headline</label>
                <input type="text" class="form-control" id="viewHeadline" name="viewHeadline" required>
              </div>
              <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="viewDescription" name="viewDescription" rows="4"></textarea>
              </div>
              <div class="form-group">
                <label for="formFileMultiple" class="form-label">Multiple files input
                  example</label>
                <input class="form-control" type="file" id="viewFileInput" name="viewFileInput" multiple>
                <img id="viewAnnouncementImage" src="" alt="Announcement Image" />
              </div>
              <div class="modal-footer d-flex justify-content-between align-content-center">
                <p class="card-text" id="viewAuthor"><small class="text-body-secondary">Author: </small></p>
                <button type="button" id="editViewBtn" class="btn btn-secondary" onclick="enableViewEdit()">Edit</button>
                <button type="submit" class="btn btn-success" id="saveBtn" onclick="saveChanges()">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Announcement Modal -->
    <div class="modal fade" id="announcementModal" tabindex="-1" role="dialog" aria-labelledby="announcementModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="announcementModalLabel">Add Announcement</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post" class="needs-validation" id="announcementForm" action="add_announcement.php" enctype="multipart/form-data">
              <input type="text" class="form-control" id="announcementId" name="announcementId" value="" hidden>
              <input type="text" class="form-control" id="author" name="author" value="<?php echo $author ?>" hidden>
              <input type="text" class="form-control" id="faculty_id" name="facultyId" value="<?php echo $user_id ?>" hidden>
              <?php if($currentAdminLevel == "super_admin"): 
              echo "
                <div class='form-group'>
                  <label for='campusAssignment'>Campus Assignment</label>
                  <select class='form-control' name='campusAssignment' id='campusAssignment' required>
                    <option value='' disabled selected>-- Select Campus --</option>
                    <option value='Malolos Campus'>Malolos Campus</option>
                    <option value='Bustos Campus'>Bustos Campus</option>
                    <option value='Sarmiento Campus'>Sarmiento Campus</option>
                    <option value='San Rafael Campus'>San Rafael Campus</option>
                    <option value='Hagonoy Campus'>Hagonoy Campus</option>
                    <option value='Meneses Campus'>Meneses Campus</option>
                  </select>
                </div>
                <div class='form-group'>
                  <label for='college'>College Assignment</label>
                  <select class='form-control' name='collegeAssignment' id='collegeAssignment' required>
                    <option value='' disabled selected>-- Select College --</option>
                    <option value='College of Architecture and Fine Arts'>College of Architecture and Fine Arts</option>
                    <option value='College of Arts and Letters'>College of Arts and Letters</option>
                    <option value='College of Business Administration'>College of Business Administration</option>
                    <option value='College of Criminal Justice Education'>College of Criminal Justice Education</option>
                    <option value='College of Hospitality and Tourism Management'>College of Hospitality and Tourism Management</option>
                    <option value='College of Information and Communications Technology'>College of Information and Communications Technology</option>
                    <option value='College of Industrial Technology'>College of Industrial Technology</option>
                    <option value='College of Law'>College of Law</option>
                    <option value='College of Nursing'>College of Nursing</option>
                    <option value='College of Engineering'>College of Engineering</option>
                    <option value='College of Education'>College of Education</option>
                    <option value='College of Science'>College of Science</option>
                    <option value='College of Sports, Exercise and Recreation'>College of Sports, Exercise and Recreation</option>
                    <option value='College of Social Sciences and Philosophy'>College of Social Sciences and Philosophy</option>
                    <option value='Graduate School'>Graduate School</option>
                  </select>
                </div>
              "; endif; ?>
              <?php if($currentAdminLevel == "admin"): 
              echo "
                <input type='text' class='form-control' id='campusAssignment' name='campusAssignment' value='$currentAdminCampus' hidden>
                <div class='form-group'>
                  <label for='college'>College Assignment</label>
                  <select class='form-control' name='collegeAssignment' id='collegeAssignment' required>
                    <option value='' disabled selected>-- Select College --</option>
                    <option value='College of Architecture and Fine Arts'>College of Architecture and Fine Arts</option>
                    <option value='College of Arts and Letters'>College of Arts and Letters</option>
                    <option value='College of Business Administration'>College of Business Administration</option>
                    <option value='College of Criminal Justice Education'>College of Criminal Justice Education</option>
                    <option value='College of Hospitality and Tourism Management'>College of Hospitality and Tourism Management</option>
                    <option value='College of Information and Communications Technology'>College of Information and Communications Technology</option>
                    <option value='College of Industrial Technology'>College of Industrial Technology</option>
                    <option value='College of Law'>College of Law</option>
                    <option value='College of Nursing'>College of Nursing</option>
                    <option value='College of Engineering'>College of Engineering</option>
                    <option value='College of Education'>College of Education</option>
                    <option value='College of Science'>College of Science</option>
                    <option value='College of Sports, Exercise and Recreation'>College of Sports, Exercise and Recreation</option>
                    <option value='College of Social Sciences and Philosophy'>College of Social Sciences and Philosophy</option>
                    <option value='Graduate School'>Graduate School</option>
                  </select>
                </div>
              "; endif; ?>
              <?php if($currentAdminLevel == "college_admin"): 
              echo "
                <input type='text' class='form-control' id='campusAssignment' name='campusAssignment' value='$currentAdminCampus' hidden>
                <input type='text' class='form-control' id='collegeAssignment' name='collegeAssignment' value='$currentCollege' hidden>
              "; endif; ?>

              <div class="form-group">
                <label for="eventDate">Event Date (Optional)</label>
                <input type="date" class="form-control" id="eventDate" name="eventDate">
              </div>
              <div class="form-group">
                <label for="headline">Headline</label>
                <input type="text" class="form-control" id="headline" name="headline" required>
                <div id="headlineFeedback" class="invalid-feedback">
                </div>
              </div>
              <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                <div id="descriptionFeedback" class="invalid-feedback">
                </div>
              </div>
              <div class="form-group">
                <label for="formFileMultiple" class="form-label">Multiple files input</label>
                <input class="form-control" type="file" id="fileInput" name="fileInput" multiple required>
                <div id="fileInputFeedback" class="invalid-feedback">
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" id="addBtn" class="btn btn-primary" form="announcementForm" disabled>Save</button>
          </div>
        </div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/announcement_panel.js"></script>
</body>

</html>