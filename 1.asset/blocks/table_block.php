<?php
function td_input($set) {
    $field = "name='".$set['field']."' ";
    $class = 'class="w-full h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4" ';
        if(isset($set['inp_style']) && $set['inp_style'] !== '') {$class = 'class="' . $set['inp_style'] . '" ';}
    $list = "";
        if(isset($set['list']) && $set['list'] !=='') {$list = "list='" . $set['list'] . "' ";} 
    $disable = "";
        if(isset($set['disable'])) {$disable = "disabled ";} 
    $value = "value=''";
        if(isset($set['value']) && $set['value'] !=='') {$value = "value='" . $set['value'] . "' ";} 
    $placeholder = '';
        if(isset($set['placeholder']) && $set['placeholder'] !=='') {$placeholder = "placeholder='" . $set['placeholder'] . "' ";} 
    $finish = "<input type='text' ".$field.$list.$disable.$value.$placeholder.$class.">";
    return $finish;
}

function td_date($set) {
    $field = "name='".$set['field']."' ";
    $class = 'class="w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4" ';
        if(isset($set['inp_style']) && $set['inp_style'] !== '') {$class = 'class="' . $set['inp_style'] . '" ';}
    $disable = "";
        if(isset($set['disable'])) {$disable = "disabled ";} 
    $value = "value=''";
        if(isset($set['value']) && $set['value'] !=='') {$value = "value='" . $set['value'] . "' ";} 
    $finish = "<input type='date' ".$field.$disable.$value.$class.">";
    return $finish;
}

function td_textarea($set) {
    $field = "name='".$set['field']."' ";
    $class = 'class="w-full h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4" ';
        if(isset($set['inp_style']) && $set['inp_style'] !== '') {$class = 'class="' . $set['inp_style'] . '" ';}
    $rows = "rows=1 ";
        if(isset($set['rows']) && $set['rows'] !=='') {$rows = "rows=" . $set['rows'] . " ";} 
    $cols = "cols=75 ";
        if(isset($set['cols']) && $set['cols'] !=='') {$cols = "cols=" . $set['cols'] . " ";} 
    $maxlength = "maxlength=50 ";
        if(isset($set['maxlength']) && $set['maxlength'] !=='') {$maxlength = "maxlength=" . $set['maxlength'] . " ";} 
    $value = "value=''";
        if(isset($set['value']) && $set['value'] !=='') {$value = "value='" . $set['value'] . "' ";} 
    $placeholder = '';
        if(isset($set['placeholder']) && $set['placeholder'] !=='') {$placeholder = "placeholder='" . $set['placeholder'] . "' ";} 

    $finish = "<textarea ".$field.$rows.$cols.$maxlength.$value.$placeholder.$class."></textarea>";
    return $finish;
}

function td_btn_set($set) {
    $class = 'w-4 h-4';
        if(isset($set['btn_style']) && $set['btn_style'] !== '') {$class = $set['btn_style'];}
    $delimit = " ";
    $btnset = explode($delimit, $set['set']);
    $all ='';
    foreach($btnset as $value){
        switch($value) {
            case "open_down":
                $all .= "<button type='button' name='".$set['field']."' class='open ".$class."' data-method='open'>
                </button>
                ";
                break;
            case "open_right":
                $all .= "<button type='button' name='".$set['field']."' class='arrow_right_black ".$class."' data-method='open'>
                </button>
                ";
                break;
            case "delete":
                $all .= "<button type='button' name='".$set['field']."' class='minus ".$class."' data-method='delete'>
                </button>
                ";
                break;
            case "submit":
                $all .= "<button type='button' name='".$set['field']."' class='enter ".$class."' data-method='submit'>
                </button>
                ";
                break;
            case "add":
                $all .= "<button type='button' name='".$set['field']."' class='plus ".$class."' data-method='add'>
                </button>
                ";
                break;
            case "edit":
                $all .= "<button type='button' name='".$set['field']."' class='edit ".$class."' data-method='edit'>
                </button>
                ";
                break;
            case "ok":
                $all .= "<button type='button' name='".$set['field']."' class='check ".$class."' data-method='value'>
                </button>
                ";
                break;
            case "ng":
                $all .= "<button type='button' name='".$set['field']."' class='cross ".$class."' data-method='value'>
                </button>
                ";
                break;
            default: 
                $all .= '';
        }
    }
    return $all;
}


function td_logic($set) {
    $field = $set['field'];
    $div_span_class = 'flex justify-center pl-2 pt-4';
        if(isset($set['div_span_style']) && $set['div_span_style'] !== '') {$div_span_class = $set['div_span_style'];}
    $span_class = '';
        if(isset($set['span_style']) && $set['span_style'] !== '') {$span_class = $set['span_style'];}

    $all = "<div class='flex flex-col h-full'>
        <div data-logic='ok' name='".$field."__ok' class='flex items-center w-10 border-r-2 border-b-2  border-black h-[50%] justify-center hover:bg-green-400 duration-300 cursor-pointer'>OK</div>
        <div data-logic='ng' name='".$field."__ng' class='flex items-center w-10 h-[50%] border-r-2 border-black justify-center hover:bg-red-400 duration-300 cursor-pointer'>NG</div>
    </div>
    <input type='hidden' name='".$field."'>
    <div class='".$div_span_class."'>
        <span data-logic='result' class='minus ".$span_class."'></span>
    </div>";
    return $all;
}
