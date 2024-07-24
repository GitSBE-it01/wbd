<?php

class Comp {
    static function default($array) {
        $title = isset($array['title']) ? "title='".$array['title']."' " : '';
        $class = isset($array['class']) ? "class='".$array['class']."' " : '';
        $type_attr = isset($array['type_attr']) ? "type='".$array['type_attr']."' " : '';
        $id = isset($array['id']) ? "id='".$array['id']."' " : '';
        $for = isset($array['for']) ? "for='".$array['for']."' " : '';
        $name = isset($array['name']) ? "name='".$array['name']."' " : '';
        $list = isset($array['list']) ? "list='".$array['list']."' " : '';
        $placeholder = isset($array['placeholder']) ? "placeholder='".$array['placeholder']."' " : '';
        $disable = isset($array['disable']) ? "disabled " : '';
        $require = isset($array['require']) ? "required " : '';
        $value = isset($array['value']) ? "value='".$array['value']."' " : '';
        $cols = isset($array['cols']) ? "colspan='".$array['cols']."' " : '';
        $rows = isset($array['rows']) ? "rowspan='".$array['rows']."' " : '';
        $autocomplete = isset($array['autocomplete']) ? "autocomplete='".$array['autocomplete']."' " : '';
        $maxlength = isset($array['maxlength']) ? "maxlength='".$array['maxlength']."' " : '';
        $href = isset($array['href']) ? "href='".$array['href']."' " : '';
        $body = '';
        if(isset($array['body'])) {
            if(is_array($array['body'])) {
                foreach($array['body'] as $val) {
                    $body .= $val;
                }
            } else {
                $body = $array['body'];
            }
        }
        $data_attr = '';
        if(isset($array['data_attr'])) {
            foreach($array['data_attr'] as $val2) {
                $data_att = explode('::', $val2);
                $data_attr .= 'data-'.$data_att[0]."='".$data_att[1]."' ";
            }
        }
        $component = "<button " 
        .$title
        .$id
        .$for
        .$name
        .$type_attr
        .$list
        .$placeholder
        .$value
        .$href
        .$autocomplete
        .$rows
        .$cols
        .$maxlength
        .$data_attr
        .$require
        .$class
        .$disable.">"
        .$body."
        </button>";

        return $component;
    }

    static function button($array) {
        $title = isset($array['title']) ? "title='".$array['title']."' " : '';
        $class = isset($array['class']) ? "class='".$array['class']."' " : '';
        $type_attr = isset($array['type_attr']) ? "type='".$array['type_attr']."' " : "type='button' ";
        $id = isset($array['id']) ? "id='".$array['id']."' " : '';
        $name = isset($array['name']) ? "name='".$array['name']."' " : '';
        $disable = isset($array['disable']) ? "disabled " : '';
        $body = '';
        if(isset($array['body'])) {
            if(is_array($array['body'])) {
                foreach($array['body'] as $val) {
                    $body .= $val;
                }
            } else {
                $body = $array['body'];
            }
        }
        $data_attr = '';
        if(isset($array['data_attr'])) {
            foreach($array['data_attr'] as $val2) {
                $data_att = explode('::', $val2);
                $data_attr .= 'data-'.$data_att[0]."='".$data_att[1]."' ";
            }
        }
        $component = "<button " 
        .$title
        .$id
        .$name
        .$type_attr
        .$data_attr
        .$class
        .$disable.">"
        .$body."
        </button>";

        return $component;
    }

    // structure
    static function div($array) {
        $title = isset($array['title']) ? "title='".$array['title']."' " : '';
        $class = isset($array['class']) ? "class='".$array['class']."' " : '';
        $id = isset($array['id']) ? "id='".$array['id']."' " : '';
        $name = isset($array['name']) ? "name='".$array['name']."' " : '';
        $body = '';
        if(isset($array['body'])) {
            if(is_array($array['body'])) {
                foreach($array['body'] as $val) {
                    $body .= $val;
                }
            } else {
                $body = $array['body'];
            }
        }
        $data_attr = '';
        if(isset($array['data_attr'])) {
            foreach($array['data_attr'] as $val2) {
                $data_att = explode('::', $val2);
                $data_attr .= 'data-'.$data_att[0]."='".$data_att[1]."' ";
            }
        }
        $component = "<div " 
        .$title
        .$id
        .$name
        .$data_attr
        .$class.">"
        .$body."
        </div>";

        return $component;
    }

    static function nav($array) {
        $title = isset($array['title']) ? "title='".$array['title']."' " : '';
        $class = isset($array['class']) ? "class='".$array['class']."' " : '';
        $id = isset($array['id']) ? "id='".$array['id']."' " : '';
        $name = isset($array['name']) ? "name='".$array['name']."' " : '';
        $body = '';
        if(isset($array['body'])) {
            if(is_array($array['body'])) {
                foreach($array['body'] as $val) {
                    $body .= $val;
                }
            } else {
                $body = $array['body'];
            }
        }
        $data_attr = '';
        if(isset($array['data_attr'])) {
            foreach($array['data_attr'] as $val2) {
                $data_att = explode('::', $val2);
                $data_attr .= 'data-'.$data_att[0]."='".$data_att[1]."' ";
            }
        }
        $component = "<nav " 
        .$title
        .$id
        .$name
        .$data_attr
        .$class.">"
        .$body."
        </nav>";
        return $component;
    }

    static function header($array) {
        $title = isset($array['title']) ? "title='".$array['title']."' " : '';
        $class = isset($array['class']) ? "class='".$array['class']."' " : '';
        $id = isset($array['id']) ? "id='".$array['id']."' " : '';
        $name = isset($array['name']) ? "name='".$array['name']."' " : '';
        $body = '';
        if(isset($array['body'])) {
            if(is_array($array['body'])) {
                foreach($array['body'] as $val) {
                    $body .= $val;
                }
            } else {
                $body = $array['body'];
            }
        }
        $data_attr = '';
        if(isset($array['data_attr'])) {
            foreach($array['data_attr'] as $val2) {
                $data_att = explode('::', $val2);
                $data_attr .= 'data-'.$data_att[0]."='".$data_att[1]."' ";
            }
        }
        $component = "<header " 
        .$title
        .$id
        .$name
        .$data_attr
        .$class.">"
        .$body."
        </header>";
        return $component;
    }

    static function aside($array) {
        $title = isset($array['title']) ? "title='".$array['title']."' " : '';
        $class = isset($array['class']) ? "class='".$array['class']."' " : '';
        $id = isset($array['id']) ? "id='".$array['id']."' " : '';
        $name = isset($array['name']) ? "name='".$array['name']."' " : '';
        $body = '';
        if(isset($array['body'])) {
            if(is_array($array['body'])) {
                foreach($array['body'] as $val) {
                    $body .= $val;
                }
            } else {
                $body = $array['body'];
            }
        }
        $data_attr = '';
        if(isset($array['data_attr'])) {
            foreach($array['data_attr'] as $val2) {
                $data_att = explode('::', $val2);
                $data_attr .= 'data-'.$data_att[0]."='".$data_att[1]."' ";
            }
        }
        $component = "<aside " 
        .$title
        .$id
        .$name
        .$data_attr
        .$class.">"
        .$body."
        </aside>";
        return $component;
    }

    static function main($array) {
        $title = isset($array['title']) ? "title='".$array['title']."' " : '';
        $class = isset($array['class']) ? "class='".$array['class']."' " : '';
        $id = isset($array['id']) ? "id='".$array['id']."' " : '';
        $name = isset($array['name']) ? "name='".$array['name']."' " : '';
        $body = '';
        if(isset($array['body'])) {
            if(is_array($array['body'])) {
                foreach($array['body'] as $val) {
                    $body .= $val;
                }
            } else {
                $body = $array['body'];
            }
        }
        $data_attr = '';
        if(isset($array['data_attr'])) {
            foreach($array['data_attr'] as $val2) {
                $data_att = explode('::', $val2);
                $data_attr .= 'data-'.$data_att[0]."='".$data_att[1]."' ";
            }
        }
        $component = "<main " 
        .$title
        .$id
        .$name
        .$data_attr
        .$class.">"
        .$body."
        </main>";
        return $component;
    }

