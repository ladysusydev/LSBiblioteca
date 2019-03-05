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
class SystemModelReaders extends LSModel
{
    /**
     * @var LSRequest
     */
    public $request = null;
    
    /**
     * Constructor
     * 
     * Recoge los datos seteados en el contbookador principal, para ser usados en el componente
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
    public function getReaders()
    {
        try {
            $db = $this->getDbo();
            $query = $db->getQuery();
            $query->select('r.id AS idr, CONCAT(r.names," ",r.lastnames) AS name, r.dui AS dui, tr.name AS typereaders');
            $query->from('ls_readers AS r');
            $query->join('', 'ls_typereaders AS tr ON r.id_typereaders=tr.id');

            if (!$rstData = $db->query($query)) {
                LSError::msgLog($this->db->errno, $this->db->error, $_SERVER['PHP_SELF']);
                throw new Exception (LSError::propError(500, 'ERROR', 'SQLERROR', LSText::_('ERROR_CONSULTA_SQL')));
            }

        } catch (Exception $e) {
            LSError::render($e);
        }

        return $rstData;
    }
    
    /**
     * Registrando un lector
     *
     * @param string $table El nombre de la tabla
     * @param array $data Los datos en formato de array que seran procesados en el registro
     *
     * @return boolean true o false
     */
    public function registryReader($table, $data)
    {
        try {
            Utils::elimArray($data, 'idr');

            foreach ($data as $key => $temp) {
                $values_temp[$key] = $this->request->checkData($temp);
            }
            $values = implode(",", $values_temp);
            $fields = implode(",", array_keys($data));

            // Creando query para registrar datos.
            $query = "INSERT INTO $table ($fields) VALUES ($values)";
 
            $db = $this->getDbo();

            if (!$rstData = $db->query($query)) {
                    LSError::msgLog($this->db->errno, $this->db->error, $_SERVER['PHP_SELF']);
                    throw new Exception (LSError::propError(500, 'ERROR', 'SQLERROR', LSText::_('ERROR_CONSULTA_SQL')));
                }

        } catch (Exception $e) {
            LSError::render($e);
        }
        
        return true;
    }
    
    /**
     * Editando un lector
     *
     * @param string $tabla Tabla que se actualizara
     * @param array $data Data pasados
     * 
     * @return boolean true en caso de exito, o null en caso de falla
     */
    public function editReader($tabla, $data)
    {    
        $id = $data['idr'];
        Utils::elimArray($data, 'idr');
        
        $query = $this->request->mysql_update_array($tabla, $data, 'id', $id);
        if (!$result = $this->_db->query($query)) { 

            return null;
        }    
        
        return true;
    }
    
    /**
     * Consultando datos de un lector
     *
     * @param int $id ID del lector
     * 
     * @return mixto, resultado en caso de exito y null por falla
     */
    public function getReader($id)
    {
        try {
            $db = $this->getDbo();
            $query = $db->getQuery();
            $query->select('r.id AS id, r.names AS names tr.id_typereaders AS idtr');
            $query->from('ls_readers AS r');
            $query->join('', 'ls_typereader AS tr ON r.id_typereader=tr.id');
            $query->where('r.id = '.$id.'');

            if (!$rstData = $db->query($query)) {
                LSError::msgLog($this->db->errno, $this->db->error, $_SERVER['PHP_SELF']);
                throw new Exception (LSError::propError(500, 'ERROR', 'SQLERROR', LSText::_('ERROR_CONSULTA_SQL')));
            }

        } catch (Exception $e) {
            LSError::render($e);
        }

        return $rstData;
    }
    
    /**
     * Elimnando un lector
     * 
     * @param string $tabla Nombre de la tabla
     * @param int $id ID del lector
     *
     * @return boolean true en caso de exito, o null por falla
     */
    public function deleteReader($tabla, $id)
    {
        try {
            $db = $this->getDbo();
            $query = $db->getQuery();
            $query = 'DELETE FROM '.$tabla.' WHERE id='.$id.' LIMIT 1';

            if (!$rstData = $db->query($query)) {
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
     * Obteniendo unidades
     *
     * @return mixto, resultado en caso de exito y null por falla
     */
    public function getTypereaders()
    {
        try {
            $db = $this->getDbo();
            $query = $db->getQuery();
            $query->select('tr.id AS idtr, tr.name AS name');
            $query->from('ls_typereaders AS tr');

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

