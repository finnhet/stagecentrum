<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vacature Aanmaken</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="card p-4 shadow-lg rounded mx-auto" style="max-width: 600px;">
            <h3 class="text-center mb-4">Vacature Aanmaken</h3>
            <form class="row g-3">
                <div class="col-md-6">
                    <label for="inputCompany" class="form-label">Naam bedrijf:</label>
                    <input type="text" class="form-control" id="inputCompany" placeholder="Bedrijfsnaam">
                </div>
                <div class="col-md-6">
                    <label for="inputStage" class="form-label">Naam stage:</label>
                    <input type="text" class="form-control" id="inputStage" placeholder="Stage naam">
                </div>
                <div class="col-12">
                    <label for="inputAddress" class="form-label">Provincie</label>
                    <input type="text" class="form-control" id="inputAddress">
                </div>
                <div class="col-12">
                    <label for="inputAddress2" class="form-label">Straat</label>
                    <input type="text" class="form-control" id="inputAddress2">
                </div>
                <div class="col-md-5">
                    <label for="inputCity" class="form-label">Telefoonnummer Begeleider:</label>
                    <input type="text" class="form-control" id="inputCity" placeholder="Bijv. 06123456">
                </div>
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary w-100">Vacature Aanmaken</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
