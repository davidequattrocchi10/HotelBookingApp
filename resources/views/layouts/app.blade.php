<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pannello di Amministrazione')</title>
    <!-- Include il CSS di Bootstrap e FontAwesome -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-color: #f8f9fa;
        }

        /* Header centrato */
        header {
            background-color: #343a40;
            padding: 15px;
            color: white;
            text-align: center;
        }

        header .logo {
            font-size: 1.5rem;
            font-weight: bold;
        }

        /* Sidebar */
        .sidebar {
            background-color: #343a40;
            padding: 20px;
            height: 100vh;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            width: 200px;
            overflow-y: auto;
            transition: width 0.3s ease;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 10px 0;
        }

        .sidebar a i {
            margin-right: 10px;
            font-size: 1.5rem;
            /* Aumento della dimensione delle icone */
        }

        .sidebar a:hover {
            background-color: #495057;
            color: #fff;
            padding-left: 10px;
            transition: 0.3s;
        }

        .main-content {
            margin-left: 250px;
            /* Spazio per la sidebar */
            padding: 20px;
            transition: margin-left 0.3s ease;
        }

        /* Sidebar in modalità responsive (solo icone) */
        @media (max-width: 768px) {
            .sidebar {
                width: 80px;
            }

            .sidebar a {
                justify-content: center;
            }

            .sidebar a span {
                display: none;
            }

            .main-content {
                margin-left: 80px;
            }

            .sidebar a i {
                font-size: 1.7rem;
                /* Aumento leggero delle icone su mobile */
            }
        }

        footer {
            margin-top: 50px;
            padding: 20px;
            text-align: center;
            color: #6c757d;
        }
    </style>
</head>

<body>
    <!-- Header con logo e nome centrato -->
    <header>
        <div class="logo">
            <i class="fas fa-hotel"></i> Hotel Admin
        </div>
    </header>

    <!-- Sidebar aggiornata -->
    <div class="sidebar">

        <a href="{{ route('admin.index') }}" class="mt-5" data-bs-toggle="tooltip" data-bs-placement="right" title="Vai alla dashboard">
            <i class="fas fa-tachometer-alt"></i> <span>Dashboard</span>
        </a>
        <a href="{{ route('admin.camere') }}" data-bs-toggle="tooltip" data-bs-placement="right" title="Gestisci le camere">
            <i class="fas fa-bed"></i> <span>Camere</span>
        </a>
        <a href="{{ route('admin.prenotazioni') }}" data-bs-toggle="tooltip" data-bs-placement="right" title="Visualizza prenotazioni">
            <i class="fas fa-calendar-alt"></i> <span>Prenotazioni</span>
        </a>
        <a href="#" data-bs-toggle="tooltip" data-bs-placement="right" title="Modifica il tuo profilo">
            <i class="fas fa-user"></i> <span>Profilo</span>
        </a>
        <a href="#" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Esci">
            <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
        </a>
    </div>

    <!-- Contenuto principale -->
    <div class="main-content">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer>
        &copy; 2024 Hotel Management - Tutti i diritti riservati
    </footer>

    <!-- JavaScript per i tooltips -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>

</body>

</html>