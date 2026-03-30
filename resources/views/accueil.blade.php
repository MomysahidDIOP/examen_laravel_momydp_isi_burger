<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISI BURGER — Le meilleur burger de Dakar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Poppins', sans-serif; }
        body { background: #fff8f0; margin: 0; }

        /* HEADER */

        .header {
            background: #1a1a2e;
            padding: 0 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 70px;
            position: sticky; top: 0; z-index: 100;
            box-shadow: 0 2px 20px rgba(0,0,0,0.3);
        }
        .nav-left { display: flex; gap: 28px; }
        .nav-right { display: flex; align-items: center; gap: 16px; }
        .nav-left a, .nav-right a.nav-link {
            color: rgba(255,255,255,0.75);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.88rem;
            transition: color 0.2s;
        }
        .nav-left a:hover, .nav-right a.nav-link:hover { color: #ff6b35; }
        .logo-center {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            display: flex; align-items: center; gap: 10px;
            text-decoration: none;
        }
        .logo-center img { width: 48px; height: 48px; object-fit: contain; }
        .logo-center .brand { color: white; font-weight: 800; font-size: 1.3rem; letter-spacing: 1px; }
        .logo-center .brand span { color: #ff6b35; }
        .btn-login {
            background: transparent;
            color: rgba(255,255,255,0.8);
            border: 1.5px solid rgba(255,255,255,0.25);
            border-radius: 8px;
            padding: 7px 18px;
            font-weight: 600; font-size: 0.85rem;
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-login:hover { border-color: #ff6b35; color: #ff6b35; }
        .btn-order {
            background: linear-gradient(135deg, #ff6b35, #f7931e);
            color: white; border: none; border-radius: 8px;
            padding: 9px 22px; font-weight: 700; font-size: 0.88rem;
            text-decoration: none;
            box-shadow: 0 4px 15px rgba(255,107,53,0.35);
            display: flex; align-items: center; gap: 6px;
            transition: opacity 0.2s;
        }
        .btn-order:hover { opacity: 0.9; color: white; }
        .logo-area { display: flex; align-items: center; gap: 12px; text-decoration: none; }
        .logo-area img { width: 50px; height: 50px; object-fit: contain; }
        .brand { color: white; font-weight: 800; font-size: 1.4rem; letter-spacing: 1px; }
        .brand span { color: #ff6b35; }
        .nav-links { display: flex; align-items: center; gap: 24px; }
        .nav-links a { color: rgba(255,255,255,0.75); text-decoration: none; font-weight: 500; font-size: 0.9rem; transition: color 0.2s; }
        .nav-links a:hover { color: #ff6b35; }
        .btn-login { background: rgba(255,107,53,0.15); color: #ff6b35; border: 1px solid rgba(255,107,53,0.4); border-radius: 8px; padding: 8px 20px; font-weight: 600; text-decoration: none; transition: all 0.2s; }
        .btn-login:hover { background: #ff6b35; color: white; }
        .btn-order { background: linear-gradient(135deg, #ff6b35, #f7931e); color: white; border: none; border-radius: 8px; padding: 10px 24px; font-weight: 700; text-decoration: none; box-shadow: 0 4px 15px rgba(255,107,53,0.4); }

        /* HERO */
        .hero {
            background: linear-gradient(135deg, #1a1a2e 0%, #2d1810 60%, #1a1a2e 100%);
            padding: 80px 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
            min-height: 500px;
        }
        .hero::before {
            content: '';
            position: absolute;
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(255,107,53,0.15) 0%, transparent 70%);
            right: 200px; top: 50%;
            transform: translateY(-50%);
        }
        .hero-text { z-index: 1; max-width: 550px; }
        .hero-badge {
            background: rgba(255,107,53,0.2);
            color: #ff6b35;
            border: 1px solid rgba(255,107,53,0.4);
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 20px;
        }
        .hero h1 { color: white; font-size: 3.2rem; font-weight: 800; line-height: 1.1; margin-bottom: 16px; }
        .hero h1 span { color: #ff6b35; }
        .hero p { color: rgba(255,255,255,0.65); font-size: 1.1rem; margin-bottom: 32px; }
        .hero-btns { display: flex; gap: 16px; align-items: center; }
        .btn-hero-primary {
            background: linear-gradient(135deg, #ff6b35, #f7931e);
            color: white; border: none; border-radius: 12px;
            padding: 16px 36px; font-weight: 700; font-size: 1rem;
            text-decoration: none; display: inline-block;
            box-shadow: 0 8px 25px rgba(255,107,53,0.45);
            transition: transform 0.2s;
        }
        .btn-hero-primary:hover { transform: translateY(-2px); color: white; }
        .btn-hero-secondary {
            color: rgba(255,255,255,0.7);
            text-decoration: none; font-weight: 500;
            display: flex; align-items: center; gap: 8px;
        }
        .hero-stats { display: flex; gap: 32px; margin-top: 48px; }
        .hero-stat-num { color: #ff6b35; font-weight: 800; font-size: 1.8rem; }
        .hero-stat-label { color: rgba(255,255,255,0.5); font-size: 0.8rem; }
        .hero-img { z-index: 1; position: relative; }
        .hero-img img { width: 420px; height: 420px; object-fit: cover; border-radius: 50%; box-shadow: 0 30px 80px rgba(255,107,53,0.3); }

        /* CATEGORIES */
        .section { padding: 60px 40px; }
        .section-title { font-size: 1.8rem; font-weight: 700; color: #1a1a2e; margin-bottom: 8px; }
        .section-sub { color: #888; margin-bottom: 32px; }
        .cat-pill {
            background: white;
            border: 2px solid #e8e0d8;
            border-radius: 40px;
            padding: 10px 20px;
            font-weight: 600;
            color: #1a1a2e;
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.2s;
            display: inline-block;
        }
        .cat-pill:hover, .cat-pill.active {
            background: #ff6b35;
            border-color: #ff6b35;
            color: white;
        }

        /* PRODUIT CARDS */
        .produit-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .produit-card:hover { transform: translateY(-6px); box-shadow: 0 16px 40px rgba(0,0,0,0.12); }
        .produit-card img { width: 100%; height: 220px; object-fit: cover; }
        .produit-card-body { padding: 20px; }
        .cat-tag { background: #fff3e8; color: #ff6b35; padding: 3px 10px; border-radius: 20px; font-size: 0.72rem; font-weight: 600; }
        .produit-name { font-weight: 700; font-size: 1.1rem; color: #1a1a2e; margin: 8px 0 4px; }
        .produit-desc { color: #888; font-size: 0.82rem; margin-bottom: 12px; }
        .produit-price { color: #ff6b35; font-weight: 800; font-size: 1.2rem; }
        .btn-add {
            background: linear-gradient(135deg, #ff6b35, #f7931e);
            color: white; border: none; border-radius: 10px;
            padding: 10px 20px; font-weight: 600; font-size: 0.9rem;
            width: 100%; cursor: pointer; transition: opacity 0.2s;
            text-decoration: none; display: block; text-align: center;
        }
        .btn-add:hover { opacity: 0.9; color: white; }

        /* FOOTER */
        .footer {
            background: #1a1a2e;
            color: rgba(255,255,255,0.6);
            padding: 40px;
            text-align: center;
        }
        .footer-brand { color: white; font-weight: 700; font-size: 1.2rem; margin-bottom: 8px; }
        .footer-brand span { color: #ff6b35; }
    </style>
</head>
<body>


{{-- HEADER --}}
<div class="header">
    <div class="nav-left">
        <a href="{{ route('accueil') }}">Accueil</a>
        <a href="#menu">Notre Menu</a>
        <a href="#categories">Catégories</a>
    </div>

    <a href="{{ route('accueil') }}" class="logo-center">
        <img src="{{ asset('images/logo.png') }}" alt="Logo ISI BURGER">
        <span class="brand">ISI <span>BURGER</span></span>
    </a>

    <div class="nav-right">
        <a href="#contact" class="nav-link">Contact</a>
        @auth
            <a href="{{ route('catalogue') }}" class="btn-order">
                <i class="bi bi-grid-fill"></i> Mon espace
            </a>
        @else
            <a href="{{ route('login') }}" class="btn-login">Se connecter</a>
            <a href="{{ route('register') }}" class="btn-order">
                <i class="bi bi-bag-fill"></i> Commander
            </a>
        @endauth
    </div>
</div>

{{-- HERO --}}
<div class="hero">
    <div class="hero-text">
        <div class="hero-badge">🔥 #1 Burger à Dakar</div>
        <h1>Les Meilleurs<br><span>Burgers</span><br>de Dakar</h1>
        <p>Faits maison avec des ingrédients frais.<br>Commandez en ligne, savourez maintenant !</p>
        <div class="hero-btns">
            @auth
                <a href="{{ route('catalogue') }}" class="btn-hero-primary">🛒 Commander maintenant</a>
            @else
                <a href="{{ route('register') }}" class="btn-hero-primary">🛒 Commander maintenant</a>
                <a href="#menu" class="btn-hero-secondary"><i class="bi bi-play-circle-fill"></i> Voir le menu</a>
            @endauth
        </div>
        <div class="hero-stats">
            <div>
                <div class="hero-stat-num">{{ \App\Models\Produit::where('archive',false)->count() }}+</div>
                <div class="hero-stat-label">Produits frais</div>
            </div>
            <div>
                <div class="hero-stat-num">{{ \App\Models\Commande::count() }}+</div>
                <div class="hero-stat-label">Commandes livrées</div>
            </div>
            <div>
                <div class="hero-stat-num">⭐ 4.9</div>
                <div class="hero-stat-label">Note clients</div>
            </div>
        </div>
    </div>
    <div class="hero-img">
        <img src="{{ asset('images/logo.png') }}" alt="ISI Burger">
    </div>
</div>

{{-- CATEGORIES --}}
<div class="section" id="categories">
    <div class="section-title">Nos Catégories</div>
    <div class="section-sub">Choisissez votre type de produit</div>
    <div style="display:flex; gap:12px; flex-wrap:wrap; margin-bottom:16px;">
        <a href="{{ route('accueil') }}" class="cat-pill {{ !request('categorie') ? 'active' : '' }}">
            Tout voir
        </a>
        @foreach($categories as $cat)
            <a href="{{ route('accueil', ['categorie' => $cat->id]) }}"
               class="cat-pill {{ request('categorie') == $cat->id ? 'active' : '' }}">
                {{ $cat->nom }} ({{ $cat->produits_count }})
            </a>
        @endforeach
    </div>
</div>

{{-- MENU --}}
<div class="section" id="menu" style="padding-top:0;">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
        <div>
            <div class="section-title">Notre Menu</div>
            <div class="section-sub">{{ $produits->total() }} produits disponibles</div>
        </div>
        {{-- Filtres --}}
        <form method="GET" action="{{ route('accueil') }}" style="display:flex; gap:10px;">
            <input type="text" name="nom" class="form-control" placeholder="Rechercher..."
                   value="{{ request('nom') }}" style="border-radius:10px; border:2px solid #e8e0d8;">
            <input type="number" name="prix_max" class="form-control" placeholder="Prix max"
                   value="{{ request('prix_max') }}" style="border-radius:10px; border:2px solid #e8e0d8; width:130px;">
            <button style="background:#ff6b35;color:white;border:none;border-radius:10px;padding:0 20px;font-weight:600;">
                Filtrer
            </button>
        </form>
    </div>

    <div class="row g-4">
        @forelse($produits as $p)
            <div class="col-md-4">
                <div class="produit-card">
                    @if($p->image)
                        <img src="{{ asset('storage/'.$p->image) }}" alt="{{ $p->nom }}">
                    @else
                        <div style="height:220px; background:linear-gradient(135deg,#1a1a2e,#2d1810);
                                display:flex; align-items:center; justify-content:center; font-size:5rem;">🍔</div>
                    @endif
                    <div class="produit-card-body">
                        <span class="cat-tag">{{ $p->categorie->nom }}</span>
                        <div class="produit-name">{{ $p->nom }}</div>
                        <div class="produit-desc">{{ Str::limit($p->description, 80) }}</div>
                        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
                            <span class="produit-price">{{ number_format($p->prix, 0, ',', ' ') }} FCFA</span>
                            <span class="badge bg-{{ $p->stock > 5 ? 'success' : ($p->stock > 0 ? 'warning' : 'danger') }}">
                            {{ $p->stock > 0 ? 'Dispo' : 'Rupture' }}
                        </span>
                        </div>
                        @auth
                            <a href="{{ route('menu', $p->id) }}" class="btn-add">Voir & Commander →</a>
                        @else
                            <a href="{{ route('login') }}" class="btn-add">Se connecter pour commander →</a>
                        @endauth
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted py-5">Aucun produit disponible</div>
        @endforelse
    </div>

    <div style="margin-top:32px;">{{ $produits->links() }}</div>
</div>


{{-- CONTACT --}}
<div id="contact" style="background:#1a1a2e; padding:60px 40px; color:white;">
    <div class="row">
        <div class="col-md-4">
            {{-- Logo au lieu du emoji --}}
            <div style="display:flex; align-items:center; gap:10px; margin-bottom:12px;">
                <img src="{{ asset('images/logo.png') }}" style="width:45px; height:45px; object-fit:contain;">
                <span style="color:white; font-weight:800; font-size:1.2rem;">ISI <span style="color:#ff6b35;">BURGER</span></span>
            </div>
            <p style="color:rgba(255,255,255,0.5); font-size:0.9rem;">Le meilleur burger de Dakar, fait avec passion et des ingrédients frais.</p>
            {{-- Réseaux sociaux --}}
            <div style="display:flex; gap:12px; margin-top:16px;">
                <a href="#" style="color:rgba(255,255,255,0.5); font-size:1.2rem;"><i class="bi bi-facebook"></i></a>
                <a href="#" style="color:rgba(255,255,255,0.5); font-size:1.2rem;"><i class="bi bi-instagram"></i></a>
                <a href="#" style="color:rgba(255,255,255,0.5); font-size:1.2rem;"><i class="bi bi-twitter-x"></i></a>
                <a href="#" style="color:rgba(255,255,255,0.5); font-size:1.2rem;"><i class="bi bi-tiktok"></i></a>
            </div>
        </div>
        <div class="col-md-4">
            <div style="font-weight:600; margin-bottom:12px;">Contact</div>
            <p style="color:rgba(255,255,255,0.5); font-size:0.9rem; margin:8px 0;">
                <i class="bi bi-geo-alt-fill" style="color:#ff6b35;"></i> Dakar, Sénégal
            </p>
            <p style="color:rgba(255,255,255,0.5); font-size:0.9rem; margin:8px 0;">
                <i class="bi bi-telephone-fill" style="color:#ff6b35;"></i> +221 33 800 80 80
            </p>
            <p style="color:rgba(255,255,255,0.5); font-size:0.9rem; margin:8px 0;">
                <i class="bi bi-envelope-fill" style="color:#ff6b35;"></i> contact@isiburger.com
            </p>
        </div>
        <div class="col-md-4">
            <div style="font-weight:600; margin-bottom:12px;">Horaires</div>
            <p style="color:rgba(255,255,255,0.5); font-size:0.9rem; margin:8px 0;">
                <i class="bi bi-clock-fill" style="color:#ff6b35;"></i> Lun - Ven : 10h - 23h
            </p>
            <p style="color:rgba(255,255,255,0.5); font-size:0.9rem; margin:8px 0;">
                <i class="bi bi-clock-fill" style="color:#ff6b35;"></i> Sam - Dim : 11h - 00h
            </p>
        </div>
    </div>
    <hr style="border-color:rgba(255,255,255,0.1); margin:32px 0;">
    <p style="text-align:center; color:rgba(255,255,255,0.3); font-size:0.85rem; margin:0;">
        © 2026 ISI BURGER — Tous droits réservés
    </p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
