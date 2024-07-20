<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Answers File</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 600px;
            width: 100%;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .card {
            border: none;
        }
        .card-header {
            background-color: #007bff;
            color: white;
            padding: 15px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            text-align: center;
            font-size: 1.25rem;
        }
        .card-body {
            padding: 20px;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-size: 1rem;
        }
        .btn {
            display: block;
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .btn:active {
            background-color: #004085;
        }
    </style>
</head>
<body>
@include('components.navbar')
@include('components.sidebar')

    <div class="container">
        <div class="card">
            <div class="card-header">{{ __('Upload Answers File') }}</div>
            <div class="card-body">
                <form action="{{ route('admin.upload-excel-answers') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="answersFile" class="form-label">Upload Answers File (answers.xlsx)</label>
                        <input type="file" class="form-control" id="answersFile" name="answersFile" accept=".xlsx" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('answersFile');
            const submitButton = document.querySelector('.btn-primary');

            fileInput.addEventListener('change', function() {
                if (fileInput.files.length > 0) {
                    submitButton.disabled = false;
                } else {
                    submitButton.disabled = true;
                }
            });
        });
    </script>
</body>
</html>
