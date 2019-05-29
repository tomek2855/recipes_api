@extends('layouts.app')

@section('content')
<div class="container">

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
                <div class="card-header">Edytuj składnik</div>

                <div class="card-body">
                	<form action="/admin/items/{{ $item->id }}" method="POST">
                    	@csrf
                        @method('PUT')
                    	<div class="form-group">
						    <label for="name">Nazwa składnika</label>
						    <input type="text" class="form-control" id="name" name="name" aria-describedby="nazwaSkładnika" value="{{ $item->name }}" autofocus="autofocus">
						</div>
				    	<button type="submit" class="btn btn-primary">Zapisz</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
