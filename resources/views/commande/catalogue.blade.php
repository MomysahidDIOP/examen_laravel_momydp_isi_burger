@extends('layouts.app')

@section('content')

    <style>
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
    </style>
    {{-- HERO BANNER --}}
    <div style="
    background: linear-gradient(135deg, #1a1a2e 0%, #2d1810 100%);
    border-radius: 20px;
    padding: 50px 40px;
    margin-bottom: 32px;
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: space-between;
">
        {{-- Cercle décoratif --}}
        <div style="
        position:absolute; right:-60px; top:-60px;
        width:300px; height:300px;
        background: rgba(255,107,53,0.12);
        border-radius: 50%;
    "></div>
        <div style="
        position:absolute; right:60px; bottom:-80px;
        width:200px; height:200px;
        background: rgba(255,107,53,0.08);
        border-radius: 50%;
    "></div>

        {{-- Texte --}}
        <div style="z-index:1;">
            <div style="
            background: rgba(255,107,53,0.2);
            color: #ff6b35;
            display: inline-block;
            padding: 4px 14px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 12px;
            border: 1px solid rgba(255,107,53,0.3);
        ">🔥 Spécialités du jour</div>

            <h1 style="color:white; font-weight:700; font-size:2.2rem; margin-bottom:8px; line-height:1.2;">
                Les Meilleurs<br>
                <span style="color:#ff6b35;">Burgers de Dakar</span>
            </h1>
            <p style="color:rgba(255,255,255,0.6); margin-bottom:20px; font-size:0.95rem;">
                Faits maison, livrés chauds. Commandez maintenant !
            </p>
            <div style="display:flex; gap:20px;">
                <div style="text-align:center;">
                    <div style="color:#ff6b35; font-weight:700; font-size:1.3rem;">
                        {{ \App\Models\Produit::where('archive',false)->count() }}
                    </div>
                    <div style="color:rgba(255,255,255,0.5); font-size:0.75rem;">Produits</div>
                </div>
                <div style="width:1px; background:rgba(255,255,255,0.1);"></div>
                <div style="text-align:center;">
                    <div style="color:#ff6b35; font-weight:700; font-size:1.3rem;">
                        {{ \App\Models\Categorie::count() }}
                    </div>
                    <div style="color:rgba(255,255,255,0.5); font-size:0.75rem;">Catégories</div>
                </div>
                <div style="width:1px; background:rgba(255,255,255,0.1);"></div>
                <div style="text-align:center;">
                    <div style="color:#ff6b35; font-weight:700; font-size:1.3rem;">⭐ 4.9</div>
                    <div style="color:rgba(255,255,255,0.5); font-size:0.75rem;">Note</div>
                </div>
            </div>
        </div>

        {{-- Burger emoji géant --}}
        <div style="z-index:1; border-radius: 20px; overflow: hidden; box-shadow: 0 20px 50px rgba(0,0,0,0.5);">
            <img src="{{ asset('images/img1.png') }}"
                 alt="ISI Burger Special"
                 style="width: 350px; height: 450px; object-fit: cover; animation: float 4s ease-in-out infinite;">
        </div>
    </div>

    {{-- Filtres --}}
    <form method="GET" action="{{ route('catalogue') }}" class="row g-2 mb-4">
        <div class="col-md-4">
            <input type="text" name="nom" class="form-control" placeholder="🔍 Rechercher un burger..."
                   value="{{ request('nom') }}">
        </div>
        <div class="col-md-3">
            <input type="number" name="prix_max" class="form-control" placeholder="Prix max (FCFA)"
                   value="{{ request('prix_max') }}">
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary w-100">Filtrer</button>
        </div>
        <div class="col-md-2">
            <a href="{{ route('catalogue') }}" class="btn btn-outline-secondary w-100">Réinitialiser</a>
        </div>
    </form>

    {{-- Titre section --}}
    <h5 class="fw-bold mb-3" style="color:#1a1a2e;">
        🍔 Notre Menu
        <span class="badge ms-2" style="background:#ff6b35; font-size:0.75rem;">
        {{ $produits->total() }} produits
    </span>
    </h5>

    {{-- Formulaire de commande --}}
    <form action="{{ route('commande.store') }}" method="POST">
        @csrf
        <div class="row">
            @forelse($produits as $p)
                <div class="col-md-4 mb-4">
                    <div class="card h-100" style="border-radius:16px; overflow:hidden; transition: transform 0.2s, box-shadow 0.2s;"
                         onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 12px 30px rgba(0,0,0,0.12)'"
                         onmouseout="this.style.transform='';this.style.boxShadow=''">

                        {{-- Image --}}
                        @if($p->image)
                            <img src="{{ asset('storage/'.$p->image) }}"
                                 style="height:200px; object-fit:cover; width:100%;">
                        @else
                            <div style="
                        height:200px;
                        background: linear-gradient(135deg, #1a1a2e, #2d1810);
                        display:flex; align-items:center; justify-content:center;
                        font-size:4rem;
                    ">🍔</div>
                        @endif

                        <div class="card-body p-3">
                            {{-- Badge catégorie --}}
                            <span style="
                        background:#fff3e8; color:#ff6b35;
                        font-size:0.7rem; font-weight:600;
                        padding:2px 8px; border-radius:10px;
                        display:inline-block; margin-bottom:6px;
                    ">{{ $p->categorie->nom }}</span>

                            <a href="{{ route('menu', $p->id) }}" style="text-decoration:none; color:#1a1a2e;">
                                <h6 class="fw-bold mb-1">{{ $p->nom }}</h6>
                            </a>
                            <p class="text-muted small mb-2" style="font-size:0.8rem;">{{ $p->description }}</p>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                        <span style="color:#ff6b35; font-weight:700; font-size:1.1rem;">
                            {{ number_format($p->prix, 0, ',', ' ') }} FCFA
                        </span>
                                <span class="badge bg-{{ $p->stock > 5 ? 'success' : ($p->stock > 0 ? 'warning' : 'danger') }}">
                            {{ $p->stock > 0 ? 'Stock: '.$p->stock : 'Rupture' }}
                        </span>
                            </div>

                            {{-- Checkbox + quantité --}}
                            <div style="
                        background:#fff8f0; border-radius:10px;
                        padding:8px 12px;
                        display:flex; align-items:center; gap:10px;
                    ">
                                <input type="checkbox" name="produits[]" value="{{ $p->id }}"
                                       id="p{{ $p->id }}"
                                       style="width:18px;height:18px;accent-color:#ff6b35;">
                                <label for="p{{ $p->id }}" class="mb-0 small fw-600">Ajouter</label>
                                <input type="number" name="quantites[]" value="1" min="1" max="{{ $p->stock }}"
                                       class="form-control form-control-sm ms-auto"
                                       style="width:70px; border-color:#ff6b35;">
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">Aucun burger disponible pour le moment.</div>
                </div>
            @endforelse
        </div>

        @if($produits->count() > 0)
            <div style="
        position: sticky; bottom: 20px;
        background: linear-gradient(135deg, #ff6b35, #f7931e);
        border-radius: 16px;
        padding: 16px 24px;
        display: flex; align-items: center; justify-content: space-between;
        box-shadow: 0 8px 30px rgba(255,107,53,0.4);
        margin-top: 16px;
    ">
                <div style="color:white;">
                    <div style="font-weight:700; font-size:1.1rem;">Prêt à commander ?</div>
                    <div style="opacity:0.85; font-size:0.85rem;">Cochez vos burgers et validez</div>
                </div>
                <button type="submit" style="
            background:white; color:#ff6b35;
            border:none; border-radius:12px;
            padding:12px 28px; font-weight:700; font-size:1rem;
            cursor:pointer;
        ">
                    🛒 Commander maintenant
                </button>
            </div>
        @endif
    </form>

    {{ $produits->links() }}
@endsection
