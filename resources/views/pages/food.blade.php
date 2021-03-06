@extends('master')
@section('food-list')
<div class="container">

	<div class="row">
		<div class="col s10">
			<h2 class="deep-purple-text">Nutrients</h2>
		</div>
		<div class="col s2">
			<div class="input-field">
				{{-- {!! FORM::open(['method' => 'GET']) !!}
				{!! FORM::input('search','search', null, 
				   ['placeholder' => 'Search (food code)']) 
              	!!}
				{!! FORM::close() !!} --}}
				<input type="text" id="search" placeholder="Search">
			</div>
		</div>
	</div>

	<table class="centered" >
		@if( count($Foods) == 0)
			<div class="card-panel deep-purple-text lighten-1"><h5 style="text-align: center;">Array is empty!</h5></div>
		@else
			<thead>
			<tr>
				<th data-field="titel">Title</th>
				<th data-field="food_code">Food code</th>
				<th data-field="calories">Calories(kCal)</th>
				<th data-field="fat">Fat(g)</th>
				<th data-field="protein">Protein</th>
				<th data-field="carbohydrates">Carbohydrates(g)</th>
				<th data-field="food_type">Food type</th>
				<th data-field="quantity">Quantity</th>
				<th></th>
				<th></th>
			</tr>
			</thead>

			<tbody class="tbody-center" id="table">


			@foreach ( $Foods as $f)
				<tr>
					<td>{{ $f->title  }}</td>
					<td>{{ $f->food_code }}</td>
					<td>{{ $f->calories }}</td>
					<td>{{ $f->fat }}</td>
					<td >{{ $f->protein }}</td>
					<td>{{ $f->carbohydrates }}</td>
					@if( $f->food_category_id == '2')
						<td>Intravenously</td>
					@else
						<td>Per os</td>
					@endif
					<td>{{ $f->quantity }}</td>

					<td class="td-icon">
						<a class="btn-floating modal-trigger" href="#{{ 'editmodel'.$f->id }}" >
							<i class="material-icons  green darken-3">mode_edit</i>
						</a>
					</td>
					<td class="td-icon">
						<a class="btn-floating modal-trigger" href="#{{ 'deletemodel'.$f->id }}"  data-method="delete">
							<i class="material-icons  red darken-1">delete</i>
						</a>
					</td>
				</tr>

				<!-- Delete Food Model-->
				<div id="{{ 'deletemodel'.$f->id }}" class="modal">
					<div class="modal-content">
						<h5>Are you sure you want to delete {{ $f->title }} ?</h5>
					</div>
					<div class="modal-footer">

						<a href="#!" class=" modal-action modal-close waves-effect btn purple darken-3" style="margin-left: 10px;">Cancel</a>

						{!! FORM::open([
                            'method' => 'DELETE',
                            'url' => ['app/food/delete', $f->id]]) !!}
						{!! FORM::submit('Delete', ['class' => 'btn danger-3 red']) !!}
					</div>
					{!! FORM::close() !!}
				</div>

				<!-- Edit Food Model-->
				<div id="{{ 'editmodel'.$f->id }}" class="modal modal-fixed-footer">
					{!! FORM::model($f,[
                        'method' => 'PUT',
                        'url' => ['app/food/update', $f->id]
                       ])
                    !!}
					<div class="modal-content">

						<div class="input-field col 12">
							{!! FORM::text('title', null) !!}
							{!! FORM::label('title', 'Title:') !!}
						</div>

						<div class="input-field col 12">
							{!! FORM::input('number', 'calories', null, array('min'=>'0','step'=>'1.0')) !!}
							{!! FORM::label('calories', 'Calories (kCal):') !!}
						</div>

						<div class="input-field col 12">
							{!! FORM::input('number', 'fat', null, array('min'=>'0','step'=>'0.1')) !!}
							{!! FORM::label('fat', 'Fat  (g):') !!}
						</div>

						<div class="input-field col 12">
							{!! FORM::input('number', 'protein', null, array('min'=>'0','step'=>'0.1')) !!}
							{!! FORM::label('protein', 'Protein (g):') !!}
						</div>

						<div class="input-field col 12">
							{!! FORM::input('number', 'carbohydrates', null, array('min'=>'0','step'=>'0.1')) !!}
							{!! FORM::label('carbohydrates', 'Carbohydrates (g):') !!}
						</div>

						<div class="input-field col 12">
							{!! FORM::input('number', 'quantity', null, array('min'=>'0','max'=>'999','step'=>'1.0')) !!}
							{!! FORM::label('quantity', 'Quantity:') !!}
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
			@if(count($Foods) > 1)
				<tr id="sumBody" style="border-top: 1px solid #d0d0d0;" class="indigo lighten-5">
	                <td></td>
	                <td></td>
	                <td style="font-weight: bold;">{{ $Foods->sum('calories') }}</td>
	                <td style="font-weight: bold;">{{ $Foods->sum('fat') }}</td>
	                <td style="font-weight: bold;">{{ $Foods->sum('protein') }}</td>
	                <td style="font-weight: bold;">{{ $Foods->sum('carbohydrates') }}</td>
	                <td></td>
	                <td style="font-weight: bold;">{{ $Foods->sum('quantity') }}</td>
	                <td></td>
	                <td></td>
	                <td></td>
            	</tr>
			@endif
	</table>

</div>

	<!-- Add Food Button-->
    <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
    	<a href="#modal_add"
    		class="btn-floating btn-large tooltipped waves-effect waves-light purple darken-4 modal-trigger "
    		data-position="left"
    		data-delay="50"
    		data-tooltip="Add new Nutrients">
    		<i class="material-icons">add</i>
    	</a>
    </div>

	<!-- Add Food Model-->
	<div id="modal_add" class="modal modal-fixed-footer">
			{!! FORM::open(['url' => 'app/food/add']) !!}
	    <div class="modal-content">

	    	<div class="input-field col 12">
			    {!! FORM::select('food_category_id', array('2'=>'Intravenously', '1'=>'Per os'),null) !!}
			    {!! FORM::label('food_category_id', 'Food type:') !!}
           	</div>

			<div class="input-field col 12">
				{!! FORM::text('title',null) !!}
				{!! FORM::label('title', 'Title:') !!}
			</div>
		
			<div class="input-field col 12">
				{!! FORM::input('number', 'food_code', null, array('min'=>'000','max'=>'999')) !!}
				{!! FORM::label('food_code', 'Food code:') !!}
			</div>
		
			<div class="input-field col 12">
				{!! FORM::input('number', 'calories', null, array('min'=>'0','max'=>'999','step'=>'1.0')) !!}
				{!! FORM::label('calories', 'Calories (kCal):') !!}
			</div>

			<div class="input-field col 12">
				{!! FORM::input('number', 'fat', null, array('min'=>'0','step'=>'0.1')) !!}
				{!! FORM::label('fat', 'Fat (g):') !!}
			</div>

			<div class="input-field col 12">
				{!! FORM::input('number', 'protein', null, array('min'=>'0','step'=>'0.1')) !!}
				{!! FORM::label('protein', 'Protein (g):') !!}
			</div>

			<div class="input-field col 12">
				{!! FORM::input('number', 'carbohydrates', null, array('min'=>'0','step'=>'0.1')) !!}
				{!! FORM::label('carbohydrates', 'Carbohydrates  (g):') !!}
			</div>

			<div class="input-field col 12">
				{!! FORM::input('number', 'quantity', null, array('min'=>'0','max'=>'999')) !!}
				{!! FORM::label('quantity', 'Quantity:') !!}
			</div>
		</div>
	    <div class="modal-footer">
	    	<a href="#!" class=" modal-action modal-close waves-effect btn red darken-3" style="margin-left: 10px;">Cancel</a>
	      	{!! FORM::submit('Save', ['class' => 'btn btn-primary green darken-3']) !!}
	    </div>
		{!! FORM::close() !!}
	</div>

@stop