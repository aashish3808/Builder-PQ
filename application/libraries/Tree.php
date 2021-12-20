<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Tree {
    var $table = '';
    var $CI = '';
    var $ul_class = '';
    var $iteration_number = 0;
    function __construct($config = array()) {
        $this -> table = $config['table'];
        $this -> CI = &get_instance();
        $this -> CI -> load -> database();
        $this -> ul_class = $config['ul_class'];
    }
    function getTree($parent_id = 0,$filter_id = 0, $selected_id = 0, $formField = '') {
		
		$selected_string = '';
		$tree            = '';
        $this -> iteration_number++;
        $this -> CI -> db -> where('parentId', $parent_id);
        $first_level = $this -> CI -> db -> get($this -> table) -> result();
		if($this -> iteration_number == 1){
			if($selected_id == 0) $selected_string = 'checked="checked"' ;
            $tree .= '<ul><li><span class="leaf" >Main Category<input type="radio" '. $selected_string .' name="form['.$formField.']" value="0"></span></li></ul>';
			
		}
        if($this->iteration_number == 1)
            $tree .= '<ul style="margin-left:40px;" id="red" class="' . $this -> ul_class . '">';
        else
            $tree .= '<ul>';
			
        foreach ($first_level as $fl) {
			$selected_string = '';
            $this -> CI -> db -> where('parentId', $fl -> id);
            $count = $this -> CI -> db -> count_all_results($this -> table);
            if ($count != 0) {
					if($fl -> id != $filter_id){
						if($selected_id == $fl -> id) $selected_string = 'checked="checked"' ;
                		$tree .= '<li><span class="leaf" >' . $fl -> name . '<input type="radio" '. $selected_string .' name="form['.$formField.']" value="'.$fl -> id.'"></span>';
					}
					else{
						$tree .= '<li><span class="leaf" >' . $fl -> name . '</span>';
					}
					$tree .= $this -> getTree($fl -> id,$filter_id,$selected_id,$formField);
            } else {
				if($fl -> id != $filter_id){
					if($selected_id == $fl -> id) $selected_string = 'checked="checked"' ;
                	$tree .= '<li class="' . $this -> ul_class . '">'.$fl -> name.'<input type="radio" '. $selected_string .' name="form['.$formField.']" value="'.$fl -> id.'">';
				}
				else{
						$tree .= '<li><span class="leaf" >' . $fl -> name . '</span>';
					}
            }
            $tree .= '</li>';
        }
        $tree .= '</ul>';
        return $tree;
    }
}
?>
