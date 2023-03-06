<?php
/*
*
* Class App
*
*/
class Admin{

    public $site = Array();

    function __construct()
    {
        
    }

    /* 
    *
    *  Try Insert Query on Database Table
    *  $username string
    *  $password string
    *
    *  return @array
    *
    */
    public static function login($username, $password){
        if($username == 'unvadmin' && $password == '3eAQW$adWT$'){
            $_SESSION['admin']['user'] = "unvadmin";
            return true;
        }else{
            return false;
        }
        
    }
    
    
    /* 
    *
    *  Admin User
    *
    *  return array
    *
    */
    public static function getUser($cedula = null){
        
        if(isset($_SESSION['admin']['user'])){
            $db = Database::getDB();
            
            // Obteniendo Intentos
            $query = $db->prepare("SELECT u.id, u.cedula, u.nombre, u.apellido, un.grupo, un.cargo, un.celular, un.asesor FROM `usuario` u LEFT JOIN `usuarios_nestle` un ON (un.cedula = u.cedula) WHERE u.cedula = :cedula LIMIT 1");
            $query->bindParam(":cedula", $cedula, PDO::PARAM_STR);
                
            $query->execute();
    
            $count = $query->rowCount();
    
            if($count){
                
                
                $user = $query->fetch(PDO::FETCH_ASSOC);
                
                // GET INTENTOS
                $queryIntentos = $db->prepare("SELECT * FROM `intentos` WHERE usuario_id = :usuario");
                $queryIntentos->bindParam(":usuario", $user['id'], PDO::PARAM_INT);
                $queryIntentos->execute();
                
                $intentos = $queryIntentos->fetchAll(PDO::FETCH_ASSOC);
        
                // GET PUNTOS
                
                $queryPuntaje = $db->prepare("SELECT * FROM `puntaje` WHERE usuario_id = :usuario");
                $queryPuntaje->bindParam(":usuario", $user['id'], PDO::PARAM_INT);
                $queryPuntaje->execute();
                
                $puntaje = $queryPuntaje->fetchAll(PDO::FETCH_ASSOC);
                
                
                return ['user' => $user, 'intentos' => $intentos, 'puntaje' => $puntaje];
            }else{
                return null;
            }
        }else{
            return null;
        }

    }
    
    
    /* 
    *
    *  Admin User
    *
    *  return array
    *
    */
    public static function updateIntentos($id = null, $intentos = null){
        
        if(isset($_SESSION['admin']['user']) && $id !== null && $intentos >= 0){
            $db = Database::getDB();
            $result = self::update($db, 'intentos', ['intentos'=>$intentos], $id);
           if($result){
                return $result;
            }else{
                return null;
            }
        }else{
            return null;
        }

    }

   
    /* 
    *
    *  Get Participaciones
    *
    *  return array
    *
    */
    public static function getParticipaciones($modulo = null, $tipo = null, $puntaje = null){
        $db = Database::getDB();
        
        // Obteniendo Intentos
        if($modulo && $tipo && !$puntaje){
            $queryCheck = $db->prepare("SELECT COUNT(*) as resultado FROM `puntaje` WHERE modulo_id = :modulo_id AND tipo = :tipo");
            $queryCheck->bindParam(":modulo_id", $modulo, PDO::PARAM_INT);
            $queryCheck->bindParam(":tipo", $tipo, PDO::PARAM_STR);
        }else if($modulo && $tipo && $puntaje){
            $queryCheck = $db->prepare("SELECT COUNT(*) as resultado FROM `puntaje` WHERE modulo_id = :modulo_id AND tipo = :tipo AND puntaje = :puntaje");
            $queryCheck->bindParam(":modulo_id", $modulo, PDO::PARAM_INT);
            $queryCheck->bindParam(":tipo", $tipo, PDO::PARAM_STR);
            $queryCheck->bindParam(":puntaje", $puntaje, PDO::PARAM_INT);
        }else if($modulo && !$tipo && !$puntaje){
            $queryCheck = $db->prepare("SELECT COUNT(*) as resultado FROM `puntaje` WHERE modulo_id = :modulo_id AND puntaje IN(100, 80, 60)");
            $queryCheck->bindParam(":modulo_id", $modulo, PDO::PARAM_INT);
        }else{
            $queryCheck = $db->prepare("SELECT COUNT(*) as resultado FROM `puntaje`");
        }
        $queryCheck->execute();

        $count = $queryCheck->rowCount();

        if($count){
            $result = $queryCheck->fetch(PDO::FETCH_ASSOC);
            return $result['resultado'];
        }else{
            return null;
        }

    }
    
