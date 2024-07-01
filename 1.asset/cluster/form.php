<?php

function formset($form_array) {
    $id = 'default';
    if(isset($form_array['id']) && $form_array['id']!=='' ) {
        $id = $form_array['id'];
    }
    $title_style = '';
    if(isset($form_array['title_style']) && $form_array['title_style']!=='' ) {
        $title_style = $form_array['title_style'];
    }
    $title = 'Detail Form';
    if(isset($form_array['title']) && $form_array['title']!=='' ) {
        $title = $form_array['title'];
    }
    
    $formset = '';
    foreach($form_array['form_detail'] as $set) {
        $type = $set['type'];
        switch($type) {
            case "radio":
                $formset .= input_radio($set)."<br>
                ";
                break;
            case "logic":
                $formset .= logical_radio($set)."<br>
                ";
                break;
            case "textarea":
                $formset .= textarea($set)."<br>
                ";
                break;
            case "text":
                $formset .= input_text($set)."<br>
                ";
                break;
            default: 
                $formset .= '';
                break;
        }
    }

    $all = "<form id='".$id."'>
    <div class='".$title_style."'>".$title."</div>
    ".$formset."
    </form>";
    return $all;
}

