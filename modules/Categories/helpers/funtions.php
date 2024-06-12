<?php
function getCategories($categories, $old = "", $parent_id = 0, $char = "")
{
    if ($categories) {
        foreach ($categories as $key => $category) {
            if ($category->parent_id == $parent_id) {
                echo '<option value="' . $category->id . '"';
                if ($old == $category->id) {
                    echo ' selected';
                }
                echo '>' . $char . $category->name . '</option>';
                unset($categories[$key]);
                getCategories($categories, $old, $category->id, $char."--");
            }
        }
    }

}


