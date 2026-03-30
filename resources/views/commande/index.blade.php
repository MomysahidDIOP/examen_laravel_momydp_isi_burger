@extends('layouts.app')

@section('content')
    <h2 class="mb-4">Toutes les commandes</h2>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Client</th>
            <th>Statut</th>
            <th>Total</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($commandes as $c)
            <tr>
                <td>{{ $c->id }}</td>
                <td>{{ $c->user->name }}</td>
                <td>
                <span class="badge bg-{{ $c->statut == 'payee' ? 'success' : ($c->statut == 'prete' ? 'primary' : ($c->statut == 'en_preparation' ? 'info' : 'warning')) }}">
                    {{ ucfirst(str_replace('_', ' ', $c->statut)) }}
                </span>
                </td>
                <td>{{ number_format($c->ligneCommandes->sum(fn($l) => $l->quantite * $l->prix_unitaire), 0, ',', ' ') }} FCFA</td>
                <td>{{ $c->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    <form action="{{ route('commande.statut', $c->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <select name="statut" class="form-select form-select-sm d-inline w-auto" onchange="this.form.submit()">
                            <option value="en_attente"     {{ $c->statut == 'en_attente' ? 'selected' : '' }}>En attente</option>
                            <option value="en_preparation" {{ $c->statut == 'en_preparation' ? 'selected' : '' }}>En préparation</option>
                            <option value="prete"          {{ $c->statut == 'prete' ? 'selected' : '' }}>Prête</option>
                            <option value="payee"          {{ $c->statut == 'payee' ? 'selected' : '' }}>Payée</option>
                        </select>
                    </form>

                    @if(!$c->paiement && $c->statut != 'payee')
                        <form action="{{ route('paiement.store') }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="commande_id" value="{{ $c->id }}">
                            <input type="hidden" name="montant" value="{{ $c->ligneCommandes->sum(fn($l) => $l->quantite * $l->prix_unitaire) }}">
                            <button class="btn btn-success btn-sm" onclick="return confirm('Enregistrer le paiement ?')">💰 Payer</button>
                        </form>
                    @endif

                    <form action="{{ route('commande.destroy', $c->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Annuler ?')">Annuler</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6" class="text-center">Aucune commande</td></tr>
        @endforelse
        </tbody>
    </table>
    {{ $commandes->links() }}
@endsection
