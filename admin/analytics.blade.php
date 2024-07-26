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
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Analytics</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <!-- Most Correctly Answered Questions -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Most Correctly Answered Questions</h5>
                            <div id="most-answered-questions"></div>
                        </div>
                    </div>
                </div>

                <!-- School Rankings -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">School Rankings</h5>
                            <div id="school-rankings"></div>
                        </div>
                    </div>
                </div>

                <!-- Performance Over Time -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Performance Over Time</h5>
                            <div id="performance-over-time"></div>
                        </div>
                    </div>
                </div>

                <!-- Percentage Repetition of Questions -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Percentage Repetition of Questions</h5>
                            <div id="percentage-repetition"></div>
                        </div>
                    </div>
                </div>

                <!-- List of Worst Performing Schools -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">List of Worst Performing Schools</h5>
                            <div id="worst-performing-schools"></div>
                        </div>
                    </div>
                </div>

                <!-- List of Best Performing Schools -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">List of Best Performing Schools</h5>
                            <div id="best-performing-schools"></div>
                        </div>
                    </div>
                </div>

                <!-- List of Participants with Incomplete Challenges -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">List of Participants with Incomplete Challenges</h5>
                            <div id="incomplete-challenges"></div>
                        </div>
                    </div>
                </div>

                <!-- Other Reports -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Other Reports</h5>
                            <div id="other-reports"></div>
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
                data: [12, 19, 3, 5, 2],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };

        const schoolRankingsData = {
            labels: ['School A', 'School B', 'School C', 'School D', 'School E'],
            datasets: [{
                label: 'School Rankings',
                data: [50, 45, 40, 35, 30],
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }]
        };

        const performanceOverTimeData = {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [{
                label: 'Performance Over Time',
                data: [10, 20, 30, 40, 50, 60, 70],
                backgroundColor: 'rgba(255, 159, 64, 0.2)',
                borderColor: 'rgba(255, 159, 64, 1)',
                borderWidth: 1
            }]
        };

        const percentageRepetitionData = {
            labels: ['Participant 1', 'Participant 2', 'Participant 3', 'Participant 4', 'Participant 5'],
            datasets: [{
                label: 'Percentage Repetition of Questions',
                data: [5, 10, 15, 20, 25],
                backgroundColor: 'rgba(255, 205, 86, 0.2)',
                borderColor: 'rgba(255, 205, 86, 1)',
                borderWidth: 1
            }]
        };

        const worstPerformingSchoolsData = {
            labels: ['School X', 'School Y', 'School Z', 'School W', 'School V'],
            datasets: [{
                label: 'Worst Performing Schools',
                data: [20, 18, 15, 12, 10],
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        };

        const bestPerformingSchoolsData = {
            labels: ['School M', 'School N', 'School O', 'School P', 'School Q'],
            datasets: [{
                label: 'Best Performing Schools',
                data: [70, 65, 60, 55, 50],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        };

        const incompleteChallengesData = {
            labels: ['Participant A', 'Participant B', 'Participant C', 'Participant D', 'Participant E'],
            datasets: [{
                label: 'Incomplete Challenges',
                data: [2, 4, 3, 5, 1],
                backgroundColor: 'rgba(201, 203, 207, 0.2)',
                borderColor: 'rgba(201, 203, 207, 1)',
                borderWidth: 1
            }]
        };

        // Render charts
        window.onload = function () {
            const ctx1 = document.getElementById('most-answered-questions').getContext('2d');
            new Chart(ctx1, {
                type: 'bar',
                data: mostAnsweredQuestionsData,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            const ctx2 = document.getElementById('school-rankings').getContext('2d');
            new Chart(ctx2, {
                type: 'bar',
                data: schoolRankingsData,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            const ctx3 = document.getElementById('performance-over-time').getContext('2d');
            new Chart(ctx3, {
                type: 'line',
                data: performanceOverTimeData,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            const ctx4 = document.getElementById('percentage-repetition').getContext('2d');
            new Chart(ctx4, {
                type: 'bar',
                data: percentageRepetitionData,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            const ctx5 = document.getElementById('worst-performing-schools').getContext('2d');
            new Chart(ctx5, {
                type: 'bar',
                data: worstPerformingSchoolsData,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            const ctx6 = document.getElementById('best-performing-schools').getContext('2d');
            new Chart(ctx6, {
                type: 'bar',
                data: bestPerformingSchoolsData,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            const ctx7 = document.getElementById('incomplete-challenges').getContext('2d');
            new Chart(ctx7, {
                type: 'bar',
                data: incompleteChallengesData,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        };
    </script>
</body>

</html>
