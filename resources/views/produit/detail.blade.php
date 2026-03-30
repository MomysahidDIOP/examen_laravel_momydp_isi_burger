@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6">
            @if($produit->image)
                <img src="{{ asset('storage/'.$produit->image) }}"
                     style="width:100%; border-radius:16px; object-fit:cover; max-height:400px;">
            @else
                <div style="height:400px; background:linear-gradient(135deg,#1a1a2e,#2d1810);
                    border-radius:16px; display:flex; align-items:center;
                    justify-content:center; font-size:8rem;">🍔</div>
            @endif
        </div>

        <div class="col-md-6">
        <span style="background:#fff3e8;color:#ff6b35;padding:4px 12px;
                     border-radius:20px;font-size:0.8rem;font-weight:600;">
            {{ $produit->categorie->nom }}
        </span>

            <h1 class="fw-bold mt-3" style="color:#1a1a2e;">{{ $produit->nom }}</h1>
            <p class="text-muted">{{ $produit->description }}</p>

            <div style="font-size:2rem; font-weight:700; color:#ff6b35; margin:16px 0;">
                {{ number_format($produit->prix, 0, ',', ' ') }} FCFA
            </div>

            <div class="mb-4">
            <span class="badge bg-{{ $produit->stock > 5 ? 'success' : ($produit->stock > 0 ? 'warning' : 'danger') }} fs-6">
                {{ $produit->stock > 0 ? 'En stock ('.$produit->stock.')' : 'Rupture de stock' }}
            </span>
            </div>

            @if($produit->stock > 0)
                <form action="{{ route('panier.ajouter', $produit->id) }}" method="POST">
                    @csrf
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <label class="fw-bold">Quantité :</label>
                        <input type="number" name="quantite" value="1" min="1" max="{{ $produit->stock }}"
                               class="form-control" style="width:100px;">
                    </div>
                    <div class="d-flex gap-3 flex-wrap">
                        <button type="submit" style="background:linear-gradient(135deg,#ff6b35,#f7931e);
                            color:white; border:none; border-radius:12px; padding:14px 32px;
                            font-weight:700; font-size:1rem; cursor:pointer;">
                            Ajouter au panier
                        </button>
                        <a href="{{ route('panier.index') }}" style="background:#1a1a2e;
                       color:white; border-radius:12px; padding:14px 24px;
                       font-weight:600; text-decoration:none; display:inline-flex; align-items:center;">
                            Voir mon panier
                        </a>
                    </div>
                </form>
            @endif

            <a href="{{ route('catalogue') }}" class="btn btn-outline-secondary mt-3">
                Retour au catalogue
            </a>
        </div>
    </div>
@endsection
