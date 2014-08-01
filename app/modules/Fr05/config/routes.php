<?php

use Illuminate\Support\Facades\Route;

Route::controller('/demo', Fr05\DemoController::class);

Route::controller('/auth', Fr05\Auth\Controller\AuthController::class);

Route::controller('/ajax/image', Fr05\AjaxWebService\Controller\ImagAjaxController::class);

Route::controller('/ajax/review', Fr05\AjaxWebService\Controller\ReviewAjaxController::class);

Route::controller('/ajax/comment', Fr05\AjaxWebService\Controller\CommentAjaxController::class);

Route::controller('/ajax/cart', Fr05\AjaxWebService\Controller\CartAjaxController::class);

Route::controller('/admin/brand', Fr05\Admin\Controller\BrandController::class);

Route::controller('/admin/user', Fr05\Admin\Controller\UserController::class);

Route::controller('/admin/product', Fr05\Admin\Controller\ProductController::class);

Route::controller('/admin/category', Fr05\Admin\Controller\CategoryController::class);

Route::controller('/admin/review', Fr05\Admin\Controller\ReviewController::class);

Route::controller('/admin/comment', Fr05\Admin\Controller\CommentController::class);

Route::controller('/admin/report', Fr05\Admin\Controller\ReportController::class);

Route::controller('/admin/config', Fr05\Admin\Controller\ConfigController::class);

Route::controller('/admin/banner', Fr05\Admin\Controller\BannerController::class);

Route::controller('/admin/order',Fr05\Admin\Controller\OrderController::class);

Route::controller('/admin', Fr05\Admin\Controller\HomeController::class);

Route::controller('/', Fr05\Shop\Controller\HomeController::class);
