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
 * Clase para la view del componente
 */ 
class SistemaVistaMensajes extends LSVista
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
    public function presentar()
    {
        // Asignaciones necesarias
        $task                 = LSReqenvironment::getVar('task', null, 'get');
        $model                = $this->getModel();
        $session                = LSPrincipal::getSession();
        $app                   = LSPrincipal::getApplication('aplicacion');

        // Una instancia a la clase Query
        $queryDB = new Query();
        
        if ($task != null) {
            // Obteniendo datos necesarios
            switch ($task) {
                case 'edit':
                    $tpl = 'edit';
                    $idm = LSReqenvironment::getVar('idm', null, 'get');
                    if ($idm != null) {
                        $this->edit = $model->getMensaje('ls_auditoria', $idm);
                    }
                    break;
                case 'delete':
                    // Obteniendo datos pasados con post
                    $idm = LSReqenvironment::getVar('idm', null, 'get');
                    $do = LSReqenvironment::getVar('do', null, 'get');

                    if ($idm != null) {
                        // Elimando el registro.
                        $result = $model->deleteMensajes('ls_auditoria', $idm, false);    
                    } elseif($do != null) {
                        $result = $model->deleteMensajes('ls_auditoria', false, true);
                    }
                    
                    if ($result != null) { 
                        $aEst = LSText::_('OPERACION_CORRECTA');
                        $alert = 'text-warning';
                    } else {
                        $aEst  = 'No se puedo realizar la operacion';
                        $alert = 'text-warning';
                    }
                    $session->set('aEst',$aEst );
                    $session->set('alert',$alert);
                    $app->__r('index.php?ladysusycom=com_system&view=mensajes');
                    break;
                    default:
                        $aEst  = LSText::_('OPERACION_INCORRECTA');
                        $alert = 'text-danger';
                        $session->set('aEst',$aEst );
                        $session->set('alert',$alert);
                        $app->__r('index.php?ladysusycom=com_system&view=mensajes');
                    
            }
        } else {
            try {
                // Obteniendo los datos para la view
                $this->dataRoles = $model->getRoles();
                if ($this->dataRoles == null) {
                    throw new Exception (LSError::propError(500, 'ERROR', 'SQLERROR', LSText::_('NO_DATOS_MOSTRAR')));
                }

            } catch (Exception $e) {
                LSError::render($e);
            }
        }    
        parent::display($tpl);
    }
}
