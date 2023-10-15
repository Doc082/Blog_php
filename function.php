<?php

function getAllNews($numRisultati=0){
      
       $mysqli = $GLOBALS['mysqli'];
         $records = [];
         
         
        if($numRisultati) $sql ="SELECT * FROM articoli ORDER BY create_at DESC LIMIT 0,$numRisultati";
        else $sql ="SELECT * FROM articoli ORDER BY create_at DESC";
        $result = $mysqli->query($sql);
        if($result && $result->num_rows){
            $records =  $result->fetch_all(MYSQLI_ASSOC);
           
        }
        return $records;
        
    }
    
    function hashtag($hashtag){
        if($hashtag){
            $arr_hash = explode(',',$hashtag);
         foreach($arr_hash as &$array){
             $array = trim($array);
             $array = '#'. $array; 
            }
        
            return $arr_hash;
         }
         $arr_hash=[];
         return $arr_hash;
        
    }
    
    
    
function getFromGet($param,  $default= null, $type ='string'){
    if($type === 'int'){
      $param = filter_input(INPUT_GET, $param, FILTER_SANITIZE_NUMBER_INT)  ;
    } else {
        $param = filter_input(INPUT_GET, $param, FILTER_SANITIZE_STRING)  ;
    }
    $ret = $param? $param : $default;
   
  
    
    return $ret;
}

