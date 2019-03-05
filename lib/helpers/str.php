<?php
/**
 * LSCorePHP
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
 * @package		LSCorePHP
 * @author		LadySusy Dev
 * @copyright	Copyright (c) 2018, LadySusy (http://www.ladysusy.org/)
 * @license		http://opensource.org/licenses/MIT	MIT License
 */
 
// Evitar acceso directo
defined('_LS') or die;

/**
 * SGC clase para utilitarios
 */
class Str
{

    public function lsstr() {
    $lsstr = array('ls'=> 
                        array('tablas' => 
                        array('roles' => 
                        array('enc' => array('titulo' => 'DMSR_TITULO', 'boton' => 'DMSR_BOTON_NUEVO'),
                              'id' => 'DMSR_ID',
                              'nombre' => 'DMSR_NOMBRE',
                              'opciones' => 'DMSR_OPCIONES'),
                              'permisos' => 
                        array('enc' => array('titulo' => 'DTP_TITULO', 'boton' => 'DTP_BOTON_NUEVO'),
                              'id' => 'DTP_ID',
                              'descripcion' => 'DTP_DESCRIPCION',
                              'categoria' => 'DTP_CATEGORIA',
                              'opciones' => 'DTP_OPCIONES'),
                              'mensajes' => 
                        array('enc' => array('titulo' => 'DTLM_TITULO', 'boton' => 'DTLM_BOTON_NUEVO'),
                              'id' => 'DTLM_ID',
                              'persona' => 'DTLM_PERSONA',
                              'acceso' => 'DTLM_ACCESO',
                              'accion' => 'DTLM_ACCION',
                              'descripcion' => 'DTLM_DESCRIPCION',
                              'ip' => 'DTLM_IP',
                              'equipo' => 'DTLM_EQUIPO',
                              'navegador' => 'DTLM_NAVEGADOR',
                              'so' => 'DTLM_SO',
                              'opciones' => 'DTP_OPCIONES')),
                        'dashboard' => array())
                    );
        return $lsstr;
    }
    
}
