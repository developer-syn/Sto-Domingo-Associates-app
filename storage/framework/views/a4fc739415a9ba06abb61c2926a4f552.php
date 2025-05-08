<?php $__env->startSection('content'); ?>
    <!-- Display Success Message -->
    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <div style="overflow-x: auto;">
        <table id="contact_us" class="table table-striped table-bordered" style="width:100%;-webkit-scrollbar: 0.8pv">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Profile Picture</th>
                    <th>Type of Inquiry</th>
                    <th>Type of Job</th>
                    <th>Recruiter</th>
                    <th>Manager Name</th>
                    <th>Branch</th>
                    <th>Hear From Us</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Message</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $inquiries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contactUs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($loop->iteration); ?></td>
                        <td>
                            <?php if($contactUs->profile_picture): ?>
                                <img src="<?php echo e(asset('storage/' . $contactUs->profile_picture)); ?>" alt="Profile Picture"
                                    style="height: 50px; width: 50px; border-radius: 50%;">
                            <?php else: ?>
                                <img src="https://via.placeholder.com/50" alt="Default Profile Picture"
                                    style="height: 50px; width: 50px; border-radius: 50%;">
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($contactUs->inquiry_type); ?></td>
                        <td><?php echo e($contactUs->job_type); ?></td>
                        <td><?php echo e($contactUs->specify_manager); ?></td>
                        <td><?php echo e($contactUs->manager_name); ?></td>
                        <td><?php echo e($contactUs->branch ? $contactUs->branch : $contactUs->specify_branch); ?></td>
                        <td><?php echo e($contactUs->hear_from_us); ?></td>
                        <td><?php echo e($contactUs->name); ?></td>
                        <td><?php echo e($contactUs->email); ?></td>
                        <td><?php echo e($contactUs->phone); ?></td>
                        <td><?php echo e($contactUs->message); ?></td>
                        <td>
                            <div class="btn-group-flex">
                                <form action="<?php echo e(route('contact_us.accept', ['contactUs' => $contactUs->id])); ?>" method="POST" style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn-accept">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>

                                <form action="<?php echo e(route('contact_us.decline', ['contactUs' => $contactUs->id])); ?>" method="POST" style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn-decline">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </form>

                                <a href="<?php echo e(route('inquiries.edit', $contactUs->id)); ?>" class="btn-edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <script>
        $(document).ready(function() {
            $('#contact_us').DataTable({
                responsive: true
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<style>
.btn-group-flex {
    display: flex;
    justify-content: flex-start;
    gap: 10px;
    margin-top: 10px;
}

.btn-group-flex button,
.btn-edit {
    padding: 10px;
    cursor: pointer;
    text-decoration: none;
    border-radius: 5px;
    font-size: 18px;
    display: flex;
    height: 41px;
    align-items: center;
}

.btn-accept {
    background-color: #04AA6D;
    border: 1px solid green;
    color: white;
}

.btn-decline {
    background-color: #b41308;
    border: 1px solid red;
    color: white;
}

.btn-edit {
    background-color: #007BFF;
    border: 1px solid #003063;
    color: white;
}

.btn-accept:hover {
    background-color: #3e8e41;
}

.btn-decline:hover {
    background-color: #d32f2f;
}

.btn-edit:hover {
    background-color: #0056b3;
}
</style>

<?php echo $__env->make('admin.inquiry', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Desktop\Sto-Domingo-Associates-app\resources\views/inquiries/index.blade.php ENDPATH**/ ?>