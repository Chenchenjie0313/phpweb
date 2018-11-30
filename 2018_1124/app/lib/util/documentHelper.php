<?php

App::import('/web/lib/util/simpleHtml/simple_html_dom.php');

class DocumentHelper{

    public static function simpleXml($string){
        simplexml_load_string($string);
        var_dump($xml);


    }

    public static function getHtmlByUrl($url){

        $html = SimpleHtmlFactory::getHtmlByUrl($url);
        return $html;

    }


    public static function parseHtmlByUrl($url){
        Logger::log(__LINE__."行,メソッド：".__METHOD__.",URL=".$url);
        try {
            $content = SimpleHtmlFactory::getHtmlByUrl($url);
            $html = SimpleHtmlFactory::str_get_html($content[0]);
            if ($html === false) return false;
            Logger::log(__LINE__."行,メソッド：".__METHOD__."", $html);
            $links = array();
            $txt = "";
            $as = $html->find('a');
            foreach($as as $s){
                $links[count($links)] = [
                    "href" => $s->href,
                    "txt" => $s->text()
                ];
            }

            Logger::log(__LINE__."行,メソッド：".__METHOD__."");
            
            $txt = $html ? $html->toTextNoA() : '';
            $html->clear();
            Logger::log(__LINE__."行,メソッド：".__METHOD__."");

            return array($txt, $links);

        } catch (Exception $e){
            Logger::log($e);
        }
        return false;

    }


    public static function parseHtml($string){
        try {
            $html = SimpleHtmlFactory::str_get_html($string);
            $links = array();
            $txt = "";
            $as = $html->find('a');
            foreach($as as $s){
                $links[count($links)] = [
                    "href" => $s->href,
                    "txt" => $s->text()
                ];
            }

            $txt = $html ? $html->plaintext : '';
            $html->clear();

            return [$txt, $links];

        } catch (Exception $e){
            Logger::log($e);
        }
        return false;

    }

    private $filePath = null;
    private $xmlDoc = null;
    private $rootNode = null;
    private $data = null;
    
    public function __construct($filePath){
        $this->xmlDoc = new DOMDocument("1.0", "UTF-8");
        $this->filePath = $filePath;
    }

    public function load(){
        $this->xmlDoc->load($this->filePath);
        $this->rootNode = $this->xmlDoc->documentElement;
    }

    public function saveAsArray(){
        if($this->rootNode){
            return $this->toArray($this->rootNode);
        } else {
            return [];
        }
    }

    private function toArray($node){
        $attrs = [];
        $childs = [];
        if($node != null){
            if($node->hasAttributes()){ 
                foreach($node->attributes as $attr){
                    $name = $attr->nodeName; // == $key
                    $value = $attr->nodeValue;
                    $attrs[$name] = $value;
                }
            }
            // ノード
            switch($node->nodeType){
                case XML_TEXT_NODE : 
                    $toArray['value'] = $nodeValue;
                    break;
                case XML_ELEMENT_NODE :
                    if($node->hasChildNodes()){
                        for($i=0; $i<$node->childNodes->length; $i++){
                            $childNode = $node->childNodes->item($i);
                            $childs[count($childs)] = $this->toArray($childNode);
                        }
                    }
                    break;
                default : 

            }

        }
        $toArray = [];
        $toArray[name] = ($node != null ? $node->nodeName : '');
        $value != null ? $toArray[value]=$value : "";
        count($attrs) != 0 ? $toArray[attrs]=$attrs : "";
        count($childs) != 0 ? $toArray[childs]=$childs : "";

        return $toArray;
    }

    public function saveAsFile($filePath){
        return $this->xmlDoc->save($filePath); //save xml into file
    }

    private function _log($el,$pre=""){
        if($el != null && $el->hasAttributes()){
            foreach($el->attributes as $key => $attr){
                $name = $attr->nodeName; // == $key
                $value = $attr->nodeValue;
                Utils::WriteLog("attributes >> " . $pre . "(attributes) : " . " => $name => : " . $value);
            }
        }
        
        switch($el->nodeType){
            case XML_TEXT_NODE : 
                Utils::WriteLog($pre . " > TEXT_CODE : NODE_NAME : " . $el->nodeName . " => NODE_VALUE : " . $el->nodeValue);
                break;
            case XML_ELEMENT_NODE : 
                //Utils::WriteLog($pre . " > " . $el->nodeName . " => " . $el->nodeValue);
                if($el->hasChildNodes()){
                    $pre .= " > $el->nodeName";
                    for($i=0; $i<$el->childNodes->length; $i++){
                        $childNode = $el->childNodes->item($i);
                        //Utils::WriteLog($pre . " >  NODE_NAME : " . $childNode->nodeName . " =>  NODE_VALUE : " . $childNode->nodeValue);
                        $this->_log($childNode,$pre);
                    }
                }
                break;
            default :

        }

        // if($el->hasChildNodes()){
        //     $pre .= " > $el->nodeName" ;
        //     for($i=0;$i<$el->childNodes->length; $i++){
        //         $item = $el->childNodes->item[$i];

        //         Utils::WriteLog($item->nodeType);

        //         if($item->nodeType === XML_ELEMENT_NODE){
        //             $this->_log($el->childNodes->item[$i], $pre);
        //         } else if($item->nodeType === XML_TEXT_NODE) {
        //             Utils::WriteLog($pre . " > " . $el->nodeName . " => " . $el->nodeValue);
        //         }

        //     }
        // } else {
        //     Utils::WriteLog($pre . " > " . $el->nodeName . " => " . $el->nodeValue);
        // }
    }
    //hasAttribute
    //hasChildNodes
    //removeChild
    //insertBefore
    //appendChild

