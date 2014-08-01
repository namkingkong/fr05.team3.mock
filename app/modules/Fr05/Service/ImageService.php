<?php
namespace Fr05\Service;

use Fr05\Model\Product;
use Fr05\Exception\ProductNotFoundException;
use Illuminate\Support\Facades\Validator;
use Fr05\Exception\EntityNotFoundException;
use Fr05\Model\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ImageService {
	
	/**
	 * Validate the given File input
	 * 
	 * @param array $input
	 * @param array $rule
	 */
	public static function validate($image, $rules) {
		$validator = Validator::make(array('image'=> $image), $rules);
		return $validator;
	}
	
	/**
	 * Delete the image having the given ID
	 * 
	 * @param int $id
	 */
	public static function delete($id){
		$image = Image::find($id);
		
		if ($image == null) {
			throw new EntityNotFoundException('Image not found');
		}
		
		$result = 0;
		
		DB::transaction(function() use (&$result, $image) {
			// Check if the Image to be deleted is main image
			$isMainImage = $image->isMainImage;
			
			// Retrieve Product ID for later user
			$productId = $image->product_id;
			
			// Delete
			$result = $image->delete();
			
			// Set Main Image (if the deleted one is Main Image)
			if ($isMainImage) {
				$nextImage = Image::where('product_id', $productId)
								->limit(1)
								->first();

				if ($nextImage) {
					$nextImage->isMainImage = true;
					$nextImage->save();
				}
			}
		});
		
		File::delete(public_path() . "/img/product/{$image->product_id}/{$image->path}");
		
		return $result;
	}
	
	/**
	 * Get all Images of the Product having the given ID
	 * 
	 * @param int $productId
	 * 
	 * @throws ProductNotFoundException
	 * 
	 * @return array
	 */
	public static function get($productId) {
		$product = Product::find($productId);
		
		if ($product == null) {
			throw new ProductNotFoundException('Product not found');
		}
		
		return $product->images;
	}
	
	public static function setMainImage($id){
		$image = Image::find($id);
		
		$product = $image->product;
		
		if($main = $product->featuredImage()) {
			$main->isMainImage = 0;
			$main->save();
		}
		
		$image->isMainImage = 1;
		
		return $image->save();
	}
}