     /* 
    *
    *  Get Participantes
    *
    *  return array
    *
    */
    public static function getParticipantes($modulo = null, $tipo = null){
        $db = Database::getDB();
        
        // Obteniendo Intentos
        if($modulo && !$tipo){
            $queryCheck = $db->prepare("SELECT COUNT(*) as resultado FROM `puntaje` WHERE modulo_id = :modulo_id AND puntaje IN(100, 80, 60)");
            $queryCheck->bindParam(":modulo_id", $modulo, PDO::PARAM_INT);
        }else if($modulo && $tipo){
            $queryCheck = $db->prepare("SELECT COUNT(*) as resultado FROM `puntaje` WHERE modulo_id = :modulo_id AND tipo = :tipo AND puntaje IN(100, 80, 60)");
            $queryCheck->bindParam(":modulo_id", $modulo, PDO::PARAM_INT);
            $queryCheck->bindParam(":tipo", $tipo, PDO::PARAM_STR);
        }else{        
            $queryCheck = $db->prepare("SELECT COUNT(*) as resultado FROM `puntaje` WHERE puntaje IN(100, 80, 60)");
        }
        $queryCheck->execute();

        $count = $queryCheck->rowCount();

        if($count){
            $result = $queryCheck->fetch(PDO::FETCH_ASSOC);
            return $result['resultado'];
        }else{
            return null;
        }

    }
    
    
    
    
    /* 
    *
    *  Get Puntajes
    *  $usuario integer
    *
    *  return array
    *
    */
    public static function getPuntajes($grupo = null){
        $db = Database::getDB();
        
        
        
        $sqlMods = "SELECT COUNT(*) as cuenta FROM modulo WHERE state = 'open'";
        $queryMods = $db->prepare($sqlMods);   
        $queryMods->execute();
        $modsCount = $queryMods->fetch(PDO::FETCH_ASSOC);
        
        $modulosActivos = (int) $modsCount['cuenta'];
        
        // echo "----------------------------------------------------------<br>";
        // echo " CURSOS <br>";
        // var_dump($modulosActivos);
        // echo "<br>";
        
        // Obteniendo Intentos
        if($grupo){
            $sql = "SELECT pt.usuario_id, un.grupo FROM puntaje pt LEFT JOIN usuario us ON (us.id = pt.usuario_id) LEFT JOIN usuarios_nestle un ON (un.cedula = us.cedula) WHERE un.grupo = :grupo GROUP BY pt.usuario_id, un.grupo";
            $queryCheck = $db->prepare($sql);
            $queryCheck->bindParam(":grupo", $grupo, PDO::PARAM_STR);
        }else{
            $sql = "SELECT pt.usuario_id, un.grupo FROM puntaje pt LEFT JOIN usuario us ON (us.id = pt.usuario_id) LEFT JOIN usuarios_nestle un ON (un.cedula = us.cedula) GROUP BY pt.usuario_id";
            $queryCheck = $db->prepare($sql);        
        }
        
        // echo $grupo . " | " . $sql . "<br><br>";
            
        $queryCheck->execute();

        $count = $queryCheck->rowCount();
        
        $puntaje = [];

        if($count){
            $result = $queryCheck->fetchAll(PDO::FETCH_ASSOC);
            
            // echo "<pre>";
            // print_r($result);
            // echo "</pre>";   
            
            foreach($result as $k => $v){
                $tmp = [];
                $userID = $v['usuario_id'];
                $userGrupo = $v['grupo'];
                $puntajeTotal = 0;
                $tiempoTotal = 0;
                $nombre = '';
                $cedula = '';
                $apellido = '';
                
                for($t=1;$t<=$modulosActivos;$t++){
                        $tipos = ['normal', 'extra'];
                        for($u=0;$u<=1;$u++){
                            $query = $db->prepare("SELECT pt.*, us.nombre, us.apellido, us.cedula FROM `puntaje` pt LEFT JOIN `usuario` us ON (pt.usuario_id = us.id) WHERE usuario_id = :usuario_id AND tipo = :tipo AND modulo_id = :modulo_id ORDER BY puntaje DESC LIMIT 1");
                            $query->bindParam(":usuario_id", $userID, PDO::PARAM_INT);
                            $query->bindParam(":modulo_id", $t, PDO::PARAM_INT);
                            $query->bindParam(":tipo", $tipos[$u], PDO::PARAM_STR);
                            $query->execute();
                            
                            $userData = $query->fetch(PDO::FETCH_ASSOC);
                            if($userData){
                                if($nombre == ''){ $nombre = $userData['nombre'] . " " . $userData['apellido']; }
                                if($cedula == ''){ $cedula = $userData['cedula']; }
                                
                                list($mins,$secs) = explode(':',$userData['tiempo']);
                                
                                // $seconds = mktime(0,8,0) - mktime(0,$mins,$secs);
                                // $tiempoTotal += $seconds;
                                
                                
                                $puntajeTotal += $userData['puntaje'];
                                
                                $tiempoRestante = (($mins * 60) + $secs);
                                
                                $tiempoLogrado = (480 - $tiempoRestante);
                                
                                $restanteFomato = self::secsToMins($tiempoRestante);
                                $logradoFomato = self::secsToMins($tiempoLogrado);
                                
                                
                                // if($userID == 864){
                                //     print_r($userData); 
                                //     print_r($tipos[$u]); 
                                //     echo " | " . $u ."<br>"; 
                                // }
                                
                                if($grupo == null){
                                    //echo $userData['nombre'] . " " .   $userData['apellido'] . "," .   trim($userData['cedula']) . "," .   $userGrupo . ", " .   $t . "," .   $tipos[$u] . "," .   $userData['puntaje'] . "," .   $restanteFomato . "," .   $logradoFomato . "," .   $userData['fecha_registro'] . "<br>";
                                    // echo "USER ID: " . $userID . " | " . $mins . ":" .  $secs . " | " . gmdate("H:i:s", mktime(0,$mins,$secs)) . " | " . gmdate("H:i:s", mktime(0,8,0)) . "<br>";
                                    // echo "USER ID: " . $userID . " | SEPARADO: " . $mins . ":" .  $secs . " | RESTO: " . $tiempoRestante . " | LOGRADO: " . $tiempoLogrado . " | RESTO GENERADO: " . $restanteFomato . " | LOGRADO GENERADO: " . $logradoFomato  . " | ALMACENADO: " . $userData['tiempo'] . "<br>"; 
                                }
                                
                            }
                        }
                }
                
                $puntaje[$userID]['puntaje'] = $puntajeTotal;
                $puntaje[$userID]['nombre'] = $nombre;
                $puntaje[$userID]['cedula'] = $cedula;
                $puntaje[$userID]['segundos'] = $tiempoTotal;

            }
            
            self::aasort($puntaje, 'puntaje');
            
            if($grupo){
                $clasificacion = array_slice($puntaje, -10);
            }else{
                $clasificacion = array_slice($puntaje, -100);
            }
            
            self::aasort($clasificacion, 'segundos');
            self::aasort($clasificacion, 'puntaje');
            rsort($clasificacion);
            
            return $clasificacion;
        }else{
            return null;
        }

    }
    
    
    /* 
    *
    *  Get Rating
    *
    *  return array
    *
    */
    public static function getRating(){
        $db = Database::getDB();
        
        // Obteniendo Intentos
        $queryCheck = $db->prepare("SELECT modulo_id, count(*) as cuenta FROM `rating` GROUP BY modulo_id");
        $queryCheck->execute();

        $count = $queryCheck->rowCount();
        
        
        

        if($count){
            $result = $queryCheck->fetchAll(PDO::FETCH_ASSOC);
            $i = 0;
            foreach($result as $k => $v){
                $rating['modulo'][$v['modulo_id']]['id'] = $v['modulo_id'];
                
                
                $query = $db->prepare("SELECT * FROM rating WHERE modulo_id = :modulo_id");
                $query->bindParam(":modulo_id", $v['modulo_id'], PDO::PARAM_INT);
                $query->execute();
                $countRows = $query->rowCount();
                
                if($countRows){
                    $sumaA = 0;
                    $sumaB = 0;
                    $sumaC = 0;
                    $data = $query->fetchAll(PDO::FETCH_ASSOC);
                    foreach($data as $n => $j){
                        $json = str_replace(array('{', '}'), array('[',']'), $j['rating']);
                        $valores = json_decode($json, true);
                        
                        // echo "<pre>";var_dump($json);echo "</pre>";
                        // echo "<pre>";var_dump($valores);echo "</pre>";
                        $sumaA += $valores[0];
                        $sumaB += $valores[1];
                        $sumaC += $valores[2];
                    }
                    
                    $rating['modulo'][$v['modulo_id']]['A'] = round($sumaA / $countRows, 2);
                    $rating['modulo'][$v['modulo_id']]['B'] = round($sumaB / $countRows, 2);
                    $rating['modulo'][$v['modulo_id']]['C'] = round($sumaC / $countRows, 2);
                }
                
                
            }
            

                
                
            return $rating;
        }else{
            return null;
        }

    }



