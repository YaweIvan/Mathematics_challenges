<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>manage schools</title>

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
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 60%; /* Adjusted to occupy 60% of the page */
            margin: auto;
            overflow: hidden;
            padding: 20px;
            text-align: right; /* Align content to the right */
        }
        .container h1 {
            text-align: center; /* Center align the heading */
            font-size: 24px; /* Adjusted font size */
            margin-bottom: 20px; /* Added margin for spacing */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            font-size: 16px; /* Adjusted font size */
        }
        table th {
            background-color: #f2f2f2;
        }
        table tbody tr:hover {
            background-color: #f2f2f2;
            cursor: pointer;
        }
        .btn {
            padding: 5px 10px;
            text-decoration: none;
            border: none;
            border-radius: 3px;
        }
        .btn-edit {
            background-color: #4CAF50;
            color: white;
        }
        .btn-delete {
            background-color: #f44336;
            color: white;
        }
    </style>
</head>
<body>

    @include('components.navbar')
    @include('components.sidebar')

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Registered schools</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Register SChools</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
        <table id="schoolTable">
            <thead>
                <tr>
                    <th>Registration Number</th>
                    <th>Name</th>
                    <th>District</th>
                    <th>Representative Name</th>
                    <th>Representative Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($schools as $school)
                <tr>
                    <td>{{ $school->schoolRegistrationNumber }}</td>
                    <td>{{ $school->schoolName }}</td>
                    <td>{{ $school->district }}</td>
                    <td>{{ $school->repName }}</td>
                    <td>{{ $school->repEmail }}</td>
                    <td>
                        <a href="{{ route('schools.edit', $school->schoolRegistrationNumber) }}" class="btn btn-edit">Edit</a>
                        <form action="{{ route('schools.destroy', $school->schoolRegistrationNumber) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete">Delete</button>
                        </form>
                    </td>
                    
                </tr>
            @endforeach
            </tbody>
        </table>
        </section>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/vendor/quill/quill.min.js"></script>
    <script src="/assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="/assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="/assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="/assets/js/main.js"></script>

</body>
</html>
