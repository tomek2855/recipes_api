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
                	<form action="/admin/recipes/{{ $recipe->id }}" method="POST">
                    	@csrf
                        @method('PUT')
                    	<div class="form-group">
						    <label for="name">Nazwa składnika</label>
						    <input type="text" class="form-control" id="name" name="name" aria-describedby="nazwaSkładnika" value="{{ $recipe->name }}" autofocus="autofocus">
						</div>

                        <hr>

                        <h5>Składniki:</h5>
                            <select id="items" name="items[]" multiple="multiple" style="min-width: 450px;">
                                @foreach ($recipe->items as $item)
                                    <option value="{{ $item->id }}" selected="selected">{{ $item->name }}</option>
                                @endforeach
                            </select>

                        <hr>

                        <h5>Opis:</h5>
                            <div class="form-group">
                                <textarea class="form-control" rows="5" id="content" name="content">{{ $recipe->content }}</textarea>
                            </div>

				    	<button type="submit" class="btn btn-primary">Zapisz</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#items').select2({
                ajax: {
                    url: '/api/items',
                    dataType: 'json'
                }
            });
        });
    </script>
@endsection