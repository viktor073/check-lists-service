@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">List users</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
					{{--<a class="btn btn-primary btn-block" href="{{ route('users.create') }}" role="button">Create user</a>--}}
					<table class="table table-striped">
						<thead>
							<tr>
					      		<th scope="col">ID</th>
							    <th scope="col">Name</th>
							    <th scope="col">E-Mail</th>
							    <th scope="col">Roles</th>
					    	</tr>
						</thead>
				  		<tbody>
				  			@foreach ($users as $user)
						    	<tr>
						      		<th scope="row">
						      			<a class="nav-link" href="{{ route('users.show', $user) }}">{{ $user->id }}</a>
						      		</th>
								    <td>
								    	<a class="nav-link" href="{{ route('users.show', $user)}}">{{ $user->name }}</a>
								    </td>
								    <td>{{ $user->email }}</td>
								    <td>
								    	@foreach ($user->roles as $role)
								    		{{ $role->name }} <br>
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