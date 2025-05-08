<?php $__env->startSection('content'); ?>
    <div style="overflow-x: auto;">
        <table id="employeeTable" class="table table-striped table-bordered" style="width:100%;-webkit-scrollbar: 0.8pv">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>Profile Picture</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Sex</th>
                    <th>Age</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Position</th>
                    <th>Address</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($loop->iteration); ?></td>
                        <td><?php echo e($employee->id); ?></td>
                        <td>
                            <?php if($employee->profile_picture): ?>
                                <img src="<?php echo e(asset('storage/' . $employee->profile_picture)); ?>" alt="Profile Picture"
                                    style="height: 50px; width: 50px; border-radius: 50%;">
                            <?php else: ?>
                                <img src="https://via.placeholder.com/50" alt="Default Profile Picture"
                                    style="height: 50px; width: 50px; border-radius: 50%;">
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($employee->first_name); ?></td>
                        <td><?php echo e($employee->middle_name); ?></td>
                        <td><?php echo e($employee->last_name); ?></td>
                        <td><?php echo e($employee->sex); ?></td>
                        <td><?php echo e($employee->age); ?></td>
                        <td><?php echo e($employee->phone_number); ?></td>
                        <td><?php echo e($employee->email); ?></td>
                        <td><?php echo e($employee->position); ?></td>
                        <td><?php echo e($employee->address); ?></td>
                        <td>
                            <a href="<?php echo e(route('employees.edit', $employee->id)); ?>" class="btn btn-primary btn-sm"
                                style="color: green;font-weight:bold">Update</a>
                        </td>
                        <td>
                            <form action="<?php echo e(route('employees.destroy', $employee->id)); ?>" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this employee?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger btn-sm"
                                    style="color:red;font-weight:bolder">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>


    <!-- DataTables JS and CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    <!-- Initialize DataTable -->
    <script>
        $(document).ready(function() {
            $('#employeeTable').DataTable({
                responsive: true
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Desktop\Sto-Domingo-Associates-app\resources\views/employees/index.blade.php ENDPATH**/ ?>