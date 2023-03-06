<?php
/*
*
* Class App
*
*/
include('Database.php');

class App{

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
    public static function login(){
        $db = Database::getDB();
        

        if(isset($_POST['username'])){
            
            // First blank filter
            if($_POST['username'] == ''){
                return [
                    'status' => 'warning',
                    'title' => '¡Error!',
                    'message' => 'Por favor llene todos los campos antes de continuar.'
                ];
            }

            // Searching on database
            $query = "SELECT u.*, un.grupo, un.cargo, un.observaciones FROM usuario as u LEFT JOIN usuarios_nestle as un ON (TRIM(un.cedula) = TRIM(u.cedula)) WHERE u.cedula = :cedula";
            
            $result = $db->prepare($query);

            $result->bindParam(":cedula", $_POST['username'], PDO::PARAM_STR);
            //$result->bindParam(":password", $_POST['password'], PDO::PARAM_STR);

            $response = $result->execute();

            $count = $result->rowCount();
            
            // If find coincidence return success else return error
            if($count){
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                
                $user = $result->fetch(PDO::FETCH_ASSOC);

                $_SESSION['user'] = $user;

                return ['status' => 'success'];
            }else{
                return [
                    'status' => 'negative',
                    'title' => '¡Error!',
                    'message' => 'El usuario o contraseña son incorrectos, por favor vuelve a intentarlo.'
                ];
            }
        }else{
            return [
                'status' => 'warning',
                'title' => '¡Error!',
                'message' => 'Por favor llena todos los campos antes de continuar.'
            ];
        }
    }


    /* 
    *
    *  Return Photo Profile
    *  $id integer
    *
    *  return string
    *
    */
    public static function getPhoto($id){
        $db = Database::getDB();
        
        // Searching on database
        $query = "SELECT imagen FROM usuario WHERE id = :id";
            
        $result = $db->prepare($query);
        $result->bindParam(":id", $id, PDO::PARAM_INT);
        $response = $result->execute();

        $count = $result->rowCount();

        if($count){
            $user = $result->fetch(PDO::FETCH_ASSOC);
            return $user['imagen'];
        }else{
            return null;
        }

    }


    /* 
    *
    *  Init Intentos
    *  $usuario integer
    *
    *  return null
    *
    */
    public static function initIntentos($usuario){
        $db = Database::getDB();
        
        // $resultCount = $db->prepare("SELECT * FROM modulo WHERE state = 'open'");
        $resultCount = $db->prepare("SELECT * FROM modulo");
        $resultCount->execute();
        $countA = $resultCount->rowCount();
        
        //Insertando Intentos en base de datos si no existe datos de intentos
        for($i=1;$i<=$countA;$i++){
            $arrTipo = ["normal","extra"];
            for($j=0;$j<=1;$j++){
                $queryCheck = $db->prepare("SELECT * FROM intentos WHERE usuario_id = :usuario_id AND modulo_id = :modulo_id AND tipo = :tipo LIMIT 1");
                $queryCheck->bindParam(":usuario_id", $usuario, PDO::PARAM_INT);
                $queryCheck->bindParam(":modulo_id", $i, PDO::PARAM_INT);
                $queryCheck->bindParam(":tipo", $arrTipo[$j], PDO::PARAM_STR);
                $queryCheck->execute();

                $countB = $queryCheck->rowCount();
                if(!$countB){
                    self::insert($db, "intentos", ['usuario_id'=> $usuario, 'modulo_id' => $i, 'intentos' => 3, 'tipo' => $arrTipo[$j]]);
                }
            }
        }

        return null;
    }

    /* 
    *
    *  Get Intentos
    *  $usuario integer
    *
    *  return array
    *
    */
    public static function getIntentos($usuario){
        $db = Database::getDB();
        $intentos = [];

        // Obteniendo Intentos
        $queryCheck = $db->prepare("SELECT * FROM intentos WHERE usuario_id = :usuario_id");
        $queryCheck->bindParam(":usuario_id", $usuario, PDO::PARAM_INT);
        $queryCheck->execute();

        $count = $queryCheck->rowCount();

        if($count){
            $resultIntentos = $queryCheck->fetchAll(PDO::FETCH_ASSOC);
            foreach($resultIntentos as $k => $v){
                $intentos[$v["modulo_id"]][$v["tipo"]] = $v["intentos"];
            }
            return $intentos;
        }else{
            return null;
        }

    }
    
    
    
