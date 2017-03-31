<div class="form-group @if ($errors->has($field)) has-error @endif" @if(isset($formStyle)) style="{{ $formStyle }}" @endif>
	@if (isset($label))
		<label
			for="{{ $field }}" class="control-label" @if(isset($labelStyle)) style="{{ $labelStyle }}" @endif
		>
			{!! $label !!}
		</label>
	@endif
	<div class="control-input 
		{{ isset($class) ? $class : '' }}
		{{ $errors->has($field) ? 'has-error' : '' }}"
	>
		{!! 
			Form::text(
				$field,
				isset($default) ? $default : null,
				[
					'class' => 'form-control',
					'placeholder' => isset($placeholder) ? $placeholder : ''
				] + (isset($attributes) ? $attributes : [])
			)
		!!}

		@if (isset($help))
		<div class="col-sm-6 text-left"><span class="help-block">{{ $help }}</span></div>
		@endif
		@if ($errors->has($field))
		<div class="col-sm-6 text-right"><span class="help-block text-danger">{{ $errors->first($field) }}</span></div>
		@endif
	</div>
</div>