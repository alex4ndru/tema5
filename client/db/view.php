<?php
namespace Main\View;

class View
{
    public $apiAddress = 'http://inbezna.ro/extra/api/';
    //public $apiAddress = 'http://localhost/bitacad/sedinta_05/server/api/';
    public $imgFieldHidden = 'hidden';
    public $resultsFieldHidden = 'hidden';
    public $contentTop;
    
    protected $data;
    
    public function __construct()
    {
        $this->callApi();
    }
    
    protected function getApiResponse()
    {
        $response = file_get_contents($this->apiAddress);
        $this->data = json_decode($response);
    }
    
    protected function callApi()
    {
        
        if(isset($_POST['type']))
        {
            
            if(isset($_POST['subject']))
            {
                $t = trim(explode(" ", $_POST['subject'])[0]); //valoarea din post exte de ex: 100 penguin, ne trebuie doar 100
                $this->apiAddress .= "{$_POST['type']}/{$t}";
                $this->getApiResponse();
                $this->drawDetails();
            }
            else
            {
                $this->apiAddress .= "{$_POST['type']}";
                $this->getApiResponse();
                $this->drawSubjects();
            }
        }
        else
        {
            $this->getApiResponse();
            $this->drawTypes();
        }
    }
    
    public function drawDetails()
    {
        $t = file_get_contents("https://www.google.ro/search?q={$this->data->name}&source=lnms&tbm=isch");
        $dom = new \DOMDocument;
        @$dom->loadHTML($t);
        $finder = new \DomXPath($dom);
        $nodes = $finder->query("//img[@src]");
        
        $imgListContent = '';
        for($i=0;$i<$nodes->length; $i++)
        {
            if($i>0) //prima imagine nu este utila
            {
                $src = $nodes->item($i)->getAttribute("src");
                $imgListContent .= "<a class='idImg' href='{$src}' target='_blank'><img src='{$src}' /></a>";
            }
        }
        $imgListContent .= "<div class='clearFix'></div>";
        
        $content = "<div class='back'>"
                    . "<form action='client.php' method='POST'>"
                    . "<input class='btnBack' type='submit' name='back' value='back to {$_POST['type']}' />"
                    . "<input type='hidden' name='type' value='{$_POST['type']}' />"
                    . "</form>"
                . "</div>";
        $content .= $imgListContent;
        $this->contentTop = $content;
    }
    
    public function drawSubjects()
    {
        $content = "<div class='back'>"
                    . "<form action='client.php' method='POST'>"
                    . "<input class='btnBack' type='submit' name='back' value='back to start' />"
                    . "</form>"
                . "</div>";
        $content .= '<div class="subjectTitles">';
        foreach($this->data as $v)
        {
            $content .= "<form action='client.php' method='POST'>"
                    . "<input class='btnTypes' type='submit' name='subject' value='{$v->id}\n {$v->name}' />"
                    . "<input type='hidden' name='type' value='{$_POST['type']}' />"
                    . "</form>";
        }
        $content .= '<div class=\'clearFix\'></div></div>';
        $this->contentTop = $content;
    }
    
    public function drawTypes()
    {
        $content = '<div class="typeTitles">';
        foreach($this->data as $v)
        {
            $content .= "<form action='client.php' method='POST'>"
                    . "<input class='btnTypes' type='submit' name='type' value='{$v}' />"
                    . "</form>";
        }
        $content .= '<div class=\'clearFix\'></div></div>';
        $this->contentTop = $content;
    }
}