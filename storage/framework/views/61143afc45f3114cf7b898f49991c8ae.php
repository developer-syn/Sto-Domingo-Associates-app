<style>
    /* resources/css/employee-form.css */

/* General form container styles */
.employee-form-section {
    padding: 20px;
    background-color: #f8f9fa; Light grey background
    border-radius: 8px; /* Rounded corners */
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
}

/* Form heading */
.employee-form-section h1 {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px;
    color: #333; /* Dark text color */
}

/* Form group styles */
.employee-form-section .form-group {
    margin-bottom: 15px;
}

/* Label styles */
.employee-form-section label {
    font-size: 16px;
    color: #555; /* Slightly lighter text for labels */
}

/* Input and textarea styles */
.employee-form-section .form-control {
    font-size: 14px;
    padding: 10px;
    /* border: 1px solid #ced4da; Light border */
    border-radius: 4px;
}

/* Input focus styles */
.employee-form-section .form-control:focus {
    border-color: #80bdff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

/* File input preview */
.employee-form-section img {
    margin-top: 10px;
    max-width: 100px;
    height: 100px;
    border-radius: 50%; /* Rounded image */
    object-fit: cover;
}

/* Submit button */
.employee-form-section .btn {
    padding: 10px 20px;
    background-color: #007bff; /* Bootstrap primary color */
    border: none;
    color: white;
    font-size: 16px;
    border-radius: 4px;
    transition: background-color 0.3s ease;
}

.employee-form-section .btn:hover {
    background-color: #0056b3;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .employee-form-section .row .col-md-4, 
    .employee-form-section .row .col-md-6 {
        width: 100%; /* Full width on smaller screens */
        margin-bottom: 15px;
    }
}


/* General form container styles */
.employee-form-section {
    max-width: 900px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f8f9fa; /* Light grey background */
    border-radius: 8px; /* Rounded corners */
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
}

/* Form heading */
.employee-form-section h1 {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px;
    color: #333; /* Dark text color */
}

/* Form Grid Layout */
.form-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr); /* 3 equal columns */
    gap: 20px; /* Spacing between columns and rows */
}

/* Form items (label + input) */
.form-item {
    display: flex;
    flex-direction: column;
}

.form-item label {
    font-size: 14px;
    margin-bottom: 5px;
    color: #555;
}

.form-item input,
.form-item textarea {
    padding: 10px;
    border: 1px solid #ced4da;
    border-radius: 4px;
    font-size: 14px;
    width: 100%;
}

/* Responsive adjustments for smaller screens */
@media (max-width: 768px) {
    .form-grid {
        grid-template-columns: 1fr; /* Single column on smaller screens */
    }
}

/* Form footer */
.form-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 20px;
}

.btn-submit {
    padding: 10px 20px;
    background-color: #007bff;
    border: none;
    color: white;
    font-size: 16px;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-submit:hover {
    background-color: #0056b3;
}

</style><?php /**PATH C:\Users\User\Desktop\Sto-Domingo-Associates-app\resources\views/components/employee-form.blade.php ENDPATH**/ ?>