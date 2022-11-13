<?php

abstract class APIController {

    protected $view;

    private $data;

    public function __construct() {
    
        $this->view = new APIView();
        $this->data = file_get_contents('php://input');
    
    }

    protected function getData() {
        
        
        return json_decode($this->data);
    
    }

}
?>