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

$config = LSPrincipal::getConfig();

$session = LSPrincipal::getSession();
$user = LSPrincipal::getUser();
$queryDB = new Query();
$resultDatos = $queryDB->getDatosUser($session->get('id'));

// Obteniendo mensajes
$resultMensajes = $queryDB->getDatosMensajes(true);
$resultEstadoMensajes = $queryDB->getEstadoMensajes();

if ($resultEstadoMensajes) {
    $colorStatus = '97de64';
} else {
    $colorStatus = '007bff';
}
// Logs del sistema
$logsLineasAdmin = file(LS_LOGS.'/error.log');
$logsAdmin = array_slice($logsLineasAdmin, -4, 4, true);

// Obteniendo logs plataforma principal
$URLPlataforma = strstr(LS_APLICACION, 'admin', true);
$logsPlat = file($URLPlataforma.'logs/error.log');
$logsPlataforma = array_slice($logsPlat, -4, 4, true);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title><?php echo $config->appName; ?> - <?php echo LSText::_('DTM_TITULO_PRI') ?></title>
  <!-- Bootstrap core CSS-->
  <link href="template/<?php echo $config->template; ?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome core CSS-->
  <link href="template/<?php echo $config->template; ?>/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- DataTables Core CSS -->
  <link href="template/<?php echo $config->template; ?>/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Registo Academico Core CSS -->
  <link href="template/<?php echo $config->template; ?>/css/ra-admin.css" rel="stylesheet">
  <!-- Bootstrap core JavaScript-->
  <script src="template/<?php echo $config->template; ?>/vendor/jquery/jquery.min.js"></script>
  <script src="template/<?php echo $config->template; ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="template/<?php echo $config->template; ?>/vendor/jquery-easing/jquery.easing.min.js"></script>