function getTotalNews(array $params){
      
       $mysqli = $GLOBALS['mysqli'];
       
        $totalRecords =0;
         
        
          
          $where = '';
         $whereParam = !empty($params['search'])? $params['search'] : '';
          
         if($whereParam){
             
             $whereParam = $mysqli->escape_string($whereParam);
             
             $where = " WHERE username like '%$whereParam%' OR ";
             $where .= " fiscalcode like '%$whereParam%' OR ";
             $where  .= "email like '$whereParam%' OR ";
             $where  .= "age =".((int)$whereParam);
             $where  .= " OR id =".((int)$whereParam);
         }
        
        $sql ="SELECT COUNT(*) AS total FROM articoli $where";
        //echo $sql;
        $result = $mysqli->query($sql);
        if($result && $result->num_rows){
           $row  = $result->fetch_assoc();
              $totalRecords = $row['total'];
           
        }
        return $totalRecords;
    }
    
    function deleteNews($id){
         $id = (int) $id;
         if(!$id){
             return false;
         }
         
        $sql = 'DELETE FROM articoli where id='.($id);
       // echo $sql;
       
        $ret = $GLOBALS['mysqli']->query($sql);
        return  $GLOBALS['mysqli']->affected_rows;
    }
    
    function getNews($url){
          $result = [];
         
         $sql = "SELECT * FROM articoli WHERE url LIKE '$url'";
          $res = $GLOBALS['mysqli']->query($sql);
           if($res && $res->num_rows){
               $result = $res->fetch_assoc();
           }
           return $result;
    }
    
    function getNewsById($id){
          $result = [];
         
         $sql = "SELECT * FROM articoli WHERE id = $id";
          $res = $GLOBALS['mysqli']->query($sql);
           if($res && $res->num_rows){
               $result = $res->fetch_assoc();
           }
           return $result;
    }
    
    function searchNews($data){
         $mysqli = $GLOBALS['mysqli'];
         $records = [];
         
         
        $sql = "SELECT * FROM articoli WHERE titolo LIKE '%$data%' OR contenuto LIKE '%$data%'";
        
        $result = $mysqli->query($sql);
        if($result && $result->num_rows){
            $records = $result->fetch_all(MYSQLI_ASSOC);
           
        }
        
        return $records;
    }
    
    function selectCategory($data){
         $mysqli = $GLOBALS['mysqli'];
         $records = [];
         
         
        $sql = "SELECT * FROM articoli WHERE categoria LIKE '%$data%'";
        
        $result = $mysqli->query($sql);
        if($result && $result->num_rows){
            $records = $result->fetch_all(MYSQLI_ASSOC);
           
        }
        
        return $records;
    }
    // da sistemare
    function updateNews(array $array, $id){
         $mysqli = $GLOBALS['mysqli'];
         
         $titolo = $mysqli->escape_string($array['titolo']);
         $contenuto = $mysqli->escape_string($array['articolo']);
         $hashtag = $mysqli->escape_string($array['hashtag']);
         $immagini = $mysqli->escape_string($array['copertina']);
         $immagini = urldecode($immagini);
         $categoria = $mysqli->escape_string($array['categoria']);
         $descrizione = $mysqli->escape_string($array['descrizione']);
         $url = crea_url($titolo);
          
         $sql = "UPDATE articoli set titolo='$titolo', contenuto='$contenuto', immagini='$immagini', url='$url', hashtag='$hashtag', categoria='$categoria'";
         $sql .= ", descrizione='$descrizione' WHERE id=$id";
         $mysqli->query($sql);
            
          return $mysqli->affected_rows;
       
    }
    
      function insertNews(array $array){
         $mysqli = $GLOBALS['mysqli'];
        
         $titolo = $mysqli->escape_string($array['titolo']);
         $contenuto = $mysqli->escape_string($array['articolo']);
         $hashtag = $mysqli->escape_string($array['hashtag']);
         $immagini = $mysqli->escape_string($array['copertina']);
         $immagini = urldecode($immagini);
         $categoria = $mysqli->escape_string($array['categoria']);
         $descrizione = $mysqli->escape_string($array['descrizione']);
         $url = crea_url($titolo);
          
        
         $sql = "INSERT INTO articoli (titolo, contenuto, immagini, url, hashtag, categoria, descrizione)";
         $sql .=" values('$titolo','$contenuto' ,'$immagini' ,'$url', '$hashtag', '$categoria', '$descrizione')";
        
          $mysqli->query($sql);
            
          return $mysqli->affected_rows;
       
    }
    
    function crea_url($str)
    {
	$str = strtolower($str);
	$str = strip_tags($str);

	$str = preg_replace('/[^a-z0-9]+/i', ' ', $str);

	$str = preg_replace('/\s+/i', ' ', $str);
	$str = trim($str);

	$str = str_replace(' ', '-', $str);
	return $str;
    }
    
    function getCategories() {
        $mysqli = $GLOBALS['mysqli'];
        $records = [];

        $sql = "SELECT categoria FROM articoli";
        
        $result = $mysqli->query($sql);
        if($result && $result->num_rows){
            $records =  $result->fetch_all(MYSQLI_ASSOC);
           
        }
        $categories=[];
        foreach($records as $record){
           if(!in_array($record['categoria'], $categories))$categories[] = $record['categoria'];
        }
        
        return $categories;
   
    }
    
    function getComments($id){
      
       $mysqli = $GLOBALS['mysqli'];
         $records = [];
         
         
        $sql ="SELECT * FROM comment WHERE post_id='$id' AND public LIKE 'ok' ORDER BY create_at DESC";
        $result = $mysqli->query($sql);
        if($result && $result->num_rows){
            $comments =  $result->fetch_all(MYSQLI_ASSOC);
           return $comments;
        }
        
        return false;
    }
    
    function getAllComments($id){
      
       $mysqli = $GLOBALS['mysqli'];
         $records = [];
         
         
        $sql ="SELECT * FROM comment WHERE post_id='$id' ORDER BY create_at DESC";
        $result = $mysqli->query($sql);
        if($result && $result->num_rows){
            $comments =  $result->fetch_all(MYSQLI_ASSOC);
           return $comments;
        }
        
        return false;
    }
    
    function insertComment(array $array){
         $mysqli = $GLOBALS['mysqli'];
        
         $email = $mysqli->escape_string($array['email']);
         $commento = $mysqli->escape_string($array['commento']);
         $id = $mysqli->escape_string($array['id']);
                
        
         $sql = "INSERT INTO comment (post_id, email, commento, public)";
         $sql .=" values('$id','$email' ,'$commento', 'no')";
        
          $mysqli->query($sql);
          echo"$sql";  
          return $mysqli->affected_rows;
       
    }
    
    function getNumberComments($id){
         $mysqli = $GLOBALS['mysqli'];
       
        $totalRecords = [];
         
                    
        $sql ="SELECT COUNT(*) AS partial FROM comment WHERE post_id='$id' AND public LIKE 'no'";
         $result = $mysqli->query($sql);
        if($result && $result->num_rows){
           $row  = $result->fetch_assoc();
              $totalRecords['partial'] = $row['partial'];
           
        }
        $sql ="SELECT COUNT(*) AS total FROM comment WHERE post_id='$id'";
       
        $result = $mysqli->query($sql);
        if($result && $result->num_rows){
           $row  = $result->fetch_assoc();
              $totalRecords['total'] = $row['total'];
           
        }
        return $totalRecords;
    }
    
    function deleteComment($id){
         $id = (int) $id;
         if(!$id){
             return false;
         }
         
        $sql = 'DELETE FROM comment where id='.($id);
       // echo $sql;
       
        $ret = $GLOBALS['mysqli']->query($sql);
        return  $GLOBALS['mysqli']->affected_rows;
    }
    
    function acceptComment($id){
        
         $mysqli = $GLOBALS['mysqli'];
         
         $sql = "UPDATE comment set public='ok' WHERE id=$id";
         $mysqli->query($sql);
          return $mysqli->affected_rows;
       
  
    }
   
    
