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
if ($this->edit) {
    $rstDatos = $this->edit->fetch_object();
    $edit = LSText::_('EDITAR_ROL');
    $do = 'edition';
} else {
    $edit = LSText::_('NUEVO_ROL');
    $do = 'registry';
}
?>
    <div class="container">
        <div class="card mb-3">
            <div class="card-header text-white mb-3" style="background:#2c92dc">
                <i class="fa fa-user-circle"></i> <?php echo LSText::_('SISTEMA'); ?> - <?php echo $edit; ?>
            </div>
            <div class="card-body">
                <form action="index.php?ladysusycom=com_system&view=roles&task=edit&do=<?php echo $do; ?>" method="post">
                    <div class="form-group row">
                        <label for="tx_nombre" class="col-sm-2 col-form-label text-muted font-weight-bold"><?php echo LSText::_('NOMBRE'); ?>:</label>
                        <div class="col-sm-10">
                            <input name="name" type="text" class="form-control" id="name" value="<?php echo $rstDatos->name; ?>"> 
                        </div>
                    </div>
                    <hr>
                    <input type="hidden" name="idr" value="<?php echo $rstDatos->id; ?>">
                    <button type="submit" class="btn btn-primary"><?php echo LSText::_('ENVIAR'); ?></button>
                </form>
            </div>
        </div>
    </div>
<?php   
/* liberar el conjunto de resultados */
if ($this->edit) {
    $this->edit->close();
}
?>
