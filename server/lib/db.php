<?php
namespace Main\Db;

class Db
{
    //protected $all;
    protected $dbData;
    
    public function __construct()
    {
        $this->connect();
    }

    protected function connect()
    {
        //preluare date din fisier XML
        $xml = simplexml_load_file('db.xml');
        foreach ($xml->children() as $k => $v)
        {
            //echo (string)$k;
            foreach($v->children() as $v2)
            {
                //echo "$v2->id | $v2->name";
                $this->dbData[$k][] = ['id' => (int)$v2->id, 'name' => (string)$v2->name];
            }
        }
        
        //test
        /*
        $mammal[] = ['id' => 100, 'name' => 'rabbit'];
        $mammal[] = ['id' => 200, 'name' => 'bear'];
        $mammal[] = ['id' => 300, 'name' => 'gopher'];

        $bird[] = ['id' => 100, 'name' => 'shoebill'];
        $bird[] = ['id' => 200, 'name' => 'hummingbird'];
        $bird[] = ['id' => 300, 'name' => 'penguin'];

        $lizard[] = ['id' => 100, 'name' => 'chameleon'];
        $lizard[] = ['id' => 200, 'name' => 'thornydevil'];
        $lizard[] = ['id' => 300, 'name' => 'gila'];
        
        $this->dbData['mammals'] = $mammal;
        $this->dbData['birds'] = $bird;
        $this->dbData['lizards'] = $lizard;
        
        $this->all = [
        'mammals'=>[100=>'rabbit', 200=>'bear', 300=>'gopher'],
        'birds'=>[100=>'shoebill', 200=>'hummingbird', 300=>'penguin'],
        'lizards'=>[100=>'chameleon', 200=>'thornydevil', 300=>'gila']
        ];
        */
        
    }
    
    public function getTypes()
    {
        foreach($this->dbData as $k => $v)
        {
            $types[] = $k;
        }
        return $types;
    }
    
    public function getAll()
    {
        //return $this->all;
        return $this->dbData;
    }
    
    public function getAllFromType($type)
    {
        /*
        foreach($this->all[$type] as $v)
        {
            $data[] = $v;
        }
        */
        
       return $this->dbData[$type];
    }
    
    public function getIdOfType($type, $id)
    {
        /*
        foreach($this->all[$type] as $k => $v)
        {
            if($id == $k) return $v;
        }
        */
        
        foreach($this->dbData[$type] as $vi)
        {
            foreach($vi as $k=>$v)
            {
                if($k == 'id' && $v == $id)
                {
                    return $vi;
                }
            }
        }
    }
}