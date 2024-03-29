<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="es_ES">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="NuLL" />
        <meta name="author" content="Arix Company" />
        <title>Arix Shell V1.0</title>
        <link href="<?php echo base_url('public/resources/css/styles.css');?>" rel="stylesheet"/>
        <link href="<?php echo base_url('public/resources/css/material-icons.css');?>" rel="stylesheet"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/resources/dtables/DataTables-1.10.23/css/jquery.dataTables.min.css');?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/resources/dtables/AutoFill-2.3.5/css/autoFill.dataTables.css');?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/resources/dtables/Buttons-1.6.5/css/buttons.dataTables.min.css');?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/resources/dtables/KeyTable-2.5.3/css/keyTable.dataTables.min.css');?>"/>
   </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">   
            <a class="navbar-brand" href="#">
              <img src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" width="30" height="30" alt="">
            </a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i>
            </button><!-- Navbar Search-->
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav">
                <li class="nav-item active">
                  <a class="nav-link" href="#">Cargando ... <span class="sr-only">(current)</span></a>
                </li>
              </ul>
            </div>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle mr-md-2 active" id="sucursal-db" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <small>Cargando ...</small>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" id="sucursal-db-list" aria-labelledby="sucursal-db">
                        <a class="dropdown-item active" href="/docs/4.1/">Cargando ...</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="https://v4-alpha.google.com/">Mas información</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="javascript:;" id="dropdown-item-u1">Cargando ...</a>
                        <a class="dropdown-item" href="javascript:;" id="dropdown-item-u2">Cambiar contraseña</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="javascript:;" id="dropdown-item-u3">Cerrar Sesion</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Cargando ...</div>
                            <a class="nav-link active" href="javascript:;">
                                <div class="sb-nav-link-icon"><i class="fas fa-angle-right"></i></div>
                                Cargando ...
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Supported by</div>
                        &reg;Arix Corporation
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">                        
                        <!--<ol class="breadcrumb mb-2" id="user-title-breadcrumb">
                            <li class="breadcrumb-item">Cargando ... </li>
                            <li class="breadcrumb-item active">Buscando ...</li>
                        </ol>-->
                        <div class="navbar navbar-expand-sm navbar-light" style="background-color: #e9ecef; margin: 0 0 11px 0">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav-idont-know" aria-controls="nav-idont-know" aria-expanded="false" aria-label="Toggle navigation">
                                <i class="fas fa-bars"></i>
                            </button>
                            <div class="collapse navbar-collapse" id="nav-idont-know">
                                <ul class="navbar-nav mr-auto mt-0 mt-lg-0" style="font-size: 1.1rem;" id="user-title-breadcrumb">
                                    <li class="breadcrumb-item active">Cargando ... </li>
                                </ul>
                                <ul class="navbar-nav mt-0 mt-lg-0">                           
                                    <li class="nav-item" id="nav-item-input-buscar">                                        
                                    </li>
                                    <li class="nav-item" id="nav-item-input-botones">
                                        <div class="btn-group btn-group-sm" id="xxx"></div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div id="use-container-secondary"></div>                           
                        <div id="use-container-primary"></div>                            
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Arix MEE (shell-v1.1, api-v2.0)</div>
                            <div>
                                <a href="#">Desarrolladores</a>
                                &middot;
                                <a href="#">Soporte técnico</a>
                                &middot;
                                <a href="#">Política de seguridad</a>
                                &middot;
                                <a href="#">Términos &amp; Condiciones</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url('public/resources/js/scripts.js');?>"></script>
        <!--<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>-->
        <script type="text/javascript" src="<?php echo base_url('public/resources/dtables/JSZip-2.5.0/jszip.min.js');?>"></script>
        <script type="text/javascript" src="<?php echo base_url('public/resources/dtables/pdfmake-0.1.36/pdfmake.min.js');?>"></script>
        <script type="text/javascript" src="<?php echo base_url('public/resources/dtables/pdfmake-0.1.36/vfs_fonts.js');?>"></script>
        <script type="text/javascript" src="<?php echo base_url('public/resources/dtables/DataTables-1.10.23/js/jquery.dataTables.min.js');?>"></script>
        <script type="text/javascript" src="<?php echo base_url('public/resources/dtables/AutoFill-2.3.5/js/dataTables.autoFill.min.js');?>"></script>
        <script type="text/javascript" src="<?php echo base_url('public/resources/dtables/Buttons-1.6.5/js/dataTables.buttons.min.js');?>"></script>
        <script type="text/javascript" src="<?php echo base_url('public/resources/dtables/Buttons-1.6.5/js/buttons.html5.min.js');?>"></script>
        <script type="text/javascript" src="<?php echo base_url('public/resources/dtables/Buttons-1.6.5/js/buttons.print.min.js');?>"></script>
        <script type="text/javascript" src="<?php echo base_url('public/resources/dtables/KeyTable-2.5.3/js/dataTables.keyTable.min.js');?>"></script>
        <script src="<?php echo base_url('public/resources/js/arixshell.js');?>"></script>        
        <?php if($js!=null){for($i=0;$i<count($js);$i++){echo '<script src="'.str_replace('base_url();',base_url(),$js[$i]).'" crossorigin="anonymous"></script>'."\n";}}else{return false;}//para cragar JS al sistema ?>
    </body>
</html>