<?php
function navi($navArray) {
    /* example 
        $navArray = [
            'title'=>'',
            'list_style'=>'',
            'title_style'=>''
            'link_style'=>''
            'a_style'=>''
            'links'=>[
                [text=>'', a_style=>'', li_style=>'', 'href'=>''],
                []
            ]
        ]
    */
    $home = Comp::div([
        "class"=>'list-none flex justify-center items-center w-[7vw] h-full hover:pt-2 hover:bg-slate-700 duration-200 pt-2 ease-in-out hover:border-b-4 hover:border-blue-500',
        'body'=>Comp::link([
            'href'=>'http://informationsystem.sbe.co.id:62898/sbe/index.php',
            'body'=>Comp::button([
                'class'=>'home h-8 w-8 bg-transparent'
            ])
        ])
    ]);

    $links = "";

    foreach($navArray['links'] as $set) {
        if(!isset($set['link']['class'])) {
            $set['link']['class'] ="flex justify-center items-center hover:bg-slate-700 duration-200 ease-in-out hover:border-blue-500 hover:font-semibold hover:border-b-4 h-full w-full text-white ease-in-out duration-200";
        }
        if(!isset($set['li']['class'])) {
            $set['li']['class'] ="h-full w-[10vw] justify-center items-center flex";
        }
        $set['li']['body']= Comp::link($set['link']);
        $li = Comp::li($set['li']);
        $links .= $li;
    }
    $mid_nav = Comp::div([
        'class'=>"w-[63vw] h-full",
        'body'=>Comp::ul([
            'class'=>"w-full h-full flex flex-row",
            'body'=>$links
        ])
    ]);

    $title_div = Comp::div([
        'class'=>'w-[30vw] h-full flex',
        'body'=>Comp::title([
            'class'=>'text-2xl underline h-full w-full pt-2 capitalize font-bold italic text-slate-200 text-right mr-[1vw]',
            'body'=>$navArray['title']
        ])
    ]);

    $nav = $home.$mid_nav.$title_div;
    return $nav;
}

function custom_nav($array) {
    $links = "";
    foreach($array['links'] as $set) {
        if(!isset($set['link']['class'])) {
            $set['link']['class'] ="flex justify-center items-center hover:bg-slate-700 duration-200 ease-in-out hover:border-blue-500 hover:font-semibold hover:border-b-4 h-full w-full text-white ease-in-out duration-200";
        }
        $set['li']['body']= Comp::link($set['link']);
        $li = Comp::li($set['li']);
        $links .= $li;
    }
    $ul_class = "w-full h-full flex flex-row";
    if(isset($array['ul']['class'])) {
        $ul_class = $array['ul']['class'];
    }
    $nav = Comp::div([
        'class'=>"w-full h-full",
        'body'=>Comp::ul([
            'class'=> $ul_class,
            'body'=>$links
        ])
    ]);
    return $nav;
}