</head>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
<?php if ($user->isAuthenticated()): ?>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
        <a class="navbar-brand" href="#"><?php echo $config->appName; ?> - <?php echo LSText::_('DTM_TITULO_PRI'); ?></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav navbar-sidenav anyClass" id="exampleAccordion">
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Link">
                    <div class="user-panel">
                        <div class="pull-left image">
                            <?php $nombre_fichero = 'template/ladysusy/images/'.$resultDatos->Foto.'.png';
                            if (file_exists($nombre_fichero)) { $foto = $resultDatos->Foto.'.png';
                            } else { $foto = 'usuario_nofoto.png'; } ?>
                            <img src="template/ladysusy/images/<?php echo $foto; ?>" class="rounded-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <a href="index.php?ladysusycom=com_sistema&vista=usuarios&tarea=editar&idu=<?php echo $resultDatos->id; ?>" class="text-light"><h6><?php echo substr($resultDatos->Nombre, 0, 18); ?></h6></a>
                            <a href="#"><i class="fa fa-circle text-success"></i> 5 User Online</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                    <a class="nav-link" href="index.php">
                        <i class="fa fa-fw fa-dashboard" style="color:#FFC107"></i>
                        <span class="nav-link-text">RA <?php echo LSText::_('DTM_TITULO_SEC'); ?></span>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right">
                    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
                    <i class="fa fa-cubes" style="color:#006df0" aria-hidden="true"></i>
                        <span class="nav-link-text"><?php echo LSText::_('DM_SISTEMA'); ?></span>
                    </a>
                    <ul class="sidenav-second-level collapse" id="collapseComponents">
                        <li>
                            <a href="index.php?ladysusycom=com_system&view=users"><?php echo LSText::_('DMS_USUARIOS') ?></a>
                        </li>
                        <li>
                            <a href="index.php?ladysusycom=com_system&view=roles"><?php echo LSText::_('DMS_ROLES') ?></a>
                        </li>
                        <li>
                            <a href="index.php?ladysusycom=com_system&view=users"><?php echo LSText::_('DMS_PERMISOS') ?></a>
                        </li>
                        <li>
                            <a href="index.php?ladysusycom=com_system&view=users"><?php echo LSText::_('DMS_MENSAJES') ?></a>
                        </li>
                        <li>
                            <a href="index.php?ladysusycom=com_system&view=units"><?php echo LSText::_('DMS_UNIDADES') ?></a>
                        </li>
                        <li>
                            <a href="index.php?ladysusycom=com_system&view=readers"><?php echo LSText::_('DMS_LECTORES') ?></a>
                        </li>
                        <li>
                            <a href="index.php?ladysusycom=com_system&view=books"><?php echo LSText::_('DMS_LIBROS') ?></a>
                        </li>
                        <li>
                            <a href="index.php?ladysusycom=com_system&view=users"><?php echo LSText::_('DMS_LOGS') ?></a>
                        </li>
                    </ul>
                </li>
                </ul>
                <ul class="navbar-nav sidenav-toggler">
                    <li class="nav-item">
                        <a class="nav-link text-center" id="sidenavToggler">
                            <i class="fa fa-fw fa-angle-left"></i>
                        </a>
                    </li>
                </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-fw fa-info"></i>
                        <span class="indicator d-none d-lg-block">
                            <i class="fa fa-fw fa-circle" style="color: #<?php echo $colorStatus; ?>"></i>
                        </span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="messagesDropdown">
                        <h6 class="dropdown-header"><?php echo LSText::_('NUEVOS_MENSAJES'); ?>: <span class="badge badge-pill badge-primary"><?php echo $resultEstadoMensajes; ?> <?php echo LSText::_('NUEVO'); ?></span></h6>
                        <?php while ($datosMensajes = $resultMensajes->fetch_object()): 
                            if ($datosMensajes->Estado == 'A') {
                                $color = '97de64';
                            } else {
                                $color = '007bff';
                            }
                        ?>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="index.php?ladysusycom=com_sistema&vista=mensajes&tarea=editar&idm=<?php echo $datosMensajes->idm; ?>">
                                <i class="fa fa-circle fa-fw" style="font-size: 10px; color: #<?php echo $color; ?>" aria-hidden="true"></i> <strong><?php echo $datosMensajes->Nombre; ?></strong>
                                <span class="small float-right text-muted"><?php echo $datosMensajes->Fecha; ?></span>
                                <div class="dropdown-message small"><?php echo $datosMensajes->Accion; ?></div>
                            </a>
                        <?php endwhile; ?>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item small" href="index.php?ladysusycom=com_sistema&vista=mensajes"><?php echo LSText::_('TODOS_MENSAJES'); ?></a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-fw fa-bell"></i>
                        <span class="indicator text-warning d-none d-lg-block">
                            <i class="fa fa-fw fa-circle"></i>
                        </span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="alertsDropdown">
                        <h6 class="dropdown-header"><?php echo LSText::_('NUEVAS_ALERTAS'); ?>:</h6>
                        <?php
                        foreach ($logsAdmin as $logs => $log) { 
                            ?>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="index.php?ladysusycom=com_sistema&vista=logs&tarea=editar&str=<?php echo $logs; ?>&ident=adm">
                            <span class="text-danger">
                                <strong>
                                <i class="fa fa-long-arrow-down fa-fw"></i><?php echo LSText::_('ERROR_ENCONTRADO'); ?></strong>
                            </span>
                            <div class="dropdown-message small"><?php echo $log; ?></div>
                        </a>
                        <?php } ?>
                        <?php foreach ($logsPlataforma as $logsp => $logp) { 
                        ?>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="index.php?ladysusycom=com_sistema&vista=logs&tarea=editar&str=<?php echo $logsp; ?>&ident=ptf">
                            <span class="text-danger">
                                <strong>
                                <i class="fa fa-long-arrow-down fa-fw"></i><?php echo LSText::_('ERROR_ENCONTRADO'); ?></strong>
                            </span>
                            <div class="dropdown-message small"><?php echo $logp; ?></div>
                        </a>
                        <?php } ?>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item small" href="index.php?ladysusycom=com_sistema&vista=logs"><?php echo LSText::_('VER_ALERTAS'); ?></a>
                    </div>
                </li>
                <li class="nav-item">
                    <form class="form-inline my-2 my-lg-0 mr-lg-2">
                        <div class="input-group">
                            <input class="form-control" type="text" placeholder="Search for...">
                            <span class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="modal" data-target="#logoutModal">
                    <i class="fa fa-fw fa-sign-out"></i><?php echo LSText::_('SALIR'); ?></a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- Logout Modal-->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="logoutModalLabel"><?php echo LSText::_('LISTO_SALIR'); ?></h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body"><?php echo LSText::_('SELECT_SALIR'); ?></div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal"><?php echo LSText::_('CANCELAR'); ?></button>
                            <a class="btn btn-primary" href="index.php?ladysusycom=com_login&task=logout"><?php echo LSText::_('SALIR'); ?></a>
                        </div>
                    </div>
                </div>
            </div>
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#"><?php echo $config->appNombre; ?></a>
                </li>
                <li class="breadcrumb-item active">Dashboardss</li>
            </ol>
            
<?php endif; ?>
