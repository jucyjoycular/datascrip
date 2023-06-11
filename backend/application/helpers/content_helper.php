<?php 

 $ci= & get_instance();

function getField($where,$field_name,$id,$table)
{
   $ci= & get_instance();	
   $query = $ci->db->where($where,$id)->from($table)->get();
   $ret = $query->row();
	return $ret->$field_name;
}


if (!function_exists('update_table')) {
  function update_table($table, $data, $where)
  {
    $app = &get_instance();
    return $app->db->update($table, $data, $where);
  }
}