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
if ($this->edit) {
    $rstDatos = $this->edit->fetch_object();
    $edit = LSText::_('EDITAR_PERMISO');
    $do = 'edicion';
} else {
    $edit = LSText::_('NUEVO_PERMISO');
    $do = 'registro';
}
?>
    <div class="container">
        <div class="card mb-3">
            <div class="card-header text-white mb-3" style="background:#2c92dc">
                <i class="fa fa-user-circle"></i> <?php echo LSText::_('SISTEMA'); ?> - <?php echo $edit; ?>
            </div>
            <div class="card-body">
                <form action="index.php?ladysusycom=com_system&view=permisos&task=edit&do=<?php echo $do; ?>" method="post">
                    <div class="form-group row">
                        <label for="tx_descripcion" class="col-sm-2 col-form-label text-muted font-weight-bold"><?php echo LSText::_('DESCRIPCION'); ?>:</label>
                        <div class="col-sm-10">
                            <input name="tx_descripcion" type="text" class="form-control" id="tx_descripcion" value="<?php echo $rstDatos->descripcion; ?>"> 
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tx_descripcion" class="col-sm-2 col-form-label text-muted font-weight-bold"><?php echo LSText::_('CATEGORIA'); ?>:</label>
                        <div class="col-sm-4">
                            <select name="id_permiso_categoria" class="custom-select">
                                <?php if (!isset($obj->id_grupo)) { ?>
                                <option></option>
                                <?php } else { ?>
                                <option value="<?php echo $rstDatos->id_categoria ?>"><?php echo $rstDatos->gnombre ?></option>
                                <?php }
                                while ($categoria = $this->categorias->fetch_object()) {
                                   // if ($->idc == $obj->id_grupo) {
                                    // No imprimimos
                                   // } else { ?>
                                        <option value="<?php echo $categoria->idc ?>"><?php echo $categoria->nombre ?></option>
                                    <?php 
                                    //} 
                                } ?>
                            </select>
                        </div><a class="btn border-button-new openModalAdmin" data-title="<?php echo LSText::_('NUEVA_CATEGORIA'); ?>" aria-label="New" id="myBtn">
                                <i class="fa fa-plus" style="color: #7c848b" aria-hidden="true"></i>
                            </a>
                    </div>
                   
                    <hr>
                    <hr>
                    <input type="hidden" name="idp" value="<?php echo $rstDatos->idp; ?>">
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
        $('.modal-body').load('lib/ayudas/modal.php?req=NC',function(result) {
            $('#myModal').modal();
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
