<?php $__env->startSection('content'); ?>
    <div class="inquiry-form-section container mt-5">
        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <!-- Dark Themed Form Container -->
        <div class="custom-form-container">
            <h1 class="text-center">Edit Inquiry</h1>

            <form action="<?php echo e(route('inquiries.update', $contactUs->id)); ?>" method="POST" class="form-container" enctype="multipart/form-data" onsubmit="return validateForm()">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <!-- Grid Layout for Form -->
                <div class="form-row">
                    <!-- Form fields remain unchanged -->
                    <div class="form-group col-md-6">
                        <label for="inquiry_type" class="form-label">Type of Inquiry</label>
                        <input type="text" name="inquiry_type" class="form-control"
                               value="<?php echo e(old('inquiry_type', $contactUs->inquiry_type)); ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="job_type" class="form-label">Type of Job</label>
                        <input type="text" name="job_type" class="form-control"
                               value="<?php echo e(old('job_type', $contactUs->job_type)); ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="manager_type" class="form-label">Manager Name</label>
                        <input type="text" name="manager_type" class="form-control"
                               value="<?php echo e(old('manager_type', $contactUs->manager_name)); ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="specify_manager" class="form-label">Specify Recruiter</label>
                        <input type="text" name="specify_manager" class="form-control"
                               value="<?php echo e(old('specify_manager', $contactUs->specify_manager)); ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="branch" class="form-label">Branch</label>
                        <input type="text" name="branch" class="form-control"
                               value="<?php echo e(old('branch', $contactUs->branch)); ?><?php echo e(old('specify_branch', $contactUs->specify_branch)); ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="hear_from_us" class="form-label">Hear From Us</label>
                        <input type="text" name="hear_from_us" class="form-control"
                               value="<?php echo e(old('hear_from_us', $contactUs->hear_from_us)); ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control"
                               value="<?php echo e(old('name', $contactUs->name)); ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control"
                               value="<?php echo e(old('email', $contactUs->email)); ?>" required>
                        <small class="form-text text-muted email-validation"></small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" name="phone" class="form-control"
                               value="<?php echo e(old('phone', $contactUs->phone)); ?>" required>
                        <small class="form-text text-muted phone-validation"></small>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="message" class="form-label">Message</label>
                        <textarea name="message" class="form-control" required><?php echo e(old('message', $contactUs->message)); ?></textarea>
                        <small class="form-text text-muted message-count">0 / 500 characters</small>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="profile_picture" class="form-label">Profile Picture</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="profile_picture" name="profile_picture">
                            <label class="custom-file-label" for="profile_picture">Choose file</label>
                        </div>
                        <?php if(isset($contactUs) && $contactUs->profile_picture): ?>
                            <img src="<?php echo e(asset('storage/' . $contactUs->profile_picture)); ?>" alt="Profile Picture"
                                class="img-thumbnail mt-2" style="width:100px; height:100px;">
                        <?php endif; ?>
                    </div>
                    <div class="form-group col-md-12">
                        <div class="form-check">
                            <input type="checkbox" name="consent" id="consent" class="form-check-input" <?php echo e($contactUs->consent ? 'checked' : ''); ?>>
                            <label for="consent" class="form-check-label">I agree to the terms.</label>
                        </div>
                    </div>
                </div>

                <div class="form-footer text-center">
                    <button type="submit" class="btn btn-custom">Update Inquiry</button>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Link to Custom CSS -->
<link href="<?php echo e(asset('css/custom.css')); ?>" rel="stylesheet">

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    function validateForm() {
        const consentCheckbox = document.getElementById('consent');
        if (!consentCheckbox.checked) {
            alert('Please agree to the terms first.');
            return false; // Prevent form submission
        }
        return true; // Allow form submission
    }

    document.addEventListener('DOMContentLoaded', function() {
        const emailInput = document.querySelector('input[name="email"]');
        const phoneInput = document.querySelector('input[name="phone"]');
        const messageTextarea = document.querySelector('textarea[name="message"]');
        const fileInput = document.querySelector('input[type="file"]');

        emailInput.addEventListener('input', function() {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const isValid = emailRegex.test(this.value);
            this.classList.toggle('is-valid', isValid);
            this.classList.toggle('is-invalid', !isValid);
            this.nextElementSibling.textContent = isValid ? 'Valid email' : 'Invalid email format';
        });

        phoneInput.addEventListener('input', function() {
            const phoneRegex = /^\+?[\d\s-]{10,14}$/;
            const isValid = phoneRegex.test(this.value);
            this.classList.toggle('is-valid', isValid);
            this.classList.toggle('is-invalid', !isValid);
            this.nextElementSibling.textContent = isValid ? 'Valid phone number' : 'Invalid phone number format';
        });

        messageTextarea.addEventListener('input', function() {
            const maxLength = 500;
            const remaining = maxLength - this.value.length;
            this.nextElementSibling.textContent = `${this.value.length} / ${maxLength} characters`;
            if (remaining < 0) {
                this.value = this.value.slice(0, maxLength);
            }
        });

        fileInput.addEventListener('change', function(e) {
            const fileName = e.target.files[0].name;
            const label = e.target.nextElementSibling;
            label.textContent = fileName;
        });

        // Trigger events on page load for pre-filled fields
        emailInput.dispatchEvent(new Event('input'));
        phoneInput.dispatchEvent(new Event('input'));
        messageTextarea.dispatchEvent(new Event('input'));
    });
</script>

<?php echo $__env->make('admin.inquiry', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Desktop\Sto-Domingo-Associates-app\resources\views/inquiries/edit.blade.php ENDPATH**/ ?>