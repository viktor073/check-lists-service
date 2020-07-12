@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Info user</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

					<a class="btn btn-primary btn-block" href="{{ route('users.edit', $user) }}" role="button">Edit</a><br>

					<table class="table table-striped">
				  		<tbody>
					    	<tr>
					      		<th scope="col">ID</th>
							    <td>{{ $user->id }}</td>
							</tr>
							<tr>
							    <th scope="col">Name</th>
							   	<td>{{ $user->name }}</td>
							</tr>
							<tr>
							    <th scope="col">E-mail</th>
							    <td>{{ $user->email }}</td>
							</tr>
							<tr>
								<th scope="col">Role</th>
							    <td>@foreach ($user->roles as $role)
								    	{{ $role->name }} <br>
								    @endforeach
								</td>
							</tr>

							<tr>
								<th scope="col">Max count check lists</th>
							    <td>{{ $user->max_count_check_lists }}</td>
					   		</tr>

							<tr>
								<th scope="col">Active</th>
							    <td>{{ $user->active }}</td>
					   		</tr>
						</tbody>
					</table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection