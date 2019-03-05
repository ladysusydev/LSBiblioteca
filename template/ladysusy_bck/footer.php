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

$user = LSPrincipal::getUser();
?> 
<?php if ($user->isAuthenticated()) { ?>
    <footer class="sticky-footer">
        <div class="container">
            <div class="text-center">
                <small><p>&copy; LadySusy - LS <?php echo date('Y') ?></p></small>
            </div>
        </div>
    </footer>
<?php } ?>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    
    <!-- Page level plugin JavaScript-->
    <script src="template/<?php echo $config->template; ?>/vendor/chart.js/Chart.min.js"></script>
    <script src="template/<?php echo $config->template; ?>/vendor/datatables/jquery.dataTables.js"></script>
    <script src="template/<?php echo $config->template; ?>/vendor/datatables/dataTables.bootstrap4.js"></script>
    
    <!-- Custom scripts for Buttons -->
    <script type="text/javascript" src="template/<?php echo $config->template; ?>/vendor/DataTables/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="template/<?php echo $config->template; ?>/vendor/DataTables/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="template/<?php echo $config->template; ?>/vendor/Buttons/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="template/<?php echo $config->template; ?>/vendor/Buttons/js/buttons.bootstrap.min.js"></script>
    <script type="text/javascript" src="template/<?php echo $config->template; ?>/vendor/Buttons/js/buttons.flash.min.js"></script>
    <script type="text/javascript" src="template/<?php echo $config->template; ?>/vendor/Buttons/js/jszip.min.js"></script>
    <script type="text/javascript" src="template/<?php echo $config->template; ?>/vendor/Buttons/js/pdfmake.min.js"></script>
    <script type="text/javascript" src="template/<?php echo $config->template; ?>/vendor/Buttons/js/vfs_fonts.js"></script>
    <script type="text/javascript" src="template/<?php echo $config->template; ?>/vendor/Buttons/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="template/<?php echo $config->template; ?>/vendor/Buttons/js/buttons.print.min.js"></script>
    
    <!-- Custom scripts for this page-->
    <script src="template/<?php echo $config->template; ?>/js/ra-admin.js"></script>
    <script src="template/<?php echo $config->template; ?>/js/ra-admin-datatables.js"></script>
    <script src="template/<?php echo $config->template; ?>/js/ra-admin-charts.js"></script>
  </div>
</body>
</html>
