<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - Mathematics Challenge</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
  <style>
    .card-icon, .activity-icon, .notification-icon, .setting-icon {
      font-size: 2rem; /* Adjust the size as needed */
      width: 40px; /* Adjust the size as needed */
      height: 40px; /* Adjust the size as needed */
      display: flex;
      align-items: center;
      justify-content: center;
      margin-right: 10px;
    }
    .d-flex.align-items-center {
      display: flex;
      align-items: center;
    }
  </style>

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  @include('components.navbar')

  @include('components.sidebar')

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">

            <!-- Total Schools Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card schools-card">

                <div class="card-body">
                  <h5 class="card-title">Total Schools</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle bg-primary text-white">
                      <i class="bi bi-building"></i>
                    </div>
                    <div>
                      <h6>50</h6>
                    </div>
                  </div>

                </div>
              </div>
            </div><!-- End Total Schools Card -->

            <!-- Total Questions Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card questions-card">

                <div class="card-body">
                  <h5 class="card-title">Total Questions</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle bg-success text-white">
                      <i class="bi bi-question-circle"></i>
                    </div>
                    <div>
                      <h6>200</h6>
                    </div>
                  </div>

                </div>
              </div>
            </div><!-- End Total Questions Card -->

            <!-- Ongoing Challenges Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card challenges-card">

                <div class="card-body">
                  <h5 class="card-title">Ongoing Challenges</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle bg-warning text-white">
                      <i class="bi bi-trophy"></i>
                    </div>
                    <div>
                      <h6>5</h6>
                    </div>
                  </div>

                </div>
              </div>
            </div><!-- End Ongoing Challenges Card -->

            <!-- Upcoming Challenges Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card upcoming-challenges-card">

                <div class="card-body">
                  <h5 class="card-title">Upcoming Challenges</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle bg-info text-white">
                      <i class="bi bi-calendar-event"></i>
                    </div>
                    <div>
                      <h6>10</h6>
                    </div>
                  </div>

                </div>
              </div>
            </div><!-- End Upcoming Challenges Card -->

            <!-- Recent Activity Card -->
            <div class="col-12">
              <div class="card recent-activity-card">

                <div class="card-body">
                  <h5 class="card-title">Recent Activity</h5>

                  <div class="activity">
                    <div class="activity-item d-flex align-items-center">
                      <div class="activity-icon bg-primary text-white rounded-circle">
                        <i class="bi bi-upload"></i>
                      </div>
                      <div>
                        <span class="fw-bold text-primary">New Questions Uploaded</span> by Admin
                        <span class="text-muted small pt-1">2 hours ago</span>
                      </div>
                    </div>

                    <div class="activity-item d-flex align-items-center">
                      <div class="activity-icon bg-success text-white rounded-circle">
                        <i class="bi bi-trophy"></i>
                      </div>
                      <div>
                        <span class="fw-bold text-success">New Challenge Set</span> by Admin
                        <span class="text-muted small pt-1">1 day ago</span>
                      </div>
                    </div>

                    <div class="activity-item d-flex align-items-center">
                      <div class="activity-icon bg-warning text-white rounded-circle">
                        <i class="bi bi-building"></i>
                      </div>
                      <div>
                        <span class="fw-bold text-warning">New School Registered</span> by Admin
                        <span class="text-muted small pt-1">3 days ago</span>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div><!-- End Recent Activity Card -->

          </div>
        </div><!-- End Left Side -->

        <!-- Right side columns -->
        <div class="col-lg-4">

          <!-- Notifications Card -->
          <div class="card notifications-card">

            <div class="card-body">
              <h5 class="card-title">Notifications</h5>

              <div class="notifications">
                <div class="notification-item d-flex align-items-center">
                  <div class="notification-icon bg-info text-white rounded-circle">
                    <i class="bi bi-info-circle"></i>
                  </div>
                  <div>
                    <span class="fw-bold text-info">System Update</span> scheduled for tomorrow
                    <span class="text-muted small pt-1">1 hour ago</span>
                  </div>
                </div>

                <div class="notification-item d-flex align-items-center">
                  <div class="notification-icon bg-danger text-white rounded-circle">
                    <i class="bi bi-exclamation-circle"></i>
                  </div>
                  <div>
                    <span class="fw-bold text-danger">Server Downtime</span> expected this weekend
                    <span class="text-muted small pt-1">2 hours ago</span>
                  </div>
                </div>

                <div class="notification-item d-flex align-items-center">
                  <div class="notification-icon bg-success text-white rounded-circle">
                    <i class="bi bi-check-circle"></i>
                  </div>
                  <div>
                    <span class="fw-bold text-success">Backup Completed</span> successfully
                    <span class="text-muted small pt-1">4 hours ago</span>
                  </div>
                </div>
              </div>
            </div>

          </div><!-- End Notifications Card -->

          <!-- System Settings Card -->
          <div class="card settings-card">

            <div class="card-body">
              <h5 class="card-title">System Settings</h5>

              <div class="settings">
                <div class="setting-item d-flex align-items-center">
                  <div class="setting-icon bg-secondary text-white rounded-circle">
                    <i class="bi bi-gear"></i>
                  </div>
                  <div>
                    <span class="fw-bold text-secondary">General Settings</span>
                    <span class="text-muted small pt-1">Configure your system</span>
                  </div>
                </div>

                <div class="setting-item d-flex align-items-center">
                  <div class="setting-icon bg-primary text-white rounded-circle">
                    <i class="bi bi-lock"></i>
                  </div>
                  <div>
                    <span class="fw-bold text-primary">Security Settings</span>
                    <span class="text-muted small pt-1">Manage security settings</span>
                  </div>
                </div>

                <div class="setting-item d-flex align-items-center">
                  <div class="setting-icon bg-warning text-white rounded-circle">
                    <i class="bi bi-bell"></i>
                  </div>
                  <div>
                    <span class="fw-bold text-warning">Notification Settings</span>
                    <span class="text-muted small pt-1">Adjust notification preferences</span>
                  </div>
                </div>
              </div>
            </div>

          </div><!-- End System Settings Card -->

        </div><!-- End Right Side -->

      </div>
    </section>

  </main><!-- End #main -->



  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
