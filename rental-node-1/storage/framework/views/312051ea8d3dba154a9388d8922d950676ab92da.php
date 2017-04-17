<div class="form-group col-sm-12">
	<?php if(isset($label)): ?>
		<label
			for="<?php echo e($field); ?>" class="control-label"
		>
			<?php echo e($label); ?>

		</label>
	<?php endif; ?>
	<div class="control-input 
		<?php echo e(isset($class) ? $class : ''); ?>

		<?php echo e($errors->has($field) ? 'has-error' : ''); ?>"
	>
		<?php echo Form::text(
				$field,
				isset($default) ? $default : null,
				[
					'class' => 'form-control',
					'placeholder' => isset($placeholder) ? $placeholder : ''
				] + (isset($attributes) ? $attributes : [])
			); ?>


		<?php if(isset($help)): ?>
		<span class="help-block"><?php echo e($help); ?></span>
		<?php endif; ?>
		<?php if($errors->has($field)): ?>
		<span class="help-block text-danger"><?php echo e($errors->first($field)); ?></span>
		<?php endif; ?>
	</div>
</div>