    /* 
    *
    *  Insert Query on Database Table
    *  $conn db
    *  $table string
    *  $values array
    *
    *  return @mixed
    *
    */
    private static function insert($conn, $table, $values) {
        if(count($values)){
            try {
                $keys = array_keys($values);
                $fieldsString = implode(", ", $keys);
                $valuesString = ":" . implode(", :", $keys);
                $insert = "INSERT INTO $table ($fieldsString) VALUES ($valuesString)";
                $query = $conn->prepare($insert);
                //echo $insert;
                foreach ($values as $key => &$value) {
                    switch(gettype($value)) {
                    case 'integer':
                    case 'double':
                        $query->bindParam(':' . $key, $value, PDO::PARAM_INT);
                        break;
                    default:
                        $query->bindParam(':' . $key, $value, PDO::PARAM_STR);
                    }
                }
                $result = $query->execute();
                return $result;

            } catch(PDOException $e) {
                //echo 'ERROR: ' . $e->getMessage(); // TODO WARNING JUST UNCOMMENT FOR DEBUG
                return null;
            }
        }
    }


    /* 
    *
    *  Update Query on Database Table
    *  $conn db
    *  $table string
    *  $values array
    *
    *  return @mixed
    *
    */
    private static function update($conn, $table, $values, $id) {
        if(count($values)){
            try {
                $updateString = "";
                foreach($values as $k => $v){
                    $updateString .= $k . " = " . ":" . $k;
                    if ($k !== array_key_last($values)) {
                        $updateString .= ", ";
                    }
                }
                $update = "UPDATE $table SET $updateString WHERE id = :id";
                $query = $conn->prepare($update);
                
                $query->bindParam(':id', $id, PDO::PARAM_INT);
                
                foreach ($values as $key => &$value) {
                    switch(gettype($value)) {
                    case 'integer':
                    case 'double':
                        $query->bindParam(':' . $key, $value, PDO::PARAM_INT);
                        break;
                    default:
                        $query->bindParam(':' . $key, $value, PDO::PARAM_STR);
                    }
                }
                //$query->debugDumpParams();
                $result = $query->execute();
                
                
                return $result;

            } catch(PDOException $e) {
                //echo 'ERROR: ' . $e->getMessage(); // TODO WARNING JUST UNCOMMENT FOR DEBUG
                return null;
            }
        }
    }

    /* 
    *
    *  Test if user is Logged In
    *  return bool
    *
    */
    public static function isLogged(){
        if(isset($_SESSION['admin']['user'])){
            return true;    
        }
        return false;
    }
    
    
    
    private static function aasort(&$array, $key) {
        $sorter = array();
        $ret = array();
        reset($array);
        foreach ($array as $ii => $va) {
            $sorter[$ii] = $va[$key];
        }
        asort($sorter);
        foreach ($sorter as $ii => $va) {
            $ret[$ii] = $array[$ii];
        }
        $array = $ret;
    }
    
    private static function secsToMins(String $time){
        return (str_pad((($time - ($time%60))/60), 2, "00", STR_PAD_LEFT) . ":" . str_pad(($time%60), 2, "00", STR_PAD_LEFT));
    }

}