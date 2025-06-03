<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\EmbedController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\ManagerProfileController;
use App\Http\Controllers\OtherBranchController;
use App\Http\Controllers\ChatBotController;
use App\Http\Controllers\AdminChatController;


// Route to delete a message
Route::delete('/chatbot/message/{id}', [ChatBotController::class, 'deleteMessage']);
Route::get('/chatbot', [ChatBotController::class, 'index']);
Route::post('/chatbot/message', [ChatBotController::class, 'sendMessage']);
Route::get('/admin/chatbot', [ChatBotController::class, 'adminIndex']);
Route::post('/admin/chatbot/message', [ChatBotController::class, 'sendAdminMessage']);

// New route for fetching messages
Route::get('/fetch/messages', [ChatBotController::class, 'fetchMessages'])->name('chatbot.fetchMessages');
// Route to notify admin when a user wants to talk
Route::post('/admin/notify', [AdminChatController::class, 'userRequest']);

// Grouping routes that require authentication
Route::middleware(['auth'])->group(function () {
    // Route to display the admin chatbot view
    Route::get('/admin/chat', [AdminChatController::class, 'index'])->name('admin.chat');

    // Route to handle user request acceptance
    Route::post('/admin/chat/user-request', [AdminChatController::class, 'handleUserRequest']);

    // Route for sending messages from the admin
    Route::post('/admin/chat', [AdminChatController::class, 'sendMessage']);
});




Route::get('/', function () {
    return view('welcome');
});

Route::get('/display-news', [EmbedController::class, 'showNews'])->name('display-news');

Route::get('/organization', function () {
    return view('organization');
})->name('organization');

Route::get('/org/{branch}', [MemberController::class, 'fetchBranchData']);
Route::get('/organization/{branch}/employees', [MemberController::class, 'fetchBranchData']);

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/join', [ContactUsController::class, 'showForm'])->name('join');
Route::post('/join', [ContactUsController::class, 'getManagerBranch'])->name('join');
Route::post('/join', [ContactUsController::class, 'submit'])->name('submit');

Route::get('/terms&condition', function () {
    return view('terms&condition');
})->name('terms&condition');

// Login and Registration Routes
// Route::get('/login', function () {
//     return view('login');
// })->middleware(['auth', 'verified'])->name('login');

Route::get('/admin/login', function () {
    return view('admin.login');
})->name('admin_login');

Route::get('/web-developer/2023-system-develop', function () {
    return view('web-developer.2023-system-develop');
})->name('2023');

Route::get('/web-developer/2024-system-update', function () {
    return view('web-developer.2024-system-update');
})->name('2024');

// Admin Dashboard and Other Admin Routes
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin/editNews', function () {
    return view('admin.editNews');
})->middleware(['auth', 'verified'])->name('editNews');

// News routes under the auth middleware
Route::middleware(['auth'])->group(function () {
    Route::get('/news', [EmbedController::class, 'index'])->name('news.index');
    Route::get('/news/create', [EmbedController::class, 'create'])->name('news.create');
    Route::post('/news', [EmbedController::class, 'store'])->name('news.store');
    Route::get('/news/{id}/edit', [EmbedController::class, 'edit'])->name('news.edit');
    Route::put('/news/{id}', [EmbedController::class, 'update'])->name('news.update');
    Route::delete('/news/{id}', [EmbedController::class, 'destroy'])->name('news.destroy');
});

// Events routes under the auth middleware
Route::middleware(['auth'])->group(function () {
    Route::get('/events', [EmbedController::class, 'indexEvents'])->name('events.index');
    Route::get('/events/create', [EmbedController::class, 'createEvent'])->name('events.create');
    Route::post('/events', [EmbedController::class, 'storeEvent'])->name('events.store');
    Route::get('/events/{id}/edit', [EmbedController::class, 'editEvent'])->name('events.edit');
    Route::put('/events/{id}', [EmbedController::class, 'updateEvent'])->name('events.update');
    Route::delete('/events/{id}', [EmbedController::class, 'destroyEvent'])->name('events.destroy');
});

// Triumphs routes under the auth middleware
Route::middleware(['auth'])->group(function () {
    Route::get('/triumphs', [EmbedController::class, 'indexTriumphs'])->name('triumphs.index');
    Route::get('/triumphs/create', [EmbedController::class, 'createTriumph'])->name('triumphs.create');
    Route::post('/triumphs', [EmbedController::class, 'storeTriumph'])->name('triumphs.store');
    Route::get('/triumphs/{id}/edit', [EmbedController::class, 'editTriumph'])->name('triumphs.edit');
    Route::put('/triumphs/{id}', [EmbedController::class, 'updateTriumph'])->name('triumphs.update');
    Route::delete('/triumphs/{id}', [EmbedController::class, 'destroyTriumph'])->name('triumphs.destroy');
});
Route::middleware(['auth'])->group(function () {
    // For Managers
    Route::put('/members/updateManagerProfile/{id}', [MemberController::class, 'updateManagerProfile'])->name('members.updateManagerProfile');
    // For Employees
    Route::put('/employees/update/{id}', [MemberController::class, 'updateEmployeeProfile'])->name('employees.update');
});

