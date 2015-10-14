<?php
namespace Main\Api;
use Main\Db\Db;

class Api
{
    protected $dbLink;
    protected $request;
    
    public function __construct()
    {
         $this->dbLink = new Db();
         $this->buildRequest();
    }
    
    protected function buildRequest()
    {
        $this->request['type'] = $_GET['type'];
        if ( isset($_GET['id']) )
        {
            $this->request['id'] = $_GET['id'];
        }
        else $this->request['id'] = null;
    }
    
    public function get()
    {        
        
        if($this->request['type'] == 'name')
        {
            //echo "return all !<br />";
            //$data = $this->dbLink->getAll();
            $data = $this->dbLink->getTypes();
        }
        else
        {
            $allTypes = $this->dbLink->getTypes();
            if( in_array($this->request['type'], $allTypes) )
            {
                if(!$this->request['id'])
                {
                    //echo "return all {$this->request['type']}<br />";
                    $data = $this->dbLink->getAllFromType($this->request['type']);
                }
                else
                {
                    //echo "return id {$this->request['id']} from {$this->request['type']}<br />";
                    $data = $this->dbLink->getIdOfType($this->request['type'], $this->request['id']);
                    if($data === null) $data = ['errId' => 'err001', 'errValue' => 'no such id ...'];
                }
            }
            else $data = ['errId' => 'err002', 'errValue' => 'unknown type !'];
        }
        
        //var_dump($data);
        $jsonResponse = json_encode($data);
        echo $jsonResponse;
    }
}