    static function footer($array) {
        $title = isset($array['title']) ? "title='".$array['title']."' " : '';
        $class = isset($array['class']) ? "class='".$array['class']."' " : '';
        $id = isset($array['id']) ? "id='".$array['id']."' " : '';
        $name = isset($array['name']) ? "name='".$array['name']."' " : '';
        $body = '';
        if(isset($array['body'])) {
            if(is_array($array['body'])) {
                foreach($array['body'] as $val) {
                    $body .= $val;
                }
            } else {
                $body = $array['body'];
            }
        }
        $data_attr = '';
        if(isset($array['data_attr'])) {
            foreach($array['data_attr'] as $val2) {
                $data_att = explode('::', $val2);
                $data_attr .= 'data-'.$data_att[0]."='".$data_att[1]."' ";
            }
        }
        $component = "<footer " 
        .$title
        .$id
        .$name
        .$data_attr
        .$class.">"
        .$body."
        </footer>";
        return $component;
    }

    // list input and selection
    static function dtlist($array) {
        $title = isset($array['title']) ? "title='".$array['title']."' " : '';
        $id = isset($array['id']) ? "id='".$array['id']."' " : '';
        $body = '';
        if(isset($array['body'])) {
            if(is_array($array['body'])) {
                foreach($array['body'] as $val) {
                    $body .= $val;
                }
            } else {
                $body = $array['body'];
            }
        }
        $data_attr = '';
        if(isset($array['data_attr'])) {
            foreach($array['data_attr'] as $val2) {
                $data_att = explode('::', $val2);
                $data_attr .= 'data-'.$data_att[0]."='".$data_att[1]."' ";
            }
        }
        $component = "<datalist " 
        .$title
        .$id
        .$data_attr.">"
        .$body."
        </datalist>";

        return $component;
    }

    static function input($array) {
        $title = isset($array['title']) ? "title='".$array['title']."' " : '';
        $class = isset($array['class']) ? "class='".$array['class']."' " : 'rounded p-2 focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 shadow-md w-[70%]';
        $type_attr = isset($array['type_attr']) ? "type='".$array['type_attr']."' " : "type='text' ";
        $id = isset($array['id']) ? "id='".$array['id']."' " : '';
        $name = isset($array['name']) ? "name='".$array['name']."' " : '';
        $list = isset($array['list']) ? "list='".$array['list']."' " : '';
        $placeholder = isset($array['placeholder']) ? "placeholder='".$array['placeholder']."' " : '';
        $disable = isset($array['disable']) ? "disabled " : '';
        $require = isset($array['require']) ? "required " : '';
        $value = isset($array['value']) ? "value='".$array['value']."' " : '';
        $body = '';
        if(isset($array['body'])) {
            if(is_array($array['body'])) {
                foreach($array['body'] as $val) {
                    $body .= $val;
                }
            } else {
                $body = $array['body'];
            }
        }
        $data_attr = '';
        if(isset($array['data_attr'])) {
            foreach($array['data_attr'] as $val2) {
                $data_att = explode('::', $val2);
                $data_attr .= 'data-'.$data_att[0]."='".$data_att[1]."' ";
            }
        }

        $component = "<input " 
        .$title
        .$id
        .$name
        .$type_attr
        .$list
        .$placeholder
        .$value."
        autocomplete='off' "
        .$data_attr
        .$require
        .$class
        .$disable.">"
        .$body."
        ";
        return $component;
    }

    static function select($array) {
        $title = isset($array['title']) ? "title='".$array['title']."' " : '';
        $class = isset($array['class']) ? "class='".$array['class']."' " : '';
        $id = isset($array['id']) ? "id='".$array['id']."' " : '';
        $name = isset($array['name']) ? "name='".$array['name']."' " : '';
        $disable = isset($array['disable']) ? "disabled " : '';
        $require = isset($array['require']) ? "required " : '';
        $multiple = isset($array['multiple']) ? "multiple " : '';
        $size = isset($array['size']) ? "size='".$array['size']."' " : '';
        $body = '';
        if(isset($array['body'])) {
            if(is_array($array['body'])) {
                foreach($array['body'] as $val) {
                    $body .= $val;
                }
            } else {
                $body = $array['body'];
            }
        }
        $data_attr = '';
        if(isset($array['data_attr'])) {
            foreach($array['data_attr'] as $val2) {
                $data_att = explode('::', $val2);
                $data_attr .= 'data-'.$data_att[0]."='".$data_att[1]."' ";
            }
        }
        $component = "<select " 
        .$title
        .$id
        .$name
        .$multiple
        .$size
        .$data_attr
        .$require
        .$class
        .$disable.">"
        .$body."
        </select>";

        return $component;
    }

