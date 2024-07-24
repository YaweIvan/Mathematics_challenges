<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Analytics</title>

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
            <h1>Admin Analytics</h1>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <!-- Most Correctly Answered Questions -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Most Correctly Answered Questions</h5>
                            <div id="most-answered-questions">
                                <ul>
                                    @foreach($reports as $report)
                                        <li>{{ $report->Most_Correctly_Answered_Questions }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- School Rankings -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">School Rankings</h5>
                            <div id="school-rankings">
                                <ul>
                                    @foreach($reports as $report)
                                        <li>{{ $report->School_Rankings }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Performance Over Time -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Performance Over Time</h5>
                            <div id="performance-over-time">
                                <ul>
                                    @foreach($reports as $report)
                                        <li>{{ $report->Perfomance_Over_Time }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Percentage Repetition of Questions -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Percentage Repetition of Questions</h5>
                            <div id="percentage-repetition">
                                <ul>
                                    @foreach($reports as $report)
                                        <li>{{ $report->Question_Repetition_Rate }}%</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- List of Worst Performing Schools -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">List of Worst Performing Schools</h5>
                            <div id="worst-performing-schools">
                                <ul>
                                    @foreach($reports as $report)
                                        <li>{{ $report->Worst_Perfoming_School }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- List of Best Performing Schools -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">List of Best Performing Schools</h5>
                            <div id="best-performing-schools">
                                <ul>
                                    @foreach($reports as $report)
                                        <li>{{ $report->Best_Perfoming_Schools }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- List of Participants with Incomplete Challenges -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">List of Participants with Incomplete Challenges</h5>
                            <div id="incomplete-challenges">
                                <ul>
                                    @foreach($reports as $report)
                                        <li>{{ $report->Incomplete_Challenges }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Other Reports -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Other Reports</h5>
                            <div id="other-reports">
                                <ul>
                                    @foreach($reports as $report)
                                        <li>{{ $report->schoolRegistrationNumber }} - {{ $report->challengeID }}</li>
                                    @endforeach
                                </ul>
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
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

    <!-- Chart.js for Analytics -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Example data for charts (replace with your data)
        const mostAnsweredQuestionsData = {
            labels: ['Question 1', 'Question 2', 'Question 3', 'Question 4', 'Question 5'],
            datasets: [{
                label: 'Most Correctly Answered Questions',
                data: @json($reports->pluck('Most_Correctly_Answered_Questions')),
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };

        // Similar updates for other data variables...

        // Render charts
        window.onload = function () {
            const ctx1 = document.getElementById('most-answered-questions').getContext('2d
