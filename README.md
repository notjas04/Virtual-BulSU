# Virtual-BulSU
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Announcement Panel</title>

  <link rel="stylesheet" href="includes\VirtualBulsu_Navbar.css">
  <style>
    .announcement-panel {
      border: 1px solid #ddd;
      padding: 20px;
      border-radius: 5px;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container-fluid">
          <a class="navbar-brand custom-brand" href="#">
            <img src="resources\BSU_Logo.png" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
            Bulacan State University
          </a>
          
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" href="VirtualBulsu_AnnouncementPanel.html">Announcements</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="VirtualBulsu_AdminPanel.html">Admins</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span class="user-icon">
                    <i class='bx bx-user'></i>
                  </span>
                </a>
              </li>
            </ul>
          </div>
    </div>

  </nav>

<div class="container mt-5">
  <div class="announcement-panel">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h2>Announcement Panel</h2>
      <button class="btn btn-primary" data-toggle="modal" data-target="#announcementModal">Add Announcement</button>
    </div>

    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Announcement Title</h5>
        <p class="card-text">This is the content of the announcement.</p>
        <p class="card-text" id="card-date"><small class="text-muted">Posted on June 12, 2023</small></p>
        <img src="resources\sarmiento.jpg" class="card-img-bottom" alt="...">
          <!-- Add the Update and Delete buttons -->
          <div class="form-group my-3">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateModal">Update</button>
            <button type="button" class="btn btn-danger">Delete</button>
          </div>
      </div>
    </div>
    
  </div>
</div>

<!-- Add the Update Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateModalLabel">Update Announcement</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="eventDate">Event Date (Optional)</label>
            <input type="date" class="form-control" id="updateEventDate">
          </div>
          <div class="form-group">
            <label for="updateHeadline">Headline</label>
            <input type="text" class="form-control" id="updateHeadline" required>
          </div>
          <div class="form-group">
            <label for="updateDescription">Description</label>
            <textarea class="form-control" id="updateDescription" rows="4"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="updateAnnouncementBtn">Update</button>
      </div>
    </div>
  </div>
</div>

<!-- Announcement Modal -->
<div class="modal fade" id="announcementModal" tabindex="-1" role="dialog" aria-labelledby="announcementModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="announcementModalLabel">Add Announcement</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="eventDate">Event Date (Optional)</label>
            <input type="date" class="form-control" id="eventDate">
          </div>
          <div class="form-group">
            <label for="headline">Headline</label>
            <input type="text" class="form-control" id="headline" required>
          </div>
          <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" rows="4"></textarea>
          </div>
          <div class="form-group">
            <label for="formFileMultiple" class="form-label">Multiple files input example</label>
            <input class="form-control" type="file" id="formFileMultiple" multiple>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>
<!-- Include the necessary Bootstrap JavaScript libraries -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
  integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
  integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
<script>
  $(document).ready(function () {
    // Update button click event handler
    $('#updateAnnouncementBtn').click(function () {
      // Get the updated headline and description from the modal fields
      const updatedHeadline = $('#updateHeadline').val();
      const updatedDescription = $('#updateDescription').val();
      const updatedEventDate = $('#updateEventDate').val();

      // Update the announcement card content
      $('.card-title').text(updatedHeadline);
      $('.card-text').text(updatedDescription);
      $('#card-date').text(updatedEventDate);

      // Close the modal
      $('#updateModal').modal('hide');
    });
  });
</script>
</body>
</html>