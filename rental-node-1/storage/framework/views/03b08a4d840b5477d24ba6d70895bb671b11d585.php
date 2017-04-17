<div class="form-group">
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
		<img id="showimage_<?php echo e(isset($showimg_id) ? $showimg_id : ''); ?>" src="#" alt="your image" style="width: 50%;height: auto;margin-bottom: 10px;" />

		<?php echo Form::file(
				$field,
				isset($attributes) ? $attributes : []
			); ?>


		<?php if(isset($help)): ?>
		<span class="help-block"><?php echo e($help); ?></span>
		<?php endif; ?>
		<?php if($errors->has($field)): ?>
		<span class="help-block text-danger"><?php echo e($errors->first($field)); ?></span>
		<?php endif; ?>
	</div>
</div>