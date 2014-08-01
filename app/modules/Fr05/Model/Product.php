<?php
namespace Fr05\Model;

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Product extends BaseModel {

	use SoftDeletingTrait;
	protected $dates = ['deleted_at'];
	
	protected $table = 'product';
	
	/**
	 *
	 * @see \Fr05\Model\BaseModel::getRules()
	 */
	public function getRules() {
		return [
				'default' => [
						
						'name' => "required | unique:product,name,$this->id",
						'list_price' => "required | numeric",
						'sales_price' => "numeric",
						'country' => "",
						'quantity' =>	"numeric",
						'description' => ""	
				]
		];
	}

	/**
	 * This Product's Brand
	 */
	public function brand() {
		return $this->belongsTo(Brand::class);
	}
	
	/**
	 * Categories this Product belongs to
	 */
	public function categories() {
		return $this->belongsToMany(Category::class, 'product_category');
	}

	/**
	 * This Product's Images
	 */
	public function images() {
		return $this->hasMany(Image::class);
	}
	
	/**
	 * This Product's Featured Image
	 */
	public function featuredImage() {
		return Image::where('product_id', $this->id)
					->where('isMainImage', true)
					->first();
	}
	
	/**
	 * This Product's Banners
	 */
	public function banner() {
		return $this->hasOne(Banner::class);
	}
	
	/**
	 * This Product's Reviews
	 */
	public function reviews() {
		return $this->hasMany(Review::class);
	}

	/**
	 * This Product's Comments
	 */
	public function comments() {
		return $this->hasMany(Comment::class);
	}
}

