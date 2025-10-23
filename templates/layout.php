<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fauzan Nurrachman</title>
    <link href="{{ url_for('static', filename='css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ url_for('static', filename='css/style.css') }}">
</head>
<body id="home">
    <nav class="navbar navbar-expand-lg navbar-light bg-customnav">
        <div class="container">
            <a class="navbar-brand" href="#home">Fauzan Nurrachman</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                </ul>
            </div>
            <div class="logo d-flex align-items-center">
                <!-- <img src="{{ url_for('static', filename='img/digitalentimg.jpeg') }}" alt="Digitalent" style="height:30px;" class="me-2"> -->
                <!-- <img src="{{ url_for('static', filename='img/cisco.png') }}" alt="Cisco" style="height:30px;"> -->
            </div>
        </div>
    </nav>

    {% block body %}{% endblock %}

    <!-- Bootstrap JS (opsional, jika butuh dropdown, dll) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>