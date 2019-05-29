@extends('layouts.app')

@php
    $firstRowPosition = $items->currentPage() * $items->perPage() - $items->perPage() + 1;
@endphp

@section('content')
<div class="container">

    @if (\Request::get('deleteError'))
        <div class="alert alert-danger" role="alert">
            Conajmniej jeden z przepisów zawiera ten składnik!
        </div>
    @endif

    @if (!empty($errors->all()))
        <div class="alert alert-danger" role="alert">
            @foreach ($errors->all() as $error)
                {{ $error }} <br>
            @endforeach
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Lista składników</div>

                <div class="card-body">
                    @if (!count($items))
                        <div class="alert">
                            Brak sładników!
                        </div>
                    @else
                        <table class="table table-striped">
                            <thead class="thead-gray">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nazwa</th>
                                    <th scope="col">Opcje</th>
                                    <th scope="col"></th>
                                </tr>
                                @foreach ($items as $item)
                                    <tr>
                                        <td>{{ $firstRowPosition++ }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <a href="/admin/items/{{ $item->id }}" class="btn btn-primary">Edytuj</a>
                                        </td>
                                        <td>
                                            <form action="/admin/items/{{ $item->id }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger">Usuń</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </thead>
                            
                        </table>
                    @endif
                </div>

                <div style="padding-left: 25px;">
                    {{ $items->links() }}
                </div>    
            </div>
        </div>
    </div>
</div>
@endsection