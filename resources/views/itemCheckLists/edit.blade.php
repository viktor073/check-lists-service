@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit itemCheckList - {{ $itemCheckList->name }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

					<form action="{{ route('itemCheckLists.update', $itemCheckList) }}" method="POST" class="col-md-13">
						@method('PUT')
						@csrf
						  <div class="form-group row">
						    <label for="inputName3" class="col-sm-2 col-form-label">Name</label>
						    <div class="col-sm-10">
						      <input type="name" class="form-control" name="name" id="inputName3" placeholder="Name" value="{{ $itemCheckList->name }}">
						    </div>
						  </div>

						   <div class="form-group row">
						    <label for="inputEmail3" class="col-sm-2 col-form-label">Slug</label>
						    <div class="col-sm-10">
						      <input type="slug" class="form-control" name="slug" id="inputEmail3" placeholder="Slug" value="{{ $itemCheckList->slug }}">
						    </div>
						  </div>

						  <div class="form-group row">
						    <div class="col-sm-10">
						      <button type="submit" class="btn btn-primary">Sign in</button>
						    </div>
						  </div>

					</form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection