<?php
namespace Fr05\Service;

use Fr05\Model\Comment;

class CommentService{

	public static function get($id){
		return Comment::find($id);
	}
	
	
	public static function delete($id){
		Comment::where('id',$id) ->delete();
	}
}