    //查找
    // getElementByTagName

    // 读取
    // loadXML
    // load
    // loadHTML
    // loadHTMLFile


    // x=xmlDoc.getElementsByTagName("book")[0];
    // x.parentNode.removeChild(x);

    //nodeValue/nodeName/nodeType
    //nodeTYpe : Element/Attribute/Text/Comment/Document

    // $items = $doc->documentElement->childNodes;
    // for ($i = 0; $i < $items->length; $i++)
    // echo get_class($items->item($i)).PHP_EOL;

    public function loadTest(){
        if($this->xmlDoc == null){
            $this->xmlDoc = new DOMDocument("1.0", "UTF-8");
        }
        $this->xmlDoc->load($this->filePath);
//        var_dump($this->xmlDoc);
        $x = $this->xmlDoc->documentElement;
        var_dump($x);
        echo $this->xmlDoc->saveXML();
    }

    public function saveTest(){
        if($this->xmlDoc == null){
            $this->xmlDoc = new DOMDocument("1.0", "UTF-8");
        }
        // $this->xmlDoc->saveXML($this->filePath); //save xml into string
        $node1= $this->createTextElement('book','java',[value=>"$10"]);
        $node2= $this->createTextElement('book','js',[value=>"$10.1"]);
        $node3= $this->createTextElement('book','c++',[value=>"$10.9"]);
        $book = $this->createElement('books',[auth=>'chen'],[$node1,$node2,$node3]);

        $node1= $this->createTextElement('action','<java>',[value=>"$10"]);
        $node2= $this->createTextElement('action','js',[value=>"$10.1"]);
        $node3= $this->createTextElement('action','c++',[value=>"$10.9"]);
        $action = $this->createElement('actions',[auth=>'chen'],[$node1,$node2,$node3]);

        $node1= $this->createTextElement('const','java',[value=>"$10"]);
        $node2= $this->createTextElement('config','js',[value=>"$10.1"]);

        $root = $this->createElement('app',[auth=>'chen'],[$book,$action,$node1,$node2]);
        $this->xmlDoc->appendChild($root);
        $this->xmlDoc->save($this->filePath); //save xml into file
    }

    private function createTextElement($name,$value,$options = []){
        $el = $this->xmlDoc->createElement($name,$value);
        foreach($options as $key => $value){
            $domAttribute = $this->xmlDoc->createAttribute($key);
            $domAttribute->value = $value;
            $el->appendChild($domAttribute);
        }
        return $el;
    }

    private function createElement($name,$options = [],$childElements=[]){
        $el = $this->xmlDoc->createElement($name,$value);
        foreach($options as $key => $value){
            $domAttribute = $this->xmlDoc->createAttribute($key);
            $domAttribute->value = $value;
            $el->appendChild($domAttribute);
        }
        foreach($childElements as $key => $childElement){
            $el->appendChild($childElement);
        }
        return $el;
    }

//     $domAttribute = $domDocument->createAttribute('name');

// // Value for the created attribute
// $domAttribute->value = 'attributevalue';

// // Don't forget to append it to the element
// $domElement->appendChild($domAttribute);


//     $root = $doc->createElement('book');
// $root = $doc->appendChild($root);

// $title = $doc->createElement('title');
// $title = $root->appendChild($title);

// $text = $doc->createTextNode('This is the title');
// $text = $title->appendChild($text);


// var_dump


    // $xml = new DOMDocument( "1.0", "ISO-8859-15" );
    // $xml->appendChild( $xml_album );
    // $xml->createElement( "Album" );
    // $xml->createElement( "Track", "The ninth symphony" );

    // $xml_track->setAttribute( "channels", "2" );
    // $xml_track->appendChild( $xml_note );
}