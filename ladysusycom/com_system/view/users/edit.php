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
    $rstData = $this->edit->fetch_object();
    $edit = LSText::_('EDITAR_USUARIO');
    $do = 'edition';
} else {
    $edit = LSText::_('NUEVO_USUARIO');
    $do = 'registry';
}
?>
    <div class="container">
        <div class="card mb-3">
            <div class="card-header text-white mb-3" style="background:#2c92dc">
                <i class="fa fa-user-circle"></i> <?php echo LSText::_('SISTEMA'); ?> - <?php echo $edit; ?>
            </div>
            <div class="card-body">
                <form action="index.php?ladysusycom=com_system&view=users&task=edit&do=<?php echo $do; ?>" method="post">
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label text-muted font-weight-bold"><?php echo LSText::_('NOMBRES'); ?>:</label>
                        <div class="col-sm-10">
                            <input name="names" type="text" class="form-control" id="name" value="<?php echo $rstData->name; ?>"> 
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lastname" class="col-sm-2 col-form-label text-muted font-weight-bold"><?php echo LSText::_('APELLIDOS'); ?>:</label>
                        <div class="col-sm-10">
                            <input name="lastname" type="text" class="form-control" id="lastname" value="<?php echo $rstData->lastname; ?>"> 
                        </div>
                    </div>
                             <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label text-muted font-weight-bold"><?php echo LSText::_('EMAIL'); ?>:</label>
                        <div class="col-sm-10">
                            <input name="email" type="text" class="form-control" id="email" value="<?php echo $rstData->email; ?>"> 
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tx_descripcion" class="col-sm-2 col-form-label text-muted font-weight-bold"><?php echo LSText::_('ROL'); ?>:</label>
                        <div class="col-sm-4">
                            <select name="id_rol" class="custom-select">
                                <?php if (!isset($rstData->idr)) { ?>
                                <option></option>
                                <?php } else { ?>
                                <option value="<?php echo $rstData->idr ?>"><?php echo $rstData->rol ?></option>
                                <?php }
                                while ($roles = $this->roles->fetch_object()) {
                                    if ($rstData->idr == $roles->idr) {
                                    // No imprimimos
                                    } else { ?>
                                        <option value="<?php echo $roles->idr ?>"><?php echo $roles->name ?></option>
                                    <?php 
									}
                                } ?>
                            </select>
                        </div><a class="btn border-button-new" data-title="<?php echo LSText::_('NUEVO_ROL'); ?>" aria-label="New" id="myBtn">
                                <i class="fa fa-plus" style="color: #7c848b" aria-hidden="true"></i>
                            </a>
                    </div>
                    <div class="form-group row">
                        <label for="photo" class="col-sm-2 col-form-label text-muted font-weight-bold"><?php echo LSText::_('FOTO'); ?>:</label>
                        <div class="col-sm-10">
                            <input name="photo" type="text" class="form-control" id="rol" value="<?php echo $rstData->photo; ?>"> 
                        </div>
                    </div>
                    <hr>
                    <input type="hidden" name="idu" value="<?php echo $rstData->idu; ?>">
                    <button type="submit" class="btn btn-primary"><?php echo LSText::_('ENVIAR'); ?></button>
                </form>
            </div>
        </div>
    </div>
    
<!-- Modal -->
<div class="modal fade" id="myModal" aria-labelledby="myModalAdminTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
    $('#myBtn').click(function() {
        var title = $(this).data('title');
        $('.modal-title').text(title);
        $('.modal-body').load('lib/helpers/modal.php?req=NC',function() {
            $('#myModal').modal({show:true});
         });
    });
});
</script>

<?php   
/* liberar el conjunto de resultados */
if ($this->edit) {
    $this->edit->close();
}
?>
