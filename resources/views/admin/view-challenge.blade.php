<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Challenges</title>

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
      <h1>Challenges</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Challenges</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section challenges">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered" id="datatable">
                  <thead>
                    <tr>
                      <th>Challenge ID</th>
                      <th>Opening Date</th>
                      <th>Closing Date</th>
                      <th>Number of Questions</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
    @foreach($challenges as $challenge)
        <tr>
            <td>{{ $challenge->challengeID }}</td>
            <td>{{ $challenge->openingDate }}</td>
            <td>{{ $challenge->closingDate }}</td>
            <td>{{ $challenge->number_of_questions }}</td>
            <td>
                @if(now() < $challenge->openingDate)
                    Upcoming
                @elseif(now() >= $challenge->openingDate && now() <= $challenge->closingDate)
                    Active
                @else
                    Closed
                @endif
            </td>
           
          
            <td>
    <a href="{{ route('admin.challenge.edit', $challenge->challengeID) }}" class="btn btn-sm btn-info">Edit</a>
    <form action="{{ route('admin.challenge.delete', $challenge->challengeID) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
    </form>
</td>

        </tr>
    @endforeach
</tbody>

                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

  <!-- Initialize DataTables -->
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      new simpleDatatables.DataTable("#datatable", {
        searchable: true,
        sortable: true,
      });
    });
  </script>

</body>

</html>
