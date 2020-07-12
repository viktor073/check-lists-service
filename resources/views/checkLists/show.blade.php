@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Info Check List</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
					@if (session('error'))
                        <div class="alert alert-success" role="error">
                            {{ session('error') }}
                        </div>
                    @endif

					<a class="btn btn-primary btn-block" href="{{ route('checkLists.edit', $checkList) }}" role="button">Edit</a><br>

					<a class="btn btn-outline-primary" href="{{ route('checkLists.itemCheckLists.create', $checkList) }}" role="button">Add new item for this check list</a>

					<table class="table table-striped">
				  		<tbody>
					    	<tr>
					      		<th scope="col">ID</th>
							    <td>{{ $checkList->id }}</td>
							</tr>
							<tr>
							    <th scope="col">Name</th>
							   	<td>{{ $checkList->name }}</td>
							</tr>
							<tr>
							    <th scope="col">Slug</th>
							    <td>{{ $checkList->slug }}</td>
							</tr>
							<tr>
								<th scope="col">Item checkList</th>
							    <td>@foreach ($checkList->itemCheckLists as $itemCheckList)
					        			<a class="nav-link" href="{{ route('itemCheckLists.show', $itemCheckList) }}">
					        				{{ $itemCheckList->name ?? 'not value' }}
						        			@if($itemCheckList->done != 0)
												 - Done
											@endif
										</a>
								    @endforeach
								</td>
							</tr>
						</tbody>
					</table>
					<form action="{{ route('checkLists.destroy', $checkList) }}" method="POST" class="col-md-13">
						@method('DELETE')
						@csrf

						<div class="col-sm-10">
					      <button type="submit" class="btn btn-danger">Delete this Check List</button>
					    </div>
					</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection