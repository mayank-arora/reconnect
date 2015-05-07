	<div class="form-group">
		{{Form::label('year' , 'Year' , array('class' => 'control-label col-md-2'))}}
		<div class="col-md-4">
			{{Form::text('year' , null, array('class' => 'form-control'))}}
		</div>
	</div>
	<div class="form-group">
		{{Form::label('description' , 'Description' , array('class' => 'control-label col-md-2'))}}
		<div class="col-md-10">
			{{Form::textarea('description' , null, array('class' => 'form-control', 'style' => 'resize:none;'))}}
		</div>
	</div>
	<div class="form-group">
		{{Form::label('' , '' , array('class' => 'control-label col-md-2'))}}
		<div class="col-md-4">
			<input type="submit" class="btn btn-primary" value="Add">
		</div>
	</div>
