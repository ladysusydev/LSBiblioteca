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
                <i class="fa fa-user-circle"></i> <?php echo LSText::_('SISTEMA'); ?> - <?php echo LSText::_($this->XMLPermisos->tablas->permisos->enc->titulo) ?>
                    <span class="float-md-right">
                        <a class="btn-nuevo btn-sm white-bg" href="index.php?ladysusycom=com_system&view=permisos&task=edit" role="button"><i class="fa fa-plus-circle fa-1x"></i> <?php echo LSText::_($this->XMLPermisos->tablas->permisos->enc->boton_nuevo) ?></a>
                    </span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="col-md-12">
                        <div class="tituloBottons">
                            <i class="fa fa-bar-chart" style="color:#2c92dc;" aria-hidden="true"></i> <?php echo LSText::_('BOTONES_REPORTES'); ?>
                        </div>
                    </div>
                    <table id="tablesAdmin" class="table table-sm table-bordered table-hover" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th><?php echo LSText::_($this->XMLPermisos->tablas->permisos->id) ?></th>
                                <th><?php echo LSText::_($this->XMLPermisos->tablas->permisos->descripcion) ?></th>
                                <th><?php echo LSText::_($this->XMLPermisos->tablas->permisos->categoria) ?></th>
                                <th><?php echo LSText::_($this->XMLPermisos->tablas->permisos->opciones) ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($this->datosPermisos) {
                                while ($obj = $this->datosPermisos->fetch_object()) {
                            ?>
                            <tr>
                                <td><?php echo $obj->idp; ?></td>
                                <td><?php echo $obj->descripcion; ?></td>
                                <td><?php echo $obj->categoria; ?></td>
                                <td>
                                    <a class="btn text-white btn-sm ml-2" style="background: #00befc;" href="index.php?ladysusycom=com_system&view=permisos&task=edit&idp=<?php echo $obj->idp; ?>" aria-label="Editar rol">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </a>
                                    <a class="btn text-white btn-danger btn-sm ml-2" href="index.php?ladysusycom=com_system&view=permisos&task=delete&idp=<?php echo $obj->idp; ?>" aria-label="Eliminar rol">
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


<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html> 
  
<head> 
<title>Aparece y desaparece un texto cuando se pulsa un enlace.</title> 

<!--
Codigo presentado por  

www.uterra.com 
 -->

<script languaje="Javascript">  
function MostrarOcultar() 
{ 
    if (document.getElementById) 
    { 
       first.innerHTML = capaVideo2.innerHTML;//Pasa el contenido arriba
      capaVideo2.innerHTML = "";//Borra el contenido del último div
    } 
} 
  
//--> 
</script> 
     
</head> 
  
<body> 
            <div class="cp_oculta" id="first">
                <a class="texto" href="javascript:MostrarOcultar();">Hola mundo</a>
            </div>
            <div class="cp_oculta" id="capaVideo2">
                <div class="form-group row">
                        <label for="tx_descripcion" class="col-sm-2 col-form-label text-muted font-weight-bold"><?php echo LSText::_('DESCRIPCION'); ?>:</label>
                        <div class="col-sm-10">
                            <input name="tx_descripcion" type="text" class="form-control" id="tx_descripcion" value="<?php echo $rstDatos->descripcion; ?>"> 
                        </div>
                    </div>
            </div> 
            
       

</body> 
  
</html>
