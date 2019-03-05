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
if ($this->edit) {
    $dataResult = $this->edit->fetch_object();
}
?>
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header text-white mb-3" style="background:#2c92dc">
                <i class="fa fa-user-circle"></i> <?php echo LSText::_('SISTEMA'); ?> - Mensaje
                <?php if ($MStatus) : ?>
                <span class="<?php echo $Alert ?>"> | <?php echo $MStatus ?></span>
                <?php endif ?>
            </div>
            <div class="card-body">
                <p class="font-weight-normal"><?php echo LSText::_('DTLM_ID'); ?>: <?php echo $dataResult->idm; ?></p>
                <p class="font-weight-normal"><?php echo LSText::_('DTLM_PERSONA'); ?>: <?php echo $dataResult->Persona; ?></p>
                <p class="font-weight-normal"><?php echo LSText::_('DTLM_ACCESO'); ?>: <?php echo $dataResult->Acceso; ?></p>
                <p class="font-weight-normal"><?php echo LSText::_('DTLM_ACCION'); ?>: <?php echo $dataResult->Accion; ?></p>
                <p class="font-weight-normal"><?php echo LSText::_('DTLM_DESCRIPCION'); ?>: <?php echo $dataResult->Descripcion; ?></p>
                <p class="font-weight-normal"><?php echo LSText::_('DTLM_IP'); ?>: <?php echo $dataResult->Ip; ?></p>
                <p class="font-weight-normal"><?php echo LSText::_('DTLM_EQUIPO'); ?>: <?php echo $dataResult->Equipo; ?></p>
                <p class="font-weight-normal"><?php echo LSText::_('DTLM_NAVEGADOR'); ?>: <?php echo $dataResult->Navegador; ?></p>
                <p class="font-weight-normal"><?php echo LSText::_('DTLM_SO'); ?>: <?php echo $dataResult->So; ?></p>
            </div>
        </div>
    </div>

