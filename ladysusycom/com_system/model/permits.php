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
class SistemaModeloPermisos extends LSModel
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
    public function getPermisos()
    {
        try {
            $db = $this->getDbo();
            $query = $db->getQuery();
            $query->select('p.id AS idp, p.tx_descripcion AS descripcion, pc.tx_nombre AS categoria');
            $query->join('','ls_permiso_categoria AS pc ON p.id_permiso_categoria=pc.id');
            $query->from('ls_permiso AS p');

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
     * Registrando un permiso
     *
     * @param string $tabla El nombre de la tabla
     * @param array $data Los datos en formato de array que seran procesados en el registro
     *
     * @return boolean true o false
     */
    public function registroPermiso($tabla, $data)
    {
        try {
            foreach ($data as $indice => $temp) {
                $valores_temp[$indice] = $this->request->checkData($temp);
            }
            $valores = implode(",", $valores_temp);
            $campos = implode(",", array_keys($data));

            // Creando query para registrar datos.
            $query = "INSERT INTO $tabla ($campos) VALUES ($valores)";
            $db = $this->getDbo();

            if (!$rstDatos = $db->query($query)) {
                    LSError::msgLog($this->db->errno, $this->db->error, $_SERVER['PHP_SELF']);
                    throw new Exception (LSError::propError('ERROR', 'SQLERROR'));
                }

        } catch (Exception $e) {
            LSError::render($e);
        }
        
        return true;
    }
    
    /**
     * Editando un permiso
     *
     * @param string $tabla Tabla que se actualizara
     * @param array $data Datos pasados
     * 
     * @return boolean true en caso de exito, o null en caso de falla
     */
    public function editPermiso($tabla, $data)
    {    
        $id = $data['idp'];
        Utils::elimArray($data, 'idp');
        
        $query = $this->request->mysql_update_array($tabla, $data, 'id', $id);
        if (!$result = $this->_db->query($query)) { 

            return null;
        }    
        
        return true;
    }
    
    /**
     * Consultando datos de los permisos
     *
     * @param int $id ID del permiso
     * 
     * @return mixto, resultado en caso de exito y null por falla
     */
    public function getPermiso($id)
    {
        try {
            $db = $this->getDbo();
            $query = $db->getQuery();
            $query->select('p.id AS idp, p.tx_descripcion AS descripcion');
            $query->from('ls_permiso AS p');
            $query->where('p.id = '.$id.'');

            if (!$rstDatos = $db->query($query)) {
                LSError::msgLog($this->db->errno, $this->db->error, $_SERVER['PHP_SELF']);
                throw new Exception (LSError::propError('ERROR', 'SQLERROR'));
            }

        } catch (Exception $e) {
            LSError::render($e);
        }

        return $rstDatos;
    }
    
    /**
     * Elimnando un permiso
     * 
     * @param string $tabla Nombre de la tabla
     * @param int $id ID del permiso
     *
     * @return boolean true en caso de exito, o null por falla
     */
    public function deletePermiso($tabla, $id)
    {
        try {
            $db = $this->getDbo();
            $query = $db->getQuery();
            //$query->delete($tabla)->where('id='.$id.'');
            $query = 'DELETE FROM '.$tabla.' WHERE id='.$id.' LIMIT 1';

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
     * Obteniendo categorias de permisos
     * 
     * @return mixto, resultado en caso de exito y null por falla
     */
    public function getCategorias()
    {
        try {
            $db = $this->getDbo();
            $query = $db->getQuery();
            $query->select('pc.id AS idc, pc.tx_nombre AS nombre');
            $query->from('ls_permiso_categoria AS pc');

            if (!$rstDatos = $db->query($query)) {
                LSError::msgLog($this->db->errno, $this->db->error, $_SERVER['PHP_SELF']);
                throw new Exception (LSError::propError('ERROR', 'SQLERROR'));
            }

        } catch (Exception $e) {
            LSError::render($e);
        }

        return $rstDatos;
    }
}

