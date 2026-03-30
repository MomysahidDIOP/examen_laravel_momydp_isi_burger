@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Catégories</h2>
        <a href="{{ route('categorie.create') }}" class="btn btn-success">+ Ajouter</a>
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Id</th>
            <th>Nom</th>
            <th>Produits</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $c)
            <tr>
                <td>{{ $c->id }}</td>
                <td>{{ $c->nom }}</td>
                <td>{{ $c->produits->count() }}</td>
                <td>
                    <a href="{{ route('categorie.edit', $c->id) }}" class="btn btn-primary btn-sm">Modifier</a>
                    <form action="{{ route('categorie.destroy', $c->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
