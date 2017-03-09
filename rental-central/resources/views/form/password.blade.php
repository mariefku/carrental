<div class="form-group">
	<label
		for="{{ $field }}" class="control-label"
	>
		{{ isset($label) ? $label : '' }}
	</label>
	<div class="control-input 
		{{ isset($class) ? $class : '' }}
		{{ $errors->has($field) ? 'has-error' : '' }}"
	>
		{!! Form::password($field, [
			'class' => 'form-control',
			'placeholder' => isset($placeholder) ? $placeholder : '',
		]) !!}
		
		@if (isset($help))
		<span class="help-block">{{ $help }}</span>
		@endif
		@if ($errors->has($field))
		<span class="help-block text-danger">{{ $errors->first($field) }}</span>
		@endif
	</div>
</div>