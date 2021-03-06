@extends('master')
@section('user-list')

<div class="container">


	<div class="row">
		<div class="col s8">
			<h2 class="deep-purple-text">Admin Dashboard</h2>
		</div>
		<div class="col s4">
			<div class="input-field">
				{!! FORM::open(['method' => 'GET']) !!}
				{!! FORM::input('search','search', null, 
				   ['data-list' => $list,
              		'data-minchars' => '2',
              		'class' => 'awesomplete',
              		'placeholder' => 'Search...']) 
              	!!}
				{!! FORM::close() !!}
			</div>
		</div>
	</div>


	<table class="responsive-table bordered highlight">
		@if( count($Users) == 0)
			<div class="card-panel red lighten-1 white-text"><h5 style="text-align: center;">Array is empty!</h5></div>
		@else
			<thead>
			<tr>
				<th data-field="ime_in_priimek">Name</th>
			</tr>
			</thead>

			<tbody>


			@foreach ( $Users as $user )
				<tr>
					<td>{{ $user->name  }}</td>


					<td class="td-icon">
						<a class="btn-floating modal-trigger tooltipped" data-position="top" data-delay="50" data-tooltip="Edit" href="#{{ 'editmodel'.$user->id }}" >
							<i class="material-icons  green darken-3">mode_edit</i>
						</a>
					</td>
					<td class="td-icon">
						<a class="btn-floating modal-trigger tooltipped" data-position="top" data-delay="50" data-tooltip="Delete" href="#{{ 'deletemodel'.$user->id }}"  data-method="delete">
							<i class="material-icons  red darken-1">delete</i>
						</a>
					</td>

				</tr>

				<!-- Delete User Model-->
				<div id="{{ 'deletemodel'.$user->id }}" class="modal">
					<div class="modal-content">
						<h5>Are you really want delete this account {{ $user->name }} ?</h5>
					</div>
					<div class="modal-footer">

						<a href="#!" class=" modal-action modal-close waves-effect btn purple darken-3" style="margin-left: 10px;">Cancel</a>

						{!! FORM::open([
                            'method' => 'DELETE',
                            'url' => ['app/user/delete', $user->id]]) !!}
						{!! FORM::submit('Delete', ['class' => 'btn danger-3 red']) !!}
					</div>
					{!! FORM::close() !!}
				</div>

				<!-- Edit User Model-->
				<div id="{{ 'editmodel'.$user->id }}" class="modal modal-fixed-footer">


					{!! FORM::model($user,[
                        'method' => 'PUT',
                        'url' => ['app/user/update', $user->id]
                       ])
                    !!}
					<div class="modal-content">

						<div class="input-field col 12">
							{!! FORM::text('name',null) !!}
							{!! FORM::label('name', 'Name:') !!}
						</div>

						<div class="input-field col 12">
							{!! FORM::email('email',null) !!}
							{!! FORM::label('email', 'Email:') !!}
						</div>

						<div class="input-field col 12">
							{!! FORM::password('password') !!}
							{!! FORM::label('password', 'Password:') !!}
						</div>

						<div class="input-field col 12">
							{!! FORM::password('password_confirmation') !!}
							{!! FORM::label('password', 'Password (Confirm):') !!}
						</div>

					</div>
					<div class="modal-footer">
						<a href="#!" class=" modal-action modal-close waves-effect btn red darken-3" style="margin-left: 10px;">Cancel</a>

						{!! FORM::submit('Update', ['class' => 'btn green darken-3']) !!}
					</div>
					{!! FORM::close() !!}

				</div>
			@endforeach

			@endif
			</tbody>
	</table>


	    <!-- Add User Button-->
    <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
    	<a href="#modal_add" 
    		class="btn-floating btn-large tooltipped waves-effect waves-light purple darken-4 modal-trigger "
    		data-position="left" 
    		data-delay="50"
    		data-tooltip="Add new User">
    		<i class="material-icons">add</i>
    	</a>      
    </div>
</div>


<!-- Add User Model -->
<div id="modal_add" class="modal modal-fixed-footer">
	{!! FORM::open(['url' => 'app/user/add']) !!}
	    <div class="modal-content">

			@if($errors->any())
				<div class="alert alert-danger">
					@foreach($errors->all() as $error)
						<p>{{ $error }}</p>
					@endforeach
				</div>
			@endif

			<div class="input-field col 12">
				{!! FORM::text('name',null) !!}
				{!! FORM::label('name', 'Name:') !!}
			</div>

			<div class="input-field col 12">
				{!! FORM::email('email',null) !!}
				{!! FORM::label('email', 'Email:') !!}
			</div>

			<div class="input-field col 12">
				{!! FORM::password('password') !!}
				{!! FORM::label('password', 'Password:') !!}
			</div>

			<div class="input-field col 12">
				{!! FORM::password('password_confirmation') !!}
				{!! FORM::label('password', 'Password (Confirm):') !!}
			</div>

			<div class="input-field col 12">
			 {!! FORM::select('role', array('user' => 'User', 'admin' => 'Admin')) !!}
			 {!! FORM::label('role', 'Role:') !!}
			</div>
	    </div>
	    <div class="modal-footer">
			<a href="#!" class=" modal-action modal-close waves-effect btn red darken-3" style="margin-left: 10px;">Cancel</a>
			{!! FORM::submit('Save', ['class' => 'btn btn-primary green darken-3']) !!}
	    </div>
	{!! FORM::close() !!}
</div>



@stop