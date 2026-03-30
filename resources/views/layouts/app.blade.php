<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISI BURGER</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Poppins', sans-serif; }
        body { background: #fff8f0; }

        /* NAVBAR */
        .navbar-isi {
            background: #1a1a2e;
            padding: 12px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .navbar-brand-isi {
            display: flex; align-items: center; gap: 10px;
            text-decoration: none;

        }
        .logo-burger {
            width: 44px; height: 44px;
            background: linear-gradient(135deg, #ff6b35, #f7931e);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem;
            box-shadow: 0 4px 12px rgba(255,107,53,0.4);
        }
        .brand-name {
            color: white; font-weight: 700; font-size: 1.3rem; letter-spacing: 1px;
        }
        .brand-name span { color: #ff6b35; }
        .navbar-right { display: flex; align-items: center; gap: 16px; }
        .user-badge {
            color: rgba(255,255,255,0.85);
            font-size: 0.85rem;
            display: flex; align-items: center; gap: 6px;
        }
        .role-pill {
            background: #ff6b35;
            color: white;
            padding: 2px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .btn-logout {
            background: rgba(255,255,255,0.1);
            color: white;
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 8px;
            padding: 6px 14px;
            font-size: 0.85rem;
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-logout:hover { background: rgba(255,107,53,0.3); color: white; }

        /* SIDEBAR */
        .sidebar {
            width: 230px; min-width: 230px;
            background: #1a1a2e;
            min-height: calc(100vh - 68px);
            padding: 20px 0;
        }
        .sidebar-section {
            padding: 0 16px;
            margin-bottom: 8px;
        }
        .sidebar-label {
            color: rgba(255,255,255,0.3);
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            padding: 8px 12px 4px;
        }
        .sidebar a {
            display: flex; align-items: center; gap: 10px;
            color: rgba(255,255,255,0.6);
            text-decoration: none;
            padding: 10px 12px;
            border-radius: 10px;
            margin: 2px 8px;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.2s;
        }
        .sidebar a:hover, .sidebar a.active {
            background: rgba(255,107,53,0.15);
            color: #ff6b35;
        }
        .sidebar a i { font-size: 1rem; width: 20px; }
        .sidebar hr { border-color: rgba(255,255,255,0.1); margin: 12px 16px; }

        /* MAIN */
        .main-content { flex: 1; padding: 28px; }

        /* CARDS */
        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.06);
        }
        .stat-card {
            border-radius: 16px;
            color: white;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }
        .stat-card::after {
            content: '';
            position: absolute;
            right: -20px; top: -20px;
            width: 100px; height: 100px;
            background: rgba(255,255,255,0.08);
            border-radius: 50%;
        }

        /* ALERTS */
        .alert { border-radius: 12px; border: none; }

        /* TABLE */
        .table { border-radius: 12px; overflow: hidden; }
        .table thead th { background: #fff3e8; color: #1a1a2e; font-weight: 600; border: none; }
        .table td { vertical-align: middle; border-color: #fff3e8; }

        /* BUTTONS */
        .btn-primary { background: #ff6b35; border-color: #ff6b35; border-radius: 8px; }
        .btn-primary:hover { background: #e55a25; border-color: #e55a25; }
        .btn-success { border-radius: 8px; }
        .btn-danger { border-radius: 8px; }
        .form-control, .form-select { border-radius: 10px; }
        .form-control:focus, .form-select:focus {
            border-color: #ff6b35;
            box-shadow: 0 0 0 3px rgba(255,107,53,0.15);
        }
    </style>
</head>
<body>

{{-- NAVBAR --}}
<div class="navbar-isi">
    <a class="navbar-brand-isi" href="{{ route('catalogue') }}">
        <img src="{{ asset('images/logo.png') }}" alt="Logo ISI BURGER" style="width: 50px; height: 50px; object-fit: contain;">
        <span class="brand-name">ISI <span>BURGER</span></span>
    </a>
    <div class="navbar-right">
        <div class="user-badge">
            <i class="bi bi-person-circle"></i>
            {{ Auth::user()->name }}
            <span class="role-pill">{{ Auth::user()->getRoleNames()->first() }}</span>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn-logout">
                <i class="bi bi-box-arrow-right"></i> Déconnexion
            </button>
        </form>
    </div>
</div>

{{-- LAYOUT --}}
<div class="d-flex">
    {{-- SIDEBAR --}}
    <div class="sidebar">
        <div class="sidebar-label">Menu</div>
        <a href="{{ route('catalogue') }}" class="{{ request()->routeIs('catalogue') ? 'active' : '' }}">
            <i class="bi bi-grid-fill"></i> Catalogue
        </a>

        {{-- PANIER et mes commandes uniauement pour les clients --}}

        @role('client')
        <a href="{{ route('panier.index') }}" class="{{ request()->routeIs('panier.*') ? 'active' : '' }}">
            <i class="bi bi-cart-fill"></i> Mon panier
            @php $panierCount = count(session()->get('panier', [])); @endphp
            @if($panierCount > 0)
                <span style="background:#ff6b35; color:white; border-radius:10px;
             padding:1px 7px; font-size:0.7rem; margin-left:auto;">
            {{ $panierCount }}
        </span>
            @endif
        </a>
        <a href="{{ route('commande.mes_commandes') }}" class="{{ request()->routeIs('commande.mes_commandes') ? 'active' : '' }}">
            <i class="bi bi-bag-fill"></i> Mes commandes
        </a>
        @endrole

        @role('gestionnaire')
        <hr>
        <div class="sidebar-label">Gestion</div>
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
        <a href="{{ route('categorie.index') }}" class="{{ request()->routeIs('categorie.*') ? 'active' : '' }}">
            <i class="bi bi-tags-fill"></i> Catégories
        </a>
        <a href="{{ route('produit.index') }}" class="{{ request()->routeIs('produit.*') ? 'active' : '' }}">
            <i class="bi bi-box-fill"></i> Produits
        </a>
        <a href="{{ route('commande.index') }}" class="{{ request()->routeIs('commande.index') ? 'active' : '' }}">
            <i class="bi bi-receipt-cutoff"></i> Commandes
        </a>
        @endrole
    </div>

    {{-- CONTENU --}}
    <div class="main-content">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-3">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('delete'))
            <div class="alert alert-danger alert-dismissible fade show mb-3">
                <i class="bi bi-trash-fill me-2"></i>{{ session('delete') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-warning alert-dismissible fade show mb-3">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
