<?php

namespace App;

use DB;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class FormDataModel extends Model
{	
	var $user_data = array();
	
	public function getSectors($get_sector_id) 
	{
		$sectors = "";
		$parent_id = 0;
		$previous_selected_sector = 0;
		$sub_cat = array();
		
		$sectors_data = DB::table("sectors")
						->orderBy('id', 'ASC')
						->get();
						
		if($get_sector_id != 0) 
		{
			$this->user_data = DB::table("user")
							   ->where('id', $get_sector_id)
							   ->get();
						
			$previous_selected_sector = isset($this->user_data[0]->sector_id) ? $this->user_data[0]->sector_id : 0;
		}
		
		foreach($sectors_data as $key=>$getsector_data) 
		{
			if($getsector_data->is_parent == 1) 
			{
				$sectors .= '<optgroup label="'.$getsector_data->sector_name.'">';
				$parent_id = $getsector_data->id;
			}
			
			foreach($sectors_data as $extract_sub_sectors) 
			{
				if($parent_id != 0 && $extract_sub_sectors->main_sector_id == $parent_id) 
				{		
					array_push($sub_cat, $extract_sub_sectors->id);	
					if(($extract_sub_sectors->main_sector_id == $parent_id) && $extract_sub_sectors->sub_cat_level == 0) 
					{
						if($previous_selected_sector == $extract_sub_sectors->id) 
						{
							$sectors .= '<option value='.$extract_sub_sectors->id.' selected>'.$extract_sub_sectors->sector_name.'</option>';
						}
						else
						{
							$sectors .= '<option value='.$extract_sub_sectors->id.'>'.$extract_sub_sectors->sector_name.'</option>';
						}
					} 
										
					if(($extract_sub_sectors->main_sector_id == $parent_id) && $extract_sub_sectors->sub_cat_level == 1) 
					{
						if(!in_array($extract_sub_sectors->sub_sub_sector_id, $sub_cat)) 
						{	
							$sectors .= '<optgroup label="'.$extract_sub_sectors->sector_name.'"style="position: relative;left: 15px;top: 6px;">';
						}
			
						else 
						{
							if($previous_selected_sector == $extract_sub_sectors->id)
							{
								$sectors .= '<option value='.$extract_sub_sectors->id.' selected>'.$extract_sub_sectors->sector_name.'</option>';
							}
							else 
							{
								$sectors .= '<option value='.$extract_sub_sectors->id.'>'.$extract_sub_sectors->sector_name.'</option>';
							}
						}
					}
					
					if(($extract_sub_sectors->main_sector_id == $parent_id) && $extract_sub_sectors->sub_cat_level == 2) 
					{
						$sectors .= '<optgroup label="'.$extract_sub_sectors->sector_name.'" style="position: relative;left: 30px;top: 6px;">';
					}
				}
			}
		} 
		$sectors .= "</optgroup>";
		return array("username" => isset($this->user_data[0]->user_name) ? $this->user_data[0]->user_name : "", "sectors" => $sectors);
	}
	
	public function saveUserData(Request $request, $username, $agreement, $sector_id) 
	{
		$count = DB::table("user")->get()->count();
		
		if($request->session()->get('user_id') === null || $count === 0)
		{
			$data = array("user_name" => $username, "sector_id" => $sector_id, "user_terms_agree" => ($agreement == "on" ? 1 : 0));
			$user_id = DB::table("user")->insertGetId($data);
			$request->session()->put('user_id', $user_id);
			
		}
		
		else
		{
			$user_id = DB::table("user")
			          ->where("id", $request->session()->get('user_id'))
					  ->update(array("sector_id" => $sector_id, "user_name" => $username));	
		}
	}
}
