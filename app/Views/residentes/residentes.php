<?php
    /* This is a function that will be called when the user clicks the button to add a new record. */
    getModal($controlador);
?>
    <header>
        <nav class="navbar naveg navbar-light">
            <a class="navbar-brand" href="<?= base_url(); ?>">
                <img src="<?= base_url(); ?>/dist/img/IKEA_logo.svg" width="80" height="30" alt="logo IKEA"><span class="text-dark font-weight-bold ml-1">Free Food</span>
            </a>
        </nav>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-12 mt-2">
                <div class="d-flex ">
                    <h4 id="slogan" class="font-weight-bold titulo text-left">Residentes</h4>
                </div>
            </div>
        </div>
    </div>
    <!-- Main content -->
    <section class="mt-2">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-header color-primario">
                    <div class="d-flex flex-row justify-content-around align-items-center">
                        <div class="flex-grow-1 mr-1">
                            <input type="text" class="form-control text-gray" placeholder="Buscar..." id="txtBuscar" name="txtBuscar">
                        </div>
                        <div class="form-inline">
                            <select class="form-control custom-select mx-1 text-gray" id="selectEntries">
                                <option value="10" class="text-gray">10</option>
                                <option value="25" class="text-gray">25</option>
                                <option value="50" class="text-gray">50</option>
                                <option value="100" class="text-gray">100</option>
                            </select>
                        </div>
                        <button type="button" class="btn color-secundario" onclick="openModal()">
                            <i class="fas fa-plus"></i> <span class="hidden-letters font-weight-bold"> Agregar</span>
                        </button>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table style="width: 100%;" class="display nowrap no-footer table table-sm table-hover" cellspacing="0" id="tabla_<?= $controlador ?>">
                        <thead>
                            <tr class="color-primario text-bold text-white">
                                <th class="pl-3" style="width: 6%;">Id</th>
                                <th style="width: 18%;">Nombres</th>
                                <th style="width: 18%;">Apellidos</th>
                                <th style="width: 10%;">Tel&eacute;fono</th>
                                <th style="width: 20%;">Correo</th>
                                <th style="width: 6%;">Edad</th>
                                <th style="width: 10%;">Estado</th>
                                <th style="width: 16%;">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="m-3 border-top text-sm">
                    <div class="float-left mt-2">
                        <p class="text-muted" id="numbers_numbers"></p>
                    </div>
                    <div class="float-right mt-2">
                        <p class="text-muted" id="pagination_pagination"></p>
                    </div>
                </div>
            </div>
        </div>
    </section>