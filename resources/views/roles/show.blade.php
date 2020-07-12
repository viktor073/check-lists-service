@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Info role</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

					<a class="btn btn-primary btn-block" href="{{ route('roles.edit', $role) }}" role="button">Edit</a><br>

					<table class="table table-striped">
				  		<tbody>
					    	<tr>
					      		<th scope="col">ID</th>
							    <td>{{ $role->id }}</td>
							</tr>
							<tr>
							    <th scope="col">Name</th>
							   	<td>{{ $role->name }}</td>
							</tr>
							<tr>
							    <th scope="col">Slug</th>
							    <td>{{ $role->slug }}</td>
							</tr>
							<tr>
								<th scope="col">Permissions</th>
							    <td>@foreach ($role->permissions as $permission)
								    	{{ $permission->name }} <br>
								    @endforeach
								</td>
							</tr>
						</tbody>
					</table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection