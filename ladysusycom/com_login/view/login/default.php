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
 
// Avoid direct access
defined('_LS') or die;

// Creando instancias
$this->app = LSPrincipal::getApplication();
$this->session = $this->app->getSession();

?>
<div class="container">
    <div class="col-md-12 text-center">
         <?php if ($msg = $this->session->get('statusLogin')) { $this->session->set('statusLogin', null); 
         echo '<i class="fa fa-exclamation-circle" style="color:#D80027;" aria-hidden="true"></i> <span style="color:#ffda44;">'.$msg.'</span>';
         } ?>
    </div>
    <div class="card card-login mx-auto mt-4">
      <div class="card-header"><i class="fa fa-user-circle-o" style="color:#343a40;" aria-hidden="true"></i>  <span style="color:#006DF0;"><?php echo LSText::_('INICIAR_SESION'); ?></span></div>
      <div class="card-body">
        <form id="loginForm" action="index.php" method="post">
          <div class="form-group">
            <label for="login"><?php echo LSText::_('USUARIO'); ?></label>
            <input class="form-control" name="login" type="text" tabindex="1" placeholder="<?php echo LSText::_('USUARIO'); ?>">
          </div>
          <div class="form-group">
            <label for="password"><?php echo LSText::_('PASSWORD'); ?></label>
            <input class="form-control" id="password" type="password" name="password" tabindex="2" placeholder="<?php echo LSText::_('PASSWORD'); ?>">
          </div>
          <input name="task" type="hidden" value="login"/>
          <input name="commit" type="submit" class="btn btn-primary btn-block" value="<?php echo LSText::_('LOG_IN'); ?>">
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="forgot-password.html"><?php echo LSText::_('RECUPERAR_PASSWORD'); ?></a>
        </div>
      </div>
    </div>
</div>
