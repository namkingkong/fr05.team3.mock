<?php

use Fr05\Model\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\HTML;
use Illuminate\Support\MessageBag;
use Fr05\Service\CategoryService;

function generateIndentationString($indentationPattern, $level) {
	$result = '';

	for ($i = 0; $i < $level; ++$i) {
		$result .= $indentationPattern;
	}

	return $result;
}

function generateList($list) {
	$listString = '<ol class="dd-list">';
	
	foreach ($list as $item) {
		$listString .= generateListItem(
				$item,
				$item->children->count() > 0 ? $item->children : null
		);
	}
	
	$listString .= '</ol>';
	
	return $listString;
}

function generateListItem($item, $nestedList = null) {
	return "<li class='dd-item clearfix' data-id='$item->id'>"
			."<div class='dd-handle'>$item->name</div>"
			. ($nestedList ? generateList($nestedList) : null)
			.'</li>';
}

HTML::macro('categoriesNestedList', function($categories)
{	
	$listString = '<div class="dd" id="lstNestedCategories">' . generateList($categories) . '</div>';
	
	return $listString;
});

function generateCategoryParentOption($category, $level, $selectedValue = null, $indentationPattern = '-- ') {
	$indentationString = generateIndentationString($indentationPattern, $level);
	$optionString = "<option value='$category->id'".($category->id == $selectedValue ? 'selected' : null).">$category->name</option>";

	foreach ($category->children as $child) {
		$optionString .= generateCategoryParentOption($category, $level + 1, $selectedValue);
	}

	return $optionString;
}

function getCategoryComboBoxItems(& $categories) {

}

HTML::macro('createCategoryComboBox', function($attributes = [], $selectedValue = null)
{
	// Retrieve all top level category
	$categories = new Collection();
	$categories->push(new Category(['id' => null, 'name' => '*** NO PARENT ***']));

	$attributesString = '';

	foreach ($attributes as $key => $val) {
		$attributesString .= " $key='$val'";
	}

	$comboString = "<select name='category[parent_id]' $attributesString>";

	foreach ($categories as $category) {
		// 		$comboString .= "<option value='$category->id'".($category->id == $selectedValue ? 'selected' : null).">$category->name</option>";
		$comboString .= generateCategoryParentOption($category, 0, $selectedValue);
	}

	$comboString .= '</select>';

	return $comboString;
});

//macro cua Minh
HTML::macro('printCategories', function($options, $selectedVals = null)
{	
	$string = "";
	
	foreach ( $options as $option ){
		if($selectedVals!=null){
		
			$checkedStat = false;
			
			foreach ($selectedVals as $selectedVal){
				if ($option->id == $selectedVal->id) {
					$checkedStat = true;
					break;
				}
			}
		}
		$string .= "</br><input style=' margin-left: calc(($option->level - 1) * 20px)' type='checkbox' value = '".$option['id']."' name = 'category_id[]' ".(isset($checkedStat) && $checkedStat == true ? 'checked' : null)." >".$option['name'];
	}
	return $string;
});

HTML::macro('printSelections', function($name, $options, $selectedVal = null)
{
	$string = "<select name='$name' class='form-control'>";
	
	foreach ( $options as $option ){
		$string .= "<option value='{$option->id}'".($option->id == $selectedVal ? 'selected' : null).">".$option->name."</option>";
	}
	
	$string .= '</select>';
	
	return $string;
});


HTML::macro('errorMessage', function($name)
{
	$errors = Session::get(('errors'), new MessageBag());
	
	if ($errors->has($name)) {
		return '<div class="alert alert-danger padding-4 margin-top-4">'
				.'<button type="button" class="close" data-dismiss="alert">'
				.'<span aria-hidden="true">&times;</span>'
				.'<span class="sr-only">Close</span>'
				.'</button>'
				.$errors->first($name)
				.'</div>';
	}
});

HTML::macro('getChildren', function($cateList = array(), $parentCate)
{
	$children = array();
	foreach($cateList as $cate)
	{
		if($cate->parent_id == $parentCate->id)
		{
			$children[] = $cate;
		}
	}
	
	if(count($children) == 0)
	{
		return false;
	}
	else {
		return $children;
	}
});

HTML::macro('printChildren', function($cateList, $cate, $margin)
{
	$children = HTML::getChildren($cateList, $cate);
	if($children)
	{
		foreach($children as $child)
		{	
			echo "<tr>";
			echo "<td>";
			for($i=0;$i<=$margin;$i++){
				echo "&nbsp";
			}
			echo $child->name.'<br>';
			echo "</td>";
	
			echo "<td class='ha-right' ><a class='btn btn-info btn-sm' href=".URL::action('Fr05\Admin\Controller\CategoryController@getUpdate')."/".$child->id.">Update</a>";
			echo " <a class='btn btn-default btn-sm btn-delete' href='".URL::to("admin/category/delete/{$child->id}")."'>Delete</a></td>";
			echo "</tr>";
			if(HTML::getChildren($cateList,$child))
			{
				HTML::printChildren($cateList, $child, $margin+10);
			}
		}
	}
	
});

HTML::macro('bannersList', function($banners, $sliders)
{
	$listString = '<div class="dd" id="lstBanners">' . generateListBanners($banners, $sliders) . '</div>';

	return $listString;
});

function generateListBanners($items, $sliders) {
	$listStr = '<ol class="dd-list">';
	foreach ($items as $item){
		if($item->product){
			$listStr .= "<li class='dd-item clearfix' data-id='$item->id'>"
				."<div class='dd-handle'>
					<img style='width:150px; height:75px;'
								src='" . URL::asset('public/img/product/'.$item->product_id.'/'.$sliders[$item->product_id]->path) ."'>"
					."<label style='margin-left:150px'>" . $item->product->name . "</label>"
					."<label style='float:left;margin-right:150px'>" . $item->index . "</label>"
					."<a style='float:right;margin-right:20px;margin-top:15px' class='btn btn-danger btn-sm dd-nodrag' onclick='return confirm('Are you sure?')' 
								href='". URL::action('Fr05\Admin\Controller\BannerController@getDelete')."/". $item->id ."'>Delete</a></div>"
				.'</li>';
		}else{
		}
	}
	$listStr .= '</ol>';
	return $listStr;
}



HTML::macro('shop_search_categories_menu', function()
{
	$fnPrintSubMenu = function(&$parent) use (&$fnPrintSubMenu) {
		if ($parent->children()->count()) {
			echo '<div class="list-group">';
			
			foreach ($parent->children as $child) {
				echo '<div class="list-group-item">';
				echo "<a data-id='{$child->id}'>{$child->name} ({$child->products->count()})</a>";
				
				$fnPrintSubMenu($child);
				
				echo '</div>';
			}
			
			echo '</div>';
		}
	};
	
	$topLevelCategories = CategoryService::getAllTopLevel();
	
	foreach ($topLevelCategories as $topLevelCategory) {
		echo '<div class="list-group-item">';
		echo "<a data-id='{$topLevelCategory->id}'>{$topLevelCategory->name} ({$topLevelCategory->products->count()})</a>";
		
		$fnPrintSubMenu($topLevelCategory);
		
		echo '</div>';
	}
});


