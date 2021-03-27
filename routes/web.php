<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\DasborController;
use App\Http\Controllers\Karyawan\AbsensiController;
use App\Http\Controllers\Karyawan\KaryawanController;
use App\Http\Controllers\Karyawan\SlipGajiController;
use App\Http\Controllers\Master\BagianController;
use App\Http\Controllers\Master\BankController;

Route::get('/', [AuthController::class, 'index'])->name('auth.index');

Route::post('/', [AuthController::class, 'login'])->name('auth.login');

Route::get('/register-karyawan', [AuthController::class, 'register'])->name('auth.registerKaryawan');

Route::post('/register-karyawan', [KaryawanController::class, 'store'])->name('karyawan.register');

Route::middleware(['auth'])->group(function() {
	// Dasbor Route
	Route::get('dasbor', [DasborController::class, 'index'])->name('dasbor.index');

	// Edit & Update Password
	Route::get('update-password', [AuthController::class, 'editPassword'])->name('auth.editPassword');
	Route::patch('update-password/{user}', [AuthController::class, 'updatePassword'])->name('auth.updatePassword');

	// Routes for Admin
	Route::middleware(['isAdmin'])->group(function() {
		// Master Routes
		Route::prefix('master')->group(function() {
			// Bagian Routes
			Route::get('bagian', [BagianController::class, 'index'])->name('bagian.index');
			Route::post('bagian', [BagianController::class, 'store'])->name('bagian.store');
			Route::patch('bagian/{bagian}', [BagianController::class, 'update'])->name('bagian.update');
			Route::delete('bagian/{bagian}', [BagianController::class, 'destroy'])->name('bagian.destroy');

			// Bank Routes
			Route::get('bank', [BankController::class, 'index'])->name('bank.index');
			Route::post('bank', [BankController::class, 'store'])->name('bank.store');
			Route::patch('bank/{bank}', [BankController::class, 'update'])->name('bank.update');
			Route::delete('bank/{bank}', [BankController::class, 'destroy'])->name('bank.destroy');
		});
	});

	Route::middleware(['isAdminOrSeniorOfficer'])->group(function() {
		// Input Routes
		Route::prefix('input')->group(function() {
			// Karyawan Routes
			Route::get('karyawan', [KaryawanController::class, 'index'])->name('karyawan.index');
			Route::get('karyawan/create', [KaryawanController::class, 'create'])->name('karyawan.create');
			Route::post('karyawan', [KaryawanController::class, 'store'])->name('karyawan.store');
			Route::get('karyawan/{karyawan}', [KaryawanController::class, 'show'])->name('karyawan.show');
			Route::get('karyawan/{karyawan}/edit', [KaryawanController::class, 'edit'])->name('karyawan.edit');
			Route::patch('karyawan/{karyawan}', [KaryawanController::class, 'update'])->name('karyawan.update');
			Route::delete('karyawan/{karyawan}', [KaryawanController::class, 'destroy'])->name('karyawan.destroy');
			Route::patch('karyawan/validasi/{karyawan}', [KaryawanController::class, 'validasiKaryawan'])->name('karyawan.validasi');
			Route::patch('karyawan/nonaktif/{karyawan}', [KaryawanController::class, 'nonaktifkanKaryawan'])->name('karyawan.nonaktif');

			// Absensi Routes
			Route::get('absensi', [AbsensiController::class, 'index'])->name('absensiKaryawan.index');
			Route::patch('absensi/{absensi}', [AbsensiController::class, 'validasi'])->name('absensiKaryawan.validasi');
			Route::patch('absensi', [AbsensiController::class, 'validasiAll'])->name('absensiKaryawan.validasiAll');

			// Slip Gaji Routes
			Route::get('slip-gaji', [SlipGajiController::class, 'index'])->name('slipGaji.index');
			Route::post('slip-gaji/{karyawan}', [SlipGajiController::class, 'storeSlipGaji'])->name('slipGaji.store');
			Route::get('slip-gaji/{id}', [SlipGajiController::class, 'exportSlipGaji'])->name('slipGaji.export');
		});
	});

	Route::middleware(['isAdminOrBusinessManager'])->group(function() {
		// Laporan Routes
		Route::prefix('laporan')->group(function() {
			// Laporan Absensi Routes
			Route::get('absensi', [AbsensiController::class, 'indexLaporan'])->name('absensi.indexLaporan');
			Route::post('absensi/export', [AbsensiController::class, 'exportAbsensi'])->name('absensi.export');

			// Laporan Slip Gaji Routes
			Route::get('slip-gaji', [SlipGajiController::class, 'indexLaporan'])->name('slipGaji.indexLaporan');
			Route::post('slip-gaji/export', [SlipGajiController::class, 'exportSlipGajiByPeriode'])->name('slipGaji.exportSlipGajiByPeriode');

			// Laporan Karyawan Routes
			Route::get('karyawan', [KaryawanController::class, 'indexLaporan'])->name('karyawan.indexLaporan');
			Route::post('karyawan/export', [KaryawanController::class, 'exportKaryawan'])->name('karyawan.export');
		});
	});

	// Routes for Community Officer
	Route::middleware(['isCommunityOfficer'])->group(function() {
		Route::prefix('karyawan')->group(function() {
			// Absensi Karyawan Routes
			Route::post('absen', [AbsensiController::class, 'storeAbsen'])->name('absensi.storeAbsen');

			// Slip Gaji Karyawan Routes
			Route::get('slip-gaji', [SlipGajiController::class, 'indexKaryawan'])->name('slipGaji.indexKaryawan');
			Route::get('slip-gaji/export-karyawan/{id}', [SlipGajiController::class, 'exportSlipGaji'])->name('slipGajiKaryawan.export');
		});
	});

	// Logout Route
	Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});