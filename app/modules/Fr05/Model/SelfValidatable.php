<?php
namespace Fr05\Model;

use Illuminate\Support\Facades\Validator;

trait SelfValidatable {
	
	/**
	 * Validation Rules
	 *
	 * @return array
	 */
	public function getRules() {
		return [ 
				'default' => [ ] 
		];
	}
	
	/**
	 * Valdate the given data array
	 *
	 * @param array $data
	 */
	public function validate($ruleName = 'default') {
		$rules = $this->getRules();
	
		// Trim white spaces before validating
		foreach ($this->attributes as &$attribute) {
			if ($attribute != null
					&& ! is_array($attribute)) {
				$attribute = trim($attribute);
			}
		}
	
		// Check if the requested rule is available
		if (! isset($rules[$ruleName])) {
			throw new \Exception("Rule named \"$ruleName\" is not available");
		}
	
		return Validator::make($this->attributes, $rules[$ruleName]);
	}
	
}
