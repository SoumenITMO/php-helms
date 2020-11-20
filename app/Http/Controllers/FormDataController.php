<?php

namespace App\Http\Controllers;

use App\FormDataModel;
use Illuminate\Http\Request;

class FormDataController extends Controller
{
	var $form_data_model;
	
	public function __construct() 
	{
		$this->form_data_model = new FormDataModel;
	}
	
    public function getSectors(Request $request) 
	{
		$user_sector_id = ($request->session()->get('user_id') != null) ? $request->session()->get('user_id') : 0 ;
		return view("index", ["formdata" => $this->form_data_model->getSectors($user_sector_id)]);
	}	

	public function saveUserData(Request $request) 
	{
		$validation_rules = [
			'username' => 'required|string',
			'terms_condition' => 'accepted',
			'sectors' => 'required|numeric'
		];
		
		$custom_messages = [
			'username.required' => 'Please enter your name',
			'terms_condition.required' => 'Please accept agrement.',
			'sectors.required' => 'Please select an sector'
		];
		
		$this->validate($request, $validation_rules, $custom_messages);
		
		$user_name = $request->input("username");
		$terms_agreement = $request->input("terms_condition");
		$selected_sector = $request->input("sectors");
		
		$this->form_data_model->saveUserData($request, $user_name, $terms_agreement, $selected_sector);
		return redirect('/');
	}
}
