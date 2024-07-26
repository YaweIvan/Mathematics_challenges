<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Upload Questions and Answers - Mathematics Challenge</title>

  <!-- Vendor CSS Files -->
  <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="/assets/vendor/bootstrap-icons/bootstrap-icons.css">
  <link rel="stylesheet" href="/assets/vendor/boxicons/css/boxicons.min.css">
  <link rel="stylesheet" href="/assets/vendor/quill/quill.snow.css">
  <link rel="stylesheet" href="/assets/vendor/quill/quill.bubble.css">
  <link rel="stylesheet" href="/assets/vendor/remixicon/remixicon.css">
  <link rel="stylesheet" href="/assets/vendor/simple-datatables/style.css">

  <!-- Template Main CSS File -->
  <link rel="stylesheet" href="/assets/css/style.css">

  <style>
    .form-group label {
      font-weight: bold;
    }
    .btn-primary {
      background-color: #0061f2;
      border-color: #0061f2;
    }
    .btn-primary:hover {
      background-color: #004bbd;
      border-color: #004bbd;
    }
  </style>
</head>

<body>

    @include('components.navbar')

    @include('components.sidebar')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Set Challenges</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Set Challenges</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="container mt-5">
                <h2 class="text-center mb-4">Set a New Challenge</h2>

                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.set-challenge.post') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                                <label for="challengeID">Challenge ID</label>
                                <input type="text" class="form-control" id="challengeID" name="challengeID" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="openingDate">Opening Date</label>
                                <input type="date" class="form-control" id="openingDate" name="openingDate" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="closingDate">Closing Date</label>
                                <input type="date" class="form-control" id="closingDate" name="closingDate" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="duration">Duration (in minutes)</label>
                                <input type="number" class="form-control" id="duration" name="duration" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="number_of_questions">Number of Questions</label>
                                <input type="number_of_questions" class="form-control" id="number_of_questions" name="number_of_questions" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Set Challenge</button>
                         
       
                          
                        </form>
                    </div>
                </div>
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
