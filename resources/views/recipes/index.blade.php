@extends('layouts.app')

@php
    $firstRowPosition = $recipes->currentPage() * $recipes->perPage() - $recipes->perPage() + 1;
@endphp

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Lista przepisów</div>

                <div class="card-body">
                    @if (!count($recipes))
                        <div class="alert">
                            Brak przepisów!
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
                                @foreach ($recipes as $recipe)
                                    <tr>
                                        <td>{{ $firstRowPosition++ }}</td>
                                        <td>{{ $recipe->name }}</td>
                                        <td>
                                            <a href="/admin/recipes/{{ $recipe->id }}" class="btn btn-primary">Edytuj</a>
                                        </td>
                                        <td>
                                            <form action="/admin/recipes/{{ $recipe->id }}" method="POST">
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
                    {{ $recipes->links() }}
                </div>
            
            </div>
        </div>
    </div>
</div>
@endsection