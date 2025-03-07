<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <title>Eric Pizza</title>

    <style>
        .brand {
            background-color: #cbb09c !important;
        }
        .brand-text {
            color: #cbb09c !important;
            font-weight: bold;
        }
        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
        }
        .pizza {
            width: 100px;
            margin: 40px auto -30px;
            display: block;
            position: relative;
            top: -30px;
        }
        /* Style the button for better mobile visibility */
        .add-pizza-btn {
            background-color: #cbb09c !important;
            font-weight: bold;
            border-radius: 8px;
        }
    </style>
</head>
<body class="grey lighten-4">
    <nav class="white z-depth-0">
        <div class="container">
            <div class="nav-wrapper">
                <a href="index.php" class="brand-logo brand-text">Eric Pizza</a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger right"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down">
                    <li><a href="add.php" class="btn add-pizza-btn z-depth-0">➕ Add a Pizza</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Mobile "Add a Pizza" Button (Always Visible) -->
    <div class="container center hide-on-large-only" style="margin-top: 10px;">
        <a href="add.php" class="btn add-pizza-btn z-depth-1">➕ Add a Pizza</a>
    </div>

    <!-- Mobile Navigation -->
    <ul class="sidenav" id="mobile-demo">
        <li><a href="add.php">Add a Pizza</a></li>
    </ul>

    <!-- Materialize JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        // Initialize Materialize components
        document.addEventListener('DOMContentLoaded', function() {
            M.Sidenav.init(document.querySelectorAll('.sidenav'));
        });
    </script>
</body>
