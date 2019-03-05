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
 * Clase para la view del componente
 */ 
class SystemViewReaders extends LSView
{
    /**
     * Una instancia a la clase request
     * 
     * @var LSRequest
     */ 
    public $request = null;
    
    /**
     * Presenta los datos en la view
     * 
     * return void
     */
    public function display()
    {
        // Asignaciones necesarias
        $task                 = LSReqenvironment::getVar('task', null, 'get');
        $model                = $this->getModel();
        $session                = LSPrincipal::getSession();
        $app                   = LSPrincipal::getApplication('aplicacion');
        
        $this->request     = new LSRequest();

        // Una intancia a la clase Query
        $queryDB = new Query();
        
        // Obteniendo roles
        $this->typereaders = $model->getTypereaders();
        
        if ($task != null) {
            // Obteniendo datos necesarios
            switch ($task) {
                case 'edit':
                    $tpl = 'edit';
                    // Obteniendo datos pasados por post
                    $data = Utils::datosPost('TODOS');
                    $idr = LSReqenvironment::getVar('idr', null, 'get');
                    
                    // Obteniendo la acción a ejecutar
                    if ($data['do']) {
                        $do = $data['do'];
                        Utils::elimArray($data, 'do');
                    } else {
                        $do = LSReqenvironment::getVar('do', null, 'get');
                    }

                    if ($idr != null && $do == null) {
                        // Obteniendo los datos iniciales
                        $this->edit = $model->getReader($idr);
        
                    } elseif ($do == 'registry' || $do == 'edition') {
                        
                        if ($do == 'edition') {
                            $do = 'edit';
                        } else {
                            $do = 'registry';
                        }
                        // Ejecutando la acción del modelo
                        $method = $do.'Reader';
                        $result = $model->$method('ls_readers', $data);
                        if ($result != null) { 
                            $aEst = LSText::_('OPERACION_CORRECTA');
                            $alert = 'alert alert-success';
                        } else {
                            $aEst  = LSText::_('OPERACION_INCORRECTA');
                            $alert = 'alert alert-danger';
                        }
                        $session->set('aEst',$aEst );
                        $session->set('alert',$alert);
                        $app->__r('index.php?ladysusycom=com_system&view=readers');    
                    }
                    break;
            
                case 'delete':
                    // Obteniendo datos pasados por post
                    $idr = LSReqenvironment::getVar('idr', null, 'get');
                    if ($idr != null && $do == null) {
                        // Eliminando un registro
                        $result = $model->deleteReader('ls_readers', $idr);    
                    }
                    if ($result != null) { 
                        $aEst = LSText::_('OPERACION_CORRECTA');
                        $alert = 'alert-success';
                    } else {
                        $aEst  = LSText::_('OPERACION_INCORRECTA');
                        $alert = 'alert alert-danger';
                    }
                    $session->set('aEst',$aEst );
                    $session->set('alert',$alert);
                    $app->__r('index.php?ladysusycom=com_system&view=readers');
                    break;
            }
        } else {
            try {
                // Obteniendo los datos para la view
                $this->dataReaders = $model->getReaders();
                if ($this->dataReaders == null) {
                    throw new Exception (LSError::propError(500, 'ERROR', 'SQLERROR', LSText::_('NO_DATOS_MOSTRAR')));
                }

            } catch (Exception $e) {
                LSError::render($e);
            }
        }    
        parent::display($tpl);
    }
}
