@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit user - {{ $user->name }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

					<form action="{{ route('users.update', $user) }}" method="POST" class="col-md-13">
						@method('PUT')
						@csrf
						  <div class="form-group row">
						    <label for="inputName3" class="col-sm-2 col-form-label">Name</label>
						    <div class="col-sm-10">
						      <input type="name" class="form-control" name="name" id="inputName3" placeholder="Name" value="{{ $user->name }}">
						    </div>
						  </div>

						   <div class="form-group row">
						    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
						    <div class="col-sm-10">
						      <input type="email" class="form-control" name="email" id="inputEmail3" placeholder="Email" value="{{ $user->email }}">
						    </div>
						  </div>

						  <div class="form-group row">
						    <div class="col-sm-2">Roles</div>
						    <div class="col-sm-10">
						    @foreach ($roles as $role)
						      <div class="form-check">
							      	<input class="form-check-input" type="checkbox" name="roles[]" id="{{ $role->id }}" value="{{ $role->id }}"
																		      	 @foreach($user->roles as $role_user)
																		      	 	@if($role->id == $role_user->id)
																		      			checked
																					@endif
											 									@endforeach
											 									>
							        <label class="form-check-label" for="{{ $role->id }}">
							        	{{ $role->name }}
							        </label>
						      </div>
						    @endforeach
						    </div>
						  </div>

						  <div class="form-group row">
						    <div class="col-sm-2">Permissions</div>
						    <div class="col-sm-10">
						    @foreach ($permissions as $permission)
						      <div class="form-check">
							      	<input class="form-check-input" type="checkbox" name="permissions[]" id="{{ $permission->id }}" value="{{ $permission->id }}"
								      	 @foreach($user->permissions as $user_permission)
								      	 	@if($permission->id == $user_permission->id)
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
						    <label for="maxCountCheckLists" class="col-sm-2 col-form-label">Max count check lists</label>
						    <div class="col-sm-10">
						      <input type="number" class="form-control" name="maxCountCheckLists" id="maxCountCheckLists" placeholder="Number" value="{{ $user->max_count_check_lists }}"
																		@unlesspermission('edit-count-check-list')
																			disabled
																		@endpermission
																		>
						    </div>
						  </div>

						  <div class="form-group row">
						    <div class="col-sm-3">Activate/Block</div>
						    <div class="col-sm-9">
						    	@permission('user-block')
							      	<a class="btn btn-secondary btn-sm" href="{{ route('block', $user) }}" role="button">
							    @else
							    	<a class="btn btn-secondary btn-sm disabled" href="{{ route('block', $user) }}" role="button" aria-disabled="true">
							    @endpermission
							      	@if($user->active == 1)
										Block user
									@else
										Activate user
									@endif
								</a>
						      </div>
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