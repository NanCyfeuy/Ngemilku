{{-- <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Ngemil Spot GIS' }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
        }
    </style>
</head>
<body>
    <!-- Konten halaman -->
    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> --}}

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ngemil Spot GIS')</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('brand.png') }}" type="image/png">
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <style>
        body {
            margin: 0;
        }

        #map {
            height: 100vh;
            width: 100%;
        }

        #detail-container {
            position: fixed;
            bottom: -100%;
            left: 50%;
            transform: translateX(-50%);
            width: 50%;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            box-shadow: 0 -2px 20px rgba(0, 0, 0, 0.25);
            border-radius: 15px;
            padding: 20px;
            transition: bottom 0.3s ease-in-out;
            z-index: 9999;
            max-height: 50vh;
            overflow-y: auto;
        }

        #detail-container.show {
            bottom: 30px;
        }

        .search-input {
            width: 180px;
            padding-left: 35px;
            border-radius: 25px;
            border: 1px solid #ccc;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: #198754;
            box-shadow: 0 0 5px rgba(25, 135, 84, 0.5);
        }

        .search-icon {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            color: #888;
        }

        .navbar-floating {
            width: 50%;
            background: rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            position: absolute;
            top: 15px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
            font-family: 'Segoe UI', sans-serif;
            transition: all 0.3s ease;
        }

        .navbar-floating:hover {
            background: rgba(255, 255, 255, 0.45);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .nav-link-custom {
            color: #333;
            font-weight: 500;
            text-decoration: none;
            position: relative;
            padding-bottom: 3px;
            transition: all 0.3s ease;
        }

        .nav-link-custom::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 0%;
            height: 2px;
            background: #198754;
            transition: width 0.3s ease;
        }

        .nav-link-custom:hover {
            color: #198754;
        }

        .nav-link-custom:hover::after {
            width: 100%;
        }

        .about-dropdown {
            display: none;
            position: absolute;
            top: 250%;
            left: 50%;
            transform: translateX(-50%);
            width: 800px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.3s ease;
            padding: 20px;
            z-index: 1001;
        }

        .nav-item:hover .about-dropdown {
            display: block;
        }

        .brand-logo {
            width: 55px;
            height: 55px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .legend {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 10px;
            padding: 10px;
            font-family: 'Segoe UI', sans-serif;
            font-size: 14px;
            line-height: 1.4;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            max-height: 500px;
            overflow-y: auto;
            transition: all 0.3s ease;
        }

        .legend input {
            margin-right: 5px;
        }

        .legend-toggle-btn {
            position: absolute;
            top: 10px;
            left: 50px;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            font-weight: bold;
            color: #198754;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .legend-toggle-btn:hover {
            background: white;
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        .about-title {
            color: #198754;
            font-weight: 700;
            margin-bottom: 15px;
            text-align: center;
            font-size: 1.5rem;
        }

        .about-section {
            margin-bottom: 15px;
        }

        .about-section h6, .about-section1 h6, .about-section2 h6 {
            color: #333;
            font-weight: 600;
            margin-bottom: 8px;
            border-bottom: 1px solid #eee;
            padding-bottom: 5px;
        }

        .team-container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-top: 10px;
        }

        .team-member {
            flex: 1;
            text-align: center;
            padding: 15px;
            border-radius: 10px;
            transition: all 0.3s ease;
            background: rgba(25, 135, 84, 0.05);
        }

        .team-member:hover {
            background: rgba(25, 135, 84, 0.1);
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .member-photo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #198754;
            margin: 0 auto 10px;
            display: block;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .member-info {
            text-align: center;
        }

        .member-name {
            font-weight: 600;
            color: #333;
            margin-bottom: 5px;
            font-size: 1rem;
        }

        .member-nim {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 8px;
        }

        .btn-login {
            background: linear-gradient(135deg, #198754, #20c997);
            color: #fff;
            font-weight: 600;
            padding: 8px 24px;
            border-radius: 30px;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(25, 135, 84, 0.25);
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #157347, #198754);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(25, 135, 84, 0.35);
        }


        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translate(-50%, -10px);
            }
            to {
                opacity: 1;
                transform: translate(-50%, 0);
            }
        }

        @keyframes popupZoom {
            from {
                transform: scale(0.8);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    @yield('content')
    
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    @yield('scripts')
</body>
</html>