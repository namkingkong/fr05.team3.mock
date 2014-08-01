<?php

namespace Fr05\Admin\Controller;

use Fr05\Service\BannerService;
use Fr05\Service\ProductService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Fr05\Model\Banner;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Fr05\Service\ImageService;
use Fr05\Model\Image;

class BannerController extends \BaseController {
	
	public function getIndex() {
		$arrOrder [] = [ 
				'index',
				'asc' 
		];
		$banners = BannerService::getAll ( $arrOrder );
		$sliders = [ ];
		
		foreach ( $banners as $banner ) {
			if ($banner->product) {
				foreach ( $banner->product->images as $image ) {
					if ($image->isMainImage) {
						$sliders [$banner->product_id] = $image;
					}
				}
			} else {
			}
		}
		
		$data = [ 
				'banners' => $banners,
				'sliders' => $sliders 
		];
		
		return View::make ( VIEW_ADMIN . '::banner.re-order', $data );
	}
	
	public function postIndex() {
		$bannerInputs = Input::all ();
		
		$banners = [ ];
		
		foreach ( $bannerInputs as $bannerInput ) {
			$curBanner = BannerService::getById ( $bannerInput ['id'] );
			
			$curBanner->index = $bannerInput ['index'];
			
			$banners [] = $curBanner;
		}
		
		try {
			BannerService::saveMany ( $banners );
			
			return Response::json ( [ 
					'success' => true 
			] );
		} catch ( \Exception $ex ) {
			return Response::json ( [ 
					'success' => false,
					'content' => $ex->getMessage () 
			], 401 );
		}
	}
	
	public function postUpdate($productId) {
		$arrOrder [] = [ 
				'index',
				'asc' 
		];
		
		$banners = BannerService::getAll ( $arrOrder );

		$isAlreadyBanner = false;
		
		foreach ( $banners as $ban ) {
			if ($ban->product_id == $productId) {
				$isAlreadyBanner = true;
				$banner = $ban;
			}
		}
		
		try {
			if($isAlreadyBanner){
				$banner->delete();
			}else{
				$banner = new Banner ();
				$banner->product_id = $productId;
				BannerService::save ( $banner );
			}
			
			return Response::json ( [ 
					'success' => true 
			] );
		} catch ( \Exception $ex ) {
			return Response::json ( [ 
					'success' => false,
					'content' => $ex->getMessage () 
			], 401 );
		}
		
		// return Redirect::action(BannerController::class . '@getIndex');
	}
	public function getDelete($id) {
		if (! BannerService::delete ( $id )) {
			dd ( 'Something wrong' );
		}
		
		return Redirect::action ( BannerController::class . '@getIndex' );
	}
}