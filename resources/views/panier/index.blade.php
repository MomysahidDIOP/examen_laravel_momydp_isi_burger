@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">🛒 Mon Panier</h2>
        <a href="{{ route('catalogue') }}" class="btn btn-outline-secondary">
            ← Continuer mes achats
        </a>
    </div>

    @if(empty($panier))
        <div class="text-center py-5">
            <div style="font-size:5rem;">🛒</div>
            <h4 class="text-muted mt-3">Votre panier est vide</h4>
            <a href="{{ route('catalogue') }}" class="btn mt-3"
               style="background:#ff6b35; color:white; border-radius:10px; padding:12px 28px; font-weight:600;">
                Voir le catalogue
            </a>
        </div>
    @else
        <div class="row">
            <div class="col-md-8">
                <div class="card p-4">
                    @foreach($panier as $id => $item)
                        <div class="d-flex align-items-center gap-3 mb-3 pb-3"
                             style="border-bottom: 1px solid #fff3e8;">
                            {{-- Image --}}
                            @if($item['image'])
                                <img src="{{ asset('storage/'.$item['image']) }}"
                                     style="width:80px; height:80px; border-radius:12px; object-fit:cover;">
                            @else
                                <div style="width:80px; height:80px; background:linear-gradient(135deg,#1a1a2e,#2d1810);
                                    border-radius:12px; display:flex; align-items:center;
                                    justify-content:center; font-size:2rem;">🍔</div>
                            @endif

                            {{-- Nom + prix --}}
                            <div class="flex-grow-1">
                                <div class="fw-bold">{{ $item['nom'] }}</div>
                                <div style="color:#ff6b35; font-weight:700;">
                                    {{ number_format($item['prix'], 0, ',', ' ') }} FCFA
                                </div>
                            </div>

                            {{-- Quantité --}}
                            <form action="{{ route('panier.modifier', $id) }}" method="POST" class="d-flex align-items-center gap-2">
                                @csrf @method('PATCH')
                                <input type="number" name="quantite" value="{{ $item['quantite'] }}"
                                       min="1" class="form-control" style="width:70px; border-color:#ff6b35;">
                                <button class="btn btn-sm btn-outline-secondary">OK</button>
                            </form>

                            {{-- Sous-total --}}
                            <div class="fw-bold" style="min-width:100px; text-align:right;">
                                {{ number_format($item['prix'] * $item['quantite'], 0, ',', ' ') }} FCFA
                            </div>

                            {{-- Supprimer --}}
                            <form action="{{ route('panier.supprimer', $id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">✕</button>
                            </form>
                        </div>
                    @endforeach

                    {{-- Vider panier --}}
                    <form action="{{ route('panier.vider') }}" method="POST" class="text-end mt-2">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger">🗑 Vider le panier</button>
                    </form>
                </div>
            </div>

            {{-- Résumé --}}
            <div class="col-md-4">
                <div class="card p-4">
                    <h5 class="fw-bold mb-3">Résumé de la commande</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Sous-total</span>
                        <span>{{ number_format($total, 0, ',', ' ') }} FCFA</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted">Livraison</span>
                        <span style="color:#10b981;">Gratuite</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-4">
                        <span class="fw-bold">Total</span>
                        <span class="fw-bold" style="color:#ff6b35; font-size:1.2rem;">
                        {{ number_format($total, 0, ',', ' ') }} FCFA
                    </span>
                    </div>
                    <form action="{{ route('panier.commander') }}" method="POST">
                        @csrf
                        <button type="submit" style="
                        background:linear-gradient(135deg,#ff6b35,#f7931e);
                        color:white; border:none; border-radius:12px;
                        padding:14px; width:100%; font-weight:700; font-size:1rem;
                        cursor:pointer;">
                            Passer la commande →
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endsection
