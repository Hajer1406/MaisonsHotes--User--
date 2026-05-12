<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maison d'hôtes — Tunisie</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500;600&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">

    <style>
        :root {
            --sand: #F5F0E8;
            --clay: #C4956A;
            --clay-dark: #9E7348;
            --ink: #1A1612;
            --ink-soft: #3D3530;
            --mist: #EDE8E0;
            --white: #FDFCFA;
            --success-soft: #E8F5EE;
            --danger-soft: #FDECEA;
        }

        * { box-sizing: border-box; }

        body {
            background: var(--sand);
            font-family: 'DM Sans', sans-serif;
            color: var(--ink);
            font-size: 15px;
            line-height: 1.6;
            min-height: 100vh;
        }

        /* ── NAVBAR ── */
        .navbar {
            background: var(--ink);
            padding: 0;
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }

        .navbar-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 0;
        }

        .navbar-brand {
            font-family: 'Cormorant Garamond', serif;
            font-weight: 500;
            font-size: 22px;
            color: var(--white) !important;
            letter-spacing: 0.02em;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .brand-dot {
            width: 7px;
            height: 7px;
            background: var(--clay);
            border-radius: 50%;
            display: inline-block;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 6px;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .nav-links a {
            color: rgba(255,255,255,0.65);
            text-decoration: none;
            font-size: 13.5px;
            font-weight: 400;
            padding: 7px 14px;
            border-radius: 6px;
            transition: all 0.2s;
            letter-spacing: 0.01em;
        }

        .nav-links a:hover { color: var(--white); background: rgba(255,255,255,0.07); }

        .btn-nav-outline {
            color: rgba(255,255,255,0.75) !important;
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 6px;
            padding: 7px 18px;
            font-size: 13px;
            font-weight: 400;
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-nav-outline:hover { border-color: rgba(255,255,255,0.5); color: white !important; }

        .btn-nav-primary {
            background: var(--clay);
            color: white !important;
            border: none;
            border-radius: 6px;
            padding: 8px 20px;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
            cursor: pointer;
        }
        .btn-nav-primary:hover { background: var(--clay-dark); }

        .navbar-toggler {
            background: transparent;
            border: 1px solid rgba(255,255,255,0.2);
            color: white;
            padding: 6px 10px;
            border-radius: 6px;
        }

        /* ── HERO ── */
        .hero-section {
            position: relative;
            background: var(--ink);
            overflow: hidden;
            min-height: 500px;
            display: flex;
            align-items: center;
        }

        .hero-bg {
            position: absolute;
            inset: 0;
            background: url('https://images.unsplash.com/photo-1564013799919-ab600027ffc6?w=1600&q=80') center/cover;
            opacity: 0.28;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            padding: 80px 0;
        }

        .hero-eyebrow {
            font-size: 11px;
            font-weight: 500;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--clay);
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .hero-eyebrow::before {
            content: '';
            display: block;
            width: 28px;
            height: 1px;
            background: var(--clay);
        }

        .hero-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(42px, 6vw, 72px);
            font-weight: 400;
            color: var(--white);
            line-height: 1.05;
            margin-bottom: 20px;
        }

        .hero-title em {
            font-style: italic;
            color: var(--clay);
        }

        .hero-subtitle {
            color: rgba(255,255,255,0.55);
            font-size: 15px;
            margin-bottom: 36px;
            max-width: 420px;
        }

        /* ── SEARCH BAR ── */
        .search-bar {
            background: var(--white);
            border-radius: 12px;
            padding: 8px 8px 8px 0;
            display: flex;
            align-items: stretch;
            gap: 0;
            max-width: 700px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }

        .search-field {
            flex: 1;
            padding: 12px 20px;
            border: none;
            background: transparent;
            outline: none;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            color: var(--ink);
            border-right: 1px solid var(--mist);
        }

        .search-field:last-of-type { border-right: none; }

        .search-field-label {
            font-size: 10px;
            font-weight: 500;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--clay);
            display: block;
            margin-bottom: 2px;
        }

        .search-field input, .search-field select {
            border: none;
            background: transparent;
            outline: none;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            color: var(--ink);
            width: 100%;
            padding: 0;
        }

        .btn-search {
            background: var(--clay);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 14px 28px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            white-space: nowrap;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .btn-search:hover { background: var(--clay-dark); }

        /* ── STATS ── */
        .hero-stats {
            display: flex;
            gap: 40px;
            margin-top: 40px;
        }

        .stat-item { text-align: left; }
        .stat-num {
            font-family: 'Cormorant Garamond', serif;
            font-size: 28px;
            font-weight: 500;
            color: var(--white);
            line-height: 1;
        }
        .stat-label {
            font-size: 11px;
            color: rgba(255,255,255,0.45);
            margin-top: 2px;
        }

        /* ── SECTION ── */
        .section-eyebrow {
            font-size: 11px;
            font-weight: 500;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--clay);
            margin-bottom: 10px;
        }

        .section-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(28px, 4vw, 42px);
            font-weight: 400;
            color: var(--ink);
            line-height: 1.1;
        }

        /* ── MAISON CARD ── */
        .maison-card {
            background: var(--white);
            border-radius: 14px;
            overflow: hidden;
            border: 1px solid rgba(196,149,106,0.12);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
        }

        .maison-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 24px 60px rgba(26,22,18,0.12);
        }

        .card-img-wrap {
            position: relative;
            overflow: hidden;
            height: 220px;
        }

        .card-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .maison-card:hover .card-img-wrap img {
            transform: scale(1.05);
        }

        .card-img-overlay-grad {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 55%;
            background: linear-gradient(to top, rgba(26,22,18,0.75), transparent);
        }

        .card-location-badge {
            position: absolute;
            bottom: 14px;
            left: 14px;
            display: flex;
            align-items: center;
            gap: 5px;
            color: white;
            font-size: 12px;
            font-weight: 400;
        }

        .fav-btn {
            position: absolute;
            top: 12px;
            right: 12px;
            z-index: 10;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: rgba(255,255,255,0.92);
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            backdrop-filter: blur(4px);
        }
        .fav-btn:hover { transform: scale(1.1); background: white; }
        .fav-btn i { font-size: 14px; }

        .badge-new {
            position: absolute;
            top: 12px;
            left: 12px;
            background: var(--clay);
            color: white;
            font-size: 10px;
            font-weight: 500;
            padding: 4px 10px;
            border-radius: 20px;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .card-body-custom {
            padding: 18px 20px 20px;
        }

        .card-maison-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 20px;
            font-weight: 500;
            color: var(--ink);
            margin-bottom: 6px;
        }

        .card-amenities {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
            margin-bottom: 14px;
        }

        .amenity-tag {
            font-size: 11px;
            color: var(--ink-soft);
            background: var(--mist);
            padding: 3px 9px;
            border-radius: 20px;
        }

        .card-footer-custom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-top: 1px solid var(--mist);
            padding-top: 14px;
        }

        .card-price {
            font-family: 'Cormorant Garamond', serif;
            font-size: 22px;
            font-weight: 600;
            color: var(--ink);
        }
        .card-price span {
            font-family: 'DM Sans', sans-serif;
            font-size: 12px;
            font-weight: 400;
            color: #888;
        }

        .card-rating {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 12px;
            color: var(--ink-soft);
        }

        .btn-card {
            background: var(--ink);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 9px 18px;
            font-size: 13px;
            font-weight: 400;
            text-decoration: none;
            transition: all 0.2s;
            font-family: 'DM Sans', sans-serif;
            cursor: pointer;
        }
        .btn-card:hover { background: var(--clay); color: white; }

        /* ── BUTTONS GENERAL ── */
        .btn-primary-custom {
            background: var(--clay);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 11px 28px;
            font-size: 14px;
            font-weight: 500;
            font-family: 'DM Sans', sans-serif;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-primary-custom:hover { background: var(--clay-dark); color: white; }

        .btn-outline-custom {
            background: transparent;
            color: var(--ink);
            border: 1.5px solid rgba(26,22,18,0.2);
            border-radius: 8px;
            padding: 10px 24px;
            font-size: 14px;
            font-weight: 400;
            font-family: 'DM Sans', sans-serif;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }
        .btn-outline-custom:hover { border-color: var(--clay); color: var(--clay); }

        .btn-danger-custom {
            background: transparent;
            color: #C0392B;
            border: 1.5px solid rgba(192,57,43,0.25);
            border-radius: 8px;
            padding: 8px 18px;
            font-size: 13px;
            font-family: 'DM Sans', sans-serif;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-danger-custom:hover { background: #C0392B; color: white; }

        /* ── FORMS ── */
        .form-card {
            background: var(--white);
            border-radius: 14px;
            border: 1px solid rgba(196,149,106,0.12);
            padding: 32px;
        }

        .form-section-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 22px;
            font-weight: 500;
            color: var(--ink);
            margin-bottom: 4px;
        }

        .form-section-sub {
            font-size: 13px;
            color: #888;
            margin-bottom: 24px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--mist);
        }

        .form-label-custom {
            font-size: 12px;
            font-weight: 500;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: var(--ink-soft);
            margin-bottom: 7px;
            display: block;
        }

        .form-control-custom {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid rgba(26,22,18,0.12);
            border-radius: 9px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            color: var(--ink);
            background: var(--white);
            transition: border-color 0.2s;
            outline: none;
            appearance: none;
        }
        .form-control-custom:focus { border-color: var(--clay); }
        .form-control-custom::placeholder { color: #aaa; }

        select.form-control-custom {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%23888' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            padding-right: 36px;
        }

        /* ── BADGES ── */
        .badge-status {
            font-size: 11px;
            padding: 4px 12px;
            border-radius: 20px;
            font-weight: 500;
        }
        .badge-paid { background: var(--success-soft); color: #1A7A42; }
        .badge-pending { background: #FEF3CD; color: #856404; }
        .badge-cancelled { background: var(--danger-soft); color: #C0392B; }
        .badge-available { background: var(--success-soft); color: #1A7A42; }
        .badge-unavailable { background: var(--danger-soft); color: #C0392B; }

        /* ── ALERT ── */
        .alert-custom {
            padding: 14px 18px;
            border-radius: 10px;
            font-size: 14px;
            margin-bottom: 20px;
            border: none;
        }
        .alert-success-custom { background: var(--success-soft); color: #1A7A42; }
        .alert-danger-custom { background: var(--danger-soft); color: #C0392B; }
        .alert-info-custom { background: #EEF4FF; color: #1A56DB; }

        /* ── MODAL ── */
        .modal-content {
            border: none;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 40px 100px rgba(0,0,0,0.25);
        }

        .modal-header-custom {
            background: var(--ink);
            color: white;
            padding: 20px 28px;
            border: none;
        }

        .modal-title-custom {
            font-family: 'Cormorant Garamond', serif;
            font-size: 20px;
            font-weight: 500;
        }

        .modal-body-custom {
            padding: 28px;
            background: var(--white);
        }

        .modal-footer-custom {
            background: var(--white);
            border-top: 1px solid var(--mist);
            padding: 16px 28px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        /* ── PAGINATION ── */
        .pagination .page-link {
            color: var(--ink);
            border: 1px solid var(--mist);
            border-radius: 8px;
            font-size: 13px;
            padding: 7px 13px;
            margin: 0 2px;
        }
        .pagination .page-item.active .page-link {
            background: var(--clay);
            border-color: var(--clay);
            color: white;
        }

        /* ── FOOTER ── */
        footer.site-footer {
            background: var(--ink);
            color: rgba(255,255,255,0.5);
            padding: 40px 0 28px;
            margin-top: 80px;
            font-size: 13px;
        }

        .footer-brand {
            font-family: 'Cormorant Garamond', serif;
            font-size: 20px;
            color: var(--white);
            margin-bottom: 8px;
        }

        .footer-links {
            display: flex;
            gap: 20px;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-links a {
            color: rgba(255,255,255,0.45);
            text-decoration: none;
            font-size: 13px;
            transition: color 0.2s;
        }
        .footer-links a:hover { color: var(--clay); }

        /* ── DESTINATIONS ── */
        .dest-chip {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--white);
            border: 1px solid rgba(196,149,106,0.2);
            border-radius: 100px;
            padding: 8px 18px 8px 10px;
            font-size: 13px;
            color: var(--ink);
            text-decoration: none;
            transition: all 0.2s;
            font-weight: 400;
        }
        .dest-chip:hover { border-color: var(--clay); color: var(--clay); background: #FBF7F2; }

        .dest-icon {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            object-fit: cover;
        }

        /* ── FOOTER ── */
footer.site-footer {
    background: var(--ink);
    color: rgba(255,255,255,0.5);
    margin-top: 80px;
    font-size: 13px;
}

.footer-brand {
    font-family: 'Cormorant Garamond', serif;
    font-size: 21px;
    font-weight: 500;
    color: var(--white);
}

.footer-col-label {
    font-size: 10px;
    font-weight: 500;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: rgba(255,255,255,0.28);
    margin-bottom: 16px;
}

.footer-links a {
    color: rgba(255,255,255,0.5);
    text-decoration: none;
    font-family: 'Cormorant Garamond', serif;
    font-size: 16px;
    transition: color 0.2s;
}
.footer-links a:hover { color: var(--clay); }

.footer-social-btn {
    width: 34px;
    height: 34px;
    border-radius: 8px;
    border: 1px solid rgba(255,255,255,0.1);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: rgba(255,255,255,0.4);
    text-decoration: none;
    transition: all 0.2s;
}
.footer-social-btn:hover {
    border-color: var(--clay);
    color: var(--clay);
    background: rgba(196,149,106,0.08);
}

        /* ── WHY US ── */
        .why-card {
            background: var(--white);
            border-radius: 14px;
            padding: 28px;
            border: 1px solid rgba(196,149,106,0.1);
            height: 100%;
        }

        .why-icon {
            width: 46px;
            height: 46px;
            background: #FBF7F2;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
            color: var(--clay);
            font-size: 18px;
        }

        /* ── STICKY SIDEBAR ── */
        .sticky-sidebar {
            position: sticky;
            top: 24px;
        }

        .info-card {
            background: var(--white);
            border-radius: 14px;
            border: 1px solid rgba(196,149,106,0.12);
            padding: 24px;
        }

        /* ── FILTER BAR ── */
        .filter-bar {
            background: var(--white);
            border-radius: 12px;
            padding: 16px 20px;
            display: flex;
            gap: 10px;
            align-items: flex-end;
            flex-wrap: wrap;
            border: 1px solid rgba(196,149,106,0.12);
            margin-bottom: 28px;
        }

        .filter-field { flex: 1; min-width: 160px; }
        .filter-label {
            font-size: 11px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--ink-soft);
            margin-bottom: 6px;
            display: block;
        }

        /* ── ANIMATIONS ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-up { animation: fadeUp 0.5s ease forwards; }
        .fade-up-1 { animation-delay: 0.05s; opacity: 0; }
        .fade-up-2 { animation-delay: 0.1s; opacity: 0; }
        .fade-up-3 { animation-delay: 0.15s; opacity: 0; }
        .fade-up-4 { animation-delay: 0.2s; opacity: 0; }

        /* ── RESPONSIVE ── */
        @media (max-width: 768px) {
            .search-bar { flex-direction: column; border-radius: 12px; padding: 12px; }
            .search-field { border-right: none; border-bottom: 1px solid var(--mist); padding: 10px 4px; }
            .search-field:last-of-type { border-bottom: none; }
            .hero-stats { gap: 24px; }
            .navbar-inner { flex-wrap: wrap; gap: 12px; }
        }

        /* bootstrap override cleanup */
        .btn { font-family: 'DM Sans', sans-serif; }
        .card { border-radius: 14px; }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <div class="navbar-inner w-100">
            <a class="navbar-brand" href="{{ route('home') }}">
                <span class="brand-dot"></span>
                Maison d'hôtes
            </a>

            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <i class="bi bi-list" style="color:white;font-size:18px;"></i>
            </button>

            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="nav-links ms-auto">
                    <li><a href="{{ route('home') }}">Accueil</a></li>
                    <li><a href="{{ route('maisons.index') }}">Maisons</a></li>

                    @auth
                        <li><a href="{{ route('reservations.index') }}">Mes réservations</a></li>
                        <li><a href="{{ route('profile.edit') }}">Mon profil</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                                @csrf
                                <button class="btn-nav-outline" style="cursor:pointer;">Déconnexion</button>
                            </form>
                        </li>
                    @else
                        <li><a href="{{ route('login') }}" class="btn-nav-outline">Connexion</a></li>
                        <li><a href="{{ route('register') }}" class="btn-nav-primary">Inscription</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </div>
</nav>

<!-- HERO (home only) -->
@if(request()->routeIs('home'))
<section class="hero-section">
    <div class="hero-bg"></div>
    <div class="container">
        <div class="hero-content">
            <div class="row align-items-center">
                <div class="col-lg-10">
                    <p class="hero-eyebrow fade-up fade-up-1">Destinations en Tunisie</p>
                    <h1 class="hero-title fade-up fade-up-2">
                        Vivez l'authenticité<br>
                        <em>tunisienne</em>
                    </h1>
                    <p class="hero-subtitle fade-up fade-up-3">
                        Des maisons d'hôtes soigneusement sélectionnées pour une expérience inoubliable.
                    </p>

                    <!-- Search bar -->
                    <form method="GET" action="{{ route('maisons.index') }}" class="search-bar fade-up fade-up-4">
                        <div class="search-field" style="padding:12px 20px;">
                            <label class="search-field-label">Destination</label>
                            <input list="villes" name="ville" placeholder="Hammamet, Sidi Bou Said..." class="form-control-custom">
                            <datalist id="villes">
                                <option value="Hammamet"></option>
                                <option value="Sidi Bou Said"></option>
                                <option value="Djerba"></option>
                                <option value="Tunis"></option>
                                <option value="Sousse"></option>
                                <option value="Tozeur"></option>
                            </datalist>
                        </div>
                        <div class="search-field" style="padding:12px 20px;">
                            <label class="search-field-label">Arrivée</label>
                            <input type="date" name="arrivee" style="color:#555;">
                        </div>
                        <div class="search-field" style="padding:12px 20px;">
                            <label class="search-field-label">Départ</label>
                            <input type="date" name="depart" style="color:#555;">
                        </div>
                        <button type="submit" class="btn-search">
                            <i class="bi bi-search"></i> Rechercher
                        </button>
                    </form>

                    <div class="hero-stats fade-up fade-up-4">
                        <div class="stat-item">
                            <div class="stat-num">50+</div>
                            <div class="stat-label">Maisons d'hôtes</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-num">12</div>
                            <div class="stat-label">Régions</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-num">4.8★</div>
                            <div class="stat-label">Note moyenne</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Flash messages -->
<div class="container mt-4">
    @if(session('success'))
        <div class="alert-custom alert-success-custom">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert-custom alert-danger-custom">
            <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
        </div>
    @endif
</div>

<!-- PAGE CONTENT -->
<div class="container mb-5 mt-3">
    @yield('content')
</div>

<!-- CHATBOT WIDGET -->
<div id="chatbot-widget" class="chatbot-widget">
    <button id="chatbot-toggle" class="chatbot-toggle" aria-label="Ouvrir le chatbot">
        <i class="bi bi-chat-dots-fill"></i>
    </button>
    <div id="chatbot-panel" class="chatbot-panel" aria-hidden="true">
        <div class="chatbot-header">
            <div>
                <div class="chatbot-title">Assistant Maison d'hôtes</div>
                <div class="chatbot-subtitle">Posez une question sur les maisons, chambres ou réservations.</div>
            </div>
            <button id="chatbot-close" class="chatbot-close" aria-label="Fermer le chatbot">×</button>
        </div>
        <div id="chatbot-messages" class="chatbot-messages">
            <div class="chatbot-message bot">
                Bonjour ! Je suis votre assistant maison d'hôtes. Comment puis-je vous aider aujourd'hui ?
            </div>
        </div>
        <form id="chatbot-form" class="chatbot-form">
            @csrf
            <input type="text" id="chatbot-input" name="message" class="chatbot-input" placeholder="Écrivez votre question..." autocomplete="off" required>
            <button type="submit" class="chatbot-submit">Envoyer</button>
        </form>
    </div>
</div>

<!-- FOOTER -->
<footer class="site-footer">
    <div class="container">

        <div class="row g-5 py-5 border-bottom border-white border-opacity-10">

            <!-- Brand -->
            <div class="col-lg-4">
                <div class="footer-brand d-flex align-items-center gap-2 mb-3">
                    <span class="brand-dot"></span>
                    Maison d'hôtes
                </div>
                <p style="font-size:13px; color:rgba(255,255,255,0.38); line-height:1.7; max-width:220px;">
                    Des adresses authentiques soigneusement sélectionnées à travers toute la Tunisie.
                </p>
                <div class="d-flex gap-2 mt-3">
                    <a href="#" class="footer-social-btn"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="footer-social-btn"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="footer-social-btn"><i class="bi bi-envelope"></i></a>
                </div>
            </div>

            <!-- Navigation -->
            <div class="col-6 col-lg-2">
                <p class="footer-col-label">Navigation</p>
                <ul class="footer-links flex-column gap-2">
                    <li><a href="{{ route('home') }}">Accueil</a></li>
                    <li><a href="{{ route('maisons.index') }}">Maisons</a></li>
                    <!-- <li><a href="#">À propos</a></li> -->
                </ul>
            </div>

            <!-- Espace client -->
            <div class="col-6 col-lg-3">
                <p class="footer-col-label">Espace client</p>
                <ul class="footer-links flex-column gap-2">
                    @auth
                        <li><a href="{{ route('reservations.index') }}">Mes réservations</a></li>
                        <li><a href="{{ route('profile.edit') }}">Mon profil</a></li>
                    @else
                        <li><a href="{{ route('login') }}">Connexion</a></li>
                        <li><a href="{{ route('register') }}">Inscription</a></li>
                    @endauth
                </ul>
            </div>

            <!-- Contact -->
            <div class="col-lg-3">
                <p class="footer-col-label">Contact</p>
                <div class="mb-3">
                    <div style="font-size:10px;letter-spacing:.12em;text-transform:uppercase;color:rgba(255,255,255,.25);">Email</div>
                    <div style="font-size:13px;color:rgba(255,255,255,.55);">contact@maisondhotestn.com</div>
                </div>
                <div>
                    <div style="font-size:10px;letter-spacing:.12em;text-transform:uppercase;color:rgba(255,255,255,.25);">Téléphone</div>
                    <div style="font-size:13px;color:rgba(255,255,255,.55);">+216 72 338 228</div>
                </div>
            </div>

        </div>

        <!-- Bottom bar -->
        <div class="d-flex align-items-center justify-content-between py-3">
            <p style="font-size:12px;color:rgba(255,255,255,.22);margin:0;">
                © {{ date('Y') }} Maison d'hôtes &nbsp;·&nbsp; Tous droits réservés
            </p>
            <p style="font-family:'Cormorant Garamond',serif;font-style:italic;font-size:13px;color:rgba(255,255,255,.18);margin:0;">
                L'authenticité tunisienne, à portée de main
            </p>
        </div>

    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggle = document.getElementById('chatbot-toggle');
        const panel = document.getElementById('chatbot-panel');
        const close = document.getElementById('chatbot-close');
        const form = document.getElementById('chatbot-form');
        const input = document.getElementById('chatbot-input');
        const messages = document.getElementById('chatbot-messages');
        const token = document.querySelector('#chatbot-form input[name="_token"]').value;

        function scrollChat() {
            messages.scrollTop = messages.scrollHeight;
        }

        function appendMessage(role, text, isMarkdown = false) {
            const bubble = document.createElement('div');
            bubble.className = 'chatbot-message ' + role;
            if (isMarkdown && role === 'bot') {
                bubble.innerHTML = marked.parse(text);
            } else {
                bubble.textContent = text;
            }
            messages.appendChild(bubble);
            scrollChat();
            return bubble;
        }

        toggle.addEventListener('click', function () {
            panel.classList.toggle('active');
            panel.setAttribute('aria-hidden', panel.classList.contains('active') ? 'false' : 'true');
            if (panel.classList.contains('active')) {
                input.focus();
            }
        });

        close.addEventListener('click', function () {
            panel.classList.remove('active');
            panel.setAttribute('aria-hidden', 'true');
        });

        form.addEventListener('submit', function (event) {
            event.preventDefault();
            const message = input.value.trim();
            if (!message) {
                return;
            }

            appendMessage('user', message);
            input.value = '';
            input.disabled = true;

            const waiting = document.createElement('div');
            waiting.className = 'chatbot-message bot typing';
            waiting.innerHTML = '<span class="dot"></span><span class="dot"></span><span class="dot"></span>';
            messages.appendChild(waiting);
            scrollChat();
            
            const chatbotRoute = "{{ route('chatbot.ask') }}";

            fetch(chatbotRoute, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ message: message })
            })
                .then(response => response.json())
                .then(data => {
                    waiting.classList.remove('typing');
                    if (data.error) {
                        waiting.innerHTML = marked.parse(data.error);
                    } else {
                        waiting.innerHTML = marked.parse(data.answer);
                    }
                })
                .catch(() => {
                    waiting.classList.remove('typing');
                    waiting.innerHTML = marked.parse('Désolé, je n’ai pas pu répondre. Veuillez réessayer.');
                })
                .finally(() => {
                    input.disabled = false;
                    input.focus();
                    scrollChat();
                });
        });
    });
</script>
<style>
    .chatbot-widget { position: fixed; right: 24px; bottom: 24px; z-index: 1050; font-family: 'Inter', sans-serif; }
    .chatbot-toggle { width: 60px; height: 60px; border-radius: 50%; border: none; background: var(--clay); color: #fff; cursor: pointer; box-shadow: 0 20px 45px rgba(0,0,0,0.18); display:flex; align-items:center; justify-content:center; font-size:20px; }
    .chatbot-panel { display: none; width: min(380px, calc(100vw - 32px)); max-height: 520px; background:#fff; border-radius:28px; box-shadow: 0 24px 80px rgba(26,22,18,0.16); overflow:hidden; border:1px solid rgba(196,149,106,0.12); }
    .chatbot-panel.active { display:flex; flex-direction:column; }
    .chatbot-header { background: var(--clay); color:white; padding:18px 18px 14px; display:flex; align-items:flex-start; justify-content:space-between; gap:16px; }
    .chatbot-title { font-size:16px; font-weight:700; margin-bottom:4px; }
    .chatbot-subtitle { font-size:13px; opacity:0.9; line-height:1.4; }
    .chatbot-close { background:transparent; border:none; color:white; font-size:24px; line-height:1; cursor:pointer; }
    .chatbot-messages { flex:1; min-height:220px; max-height:320px; overflow-y:auto; padding:18px; background:#F7F2EC; display:flex; flex-direction:column; gap:12px; }
    .chatbot-message { padding:12px 14px; border-radius:18px; max-width:85%; line-height:1.5; font-size:14px; }
    .chatbot-message.user { background:#fff; color:#1e1e1e; align-self:flex-end; box-shadow:0 5px 18px rgba(0,0,0,0.06); }
    .chatbot-message.bot { background:#fdeedb; color:#1f1f1f; align-self:flex-start; }
    .chatbot-message p:last-child { margin-bottom: 0; }
    .chatbot-message ul, .chatbot-message ol { padding-left: 20px; margin-bottom: 0; }
    .chatbot-message strong { color: #1a1612; font-weight: 700; }
    .chatbot-message.typing { display: flex; align-items: center; gap: 4px; padding: 16px 18px; min-height: 48px; }
    .chatbot-message.typing .dot { width: 6px; height: 6px; background: #c4956a; border-radius: 50%; animation: typing 1.4s infinite ease-in-out both; }
    .chatbot-message.typing .dot:nth-child(1) { animation-delay: -0.32s; }
    .chatbot-message.typing .dot:nth-child(2) { animation-delay: -0.16s; }
    @keyframes typing { 0%, 80%, 100% { transform: scale(0); } 40% { transform: scale(1); } }
    .chatbot-form { display:flex; gap:10px; padding:16px; border-top:1px solid rgba(196,149,106,0.15); background:#fff; }
    .chatbot-input { flex:1; border:1px solid rgba(196,149,106,0.2); border-radius:999px; padding:12px 16px; font-size:14px; outline:none; }
    .chatbot-submit { background:var(--clay); color:#fff; border:none; border-radius:999px; padding:12px 18px; cursor:pointer; font-weight:600; }
    .chatbot-submit:hover { opacity:0.95; }
    @media(max-width: 576px) { .chatbot-widget { right: 12px; bottom: 12px; } .chatbot-panel { width: calc(100vw - 24px); } }
</style>
</body>
</html>