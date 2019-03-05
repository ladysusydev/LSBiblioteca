<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema bibliotecario">
    <meta name="author" content="LadySusys">
    <title><?php echo $config->appName; ?> - <?php echo LSText::_('DTM_TITULO_PRI') ?></title>
    <!-- Bootstrap core CSS-->
    <link href="template/<?php echo $config->template; ?>/vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome core CSS-->
    <link href="template/<?php echo $config->template; ?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- DataTables Core CSS -->
    <link href="template/<?php echo $config->template; ?>/vendors/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- Registo Academico Core CSS -->
    <link href="template/<?php echo $config->template; ?>/css/main.css" rel="stylesheet">
</head>
<body class="app sidebar-mini rtl">
    <!-- Navbar-->
    <header class="app-header">
        <a class="app-header__logo" href="index.html">SB</a>
        <!-- Sidebar toggle button-->
        <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"> </a>
        <!-- Titulo principal -->
        <span class="app-header__title">Sistema Bibliotecario</span>
        <!-- Navbar Right Menu-->
        <ul class="app-nav">
            <!--Notification Menu-->
            <li class="dropdown">
                <a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications">
                    <i class="fa fa-bell-o fa-lg"></i>
                </a>
                <ul class="app-notification dropdown-menu dropdown-menu-right">
                    <li class="app-notification__title">You have 4 new notifications.</li>
                    <div class="app-notification__content">
                        <li>
                            <a class="app-notification__item" href="javascript:;">
                                <span class="app-notification__icon">
                                    <span class="fa-stack fa-lg">
                                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                        <i class="fa fa-envelope fa-stack-1x fa-inverse"></i>
                                    </span>
                                </span>
                                <div>
                                    <p class="app-notification__message">Lisa sent you a mail</p>
                                    <p class="app-notification__meta">2 min ago</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="app-notification__item" href="javascript:;">
                                <span class="app-notification__icon">
                                    <span class="fa-stack fa-lg">
                                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                        <i class="fa fa-envelope fa-stack-1x fa-inverse"></i>
                                    </span>
                                </span>
                                <div>
                                    <p class="app-notification__message">Lisa sent you a mail</p>
                                    <p class="app-notification__meta">2 min ago</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="app-notification__item" href="javascript:;">
                                <span class="app-notification__icon">
                                    <span class="fa-stack fa-lg">
                                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                        <i class="fa fa-envelope fa-stack-1x fa-inverse"></i>
                                    </span>
                                </span>
                                <div>
                                    <p class="app-notification__message">Lisa sent you a mail</p>
                                    <p class="app-notification__meta">2 min ago</p>
                                </div>
                            </a>
                        </li>
                    </div>
                    <li class="app-notification__footer"><a href="#">See all notifications.</a></li>
                </ul>
            </li>
            <!-- User Menu-->
            <li class="dropdown">
                <a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu">
                    <i class="fa fa-user fa-lg"></i>
                </a>
                <ul class="dropdown-menu settings-menu dropdown-menu-right">
                    <li><a class="dropdown-item" href="page-user.html"><i class="fa fa-cog fa-lg"></i> Settings</a></li>
                    <li><a class="dropdown-item" href="page-user.html"><i class="fa fa-user fa-lg"></i> Profile</a></li>
                    <li><a class="dropdown-item" href="page-login.html"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
                </ul>
            </li>
        </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
        <div class="app-sidebar__user">
            <?php $nombre_fichero = 'template/ladysusy/images/'.$resultDatos->Foto.'.png';
            if (file_exists($nombre_fichero)) { $foto = $resultDatos->Foto.'.png';
            } else { $foto = 'usuario_nofoto.png'; } ?>
            <img src="template/ladysusy/images/<?php echo $foto; ?>" alt="User Image">
            <div>
                <p class="app-sidebar__user-name">John Doe</p>
                <p class="app-sidebar__user-designation">Frontend Developer</p>
            </div>
        </div>
        <ul class="app-menu">
            <li>
                <a class="app-menu__item active" href="index.html">
                    <i class="app-menu__icon fa fa-dashboard"></i>
                    <span class="app-menu__label">Dashboard</span>
                </a>
            </li>
            <li class="treeview">
                <a class="app-menu__item" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa fa-edit"></i>
                    <span class="app-menu__label"><?php echo LSText::_('DM_SISTEMA'); ?></span>
                    <i class="treeview-indicator fa fa-angle-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a class="treeview-item" href="index.php?ladysusycom=com_system&view=users">
                            <i class="icon fa fa-circle-o"></i> <?php echo LSText::_('DMS_USUARIOS') ?>
                        </a>
                    </li>
                    <li>
                        <a class="treeview-item" href="index.php?ladysusycom=com_system&view=roles">
                            <i class="icon fa fa-circle-o"></i> <?php echo LSText::_('DMS_ROLES') ?>
                        </a>
                    </li>
                    <li>
                        <a class="treeview-item" href="index.php?ladysusycom=com_system&view=users">
                            <i class="icon fa fa-circle-o"></i> <?php echo LSText::_('DMS_PERMISOS') ?>
                        </a>
                    </li>
                    <li>
                        <a class="treeview-item" href="index.php?ladysusycom=com_system&view=users">
                            <i class="icon fa fa-circle-o"></i> <?php echo LSText::_('DMS_MENSAJES') ?>
                        </a>
                    </li>
                    <li>
                        <a class="treeview-item" href="index.php?ladysusycom=com_system&view=units">
                            <i class="icon fa fa-circle-o"></i> <?php echo LSText::_('DMS_UNIDADES') ?>
                        </a>
                    </li>
                    <li>
                        <a class="treeview-item" href="index.php?ladysusycom=com_system&view=readers">
                            <i class="icon fa fa-circle-o"></i> <?php echo LSText::_('DMS_LECTORES') ?>
                        </a>
                    </li>
                    <li>
                        <a class="treeview-item" href="index.php?ladysusycom=com_system&view=books">
                            <i class="icon fa fa-circle-o"></i> <?php echo LSText::_('DMS_LIBROS') ?>
                        </a>
                    </li>
                    <li>
                        <a class="treeview-item" href="index.php?ladysusycom=com_system&view=users">
                            <i class="icon fa fa-circle-o"></i><?php echo LSText::_('DMS_LOGS') ?>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </aside>
    