Route::delete('/contact_us/{contactUs}', [ContactUsController::class, 'destroy'])->name('contact_us.destroy');
Route::put('/contact_us/{contactUs}', [ContactUsController::class, 'update'])->name('contact_us.update');

// Define the route for listing manager profiles
Route::get('/managers', [ManagerProfileController::class, 'index'])->name('managers');

// Members Page Route
Route::get('/admin/members', function () {
    return view('admin.members');
})->middleware(['auth', 'verified'])->name('members');

// Profile Management Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Employee Management Routes
Route::middleware('auth')->group(function () {
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
    Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
    Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
    Route::put('/employees/{employee}', [EmployeeController::class, 'update'])->name('employees.update');
    Route::delete('/employees', [EmployeeController::class, 'destroy'])->name('employees.destroy');
});

Route::get('/managers/{managerId}/employees', [MemberController::class, 'showEmployees'])->name('managers.showEmployees')->middleware('auth');
// Member Management Routes
Route::middleware('auth')->group(function () {
    Route::get('/cebu', [MemberController::class, 'showBranch'])->name('cebu.index')->defaults('branch', 'cebu');
    Route::post('/cebu/manager-profile', [MemberController::class, 'storeManagerProfile'])->name('members.storeManagerProfile');
    Route::post('/cebu/employee-profile', [MemberController::class, 'storeEmployeeProfile'])->name('members.storeEmployeeProfile');
    Route::delete('/managers/{id}', [MemberController::class, 'deleteManagerProfile'])->name('members.deleteManagerProfile');
    Route::delete('/employees/{employee}', [MemberController::class, 'deleteEmployeeProfile'])->name('members.deleteEmployeeProfile');
    Route::delete('/recruits/{id}', [MemberController::class, 'destroyNewRecruit'])->name('members.destroyNewRecruit');

    Route::get('/makati', [MemberController::class, 'showBranch'])->name('makati.index')->defaults('branch', 'makati');
    Route::post('/makati/manager-profile', [MemberController::class, 'storeManagerProfile'])->name('members.storeManagerProfile');
    Route::post('/makati/employee-profile', [MemberController::class, 'storeEmployeeProfile'])->name('members.storeEmployeeProfile');

    Route::get('/bohol', [MemberController::class, 'showBranch'])->name('bohol.index')->defaults('branch', 'bohol');
    Route::post('/bohol/manager-profile', [MemberController::class, 'storeManagerProfile'])->name('members.storeManagerProfile');
    Route::post('/bohol/employee-profile', [MemberController::class, 'storeEmployeeProfile'])->name('members.storeEmployeeProfile');

    Route::get('/negros-oriental', [MemberController::class, 'showBranch'])->name('negros-oriental.index')->defaults('branch', 'negros-oriental');
    Route::post('/negros-oriental/manager-profile', [MemberController::class, 'storeManagerProfile'])->name('members.storeManagerProfile');
    Route::post('/negros-oriental/employee-profile', [MemberController::class, 'storeEmployeeProfile'])->name('members.storeEmployeeProfile');

    Route::get('/pampanga', [MemberController::class, 'showBranch'])->name('pampanga.index')->defaults('branch', 'pampanga');
    Route::post('/pampanga/manager-profile', [MemberController::class, 'storeManagerProfile'])->name('members.storeManagerProfile');
    Route::post('/pampanga/employee-profile', [MemberController::class, 'storeEmployeeProfile'])->name('members.storeEmployeeProfile');

    Route::get('/other', [OtherBranchController::class, 'display'])->name('other.index');
    Route::post('/other/manager-profile', [OtherBranchController::class, 'storeManagerProfile'])->name('members.storeManagerProfile');
    Route::post('/other', [OtherBranchController::class, 'storeEmployeeProfile'])->name('members.storeEmployeeProfile');
    Route::post('/other', [OtherBranchController::class, 'updateManagerProfile'])->name('members.updateManagerProfile');
    Route::get('/other/edit/{id}', [OtherBranchController::class, 'edit'])->name('other.edit');
    Route::put('/other/update/{id}', [OtherBranchController::class, 'update'])->name('other.update');
    Route::delete('/other/delete/{id}', [OtherBranchController::class, 'delete'])->name('other.delete');
});

Route::get('/admin/inquiry', function () {
    return view('admin.inquiry');
})->middleware(['auth', 'verified'])->name('inquiry');

Route::middleware('auth')->group(function () {
    Route::get('/index', [ContactUsController::class, 'showInquiry'])->name('inquiries.index');
    Route::post('/contact_us/{contactUs}/accept', [ContactUsController::class, 'accept'])->name('contact_us.accept');
    Route::delete('/contact_us/{contactUs}/decline', [ContactUsController::class, 'decline'])->name('contact_us.decline');
    Route::get('inquiries/{contactUs}/edit', [ContactUsController::class, 'edit'])->name('inquiries.edit');
    Route::put('inquiries/{contactUs}', [ContactUsController::class, 'update'])->name('inquiries.update');
});

require __DIR__ . '/auth.php';
