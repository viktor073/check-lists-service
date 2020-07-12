@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Check List</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
					<a class="btn btn-primary btn-block" href="{{ route('checkLists.create') }}" role="button" >Create check list</a>
					<table class="table table-striped">
						<thead>
							<tr>
					      		<th scope="col">ID</th>
							    <th scope="col">Name</th>
							    <th scope="col">Slug</th>
							    <th scope="col">Author</th>
							    <th scope="col">Item</th>
					    	</tr>
						</thead>
				  		<tbody>
				  			@foreach ($checkLists as $checkList)
						    	<tr>
						      		<th scope="row">
						      			<a class="nav-link" href="{{ route('checkLists.show', $checkList) }}">{{ $checkList->id ?? 'not value' }}</a>
						      		</th>
								    <td>
								    	<a class="nav-link" href="{{ route('checkLists.show', $checkList)}}">{{ $checkList->name }}</a>
								    </td>
								    <td>{{ $checkList->slug ?? 'not value' }}</td>
								    <td>{{ $checkList->user['name'] ?? 'not value' }}</td>
								    <td>
								    	@foreach ($checkList->itemchecklists as $itemchecklist)
								    		{{ $itemchecklist->name ?? 'not value' }} <br>
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