<?php
namespace Fr05\AjaxWebService\Controller;

use Illuminate\Support\Facades\Input;
use Fr05\Service\ImageService;
use Illuminate\Support\Facades\Response;
use Fr05\Exception\ProductNotFoundException;
use Illuminate\Support\Facades\URL;
use Fr05\Model\Image;

class ImagAjaxController extends \BaseController {
	
	/**
	 * [REQUEST_METHOD = GET]
	 * Get all Images of the requested Product
	 * 
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function getGetImages($productId) {
		try {
			$images = ImageService::get($productId);
			
			foreach ($images as $image) {
				$image->path = URL::to("public/img/product/{$productId}/{$image->path}");
			}
			
			// Success result
			$data = [
					'status' => true,
					'data' => $images
			];
		}
		catch (ProductNotFoundException $ex) {
			// Failed result (if Product not found)
			$data = [
					'status' => false,
					'message' => $ex->getMessage()
			];
		}
		
		return Response::json($data);
	}
	
	/**
	 * [REQUEST_METHOD = DELETE]
	 * Delete the requested Image
	 * 
	 * **************************
	 * ***** Must be ADMIN ******
	 * **************************
	 */
	public function getDelete($id) {
		/*
		 * Check authentication and authorization
		 */
		// TODO: CHECK...
		
		/*
		 * Delete
		 */
		try {
			$result = ImageService::delete($id);
			
			$data = [
					'status' => true,
					'data' => $result
			];
		}
		catch (EntityNotFoundException $ex) {
			$data = [
					'status' => false,
					'data' => $ex->getMessage()
			];
		}
		
		/*
		 * Return result
		 */
		return Response::json($data);
	}
	
	public function getSetMain($id) {
		if (ImageService::setMainImage ($id)) {
			$data = [ 
					'status' => true,
					'message' => 'OK' 
			];
		} else {
			$data = [
					'status' => false,
					'message' => 'Error' 
			];
		}
		
		return Response::json($data);
	}
}
