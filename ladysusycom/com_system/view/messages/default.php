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
$session = LSPrincipal::getSession();
$config = LSPrincipal::getConfig();

if ($session->get('aEst')) {
     $MStatus = $session->get('aEst');
     $Alert = $session->get('alert');
     $session->set('aEst', null);
     $session->set('alert', null);
}
?>
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header text-white mb-3" style="background:#2c92dc">
                <i class="fa fa-user-circle"></i> <?php echo LSText::_('SISTEMA'); ?> - <?php echo LSText::_($this->XMLAdmin->tablas->mensajes->enc->titulo) ?>
                <?php if ($MStatus) : ?>
                <span class="<?php echo $Alert ?>"> | <?php echo $MStatus ?></span>
                <?php endif ?>
                    <span class="float-md-right">
                        <form action="index.php?ladysusycom=com_system&view=mensajes&task=delete&do=fullDelete"method="post">
                            <button class="btn-nuevo btn-sm white-bg" data-toggle="modal" data-target="#nuevoDoc"><i class="fa fa-trash-o fa-1x"></i> <?php echo LSText::_($this->XMLAdmin->tablas->mensajes->enc->boton_vaciar) ?></button>
                        </form>
                    </span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="col-md-12">
                        <div class="tituloBottons">
                            <i class="fa fa-bar-chart" style="color:#2c92dc;" aria-hidden="true"></i> <?php echo LSText::_('BOTONES_REPORTES'); ?> 
                    </div>
                    <table id="tableRoles" class="table table-sm table-bordered table-hover" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th><?php echo LSText::_($this->XMLAdmin->tablas->mensajes->id) ?></th>
                                <th><?php echo LSText::_($this->XMLAdmin->tablas->mensajes->persona) ?></th>
                                <th><?php echo LSText::_($this->XMLAdmin->tablas->mensajes->acceso) ?></th>
                                <th><?php echo LSText::_($this->XMLAdmin->tablas->mensajes->accion) ?></th>
                                <th><?php echo LSText::_($this->XMLAdmin->tablas->mensajes->descripcion) ?></th>
                                <th><?php echo LSText::_($this->XMLAdmin->tablas->mensajes->ip) ?></th>
                                <th><?php echo LSText::_($this->XMLAdmin->tablas->mensajes->equipo) ?></th>
                                <th><?php echo LSText::_($this->XMLAdmin->tablas->mensajes->navegador) ?></th>
                                <th><?php echo LSText::_($this->XMLAdmin->tablas->mensajes->so) ?></th>
                                <th><?php echo LSText::_($this->XMLAdmin->tablas->mensajes->opciones) ?></th>
   
                            </tr>
                        </thead>
                        <tbody>
                        

                            <?php
                            // Definiendo tipos de documentos
                            $arrayTipo = array('M'=>'Memorandum', 'O'=>'Oficio');
                            if ($this->datosMensajes) {
                                // Manejando contador de registros
                                while ($obj = $this->datosMensajes->fetch_object()) {
                            ?>
                            <tr>
                                <td><?php echo $obj->idm; ?></td>
                                <td><?php echo $obj->Persona; ?></td>
                                <td><?php echo $obj->Acceso; ?></td>
                                <td><?php echo $obj->Accion; ?></td>
                                <td><?php echo $obj->Descripcion; ?></td>
                                <td><?php echo $obj->Ip; ?></td>
                                <td><?php echo $obj->Equipo; ?></td>
                                <td><?php echo $obj->Navegador; ?></td>
                                <td><?php echo $obj->So; ?></td>
                                <td>
                                    <a class="btn text-white btn-danger btn-sm" href="index.php?ladysusycom=com_system&view=mensajes&task=delete&idm=<?php echo $obj->idm; ?>" aria-label="Skip to main navigation">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php } } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

