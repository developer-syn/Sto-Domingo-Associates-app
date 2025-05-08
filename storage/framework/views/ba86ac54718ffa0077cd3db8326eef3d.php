

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('components.embeded', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <a href="<?php echo e(route('events.create')); ?>" class="btn btn-primary mb-3">Add Event</a><br><br>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="news-list">
        <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="news-item">
                <div class="embed-code">
                    <?php echo $item->embed_code; ?>

                </div>

                <div class="actions">
                    <a href="<?php echo e(route('events.edit', $item->id)); ?>" class="btn btn-warning">Edit</a>
                    <form action="<?php echo e(route('events.destroy', $item->id)); ?>" method="POST" style="display:inline-block;">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.editNews', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Desktop\Sto-Domingo-Associates-app\resources\views/events/index.blade.php ENDPATH**/ ?>