    static function option($array) {
        $value = isset($array['value']) ? "value='".$array['value']."' " : '';
        $select = isset($array['select']) ? "selected ": '';
        $disable = isset($array['disable']) ? "disabled ": '';
        $body = '';
        if(isset($array['body'])) {
            if(is_array($array['body'])) {
                foreach($array['body'] as $val) {
                    $body .= $val;
                }
            } else {
                $body = $array['body'];
            }
        }
        $component = "<option " 
        .$value
        .$select
        .$disable
        .">
        ".$body."
        </option>";

        return $component;
    }

    static function label($array) {
        $title = isset($array['title']) ? "title='".$array['title']."' " : '';
        $class = isset($array['class']) ? "class='".$array['class']."' " : '';
        $for = isset($array['for']) ? "for='".$array['for']."' " : '';
        $body = '';
        if(isset($array['body'])) {
            if(is_array($array['body'])) {
                foreach($array['body'] as $val) {
                    $body .= $val;
                }
            } else {
                $body = $array['body'];
            }
        }
        $data_attr = '';
        if(isset($array['data_attr'])) {
            foreach($array['data_attr'] as $val2) {
                $data_att = explode('::', $val2);
                $data_attr .= 'data-'.$data_att[0]."='".$data_att[1]."' ";
            }
        }
        $component = "<label " 
        .$title
        .$for
        .$data_attr
        .$class.">"
        .$body."
        </label>";

        return $component;
    }

