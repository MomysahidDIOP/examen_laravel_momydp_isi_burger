@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Burgers</h2>
        <a href="{{ route('produit.create') }}" class="btn btn-success">+ Ajouter</a>
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Image</th>
            <th>Nom</th>
            <th>Prix</th>
            <th>Stock</th>
            <th>Catégorie</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($produits as $p)
            <tr>
                <td>
                    @if($p->image)
                        <img src="{{ asset('storage/'.$p->image) }}" width="60">
                    @else
                        —
                    @endif
                </td>
                <td>{{ $p->nom }}</td>
                <td>{{ number_format($p->prix, 0, ',', ' ') }} FCFA</td>
                <td>
                <span class="badge {{ $p->stock > 0 ? 'bg-success' : 'bg-danger' }}">
                    {{ $p->stock }}
                </span>
                </td>
                <td>{{ $p->categorie->nom }}</td>
                <td>
                    <a href="{{ route('produit.edit', $p->id) }}" class="btn btn-primary btn-sm">Modifier</a>
                    <form action="{{ route('produit.destroy', $p->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $produits->links() }}
@endsection
