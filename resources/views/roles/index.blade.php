@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">List roles</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
					<a class="btn btn-primary btn-block" href="{{ route('roles.create') }}" role="button" >Create role</a>
					<table class="table table-striped">
						<thead>
							<tr>
					      		<th scope="col">ID</th>
							    <th scope="col">Name</th>
							    <th scope="col">Slug</th>
							    <th scope="col">Permissions</th>
					    	</tr>
						</thead>
				  		<tbody>
				  			@foreach ($roles as $role)
						    	<tr>
						      		<th scope="row">
						      			<a class="nav-link" href="{{ route('roles.show', $role) }}">{{ $role->id }}</a>
						      		</th>
								    <td>
								    	<a class="nav-link" href="{{ route('roles.show', $role)}}">{{ $role->name }}</a>
								    </td>
								    <td>{{ $role->slug }}</td>
								    <td>
								    	@foreach ($role->permissions as $permission)
								    		{{ $permission->name }} <br>
								    	@endforeach
								    </td>
						   		</tr>
					   		@endforeach
						</tbody>
					</table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection