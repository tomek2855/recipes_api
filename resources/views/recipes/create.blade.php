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
                <div class="card-header">Dodaj przepis</div>

                <div class="card-body">
                	<form action="/admin/recipes" method="POST">
                    	@csrf
                    	<div class="form-group">
						    <label for="name">Nazwa przepisu</label>
						    <input type="text" class="form-control" id="name" name="name" aria-describedby="nazwaSkładnika" autofocus="autofocus">
						</div>
				    	<button type="submit" class="btn btn-primary">Zapisz i dodaj składniki</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
