<?php
/**
 * Query
 * 
 * @author ATE/José Roberto Alas <ladysusydev@gmail.org>
 */
 
// Evitar acceso directo
defined('_LS') or die;

/**
 * clase LSQuery
 */
class Query extends LSModel
{ 
    /**
     * Obteniendo datos del usuario
     * 
     * @param  int  $id  Id del usuario
     *
     * @return query en caso de exito y null por falla
     */
    public function getDatosUser($id)
    {            
        // Consultando los datos
        $db = $this->getDbo();
        $query = $db->getQuery();
        $query->select('u.id AS id, CONCAT_WS(" ", u.names, u.lastname) AS Name, u.photo AS Photo');
        $query->from('&&__users AS u');
        $query->where('u.id = "'.$id.'"');
        
        if (!$resultSQL = $db->setQuery($query)) {
            return null;
        }  else {
           $obj = $resultSQL->fetch_object();
        }

        /* liberar el conjunto de resultados */
        $resultSQL->close();

        return $obj;
    }
    
    /**
     * Obteniendo mensajes de auditoria
     *
     * @return query en caso de exito y null por falla
     */
    public function getDatosMensajes($resumen = null)
    {            
        // Consultando los datos
        $db = $this->getDbo();
        $query = $db->getQuery();
        $query->select('a.id AS idm, DATE_FORMAT(a.access, "%d-%b-%Y %H:%i") AS Fecha, CONCAT_WS(" ", u.names, u.lastname) AS Nombre, a.action AS Accion');
        $query->select('a.description AS Descripcion, a.ip AS IP, a.pc AS Equipo, a.browser AS Navegador, a.so AS SO, a.state AS Estado');
        $query->from('&&__audit AS a');
        $query->join('', 'ls_users AS u ON a.id_users = u.id');
        $query->order('a.state');
        if ($resumen) {
            $query .= ' LIMIT 4';
        }
        
        if (!$resultSQL = $db->setQuery($query)) {
            return null;
        }  else {
           return $resultSQL;
        }
    }
    
    /**
     * Estado de mensajes
     * 
     * @return int Total de registros
     */ 
    public function getEstadoMensajes()
    {
        $db = $this->getDbo();
        $sql = 'SELECT * FROM ls_auditoria WHERE c_estado="A"';
        if ($result = $db->query($sql)) { 
            $total = $result->num_rows;
            $result->close();
            
            return $total;
        } else {
            return null;
        }
    }
    
    
    
    /**
     * Cuenta el total de registros
     * 
     * @param string $tabla Nombre de la tabla
     * @param string $reqFecha Una fecha de requerimiento
     * 
     * @return int Total de registros
     */ 
    public function total_registros($tabla, $reqFecha = null)
    {
        if ($reqFecha) {
            $year = $this->getYear();
            $where = 'WHERE YEAR(fecha) = "'.$year.'"';
            
        } else {
            $where = '';
        }
        
        $db = $this->getDbo();
        // Consultando los datos
        $sql = "SELECT * FROM ".$tabla." ".$where."";
        if ($result = $db->query($sql)) { 
            // Obtener el total
            $total = $result->num_rows;
            $result->close();
        }    
        
        return $total;
    }
    
    /**
     * Registro de auditoria
     * 
     * @param array $datos Parametros a registrar
     * 
     * @return boolean
     */ 
    public function setAuditoria($datos)
    {
        try {
            // Instanciando base de datos
            $db = $this->getDbo();
            
            // Procesando informacion
            foreach ($datos as $indice => $temp) {
                $valores_temp[$indice] = $this->checkData($temp);
            }
        
            $valores = implode(",", $valores_temp);
            $campos = implode(",", array_keys($datos));
            
            // Registrando la informacion en la base de datos.
            $query = "INSERT INTO ls_auditoria ($campos) VALUES ($valores)";

            if (!$db->query($query)) {
                LSError::msgLog($db->errno, $db->error, $_SERVER['PHP_SELF']);
                throw new Exception (LSError::propError(500, 'ERROR', 'SQLERROR', 'Revise el log del sistema'));
            }
        } catch (Exception $e) {
            // Capturando los errores de la base de datos
            LSError::render($e);
        }

        return true;
    }

}
