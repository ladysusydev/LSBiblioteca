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
?>
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header text-white mb-3" style="background:#2c92dc">
                <i class="fa fa-user-circle"></i> <?php echo LSText::_('SISTEMA'); ?> - Logs
                    <span class="float-md-right">
                        <form action="index.php?ladysusycom=com_system&view=logs&task=delete&do=fullDelete"method="post">
                            <button class="btn-nuevo btn-sm white-bg" data-toggle="modal" data-target="#nuevoDoc"><i class="fa fa-trash-o fa-1x"></i> <?php echo LSText::_('DTLM_BOTON_VACIAR'); ?></button>
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
                                <th><?php echo LSText::_('ERROR_ENCONTRADO'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($this->logsLineasPlataforma as $errorFoundPlat) : ?>
                            <tr>
                                <td><?php echo $errorFoundPlat; ?></td>
                            </tr>
                            <?php endforeach; ?>
                            <?php foreach ($this->logsLineasAdmin as $errorFoundAdmin) : ?>
                            <tr>
                                <td><?php echo $errorFoundAdmin; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

