@extends('layouts.app')

@section('content')
    <h2 class="mb-4">Mes commandes</h2>

    @forelse($commandes as $c)
        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between">
                <span>Commande #{{ $c->id }}</span>
                <span class="badge bg-{{ $c->statut == 'payee' ? 'success' : ($c->statut == 'prete' ? 'primary' : 'warning') }}">
                    {{ ucfirst(str_replace('_', ' ', $c->statut)) }}
                </span>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                    <tr>
                        <th>Burger</th>
                        <th>Quantité</th>
                        <th>Prix unitaire</th>
                        <th>Sous-total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($c->ligneCommandes as $ligne)
                        <tr>
                            <td>{{ $ligne->produit->nom }}</td>
                            <td>{{ $ligne->quantite }}</td>
                            <td>{{ number_format($ligne->prix_unitaire, 0, ',', ' ') }} FCFA</td>
                            <td>{{ number_format($ligne->quantite * $ligne->prix_unitaire, 0, ',', ' ') }} FCFA</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <p class="fw-bold text-end">
                    Total : {{ number_format($c->ligneCommandes->sum(fn($l) => $l->quantite * $l->prix_unitaire), 0, ',', ' ') }} FCFA
                </p>
            </div>

            {{-- ✅ Nouveau footer avec bouton facture --}}
            <div class="card-footer d-flex justify-content-between align-items-center">
                <span class="text-muted small">Passée le {{ $c->created_at->format('d/m/Y à H:i') }}</span>
                <a href="{{ route('commande.facture', $c->id) }}" class="btn btn-sm"
                   style="background:#ff6b35; color:white; border-radius:8px;">
                    📄 Télécharger facture
                </a>
            </div>
        </div>
    @empty
        <div class="alert alert-info">Vous n'avez pas encore de commandes.</div>
    @endforelse

    {{ $commandes->links() }}
@endsection
