<?php
require "connect.php";
require "includes/sessionEnd.php";

$currentAdminId = $_SESSION["user"];

$sql1 = "SELECT * FROM campus_admin WHERE faculty_id = '$currentAdminId'";
$result1 = $con->query($sql1);

if ($result1) {
  while ($row = $result1->fetch_assoc()) {
    $currentAdminLevel = $row['admin_level'];
    $currentAdminCampus = $row['campus'];
  }
}
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <?php include "includes/cdn.php"; ?>
    <link rel="stylesheet" href="CSS/navbar.css">
    <link rel="stylesheet" href="CSS/admin_panel.css">
  </head>

  <body>
    

  <?php include "includes/navbar.php"; ?>

  <div class="container-fluid mt-5" id="adminPage">
    <div class="admin-panel-container">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Virtual BulSU Admins</h2>
        <div class="mb-1">
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#adminModal">Add Admin</button>
          <a href="generate_report_admin.php" class="btn btn-success">Download List</a>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <!-- Table to display the list of admins -->
          <div class="table-responsive">
            <table id="adminTableSuper" class="table table-striped table-hover" style="width:100%">
              <thead>
                  <tr>
                      <th>Faculty ID</th>
                      <th>Name</th>
                      <th>Campus Assignment</th>
                      <th>Actions</th>
                  </tr>
              </thead>
              <tbody>
                  
              </tbody>
            </table>
            </div>
          </div>
      </div>
    </div>
  </div>

  <!-- View Admin Details Modal -->
  <div class="modal fade" id="viewAdminDetails" tabindex="-1" role="dialog"
        aria-labelledby="adminDetailsModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="announcementModalLabel">Announcement Details</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
              </button>
            </div>
            <div class="modal-body">
              <form id="adminDetailsForm" class="needs-validation">
                <div class="form-group">
                  <label for="facultyId">Faculty ID:</label>
                  <input type="text" class="form-control" id="facultyId" disabled>
                </div>
                <div class="form-group mt-2">
                  <div class="row">
                    <div class="col">
                      <label for="name">First Name:</label>
                      <input type="text" class="form-control" id="viewFirstName">
                      <div id="viewFirstNameFeedback" class="invalid-feedback">
                      </div>
                    </div>
                    <div class="col">
                      <label for="name">Middle Name:</label>
                      <input type="text" class="form-control" id="viewMiddleName">
                    </div>
                    <div class="col">
                      <label for="name">Last Name:</label>
                      <input type="text" class="form-control" id="viewLastName">
                      <div id="viewLastNameFeedback" class="invalid-feedback">
                      </div>
                    </div>
                  </div>
                </div>
                <div class='form-group mt-2'>
                  <label for='campus'>Campus:</label>
                  <select class='form-control' id='viewCampus'>
                    <option value='Malolos Campus'>Malolos Campus</option>
                    <option value='Bustos Campus'>Bustos Campus</option>
                    <option value='Sarmiento Campus'>Sarmiento Campus</option>
                    <option value='San Rafael Campus'>San Rafael Campus</option>
                    <option value='Hagonoy Campus'>Hagonoy Campus</option>
                    <option value='Meneses Campus'>Meneses Campus</option>
                  </select>
                </div>
                <div class="form-group mt-2">
                  <label for="email">Email:</label>
                  <input type="email" class="form-control" id="viewEmail">
                  <div id="viewEmailFeedback" class="invalid-feedback">
                  </div>
                </div>
                <div class="form-group mt-2">
                  <label for="phone">Contact Number:</label>
                  <input type="text" class="form-control" id="viewPhone">
                  <div id="viewPhoneFeedback" class="invalid-feedback">
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-success" id="saveBtn" onclick="saveChanges()">Save</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="alert alert-success" id="saveSuccessAlert" style="display: none;">
        Changes have been saved successfully.
      </div>
  
  <!-- Admin Modal -->
  <div class="modal fade" id="adminModal" tabindex="-1" aria-labelledby="adminModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="adminModalLabel">Add Admin</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          </button>
        </div>
        <div class="modal-body">
          <form class="needs-validation" method="post" id="adminForm" action="add_admin_details.php" onsubmit="submitForm(event)">
            <div class="form-group mt-2">
              <label for="addFacultyId">Faculty ID:</label>
              <input type="text" class="form-control" name="addFacultyId" id="addFacultyId" onkeyup="checkFacultyId()" value="" pattern="\d+" required>
              <div id="feedbackMessage" class="invalid-feedback">
              </div>
            </div>
            <div class="form-row mt-2">
              <div class="col">
                <label for="firstName">First Name</label>
                <input type="text" class="form-control" name="firstName" id="firstName" required>
                <div id="firstNameFeedback" class="invalid-feedback">
                </div>
              </div>
              <div class="col">
                <label for="middleName">Middle Name</label>
                <input type="text" class="form-control" name="middleName" id="middleName">
              </div>
              <div class="col">
                <label for="lastName">Last Name</label>
                <input type="text" class="form-control" name="lastName" id="lastName" required>
                <div id="lastNameFeedback" class="invalid-feedback">
                </div>
              </div>
            </div>
            <div class='form-group mt-2' has-validation>
              <label for='campus'>Campus</label>
              <select class='form-control' name='addCampus' id='addCampus' required>
                <option value='' selected disabled> -- Select Campus -- </option>
                <option value='Malolos Campus'>Malolos Campus</option>
                <option value='Bustos Campus'>Bustos Campus</option>
                <option value='Sarmiento Campus'>Sarmiento Campus</option>
                <option value='San Rafael Campus'>San Rafael Campus</option>
                <option value='Hagonoy Campus'>Hagonoy Campus</option>
                <option value='Meneses Campus'>Meneses Campus</option>
              </select>
              <div id="addCampusFeedback" class="invalid-feedback"></div>
            </div>
            <div class="form-group mt-2">
              <label for="email">Email</label>
              <input type="email" class="form-control" name="addEmail" id="addEmail" required>
              <div id="addEmailFeedback" class="invalid-feedback">
              </div>
            </div>
            <div class="form-group mt-2">
              <label for="phone">Contact Number</label>
              <input type="text" class="form-control" name="addPhone" id="addPhone" required>
              <div id="addPhoneFeedback" class="invalid-feedback">
              </div>
            </div>
            <div class="form-group mt-2">
              <label for="addFacultyId">Password:</label>
              <input type="password" class="form-control" name="addPassword" id="addPassword" value="" onkeyup="validatePassword()" required>
              <div id="passwordFeedback" class="invalid-feedback">
              </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary" id="addBtn" onclick="submitForm()">Add</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php 
  
  include "includes/js_cdn.php"; 
  
  ?>
  <script src="js/admin_panel.js"></script>
  

  </body>
</html>