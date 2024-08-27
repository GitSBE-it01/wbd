<?php
class Comp {
    /*
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
*/
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

    static function canvas($array) {
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
        $component = "<canvas " 
        .$title
        .$id
        .$name
        .$data_attr
        .$class.">"
        .$body."
        </canvas>";

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

    static function textarea($array) {
        $title = isset($array['title']) ? "title='".$array['title']."' " : '';
        $class = isset($array['class']) ? "class='".$array['class']."' " : 'rounded p-2 focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 shadow-md w-[70%]';
        $type_attr = isset($array['type_attr']) ? "type='".$array['type_attr']."' " : "type='text' ";
        $id = isset($array['id']) ? "id='".$array['id']."' " : '';
        $name = isset($array['name']) ? "name='".$array['name']."' " : '';
        $list = isset($array['list']) ? "list='".$array['list']."' " : '';
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

        $component = "<textarea " 
        .$title
        .$id
        .$name
        .$type_attr
        .$list
        .$value."
        autocomplete='off' "
        .$data_attr
        .$require
        .$class
        .$disable.">"
        .$body."
        </textarea>";
        return $component;
    }

    static function input($array) {
        $title = isset($array['title']) ? "title='".$array['title']."' " : '';
        $class = isset($array['class']) ? "class='".$array['class']."' " : 'class="rounded p-2 focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 shadow-md w-[70%]" ';
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

    static function li($array) {
        $title = isset($array['title']) ? "title='".$array['title']."' " : '';
        $class = isset($array['class']) ? "class='".$array['class']."' " : '';
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
        $component = "<li " 
        .$title
        .$id
        .$data_attr
        .$class.">"
        .$body."
        </li>";

        return $component;
    }
    
    static function ul($array) {
        $title = isset($array['title']) ? "title='".$array['title']."' " : '';
        $class = isset($array['class']) ? "class='".$array['class']."' " : '';
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
        $component = "<ul " 
        .$title
        .$id
        .$data_attr
        .$class.">"
        .$body."
        </ul>";

        return $component;
    }
}

