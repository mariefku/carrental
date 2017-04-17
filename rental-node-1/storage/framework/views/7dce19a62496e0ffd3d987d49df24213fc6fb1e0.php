<div class="form-group">
	<?php if(isset($label)): ?>
	<label
		for="<?php echo e($field); ?>" class="control-label"
	>
		<?php echo e($label); ?>

	</label>
	<?php endif; ?>
	<div class="checkbox control-input 
		<?php echo e(isset($class) ? $class : ''); ?>

		<?php echo e($errors->has($field) ? 'has-error' : ''); ?>"
	>

			<label>
				<?php echo Form::checkbox (
						$field, 
						$i['value'], 
						isset($i['default']) ? $i['default'] : ''
					); ?>

				<?php echo e(isset($i['label']) ? $i['label'] : ''); ?>

			</label>

		<?php if(isset($help)): ?>
		<span class="help-block"><?php echo e($help); ?></span>
		<?php endif; ?>
		<?php if($errors->has($field)): ?>
		<span class="help-block text-danger"><?php echo e($errors->first($field)); ?></span>
		<?php endif; ?>
	</div>
</div>