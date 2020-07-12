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

					<a class="btn btn-primary btn-block" href="{{ route('itemCheckLists.edit', $itemCheckList) }}" role="button">Edit</a><br>

					<table class="table table-striped">
				  		<tbody>
					    	<tr>
					      		<th scope="col">ID</th>
							    <td>{{ $itemCheckList->id }}</td>
							</tr>
							<tr>
							    <th scope="col">Name</th>
							   	<td>{{ $itemCheckList->name }}</td>
							</tr>
							<tr>
							    <th scope="col">Slug</th>
							    <td>{{ $itemCheckList->slug }}</td>
							</tr>
							<tr>
								<th scope="col">Сomplete</th>
							    <td>
							    	<div class="form-group row">
								    	<form action="{{ route('itemCheckLists.update', $itemCheckList) }}" method="POST" class="col-md-13">
											@method('PUT')
											@csrf

											@if($itemCheckList->done != 0)
												<div class="form-check form-check-inline">
												  <input class="form-check-input" type="radio" name="done" id="done1" value="1" checked>
												  <label class="form-check-label" for="done1">
												    Yes
												  </label>
												</div>
												<div class="form-check form-check-inline">
												  <input class="form-check-input" type="radio" name="done" id="done2" value="0">
												  <label class="form-check-label" for="done2">
												    No
												  </label>
												</div>
			 								@else
												<div class="form-check form-check-inline">
												  <input class="form-check-input" type="radio" name="done" id="done1" value="1">
												  <label class="form-check-label" for="done1">
												    Yes
												  </label>
												</div>
												<div class="form-check form-check-inline">
												  <input class="form-check-input" type="radio" name="done" id="done2" value="0" checked>
												  <label class="form-check-label" for="done2">
												    No
												  </label>
												</div>
			 								@endif
											</div>

										    <div class="col-sm-10">
										      <button type="submit" class="btn btn-primary">Sign in</button>
										    </div>

										</form>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
					<form action="{{ route('itemCheckLists.destroy', $itemCheckList) }}" method="POST" class="col-md-13">
						@method('DELETE')
						@csrf

						<div class="col-sm-10">
					      <button type="submit" class="btn btn-danger">Delete this Item</button>
					    </div>
					</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection