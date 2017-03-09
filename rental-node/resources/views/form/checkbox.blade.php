<div class="form-group">
	@if (isset($label))
	<label
		for="{{ $field }}" class="control-label"
	>
		{{ $label }}
	</label>
	@endif
	<div class="checkbox control-input 
		{{ isset($class) ? $class : '' }}
		{{ $errors->has($field) ? 'has-error' : ''}}"
	>
		@foreach ($checkbox as $i)
			<label>
				{!! Form::checkbox (
						$field, 
						$i['value'], 
						isset($i['default']) ? $i['default'] : ''
					)  
				!!}
				{{ isset($i['label']) ? $i['label'] : ''}}
			</label>
		@endforeach
		@if (isset($help))
		<span class="help-block">{{ $help }}</span>
		@endif
		@if ($errors->has($field))
		<span class="help-block text-danger">{{ $errors->first($field) }}</span>
		@endif
	</div>
</div>