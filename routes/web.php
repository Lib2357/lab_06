<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


// 1. Route /home trả về một chuỗi văn bản
Route::get('/home', function () {
    return "Chào mừng đến với Laravel";
});

// 2. Route /about trả về thông tin cá nhân
Route::get('/about', function () {
    return "Họ tên: Nguyễn Văn A - Lớp: WD1801 - MSSV: PS12345";
});

// 3. Route /contact trả về file contact.blade.php
Route::get('/contact', function () {
    return view('contact'); 
    // Lưu ý: Chỉ ghi 'contact', không cần ghi đuôi .blade.php
});

// Route tính tổng hai số a và b
Route::get('/tong/{a}/{b}', function ($a, $b) {
    $sum = $a + $b; // Thực hiện phép tính
    return "Tổng của $a và $b là: $sum";
});

// Route thông tin sinh viên với tham số age tùy chọn
Route::get('/sinh-vien/{name}/{age?}', function ($name, $age = 20) {
    return "Sinh viên: $name - Tuổi: $age";
});


// Gom nhóm các route có chung tiền tố 'admin'
Route::prefix('admin')->group(function () {
    
    // Đường dẫn thực tế sẽ là: /admin/dashboard
    Route::get('/dashboard', function () {
        return "Chào mừng Admin đến với trang quản trị";
    });

    // Đường dẫn thực tế sẽ là: /admin/users
    Route::get('/users', function () {
        return "Danh sách người dùng hệ thống";
    });
    
});

// Route kiểm tra ngày tháng với các ràng buộc nghiêm ngặt
Route::get('/check-date/{day}/{month}/{year}', function ($day, $month, $year) {
    return "Ngày bạn vừa nhập là: $day/$month/$year";
})->where([
    'day'   => '[1-9]|[12][0-9]|3[01]', // Chỉ nhận số từ 1-31
    'month' => '[1-9]|1[0-2]',          // Chỉ nhận số từ 1-12
    'year'  => '[0-9]{4}'               // Phải là đúng 4 chữ số
]);