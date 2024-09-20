@extends('layouts.app')

@section('title', 'Gestione Camere')

@section('content')
<h1>Gestione Camere</h1>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Descrizione</th>
            <th>Prezzo</th>
            <th>Azioni</th>
        </tr>
    </thead>
    <tbody>
        @foreach($rooms as $room)
        <tr>
            <td>{{ $room->nome }}</td>
            <td>{{ $room->descrizione }}</td>
            <td>{{ $room->prezzo }}</td>
            <td>
                <!-- Bottone modifica collegato alla vista di modifica -->
                <a href="{{ route('admin.edit-room', $room->id) }}" class="btn btn-sm btn-warning">Modifica</a>
                <!-- Bottone elimina collegato alla funzione di eliminazione -->
                <a href="{{ route('admin.delete-room', $room->id) }}" class="btn btn-sm btn-danger"
                    onclick="return confirm('Sei sicuro di voler eliminare questa camera?')">Elimina</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<!-- Bottone per aggiungere una nuova camera collegato alla vista di creazione -->
<a href="{{ route('admin.add-room') }}" class="btn btn-success mt-4">Aggiungi Nuova Camera</a>


<!-- Link per tornare alla dashboard e alla home -->
<a href="{{ route('admin.index') }}" class="btn btn-secondary mt-4">Torna alla Dashboard di Amministrazione</a>
<a href="/" class="btn btn-primary mt-4">Torna alla home</a>
@endsection