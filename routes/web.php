<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DepositController as AdminDepositController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\Agent\DashboardController as AgentDashboardController;
use App\Http\Controllers\Agent\AgentDepositController;
use App\Http\Controllers\Citizen\DashboardController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\PointController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

// Routes citoyen
Route::middleware('auth', 'banned', 'role:citizen')->prefix('citizen')->group(function () {
    // Tableau de bord
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Dépôts
    Route::get('deposits/index', [DepositController::class, 'index'])
        ->name('citizen.deposits.index');
    Route::get('deposits/create', [DepositController::class, 'create'])
        ->name('citizen.deposits.create');
    Route::post('deposits/store', [DepositController::class, 'store'])
        ->name('citizen.deposits.store');
    Route::get('deposits/{deposit}', [DepositController::class, 'show'])
        ->name('citizen.deposits.show');
    Route::get('deposits/{deposit}/edit', [DepositController::class, 'edit'])
        ->name('citizen.deposits.edit');
    Route::put('deposits/{deposit}', [DepositController::class, 'update'])
        ->name('citizen.deposits.update');
    Route::delete('deposits/{deposit}', [DepositController::class, 'destroy'])
        ->name('citizen.deposits.destroy');

    // Récompenses
    Route::get('rewards', [PointController::class, 'myRewards'])
        ->name('citizen.rewards.index');
    Route::post('rewards/{voucher}/redeem', [PointController::class, 'redeem'])
        ->name('citizen.rewards.redeem');
});

// Routes agent
Route::middleware('auth', 'banned', 'role:agent')->prefix('agent')->group(function () {
    // Tableau de bord
    Route::get('/dashboard', [AgentDashboardController::class, 'index'])
        ->name('agent.dashboard');
    // Dépôts agent
    Route::get('deposits/pending', [AgentDepositController::class, 'pending'])
        ->name('agent.deposits.pending');
    Route::get('deposits/assigned', [AgentDepositController::class, 'assigned'])
        ->name('agent.deposits.assigned');
    Route::post('deposits/{deposit}/assign', [AgentDepositController::class, 'assign'])
        ->name('agent.deposits.assign');
    Route::get('deposits/{deposit}/validate', [AgentDepositController::class, 'showValidate'])
        ->name('agent.deposits.validate');
    Route::post('deposits/{deposit}/validate', [AgentDepositController::class, 'validateDeposit'])
        ->name('agent.deposits.validateDeposit');
    Route::get('deposits/history', [AgentDepositController::class, 'history'])
        ->name('agent.deposits.history');
});

// Routes admin
Route::middleware('auth', 'banned', 'role:admin')->prefix('admin')->group(function () {
    // Tableau de bord admin
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');
    // Gestion des utilisateurs
    Route::get('/users', [UserController::class, 'index'])
        ->name('admin.users.index');
    Route::get('/users/{user}', [UserController::class, 'show'])
        ->name('admin.users.show');
    Route::patch('/users/{user}/ban', [AdminController::class, 'toggleBan'])
        ->name('admin.users.toggle-ban');
    Route::patch('/users/{user}/verify', [AdminController::class, 'toggleVerify'])
        ->name('admin.users.toggle-verify');
    // Gestion des dépôts
    Route::get('/deposits', [AdminDepositController::class, 'index'])
        ->name('admin.deposits.index');
    Route::get('/deposits/{deposit}', [AdminDepositController::class, 'show'])
        ->name('admin.deposits.show');
    // Gestion des catégories
    Route::get('/categories', [CategoryController::class, 'index'])
        ->name('admin.categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])
        ->name('admin.categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])
        ->name('admin.categories.store');
    Route::get('/categories/{wasteCategory}/edit', [CategoryController::class, 'edit'])
        ->name('admin.categories.edit');
    Route::patch('/categories/{wasteCategory}', [CategoryController::class, 'update'])
        ->name('admin.categories.update');
    Route::delete('/categories/{wasteCategory}', [CategoryController::class, 'destroy'])
        ->name('admin.categories.destroy');
    // Gestion des récompenses
    Route::get('/rewards', [VoucherController::class, 'index'])
        ->name('admin.rewards.index');
    Route::get('/rewards/create', [VoucherController::class, 'create'])
        ->name('admin.rewards.create');
    Route::post('/rewards', [VoucherController::class, 'store'])
        ->name('admin.rewards.store');
    Route::get('/rewards/{voucher}/edit', [VoucherController::class, 'edit'])
        ->name('admin.rewards.edit');
    Route::patch('/rewards/{voucher}', [VoucherController::class, 'update'])
        ->name('admin.rewards.update');
    Route::delete('/rewards/{voucher}', [VoucherController::class, 'destroy'])
        ->name('admin.rewards.destroy');
});

require __DIR__ . '/auth.php';
