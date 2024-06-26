<?php
function getCategoriesCheckbox($categories, $old = [], $parent_id = 0, $char = "")
{

    if ($categories) {
        foreach ($categories as $key => $category) {
            if ($category->parent_id == $parent_id) {
                $checked = !empty($old)  && in_array($category->id, $old) ? "checked" : "null";

                echo '<lable class="d-block"><input type="checkbox" name="categories[]" value="'.$category->id.'" '.$checked.' >' . $char.$category->name . '</lable>';
                unset($categories[$key]);
                getCategoriesCheckbox($categories, $old, $category->id, $char . "--");
            }
        }
    }

}
