@extends('layouts.app')

@section('content')
    <h2>{{ $categorie->exists ? 'Modifier' : 'Ajouter' }} une catégorie</h2>

    <form action="{{ route($categorie->exists ? 'categorie.update' : 'categorie.store', $categorie->exists ? $categorie->id : []) }}" method="POST">
        @csrf
        @if($categorie->exists)
            @method('PUT')
        @endif

        <div class="mb-3">
            <label class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror"
                   value="{{ $categorie->exists ? $categorie->nom : old('nom') }}">
            @error('nom')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">
            {{ $categorie->exists ? 'Modifier' : 'Ajouter' }}
        </button>
        <a href="{{ route('categorie.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
@endsection
