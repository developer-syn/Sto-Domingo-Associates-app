<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('components.employee-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="employee-form-section container">
        <h1><?php echo e(isset($employee) ? 'Edit Employee' : 'Add New Employee'); ?></h1>

        <!-- Form for adding/editing employee -->
        <form method="POST"
            action="<?php echo e(isset($employee) ? route('employees.update', $employee->id) : route('employees.store')); ?>"
            enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php if(isset($employee)): ?>
                <?php echo method_field('PUT'); ?>
            <?php endif; ?>

            <!-- Grid Layout for Form -->
            <div class="form-grid">
                <!-- First Name -->
                <div class="form-item">
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name" class="form-control"
                        value="<?php echo e(old('first_name', $employee->first_name ?? '')); ?>" required>
                </div>

                <!-- Middle Name -->
                <div class="form-item">
                    <label for="middle_name">Middle Name</label>
                    <input type="text" id="middle_name" name="middle_name" class="form-control"
                        value="<?php echo e(old('middle_name', $employee->middle_name ?? '')); ?>">
                </div>

                <!-- Last Name -->
                <div class="form-item">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" class="form-control"
                        value="<?php echo e(old('last_name', $employee->last_name ?? '')); ?>" required>
                </div>

                <!-- Email -->
                <div class="form-item">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control"
                        value="<?php echo e(old('email', $employee->email ?? '')); ?>" required>
                </div>

                <!-- Sex -->
                <div class="form-item">
                    <label for="sex">Sex</label>
                    <select id="sex" name="sex" class="form-control" required>
                        <option value="">-- Select Sex --</option>
                        <option value="Male" <?php echo e(old('sex', $employee->sex ?? '') == 'Male' ? 'selected' : ''); ?>>Male
                        </option>
                        <option value="Female" <?php echo e(old('sex', $employee->sex ?? '') == 'Female' ? 'selected' : ''); ?>>Female
                        </option>
                    </select>
                </div>

                <!-- Phone Number -->
                <div class="form-item">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" id="phone_number" name="phone_number" class="form-control"
                        value="<?php echo e(old('phone_number', $employee->phone_number ?? '')); ?>" required minlength="99999999999"
                        maxlength="11">
                </div>

                <!-- Age -->
                <div class="form-item">
                    <label for="age">Age</label>
                    <input type="number" id="age" name="age" class="form-control"
                        value="<?php echo e(old('age', $employee->age ?? '')); ?>" required minlength="2" maxlength="2">
                </div>

                <!-- Position -->
                <div class="form-item">
                    <label for="position">Position</label>
                    <input type="text" id="position" name="position" class="form-control"
                        value="<?php echo e(old('position', $employee->position ?? '')); ?>" required>
                </div>

                <!-- Address -->
                <div class="form-item">
                    <label for="address">Address</label>
                    <textarea id="address" name="address" class="form-control" required><?php echo e(old('address', $employee->address ?? '')); ?></textarea>
                </div>
            </div>

            <!-- Profile Picture & Submit Button -->
            <div class="form-footer">
                <div>
                    <label for="profile_picture">Profile Picture</label>
                    <input type="file" id="profile_picture" name="profile_picture" class="form-control">
                    <?php if(isset($employee) && $employee->profile_picture): ?>
                        <img src="<?php echo e(asset('storage/' . $employee->profile_picture)); ?>" alt="Profile Picture"
                            style="width:100px; height:100px; margin-top: 10px;">
                    <?php endif; ?>
                </div>
                <button type="submit" class="btn-submit">
                    <?php echo e(isset($employee) ? 'Update Employee' : 'Add Employee'); ?>

                </button>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Desktop\Sto-Domingo-Associates-app\resources\views/employees/form.blade.php ENDPATH**/ ?>