<?php

function formset($form_array) {
    $id = 'default';
    if(isset($form_array['id']) && $form_array['id']!=='' ) {
        $id = $form_array['id'];
    }
    $div_class = 'p-4 z-30 block hidden shadow-lg shadow-slate-800 rounded fixed w-[60vw] h-[60vh] mx-[20vw] my-[20vh] bg-slate-400';
    if(isset($form_array['div_style']) && $form_array['div_style']!=='' ) {
        $div_class = $form_array['div_style'];
    }

    $title = 'Detail Form';
    if(isset($form_array['title']) && $form_array['title']!=='' ) {
        $title = $form_array['title'];
    }
    
    $formset = '';
    foreach($form_array['list_field'] as $set) {
        $formset .= inputText($set)."
        ";
    }

    $all ="<div data-card='".$id."' class='".$div_class."'>
        <h2 class='text-xl font-semibold'>".$title."</h2>
        ".$formset."
    </div>";
    return $all;
}