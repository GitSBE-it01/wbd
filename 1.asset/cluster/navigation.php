<?php
function nav($navArray) {
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
    $home = "<li class='list-none w-[7vw] h-full hover:pt-2 hover:bg-slate-700 duration-200 pt-2 pl-10 pr-10 ease-in-out hover:border-b-4 hover:border-teal-300'>
            <a href='http://informationsystem.sbe.co.id:8080/sbe/index.php'>
                <button class='home h-8 w-8 bg-transparent'>
                </button>
            </a>
        </li>";

    $dflt_list_style = "w-[63vw] h-full flex flex-row";
        if(isset($navArray['list_style']) && $navArray['list_style'] !=='') {$dflt_list_style = $navArray['list_style'];}

    $dflt_link_style  = "h-full w-[10vw] pt-3 justify-center flex hover:bg-slate-700 duration-200 ease-in-out hover:border-teal-300 hover:font-semibold hover:border-b-4 hover:pt-2";
    if(isset($navArray['link_style']) && $navArray['link_style'] !=='') {$dflt_link_style = $navArray['link_style'];}

    $dflt_a_style = "text-white ease-in-out duration-200";
    if(isset($navArray['a_style']) && $navArray['a_style'] !=='') {$dflt_a_style = $navArray['a_style'];}

    $links = "";
    foreach($navArray['links'] as $set) {
        $li_style = $dflt_link_style;
            if(isset($set['li_style']) && $set['li_style'] !=='') {$li_style = $set['li_style'];}
        $a_style = $dflt_a_style;
            if(isset($set['a_style']) && $set['a_style'] !=='') {$a_style = $set['a_style'];}
        $text = $set['text'];
        $href = $set['href'];
        $link = "
            <li class='".$li_style."'>
                <a class='" .$a_style ."' href='".$href ."'>"."
                    ".$text."
                </a>
            </li>";
        $links .= $link;
    }

    $dflt_title_style = "text-2xl underline h-full w-full pt-2 capitalize font-bold italic text-slate-200 text-right mr-[1vw]";
        if(isset($navArray['title_style']) && $navArray['title_style'] !=='') {$dflt_title_style = $navArray['title_style'];}
    $title = "<div class='w-[30vw] h-full flex'>
            <h1 class='".$dflt_title_style . "'>
                ".$navArray['title']."
            </h1>
        </div>";

    $finish = $home."
        <ul class='".$dflt_list_style."'>"
            .$links."
        </ul>
        ".$title;
    return $finish;
}
