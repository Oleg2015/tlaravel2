<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Http\Controllers\Controller;

use Validator;

class ContactController extends Controller
{
//	protected $request;
//	
//	public function __construct(Request $request) {
//		$this->request = $request;
//	}
    
		public function store(Request $request,$id = FALSE) {

			if($request->isMethod('post')) {
				
				$messages = [
					'name.required' => 'ПОЛЕ :attribute обязательно к заполнению',
					'email.max' => 'Максимально допустимое количество символов в поле :attribute - :max'
				];
				$validator = Validator::make($request->all(),[
					'name'=>'required',
//					'email'=>'required'
					],
					$messages);
				
				$validator->sometimes(['email','site'],'required',function($input) {
//					dump($input);
//					exit();
					return strlen($input->name) >= 10;
				});
				
//				$validator->after(function($validator) {
//					$validator->errors()->add('name','Дополнительное сообщение');
//				});
				
				if($validator->fails()) {
					
					$messages = $validator->errors();					
					
//					if($messages->has('name')) {
//						dump($messages->first('name','<p> :message </p>'));
//					}
					dump($validator->failed());
					exit();
					
					return redirect()->route('contact')->withErrors($validator)->withInput();
				}
				
				
			}
			
			  return view('default.contact',['title'=>'Contacts']);
		  }
		
	public function show() {
		return view('default.contact',['title'=>'Contacts']);
	}
}