    // table
    static function create_table($array) {
        /*
        $array = [
            'table'=>[
                'id'=>'',
            ],
            'row_count'=>'',
            'class'=>[
                'table'=>'',
                'tr'=>'',
                'th_first'=>'',
                'th'=>'',
                'td_first'=>'',
                'td'=>'',
            ],
            'tr'=>[
                [
                    'type'=>'text',
                    'th'=>[
                        'body'=>'text here', 
                        'class'=>'custom class here'
                    ],
                    'td'=>[
                        'data_attr'=>['custom_attribute::value_custom_attribute'],
                        'body'=>'text here', 
                        'class'=>'custom class here'
                    ],
                ],
                [
                    'type'=>'input',
                    'th'=>[
                        'body'=>'text here', 
                        'class'=>'custom class here'
                    ],
                    'td'=>[
                        'data_attr'=>[
                            'custom_attribute::value_custom_attribute'
                        ],
                        'class'=>'custom class here'
                    ],
                    'inp'=>[
                        'type_attr'=>'type input here', 
                        'name'=> 'eff_date',
                        'class'=>'custom class here'
                    ]
                ],
                [
                    'type'=>'select',
                    'th'=>[
                        'body'=>'text here', 
                        'class'=>'custom class here'
                    ],
                    'td'=>[
                        'data_attr'=>[
                            'custom_attribute::value_custom_attribute'
                        ],
                        'class'=>'custom class here'
                    ],
                    'sel'=>[
                        'type_attr'=>'type input here', 
                        'name'=> 'field in database',
                        'class'=>'custom class here',
                    ],
                    'opt'=>[
                        [
                            'body'=>'',
                            'select'=>'', //if needed for default option selected
                            'disable'=>'', //if needed for disabled option to be selected
                        ],
                    ],
                ],
                [
                    'type'=>'hidden',
                    'inp'=>['type_attr'=>'hidden', 'name'=> 'field in database', 'value'=>'value of value in input hidden']
                ],
                [
                    'type'=>'set_btn',
                    'th'=>[
                        'body'=>'text here', 
                        'class'=>'custom class here'
                    ],
                    'td'=>[
                        'data_attr'=>[
                            'custom_attribute::value_custom_attribute'
                        ],
                        'class'=>'custom class here'
                    ],
                    'btn'=>[
                        [
                            'data_attr'=>['method::open'],
                            'class'=>'w-6 h-6 arrow_right_black'
                        ],
                        [
                            'data_attr'=>['method::delete'],
                            'class'=>'w-6 h-6 ml-2 minus'
                        ],
                    ]
                ],
            ],
        ];*/

        //class
        $cls = $array['class'];
        $array['table']['class'] = isset($cls['table']) ? $cls['table'] : 'w-full scrollable';
        $class_tr = isset($cls['tr']) ? $cls['tr'] : 'hidden';
        $class_th_first = isset($cls['th_first']) ? $cls['th_first'] : 'bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20 ';
        $class_th = isset($cls['th']) ? $cls['th'] : 'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 ';
        $class_td_first = isset($cls['td_first']) ? $cls['td_first'] : 'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10 w-[20vw]';
        $class_td = isset($cls['td']) ? $cls['td'] : 'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black ';

        // header
        $th = '';
        for($i=0; $i<count($array['tr']); $i++) {
            $tr = $array['tr'][$i];
            if(isset($tr['th'])) {
                if(!isset($tr['th']['class'])) {
                    if($i=0) {
                        $tr['th']['class']= $class_th_first;
                    } else {
                        $tr['th']['class']= $class_th;
                    }
                }
                $th .= self::th($array['th'][$i]);
            }
        }
        $tr_head = self::tr([
            'data_attr'=>['id::header'],
            'body'=>$th
        ]);

        // body
        $row_count = isset($array['row_count']) ? $array['row_count'] : 50;
        $tr_body = '';
        for ($i=0; $i<$row_count; $i++) {
            $td='';
            for($ii=0; $ii<count($array['tr']); $ii++) {
                $tr = $array['tr'][$ii];
                if(!isset($tr['td']['class'])) {
                    if($ii=0) {
                        $tr['td']['class']= $class_td_first;
                    } else {
                        $tr['td']['class']= $class_td;
                    }
                }
                $type = $tr['type'];
                switch ($type) {
                    case 'text':
                        $td .= self::td($tr['td']);
                        break;
                    case 'input':
                        $td_container = $tr['td'];
                        // give id to input
                        $tr['inp']['id'] = $tr['inp']['name']."__".$i;
                        // give value to label and input
                        $val = isset($tr['inp']['value']) ? $tr['inp']['value'] : '';
                        // give data-field in td
                        $td_container['data_attr'][] = 'field::'.$tr['inp']['name'];
                        // give body detail of td
                        $td_container['body'] = [
                            self::label([
                                'for'=>$tr['inp']['id'],
                                'data_attr'=>['field::'.$tr['inp']['name']],
                                'body'=>$val
                            ]),
                            self::input($tr['inp']),
                        ];
                        $td .= self::td($td_container);
                        break;
                    case 'select':
                        $td_container = $tr['td'];
                        // give id to selection
                        $tr['sel']['id'] = $tr['sel']['name']."__".$i;
                        // give value to label and input
                        $val = isset($tr['sel']['value']) ? $tr['sel']['value'] : '';
                        // give data-field in td
                        $td_container['data_attr'][] = 'field::'.$tr['sel']['name'];
                        // give option to selection
                        $tr['sel']['body'] = '';
                        foreach($tr['option'] as $set) {
                            $set['value'] = $set['body'];
                            $tr['sel']['body'] .= self::option($set);
                        }
                        // give body detail of td
                        $td_container['body'] = [
                            self::label([
                                'for'=>$tr['sel']['id'],
                                'data_attr'=>['field::'.$tr['sel']['name']],
                                'body'=>$val
                            ]),
                            self::select($tr['sel']),
                        ];
                        $td .= self::td($td_container);
                        break;
                    case 'hidden':
                        $td .= self::input($tr['inp']);
                        break;
                    case 'set_btn':
                        $td_container = $tr['td'];
                        $td_container['body']='';
                        foreach($tr['btn'] as $set) {
                            $td_container['body'] .= self::button($set);
                        }
                        $td .= self::td($td_container);
                        break;
                    default:
                        exit("Error: Invalid type = ".$type);
                }
    
            }
            $tr_body .= self::tr([
                'data_attr'=>['id::'.$i],
                'class'=>$class_tr,
                'body'=>$td
            ]);
        }

            
        $array['table']['body'] = [
            self::thead(['body'=>$tr_head]),
            self::tbody(['body'=>$tr_body])
        ];

        $component = self::table($array['table']);
        return $component;
    }

