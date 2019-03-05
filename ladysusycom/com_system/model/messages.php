<?php
/**
 * LSBiblioteca
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2018, LadySusy
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package		LSBiblioteca
 * @author		LadySusy Dev
 * @copyright	Copyright (c) 2008, LadySusy (http://www.ladysusy.org/)
 * @license		http://opensource.org/licenses/MIT	MIT License
 */
 
// Evitar acceso directo
defined('_LS') or die;

/**
 * Clase del modelo del componente
 */
class SistemaModeloMensajes extends LSModel
{
    /**
     * @var LSRequest
     */
    public $request = null;
    
    /**
     * Constructor.
     * 
     * Recoge los datos seteados en el controlador principal, para ser usados en el componente
     */
     public function __construct()
    {
        // Creando una instancia a la clase request
        $this->request = new LSRequest();
        
        // Llamando al constructor padre.
        parent::__construct();
    }
    
    /**
     * Consultando listado de registros
     *
     * @return mixto, resultado en caso de exito y null por falla
     */
    public function getMensajes()
    {
        try {
            $db = $this->getDbo();
            
            // Actualizando estado de mensajes
            $queryUpdate = 'UPDATE ls_auditoria SET c_estado = "V"';
            $db->query($queryUpdate);
                
            $query = $db->getQuery();
            $query->select('a.id AS idm, a.dt_acceso AS Acceso, a.tx_accion AS Accion');
            $query->select('a.tx_descripcion AS Descripcion, a.v_ip AS Ip, a.v_equipo AS Equipo, a.v_navegador AS Navegador');
            $query->select('a.v_so AS So, CONCAT_WS(" ", p.tx_nombre2, p.tx_apellido1) AS Persona');
            $query->from('ls_auditoria AS a');
            $query->join('', 'ls_persona AS p ON a.id_persona = p.id');
            $query->order('a.dt_acceso');

            if (!$rstDatos = $db->query($query)) {
                LSError::msgLog($this->db->errno, $this->db->error, $_SERVER['PHP_SELF']);
                throw new Exception (LSError::propError(500, 'ERROR', 'SQLERROR', 'Revise el log del system'));
            }

        } catch (Exception $e) {
            LSError::render($e);
        }

        return $rstDatos;
    }
    
    /**
     * Elimnando un mensaje
     * 
     * @param string $tabla Nombre de la tabla
     * @param int $id del mensaje
     *
     * @return boolean true en caso de exito, o null por falla
     */
    public function deleteMensajes($tabla, $id = false, $full = false)
    {
        try {
            $db = $this->getDbo();
            $query = $db->getQuery();
            if ($full) {
                $query = 'DELETE FROM '.$tabla.'';
            } elseif($id) {
                $query = 'DELETE FROM '.$tabla.' WHERE id='.$id.' LIMIT 1';
            }
            
            if (!$rstDatos = $db->query($query)) {
                LSError::msgLog($this->db->errno, $this->db->error, $_SERVER['PHP_SELF']);
                throw new Exception (LSError::propError('ALERT', 'SQLDELETE'));
            }

        } catch (Exception $e) {
            LSError::render($e);

            return false;
        }
        
        return true;
    }
    
    /**
     * Consultando datos del mensaje
     *
     * @param string $tabla Nombre de la tabla
     * @param int $id ID del mensaje
     * 
     * @return    mixto, resultado en caso de exito y null por falla.
     */
    public function getMensaje($tabla, $id)
    {            
        try {
            $db = $this->getDbo();
            $query = $db->getQuery();
            $query->select('a.id AS idm, a.dt_acceso AS Acceso, a.tx_accion AS Accion');
            $query->select('a.tx_descripcion AS Descripcion, a.v_ip AS Ip, a.v_equipo AS Equipo, a.v_navegador AS Navegador');
            $query->select('a.v_so AS So, CONCAT_WS(" ", p.tx_nombre2, p.tx_apellido1) AS Persona');
            $query->from('ls_auditoria AS a');
            $query->join('', 'ls_persona AS p ON a.id_persona = p.id');
            $query->where('a.id = '.$id.'');
            $query->order('a.dt_acceso');

            if (!$rstDatos = $db->query($query)) {
                LSError::msgLog($this->db->errno, $this->db->error, $_SERVER['PHP_SELF']);
                throw new Exception (LSError::propError(500, 'ERROR', 'SQLERROR', 'Revise el log del system'));
            }

        } catch (Exception $e) {
            LSError::render($e);
        }

        return $rstDatos;
    }
}

