@extends('layouts.app')

@section('content')
    <h2>{{ $produit->exists ? 'Modifier' : 'Ajouter' }} un burger</h2>

    <form action="{{ route($produit->exists ? 'produit.update' : 'produit.store', $produit->exists ? $produit->id : []) }}"
          method="POST" enctype="multipart/form-data">
        @csrf
        @if($produit->exists)
            @method('PUT')
        @endif

        <div class="mb-3">
            <label class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror"
                   value="{{ $produit->exists ? $produit->nom : old('nom') }}">
            @error('nom')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control">{{ $produit->exists ? $produit->description : old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Prix (FCFA)</label>
            <input type="number" name="prix" class="form-control @error('prix') is-invalid @enderror"
                   value="{{ $produit->exists ? $produit->prix : old('prix') }}">
            @error('prix')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Stock</label>
            <input type="number" name="stock" class="form-control"
                   value="{{ $produit->exists ? $produit->stock : old('stock', 0) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Catégorie</label>
            <select name="categorie_id" class="form-control @error('categorie_id') is-invalid @enderror">
                <option value="">-- Choisir --</option>
                @foreach($categories as $c)
                    <option value="{{ $c->id }}" {{ ($produit->exists && $produit->categorie_id == $c->id) ? 'selected' : '' }}>
                        {{ $c->nom }}
                    </option>
                @endforeach
            </select>
            @error('categorie_id')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Image</label>
            @if($produit->exists && $produit->image)
                <img src="{{ asset('storage/'.$produit->image) }}" width="80" class="d-block mb-2">
            @endif
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-success">
            {{ $produit->exists ? 'Modifier' : 'Ajouter' }}
        </button>
        <a href="{{ route('produit.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
@endsection
