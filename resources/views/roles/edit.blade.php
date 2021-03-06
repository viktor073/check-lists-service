@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit role - {{ $role->name }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

					<form action="{{ route('roles.update', $role) }}" method="POST" class="col-md-13">
						@method('PUT')
						@csrf
						  <div class="form-group row">
						    <label for="inputName3" class="col-sm-2 col-form-label">Name</label>
						    <div class="col-sm-10">
						      <input type="name" class="form-control" name="name" id="inputName3" placeholder="Name" value="{{ $role->name }}">
						    </div>
						  </div>

						   <div class="form-group row">
						    <label for="inputEmail3" class="col-sm-2 col-form-label">Slug</label>
						    <div class="col-sm-10">
						      <input type="slug" class="form-control" name="slug" id="inputEmail3" placeholder="Slug" value="{{ $role->slug }}" disabled>
						    </div>
						  </div>

						  <div class="form-group row">
						    <div class="col-sm-2">Permissions</div>
						    <div class="col-sm-10">
						    @foreach ($permissions as $permission)
						      <div class="form-check">
							      	<input class="form-check-input" type="checkbox" name="permissions[]" id="{{ $permission->id }}" value="{{ $permission->id }}"
								      	 @foreach($role->permissions as $role_permission)
								      	 	@if($permission->id == $role_permission->id)
								      			checked
											@endif
	 									@endforeach
	 								>
							        <label class="form-check-label" for="{{ $permission->id }}">
							        	{{ $permission->name }}
							        </label>
						      </div>
						    @endforeach
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