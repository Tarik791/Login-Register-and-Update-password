<?php


class Validate{

    private $_passed = false,
            $_errors = array(),
            $_db = null;


    public function __construct(){

        //instance of database
        $this->_db = DB::getInstance();

        
    }

    //check for data(user must be write correct input field when he/she want register on this app)
    public function check($source, $items = array()){

        foreach($items as $item => $rules){

            foreach($rules as $rule => $rule_value){

                $value = trim($source[$item]);
                $item = escape($item);

                //user have problem if this is true
                if($rule === 'required' && empty($value)){

                    $this->addError("{$item} is required");

                //user dont have problem if this is false
                }else if(!empty($value)){

                    //RULES!
                    switch ($rule) {
                        case 'min':

                            //min word length!
                            if(strlen($value) < $rule_value){

                                $this->addError("{$item} must be a minimum of {$rule_value} characters!");

                            }
                        break;
                        case 'max';


                            //max word length!
                            if(strlen($value) > $rule_value){

                                $this->addError("{$item} must be a maximum of {$rule_value} characters!");

                            }
                            

                        break;
                        case 'matches':
                            //password must be same
                            if($value != $source[$rule_value]){

                                $this->addError("{$rule_value} must match {$item}");

                            }
                        
                        break;
                        case 'unique':

                            //cant be same username
                            $check = $this->_db->get($rule_value, array($item, '=', $value));

                            if($check->count()){

                                $this->addError("{$item} alredy exists.");

                            }

                        break;
             
                    }


                }

            }

        }

        //if errros array is empty, data has been passed
        if(empty($this->_errors)){

            $this->_passed = true;

        }

        return $this;



    }

    //add error
    private function addError($error){

        $this->_errors[] = $error;



    }

    //return lists of errors of we have
    public function errors(){

        return $this->_errors;


    }

    //data has been passed
    public function passed(){

        return $this->_passed;
    }



}




?>