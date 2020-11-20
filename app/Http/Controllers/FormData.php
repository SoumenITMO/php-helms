<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class FormData extends Controller
{
    public function getDatabaseData1() {		
		
		$arranged_data = array();
		$subsectors = [];
		$sub_sub_sectors = [];
		$has_third_sub_category = false;
		$sub_sub_cat_id = 0;
		$sub_sub_cat_name = "";
		$sub_cat_id = 0;
		
		$sector_data = DB::table('sub_sectors')->get();
		
		foreach($sector_data as $getsector_data) {
			
			if($has_third_sub_category && ($sub_sub_cat_id == $getsector_data->sub_sub_sector_id)) 
			{
				$sub_sub_sectors[$getsector_data->id] = $getsector_data->sub_sector_name;
			} 
			
			else 
			{								
				if($sub_sub_cat_name != "" && !empty($sub_sub_sectors))
					array_push($arranged_data, array($sub_sub_cat_name => $sub_sub_sectors));
				
				$has_third_sub_category = false;
				$sub_sub_cat_id = 0;
				$sub_sub_cat_name = "";
				$sub_sub_sectors = [];
			}
			
			if($getsector_data->sub_cat_level == 2) 
			{
				$sub_sub_cat_id = $getsector_data->id;
				$sub_sub_cat_name = $getsector_data->sub_sector_name;
				$has_third_sub_category = true;
			}
			
			else if($getsector_data->sub_cat_level == 1 ) 
			{
				foreach($sector_data as $key=>$getsector_data_) 
				{	
					if(($getsector_data->id == $getsector_data_->sub_sub_sector_id) && $getsector_data_->sub_cat_level == 0) 
					{
						$subsectors[$getsector_data_->id] = $getsector_data_->sub_sector_name;
					}
				}
				array_push($arranged_data, array($getsector_data->sub_sector_name => $subsectors));
				$sub_cat_id = $getsector_data->id;
				$subsectors = [];
			}
			
			else if($getsector_data->sub_cat_level == 0 && $sub_cat_id != $getsector_data->sub_sub_sector_id) 
			{
				array_push($arranged_data, $getsector_data->sub_sector_name);
			}
		}
		
		echo "<pre>";
		print_r($arranged_data);
		echo "</pre>";
	}
	
	public function get() {
		
		$parent = [];
		$main_sectors = [];
		$sub_category = [];
		$sub_sub_category = [];
		$parent_no_sub_sectors = [];
		$main_arr = array();
		$sub_cat_id = 0;
		$compare_sub_cat_id = 0;
		
		
		$sectors_data = DB::select(DB::raw("SELECT * FROM `sub_sectors`"));
		
		foreach($sectors_data as $key=>$getsector_data) 
		{
			
			if($getsector_data->is_parent == 1) {
				$main_sectors[$getsector_data->id] = $getsector_data->sector_name;
			}
			
			if($getsector_data->sub_cat_level == 0 && ($compare_sub_cat_id == $getsector_data->sub_sub_sector_id) && $compare_sub_cat_id != 0) {
				$sub_sub_category[$getsector_data->id] = $getsector_data->sector_name;
			}
			
			if($getsector_data->sub_cat_level == 0 && $sub_cat_id == $getsector_data->sub_sub_sector_id) {
				$sub_category[$getsector_data->id] = $getsector_data->sector_name;
			}
			
			if($getsector_data->sub_cat_level == 0 && $getsector_data->sub_sub_sector_id == 0) {
				$parent_no_sub_sectors[$getsector_data->id] = $getsector_data->sector_name;
			}
			
			if($getsector_data->sub_cat_level == 2 && $getsector_data->sub_sub_sector_id != 0) {
				$compare_sub_cat_id = $getsector_data->id;
			}
			
			if($getsector_data->sub_cat_level == 1 && $getsector_data->sub_sub_sector_id == 0) {
				$parent[$getsector_data->id] = $getsector_data->sector_name;
				$sub_cat_id = $getsector_data->id;
			}
		}
		
		array_push($main_arr, array("main"=>$main_sectors, "parent" => $parent_no_sub_sectors, "parent_sub_sectors" => $parent, "subsectors" => $sub_category, 
		"sub_subsectors" => $sub_sub_category));
		
		echo "<pre>";
		print_r($main_arr);
		echo "</pre>"; 
	}
}