    static function table($array) {
        $title = isset($array['title']) ? "title='".$array['title']."' " : '';
        $class = isset($array['class']) ? "class='".$array['class']."' " : '';
        $id = isset($array['id']) ? "id='".$array['id']."' " : '';
        $name = isset($array['name']) ? "name='".$array['name']."' " : '';
        $body = '';
        if(isset($array['body'])) {
            if(is_array($array['body'])) {
                foreach($array['body'] as $val) {
                    $body .= $val;
                }
            } else {
                $body = $array['body'];
            }
        }
        $data_attr = '';
        if(isset($array['data_attr'])) {
            foreach($array['data_attr'] as $val2) {
                $data_att = explode('::', $val2);
                $data_attr .= 'data-'.$data_att[0]."='".$data_att[1]."' ";
            }
        }
        $component = "<table " 
        .$title
        .$id
        .$name
        .$data_attr
        .$class.">"
        .$body."
        </table>";

        return $component;
    }

    static function thead($array) {
        $body = '';
        if(isset($array['body'])) {
            if(is_array($array['body'])) {
                foreach($array['body'] as $val) {
                    $body .= $val;
                }
            } else {
                $body = $array['body'];
            }
        }
        $component = "<thead>" 
        .$body."
        </thead>";

        return $component;
    }

    static function tbody($array) {
        $body = '';
        if(isset($array['body'])) {
            if(is_array($array['body'])) {
                foreach($array['body'] as $val) {
                    $body .= $val;
                }
            } else {
                $body = $array['body'];
            }
        }
        $component = "<tbody>" 
        .$body."
        </tbody>";

        return $component;
    }

    static function tr($array) {
        $title = isset($array['title']) ? "title='".$array['title']."' " : '';
        $class = isset($array['class']) ? "class='".$array['class']."' " : '';
        $id = isset($array['id']) ? "id='".$array['id']."' " : '';
        $name = isset($array['name']) ? "name='".$array['name']."' " : '';
        $body = '';
        if(isset($array['body'])) {
            if(is_array($array['body'])) {
                foreach($array['body'] as $val) {
                    $body .= $val;
                }
            } else {
                $body = $array['body'];
            }
        }
        $data_attr = '';
        if(isset($array['data_attr'])) {
            foreach($array['data_attr'] as $val2) {
                $data_att = explode('::', $val2);
                $data_attr .= 'data-'.$data_att[0]."='".$data_att[1]."' ";
            }
        }
        $component = "<tr " 
        .$title
        .$id
        .$name
        .$data_attr
        .$class.">"
        .$body."
        </tr>";

        return $component;
    }

    static function td($array) {
        $title = isset($array['title']) ? "title='".$array['title']."' " : '';
        $class = isset($array['class']) ? "class='".$array['class']."' " : '';
        $id = isset($array['id']) ? "id='".$array['id']."' " : '';
        $name = isset($array['name']) ? "name='".$array['name']."' " : '';
        $body = '';
        if(isset($array['body'])) {
            if(is_array($array['body'])) {
                foreach($array['body'] as $val) {
                    $body .= $val;
                }
            } else {
                $body = $array['body'];
            }
        }
        $data_attr = '';
        if(isset($array['data_attr'])) {
            foreach($array['data_attr'] as $val2) {
                $data_att = explode('::', $val2);
                $data_attr .= 'data-'.$data_att[0]."='".$data_att[1]."' ";
            }
        }
        $component = "<td " 
        .$title
        .$id
        .$name
        .$data_attr
        .$class.">"
        .$body."
        </td>";

        return $component;
    }

    static function th($array) {
        $title = isset($array['title']) ? "title='".$array['title']."' " : '';
        $class = isset($array['class']) ? "class='".$array['class']."' " : '';
        $id = isset($array['id']) ? "id='".$array['id']."' " : '';
        $name = isset($array['name']) ? "name='".$array['name']."' " : '';
        $body = '';
        if(isset($array['body'])) {
            if(is_array($array['body'])) {
                foreach($array['body'] as $val) {
                    $body .= $val;
                }
            } else {
                $body = $array['body'];
            }
        }
        $data_attr = '';
        if(isset($array['data_attr'])) {
            foreach($array['data_attr'] as $val2) {
                $data_att = explode('::', $val2);
                $data_attr .= 'data-'.$data_att[0]."='".$data_att[1]."' ";
            }
        }
        $component = "<th " 
        .$title
        .$id
        .$name
        .$data_attr
        .$class.">"
        .$body."
        </th>";

        return $component;
    }

