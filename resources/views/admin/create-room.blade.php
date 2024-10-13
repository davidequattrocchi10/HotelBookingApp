@extends('layouts.app')

@section('title', 'Aggiungi Nuova Camera')

@section('content')
<div class="container">
    <h1 class="text-3xl font-bold mb-6">Aggiungi Nuova Camera</h1>

    <form action="{{ route('admin.store-room') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-3">
            <label for="nome" class="form-label">Nome Camera</label>
            <input type="text" name="nome" id="nome" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="descrizione" class="form-label">Descrizione</label>
            <textarea name="descrizione" id="descrizione" class="form-control" rows="3" required></textarea>
        </div>

        <div class="form-group mb-3">
            <label for="prezzo" class="form-label">Prezzo</label>
            <input type="number" name="prezzo" id="prezzo" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="immagine">Immagine della Camera</label>
            <input type="file" class="form-control" id="immagine" name="immagine">
        </div>

        <div class="form-group mb-3">
            <label for="disponibile" class="form-label">Disponibile</label>
            <select name="disponibile" id="disponibile" class="form-control" required>
                <option value="1">Sì</option>
                <option value="0">No</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Aggiungi Camera</button>
    </form>

    <!-- Link per tornare alla dashboard e alla home -->
    <a href="{{ route('admin.index') }}" class="btn btn-secondary mt-4">Torna alla Dashboard di Amministrazione</a>
    <a href="/" class="btn btn-primary mt-4">Torna alla home</a>
</div>
@endsection