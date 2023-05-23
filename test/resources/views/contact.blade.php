<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/app.css">
    <title>Document</title>
</head>
<body>

@include('partials.header')
    <div class="container">
        <h1>Contactformulier</h1>

        <!--Hieronder zie je de formulier die het contactformulier indient.
        Met @csrf voer ik csrf-protectie uit.-->
        <form action="{{ route('contact.indienen') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="message">Bericht:</label>
                <!--Met de rows="5" verwijs ik naar het aantal lijntjes in de text area.-->
                <textarea name="message" id="message" class="form-control" rows="5" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Verzenden</button>
        </form>
    </div>

</body>
</html>