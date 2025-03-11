<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vacature Aanmaken</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
  <x-app-layout>
    <div class="container mt-5">
      <div class="card p-4 shadow-lg rounded mx-auto" style="max-width: 600px;">
        <h3 class="text-center mb-4">Vacature Aanmaken</h3>
        <form class="row g-3" action="{{ url('/vacancy_create') }}" method="POST">
          @csrf
          <div class="col-12">
            <label for="inputTitle" class="form-label">Titel</label>
            <input type="text" class="form-control" id="inputTitle" name="title" placeholder="Titel" required>
          </div>
          <div class="col-12">
            <label for="inputIntroduction" class="form-label">Introductie</label>
            <input type="text" class="form-control" id="inputIntroduction" name="introduction" placeholder="Introductie" required>
          </div>
          <div class="col-12">
            <label for="inputDescription" class="form-label">Beschrijving</label>
            <textarea class="form-control" id="inputDescription" name="description" rows="3" placeholder="Beschrijving" required></textarea>
          </div>
          <div class="col-12">
            <label for="inputLocation" class="form-label">Locatie</label>
            <input type="text" class="form-control" id="inputLocation" name="location" placeholder="Locatie" required>
          </div>

          <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary w-100">Vacature Aanmaken</button>
          </div>
        </form>
      </div>
    </div>
  </x-app-layout>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>