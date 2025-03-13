<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $vacancy->title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .company-logo {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card p-3">
                <div class="text-center">
                    <h4>{{ $user->name }}</h4>
                    <p class="text-muted">{{ $vacancy->location }}</p>
                </div>
                <p><strong>Over ons:</strong></p>
                <p>{{ $user->description }}</p>
                <a href="#" class="btn btn-outline-primary w-100 mt-2">Company Profile</a>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card p-4">
                <h3 class="card-title">{{ $vacancy->title }}</h3>
                <h6 class="card-subtitle text-muted">{{ $vacancy->location }}</h6>
                <hr>
                <p><strong>Introductie:</strong></p>
                <p>{{ $vacancy->introduction }}</p>
                <hr>
                <p><strong>Beschrijving:</strong></p>
                <p>{{ $vacancy->description }}</p>
                <div class="d-flex justify-content-between">
                    <a onclick="history.back();" class="btn btn-secondary">Terug naar vacatures</a>
                </div>   
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
