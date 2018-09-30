<?php 
namespace App\Http\Requests;

class UpdateAuthorRequest extends StoreAuthorRequest{
	public function rules(){
		$rules = parent::rules();
		$rules['name'] = 'required|unique:authors,name,'.$this->route('author');
		return $rules;
	}
}