    //text 
    static function text($array) {
        $title = isset($array['title']) ? "title='".$array['title']."' " : '';
        $class = isset($array['class']) ? "class='".$array['class']."' " : '';
        $id = isset($array['id']) ? "id='".$array['id']."' " : '';
        $name = isset($array['name']) ? "name='".$array['name']."' " : '';
        $title = isset($array['title']) ? "title='".$array['title']."' " : '';
        
        $body = '';
        if(isset($array['body'])) {
            if(is_array($array['body'])) {
                foreach($array['body'] as $val) {
                    $body .= $val;
                }
            } else {
                $body = $array['body'];
            }
        }
        $data_attr = '';
        if(isset($array['data_attr'])) {
            foreach($array['data_attr'] as $val2) {
                $data_att = explode('::', $val2);
                $data_attr .= 'data-'.$data_att[0]."='".$data_att[1]."' ";
            }
        }
        $component = "<p " 
        .$title
        .$id
        .$name
        .$data_attr
        .$class.">"
        .$body."
        </p>";

        return $component;
    }

    static function title($array) {
        $title = isset($array['title']) ? "title='".$array['title']."' " : '';
        $class = isset($array['class']) ? "class='".$array['class']."' " : '';
        $id = isset($array['id']) ? "id='".$array['id']."' " : '';
        $name = isset($array['name']) ? "name='".$array['name']."' " : '';
        $title = isset($array['title']) ? "title='".$array['title']."' " : '';
        
        $body = '';
        if(isset($array['body'])) {
            if(is_array($array['body'])) {
                foreach($array['body'] as $val) {
                    $body .= $val;
                }
            } else {
                $body = $array['body'];
            }
        }
        $data_attr = '';
        if(isset($array['data_attr'])) {
            foreach($array['data_attr'] as $val2) {
                $data_att = explode('::', $val2);
                $data_attr .= 'data-'.$data_att[0]."='".$data_att[1]."' ";
            }
        }
        $component = "<h1 " 
        .$title
        .$id
        .$name
        .$data_attr
        .$class.">"
        .$body."
        </h1>";

        return $component;
    }

    static function span($array) {
        $title = isset($array['title']) ? "title='".$array['title']."' " : '';
        $class = isset($array['class']) ? "class='".$array['class']."' " : '';
        $id = isset($array['id']) ? "id='".$array['id']."' " : '';
        $name = isset($array['name']) ? "name='".$array['name']."' " : '';
        $title = isset($array['title']) ? "title='".$array['title']."' " : '';
        
        $body = '';
        if(isset($array['body'])) {
            if(is_array($array['body'])) {
                foreach($array['body'] as $val) {
                    $body .= $val;
                }
            } else {
                $body = $array['body'];
            }
        }
        $data_attr = '';
        if(isset($array['data_attr'])) {
            foreach($array['data_attr'] as $val2) {
                $data_att = explode('::', $val2);
                $data_attr .= 'data-'.$data_att[0]."='".$data_att[1]."' ";
            }
        }
        $component = "<span " 
        .$title
        .$id
        .$name
        .$data_attr
        .$class.">"
        .$body."
        </span>";

        return $component;
    }

    //link
    static function link($array) {
        $title = isset($array['title']) ? "title='".$array['title']."' " : '';
        $class = isset($array['class']) ? "class='".$array['class']."' " : '';
        $id = isset($array['id']) ? "id='".$array['id']."' " : '';
        $href = isset($array['href']) ? "href='".$array['href']."' " : '';
        $body = '';
        if(isset($array['body'])) {
            if(is_array($array['body'])) {
                foreach($array['body'] as $val) {
                    $body .= $val;
                }
            } else {
                $body = $array['body'];
            }
        }
        $data_attr = '';
        if(isset($array['data_attr'])) {
            foreach($array['data_attr'] as $val2) {
                $data_att = explode('::', $val2);
                $data_attr .= 'data-'.$data_att[0]."='".$data_att[1]."' ";
            }
        }
        $component = "<a " 
        .$title
        .$id
        .$href
        .$data_attr
        .$class.">"
        .$body."
        </a>";
        return $component;
    }

}