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
        <link href="<?php echo base_url('public/resources/css/styles.css');?>" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
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
                        <a class="dropdown-item" href="https://v4-alpha.getbootstrap.com/">Mas información</a>
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
                            <a class="nav-link" href="index.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-angle-right"></i></div>
                                Contactos
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Supported by</div>
                        &reg;Arix Company 
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
                                <ul class="navbar-nav mr-auto mt-2 mt-lg-0" style="font-size: 1rem;" id="user-title-breadcrumb">
                                    <li class="breadcrumb-item">Cargando ... </li>
                                    <li class="breadcrumb-item active">Buscando ...</li>
                                </ul>
                                <ul class="navbar-nav mt-2 mt-lg-0">                                    
                                    <li class="nav-item" id="nav-item-input-buscar">
                                        
                                    </li>
                                    <li class="nav-item">
                                        <div class="btn-group btn-group-sm" id="nav-item-input-botones"></div>
                                    </li>
                                </ul>
                              </div>
                            </div>
                            <div class="row" id="use-container-secondary">                            
                            </div>                           
                            <div class="row" id="use-container-primary">                            
                            </div>
                            
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
        <script src="<?php echo base_url('public/resources/js/scripts.js');?>"></script>
        <script src="<?php echo base_url('public/resources/js/arixshell.js');?>"></script>
        <?php if($js!=null){for($i=0;$i<count($js);$i++){echo '<script src="'.str_replace('base_url();',base_url(),$js[$i]).'" crossorigin="anonymous"></script>';}}else{return false;}//para cragar JS al sistema ?>
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        
        <script src="assets/demo/datatables-demo.js"></script>-->
    </body>
</html>