    /* 
    *
    *  Check if last chance was perfect
    *  $usuario integer
    *
    *  return array
    *
    */
    public static function getLastChance($usuario, $modulo, $tipo){
        $db = Database::getDB();

        // Obteniendo Intentos
        $queryCheck = $db->prepare("SELECT * FROM puntaje WHERE usuario_id = :usuario_id AND modulo_id = :modulo_id AND tipo = :tipo AND puntaje > 0 ORDER BY puntaje DESC LIMIT 1");
        $queryCheck->bindParam(":modulo_id", $modulo, PDO::PARAM_INT);
        $queryCheck->bindParam(":usuario_id", $usuario, PDO::PARAM_INT);
        $queryCheck->bindParam(":tipo", $tipo, PDO::PARAM_STR);
        $queryCheck->execute();

        $count = $queryCheck->rowCount();

        if($count){
            return false;
        }else{
            return true;
        }

    }
    
    /* 
    *
    *  get Ramaining ExtraPoints Quiz
    *  $usuario integer
    *
    *  return array
    *
    */
    public static function getRemainingDays($lastday){
        $now = new \DateTime('now');
        $now->format('Y-m-d');
        
        $firstDate = $now->format('Y-m-d');
        $secondDate = '2022-02-25';
        
        $dateDifference = abs(strtotime($secondDate) - strtotime($firstDate));
        
        $years  = floor($dateDifference / (365 * 60 * 60 * 24));
        $months = floor(($dateDifference - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
        $days   = floor(($dateDifference - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 *24) / (60 * 60 * 24));
        
        return $days;
    }

    
    /* 
    *
    *  get Config Value
    *  $usuario integer
    *
    *  return array
    *
    */
    public static function getConfig($name){
        $db = Database::getDB();
        
        // Searching on database
        $query = "SELECT * FROM config WHERE name = :name LIMIT 1";
            
        $result = $db->prepare($query);
        $result->bindParam(":name", $name, PDO::PARAM_STR);
        $result->execute();

        $count = $result->rowCount();

        if($count){
            $data = $result->fetch(PDO::FETCH_ASSOC);
            return $data['value'];
        }else{
            return null;
        }

    }


    /* 
    *
    *  get Config Value
    *  $usuario integer
    *
    *  return array
    *
    */
    public static function getRecursos($modulo){
        $db = Database::getDB();
        
        // Searching on database
        $query = "SELECT * FROM recurso WHERE modulo_id = :modulo_id";
            
        $result = $db->prepare($query);
        $result->bindParam(":modulo_id", $modulo, PDO::PARAM_INT);
        $result->execute();

        $count = $result->rowCount();

        if($count){
            $data = $result->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }else{
            return null;
        }

    }

    
    /* 
    *
    *  Restar Intento
    *  $usuario integer
    *  $modulo integer
    *  $tipo string
    *  $intento integer
    *
    *  return bool
    *
    */
    public static function restarIntento($usuario,$modulo,$tipo,$intentos){
        $db = Database::getDB();

        $intento = $intentos - 1;

        $update = "UPDATE intentos SET intentos = :intentos  WHERE usuario_id = :usuario_id AND modulo_id = :modulo_id AND tipo = :tipo";
        $query = $db->prepare($update);
        $query->bindParam(':intentos', $intento, PDO::PARAM_INT);
        $query->bindParam(':usuario_id', $usuario, PDO::PARAM_INT);
        $query->bindParam(':modulo_id', $modulo, PDO::PARAM_INT);
        $query->bindParam(':tipo', $tipo, PDO::PARAM_STR);

        $result = $query->execute();

        if($result){
            return true;
        }else{
            echo false;
        }

    }


    /* 
    *
    *  Know if module is rated by user
    *  $usuario integer
    *  $modulo integer
    *
    *  return bool
    *
    */
    public static function rating($usuario, $modulo, $rating){
        $db = Database::getDB();
        $data = [
            'usuario_id' => $usuario,
            'modulo_id' => $modulo,
            'rating' => $rating,
        ];
        $result = self::insert($db, 'rating', $data);

        if($result){
            return true;
        }else{
            return false;
        }

    }

    /* 
    *
    *  Know if module is rated by user
    *  $usuario integer
    *  $modulo integer
    *
    *  return bool
    *
    */
    public static function isRated($usuario, $modulo){
        $db = Database::getDB();
        $intentos = [];

        // Obteniendo Intentos
        $queryCheck = $db->prepare("SELECT * FROM rating WHERE usuario_id = :usuario_id AND modulo_id = :modulo_id LIMIT 1");
        $queryCheck->bindParam(":usuario_id", $usuario, PDO::PARAM_INT);
        $queryCheck->bindParam(":modulo_id", $modulo, PDO::PARAM_INT);
        $queryCheck->execute();

        $count = $queryCheck->rowCount();

        if($count){
            return true;
        }else{
            return false;
        }

    }



    /* 
    *
    *  Return Nestle User
    *  $cedula integer
    *
    *  return string
    *
    */
    public static function saveResult($usuario, $modulo, $puntaje, $intento, $tipo, $tiempo, $puntaje_real, $numero_aciertos){
        $db = Database::getDB();
        $data = [
            'usuario_id' => $usuario,
            'modulo_id' => $modulo,
            'puntaje' => $puntaje,
            'intento' => $intento,
            'tipo' => $tipo,
            'tiempo' => $tiempo,
            'puntaje_real' => $puntaje_real,
            'numero_aciertos' => $numero_aciertos
        ];
        $result = self::insert($db, 'puntaje', $data);

        if($result){
            echo json_encode(["staut" => "success"]);
        }else{
            echo json_encode(["staut" => "error"]);
        }

    }


    /* 
    *
    *  Return Puntaje
    *  $cedula integer
    *
    *  return string
    *
    */

    public static function getModulos(){
        $db = Database::getDB();
        $query = "SELECT * FROM modulo";
            
        $result = $db->prepare($query);
        $response = $result->execute();

        $count = $result->rowCount();

        if($count){
            $_modulos = $result->fetchAll(PDO::FETCH_ASSOC); 
            $keys = range(1, count($_modulos));
            $modulos = array_combine($keys, $_modulos);
            return $modulos;
        }else{
            return null;
        }
    }



    /* 
    *
    *  Return Preguntas
    *  $modulo  integer
    *  $tipo    string
    *  
    *  return string
    *
    */
    public static function getPreguntas($modulo, $tipo, $grupo = "General"){
        $db = Database::getDB();
        
        if(trim($grupo) == "Mercaderistas"){
            $grupo = "Mercaderistas";
        }else{
            $grupo = "General";
        }
        
        if($tipo == "modulo"){
            $grupo = "General";
        }
        
        $queryPreguntas = "SELECT id as element, numero as id, tipo, texto as pregunta, respuesta_correcta, puntos FROM pregunta WHERE modulo_id = :modulo_id AND modulo_tipo = :modulo_tipo AND grupo = :grupo ORDER BY numero";
        $resultPreguntas = $db->prepare($queryPreguntas);
        $resultPreguntas->bindParam(":modulo_id", $modulo, PDO::PARAM_INT);
        $resultPreguntas->bindParam(":modulo_tipo", $tipo, PDO::PARAM_STR);
        $resultPreguntas->bindParam(":grupo", $grupo, PDO::PARAM_STR);
        $resultPreguntas->execute();

        $setPreguntas = $resultPreguntas->fetchAll(PDO::FETCH_ASSOC);

        foreach($setPreguntas as $k => $v){
            $queryRespuestas = "SELECT numero as id, texto FROM respuesta WHERE pregunta_id = :pregunta_id AND grupo = :grupo";
            $resultRespuestas = $db->prepare($queryRespuestas);
            $resultRespuestas->bindParam(":pregunta_id", $v['element'], PDO::PARAM_INT);
            $resultRespuestas->bindParam(":grupo", $grupo, PDO::PARAM_STR);
            $resultRespuestas->execute();
            $count = $resultRespuestas->rowCount();
            if($count){
                $respuestas = $resultRespuestas->fetchAll(PDO::FETCH_ASSOC);
                foreach($respuestas as $j => $m){
                    $setPreguntas[$k]['respuestas'][$m['id']] = $m['texto'];
                }
            }
        }
        
        $keys = range(1, count($setPreguntas));
        $preguntas = array_combine($keys, $setPreguntas);

        if(count($preguntas)){
            return json_encode($preguntas);
        }else{
            return null;
        }
    }



    /* 
    *
    *  Return Puntaje
    *  $cedula integer
    *
    *  return string
    *
    */
    public static function getPuntaje($usuario){
        $db = Database::getDB();

        $puntaje = [];

        $puntaje['modulos'] = [];
        $puntaje['total'] = 0;
        
        $resultCount = $db->prepare("SELECT * FROM modulo");
        $resultCount->execute();
        $count = $resultCount->rowCount();

        for($i=1;$i<=$count;$i++){
            //Getting Values
            $arrTipo = ["normal","extra"];
            for($j=0;$j<=1;$j++){
                $queryPuntaje = $db->prepare("SELECT puntaje, tiempo, intento, tipo, fecha_registro FROM puntaje WHERE usuario_id = :usuario_id AND modulo_id = :modulo_id AND tipo = :tipo ORDER by puntaje DESC LIMIT 1");
                $queryPuntaje->bindParam(":usuario_id", $usuario, PDO::PARAM_INT);
                $queryPuntaje->bindParam(":modulo_id", $i, PDO::PARAM_INT);
                $queryPuntaje->bindParam(":tipo", $arrTipo[$j], PDO::PARAM_STR);
                $resultPuntaje = $queryPuntaje->execute();
                if($queryPuntaje->rowCount() && $resultPuntaje){
                    $val = $queryPuntaje->fetch(PDO::FETCH_ASSOC);
                    $puntaje['modulos'][$i][$arrTipo[$j]] = $val;
                    $puntaje['total'] += $val['puntaje'];
                }
            }
        }

        return $puntaje;

    }
    
    
        /* 
    *
    *  Return Ranking
    *  $grupo string
    *
    *  return string
    *
    */
    public static function getRanking($grupo){
        $db = Database::getDB();
        
        // Searching on database
        $query = "
        SELECT 
        	id,
        	grupo, 
            grupo_nestle,
        	modulo,
        	posicion, 
        	nombre, 
            (
            SELECT puntaje
                FROM ranking as rk2 
            WHERE rk2.nombre = rk.nombre 
            AND rk2.grupo = rk.grupo 
            AND rk2.modulo = rk.modulo
            AND rk2.tipo = 'normal'
                LIMIT 1
            ) as normal, 
            (
            SELECT puntaje
                FROM ranking as rk3 
            WHERE rk3.nombre = rk.nombre 
            AND rk3.grupo = rk.grupo 
            AND rk3.modulo = rk.modulo
            AND rk3.tipo = 'extra'
                LIMIT 1
            ) as extra
            
        FROM ranking as rk 
        WHERE LOWER(TRIM(rk.grupo)) = LOWER(TRIM(:grupo))
        GROUP BY grupo, grupo_nestle, modulo, posicion, nombre
        ORDER BY grupo, grupo_nestle, modulo, posicion, nombre, modulo
        ";
            
        $result = $db->prepare($query);
        $result->bindParam(":grupo", $grupo, PDO::PARAM_STR);
        $result->execute();

        $count = $result->rowCount();
        
        if($count){
            $data = $result->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }else{
            return null;
        }

    }
    
    /* 
    *
    *  Return Ranking by module id
    *  $grupo string
    *
    *  return string
    *
    */
    public static function getRankingByModule($grupo, $module_id, $cargo = null){
        $db = Database::getDB();
        $cargoName = "";
        
        switch ($cargo){
            case "Vendedor Dsd":
                $cargoName = "VENDEDORES DSD";
            break;
            case "Supervisor Dsd":
                $cargoName = "SUPERVISORES DSD";
            break;
            case "Mercaderista":
                $cargoName = "MERCADERISTAS";
            break;
            case "Supervisor":
                $cargoName = "SUPERVISORES";
            break;
        }
        
        // Searching on database
        $query = "
        SELECT 
        	id,
        	grupo, 
            grupo_nestle,
        	modulo,
        	posicion, 
        	nombre, 
            (
            SELECT puntaje
                FROM ranking as rk2 
            WHERE rk2.nombre = rk.nombre 
            AND rk2.grupo = rk.grupo 
            AND rk2.modulo = rk.modulo
            AND rk2.tipo = 'normal'
                LIMIT 1
            ) as normal, 
            (
            SELECT puntaje
                FROM ranking as rk3 
            WHERE rk3.nombre = rk.nombre 
            AND rk3.grupo = rk.grupo 
            AND rk3.modulo = rk.modulo
            AND rk3.tipo = 'extra'
                LIMIT 1
            ) as extra
            
        FROM ranking as rk 
        WHERE LOWER(TRIM(rk.grupo)) = LOWER(TRIM(:grupo))
        AND rk.modulo = :module_id
        AND rk.grupo_nestle LIKE :cargo
        GROUP BY grupo, grupo_nestle, modulo, posicion, nombre
        ORDER BY grupo, grupo_nestle, modulo, posicion, nombre, modulo
        ";
            
        $cargoName = "{$cargoName}%";
        
        $result = $db->prepare($query);
        $result->bindParam(":grupo", $grupo, PDO::PARAM_STR);
        $result->bindParam(":module_id", $module_id, PDO::PARAM_STR);
        $result->bindParam(":cargo", $cargoName, PDO::PARAM_STR);
        $result->execute();

        $count = $result->rowCount();
        

        if($count){
            $data = $result->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }else{
            return null;
        }

    }


    /* 
    *
    *  Return Nestle User
    *  $cedula integer
    *
    *  return string
    *
    */
    public static function getAvance($puntaje, $modulos){
        $avance = 0;
        if(count($puntaje) == count($modulos)){
            $avance = 100;
        }else{
            for($i=1;$i<=count($modulos);$i++){
                if(isset($puntaje[$i]["normal"])){
                    $avance += 8;
                }
                if(isset($puntaje[$i]["extra"])){
                    $avance += 8;
                }
            }
        }

        return $avance;

    }

    /* 
    *
    *  Return Nestle User
    *  $cedula integer
    *
    *  return string
    *
    */
    public static function getNestleUser($cedula){
        $db = Database::getDB();
        
        // Searching on database
        $query = "SELECT * FROM usuarios_nestle WHERE cedula = :cedula LIMIT 1";
            
        $result = $db->prepare($query);
        $result->bindParam(":cedula", $cedula, PDO::PARAM_STR);
        $response = $result->execute();

        $count = $result->rowCount();

        if($count){
            $data = $result->fetch(PDO::FETCH_ASSOC);
            echo json_encode(["staut" => "success", "data" => $data]);
        }else{
            echo json_encode(["staut" => "null", 'count' => $count]);
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
            $sql = "SELECT pt.usuario_id FROM puntaje pt LEFT JOIN usuario us ON (us.id = pt.usuario_id) LEFT JOIN usuarios_nestle un ON (un.cedula = us.cedula) GROUP BY pt.usuario_id";
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
                                $seconds = mktime(0,$mins,$secs) - mktime(0,0,0);
                                $puntajeTotal += $userData['puntaje'];
                                $tiempoTotal += $seconds;
                                
                                // if($userID == 864){
                                //     print_r($userData); 
                                //     print_r($tipos[$u]); 
                                //     echo " | " . $u ."<br>";
                                // } $userData['nombre'] . ", " .   
                                
                                
                                
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
    *  Try Insert Query on Database Table
    *  $data array
    *
    *  return bool
    *
    */
    public static function registrar($data){
        $db = Database::getDB();
        $result = self::insert($db, 'usuario', $data);

        return $result;

    }

    /* 
    *
    *  Try Insert Query on Database Table
    *  $data array
    *
    *  return bool
    *
    */
    public static function updatePhoto($id, $data){
        $db = Database::getDB();
        $result = self::update($db, 'usuario', $data, $id);

        echo $result;

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
                
                
                echo $result;

            } catch(PDOException $e) {
                echo 'ERROR: ' . $e->getMessage(); // TODO WARNING JUST UNCOMMENT FOR DEBUG
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
        if(isset($_SESSION['user']['id'])){
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
    
    
    
    public static function formatDump($var){
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
    }

}