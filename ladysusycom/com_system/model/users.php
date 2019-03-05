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
 * @copyright	Copyright (c) 2018, LadySusy (http://www.ladysusy.org/)
 * @license		http://opensource.org/licenses/MIT	MIT License
 */
 
// Evitar acceso directo
defined('_LS') or die;

/**
 * Clase del modelo del componente
 */
class SystemModelUsers extends LSModel
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
    public function getUsers()
    {
        try {
            $db = $this->getDbo();
            $query = $db->getQuery();
            $query->select('u.id AS idu, CONCAT(u.names," ",u.lastname) AS name, u.email AS email, u.id_rol AS idr, r.name AS rol, u.photo AS photo');
            $query->from('ls_users AS u');
            $query->join('','ls_rol AS r ON u.id_rol = r.id');

            if (!$rstDatos = $db->query($query)) {
                LSError::msgLog($this->db->errno, $this->db->error, $_SERVER['PHP_SELF']);
                throw new Exception (LSError::propError(500, 'ERROR', 'SQLERROR', LSText::_('ERROR_CONSULTA_SQL')));
            }

        } catch (Exception $e) {
            LSError::render($e);
        }

        return $rstDatos;
    }
    
    /**
     * Registrando un usuario
     *
     * @param string $table El nombre de la tabla
     * @param array $data Los datos en formato de array que seran procesados en el registro
     *
     * @return boolean true o false
     */
    public function registryUser($table, $data)
    {
        try {
			Utils::elimArray($data, 'idu');

            foreach ($data as $indice => $temp) {
                $valores_temp[$indice] = $this->request->checkData($temp);
            }
            $valores = implode(",", $valores_temp);
            $campos = implode(",", array_keys($data));

            // Creando query para registrar datos.
            $query = "INSERT INTO $table ($campos) VALUES ($valores)";
            $db = $this->getDbo();

            if (!$rstDatos = $db->query($query)) {
                    LSError::msgLog($this->db->errno, $this->db->error, $_SERVER['PHP_SELF']);
                    throw new Exception (LSError::propError(500, 'ERROR', 'SQLERROR', LSText::_('ERROR_CONSULTA_SQL')));
                }

        } catch (Exception $e) {
            LSError::render($e);
        }
        
        return true;
    }
    
    /**
     * Editando un usuario
     *
     * @param string $table Tabla que se actualizara
     * @param array $data Datos pasados
     * 
     * @return boolean true en caso de exito, o null en caso de falla
     */
    public function editUser($table, $data)
    {    
        $id = $data['idu'];
        Utils::elimArray($data, 'idu');
        
        $query = $this->request->mysql_update_array($table, $data, 'id', $id);
        if (!$result = $this->_db->query($query)) { 

            return null;
        }    
        
        return true;
    }
    
    /**
     * Consultando datos de un usuario
     *
     * @param int $idu ID del usuario
     * 
     * @return mixto, resultado en caso de exito y null por falla
     */
    public function getUser($idu)
    {
        try {
            $db = $this->getDbo();
            $query = $db->getQuery();
            $query->select('u.id AS idu, u.names AS name, u.lastname AS lastname, u.email AS email, u.id_rol AS idr, r.name AS rol, u.photo AS photo');
            $query->from('ls_users AS u');
            $query->join('','ls_rol AS r ON u.id_rol = r.id');
            $query->where('u.id = '.$idu.'');

            if (!$rstDatos = $db->query($query)) {
                LSError::msgLog($this->db->errno, $this->db->error, $_SERVER['PHP_SELF']);
                throw new Exception (LSError::propError(500, 'ERROR', 'SQLERROR', LSText::_('ERROR_CONSULTA_SQL')));
            }

        } catch (Exception $e) {
            LSError::render($e);
        }

        return $rstDatos;
    }
    
    /**
     * Elimnando un usuario
     * 
     * @param string $tabla Nombre de la tabla
     * @param int $id ID del usuario
     *
     * @return boolean true en caso de exito, o null por falla
     */
    public function deleteUser($tabla, $id)
    {
        try {
            $db = $this->getDbo();
            $query = $db->getQuery();
            $query = 'DELETE FROM '.$tabla.' WHERE id='.$id.' LIMIT 1';

            if (!$rstDatos = $db->query($query)) {
                LSError::msgLog($this->db->errno, $this->db->error, $_SERVER['PHP_SELF']);
                throw new Exception (LSError::propError(500, 'ERROR', 'SQLERROR', LSText::_('ERROR_CONSULTA_SQL')));
            }

        } catch (Exception $e) {
            LSError::render($e);

            return false;
        }
        
        return true;
        
    }
    
    /**
     * Obteniendo roles
     *
     * @return mixto, resultado en caso de exito y null por falla
     */
    public function getRoles()
    {
        try {
            $db = $this->getDbo();
            $query = $db->getQuery();
            $query->select('r.id AS idr, r.name AS name');
            $query->from('ls_rol AS r');

            if (!$rstDatos = $db->query($query)) {
                LSError::msgLog($this->db->errno, $this->db->error, $_SERVER['PHP_SELF']);
                throw new Exception (LSError::propError(500, 'ERROR', 'SQLERROR', LSText::_('ERROR_CONSULTA_SQL')));
            }

        } catch (Exception $e) {
            LSError::render($e);
        }

        return $rstDatos;
    }
}

