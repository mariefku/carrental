<div class="form-group">
	@if (isset($label))
		<label
			for="{{ $field }}" class="control-label"
		>
			{{ $label }}
		</label>
	@endif
	<div class="control-input 
		{{ isset($class) ? $class : '' }}
		{{ $errors->has($field) ? 'has-error' : '' }}"
	>
		<img id="showimage_{{ isset($showimg_id) ? $showimg_id : '' }}" src="#" alt="your image" style="width: 50%;height: auto;margin-bottom: 10px;" />

		{!! 
			Form::file(
				$field,
				isset($attributes) ? $attributes : []
			)
		!!}

		@if (isset($help))
		<span class="help-block">{{ $help }}</span>
		@endif
		@if ($errors->has($field))
		<span class="help-block text-danger">{{ $errors->first($field) }}</span>
		@endif
	</div>
</div>