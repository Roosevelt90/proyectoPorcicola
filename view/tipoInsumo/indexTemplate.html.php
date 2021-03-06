<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php
use mvc\view\viewClass as view ?>
<?php
use mvc\config\configClass as config ?>
<?php
use mvc\request\requestClass as request ?>

<?php $idTipoInsumo = tipoInsumoTableClass::ID ?>
<?php $descripcion = tipoInsumoTableClass::DESCRIPCION ?>
<?php  $countDetale = 1 ?>
<main class="mdl-layout__content mdl-color--grey-100">
    <div class="mdl-grid demo-content">
        <div class="container container-fluid">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <h2>
                        <?php echo i18n::__('tipoInsumo') ?> 
                    </h2>
                </div>
            </div>
            <div style="margin-bottom: 10px; margin-top: 30px">
                <a href="#" data-target="#myModalFilter" data-toggle="modal" id="filter" class="btn btn-xs btn-default active"><?php echo i18n::__('filters') ?></a>
                <div class="mdl-tooltip mdl-tooltip--large" for="filter">
                    Filtros
                </div>
                <a href="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'deleteFiltersVacunacion') ?>" id="deleteFilter" class="btn btn-info btn-xs" ><?php echo i18n::__('deleteFilter') ?></a>
                <div class="mdl-tooltip mdl-tooltip--large" for="deleteFilter">
                    Borrar filtros
                </div>
                <a id="new" href="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'insertVacunacion') ?>" class="btn btn-success btn-xs"><?php echo i18n::__('newRegistroVacunacion') ?></a>
                <div class="mdl-tooltip mdl-tooltip--large" for="new">
                    Nuevo registro
                </div>
                <a href="#" data-target="#myModalEliminarMasivo" data-toggle="modal" id="deleteMasa" class="btn btn-xs btn-default active"><?php echo i18n::__('borrar seleccion') ?></a>
                <div class="mdl-tooltip mdl-tooltip--large" for="deleteMasa">
                    Eliminar en masa
                </div>
                <a href="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'reportVacunacion') ?>" id="reporte" class="btn btn-info btn-xs" ><?php echo i18n::__('reporte') ?></a>
                <div class="mdl-tooltip mdl-tooltip--large" for="reporte">
                    Reportes
                </div>
            </div>
            <?php view::includeHandlerMessage() ?>
            <table class="table table-bordered table-responsive ">
                <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('insumo', 'deleteSelectTipoInsumo') ?>" method="POST">
                    <thead>
                        <tr class="active">
                            <th>
                                <input class="mdl-checkbox__input " type="checkbox" id="chkAll">
                            </th>
                            <th><?php echo i18n::__('id') ?> </th>
                            <th><?php echo i18n::__('descripcion') ?> </th>
                            <th><?php echo i18n::__('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($objTipoInsumo as $key): ?>
                          <tr>
                              <td>
                                  <input type="checkbox" class="mdl-checkbox__input" name="chk[]" value="<?php echo $key->id ?>" id="checkbox2">
                              </td>
                              <td><?php echo $key->$idTipoInsumo ?></td>
                              <td><?php echo $key->$descripcion ?></td>
                              <td>          
                                  <a id="editDetalle<?php echo $countDetale ?>" href="<?php echo routing::getInstance()->getUrlWeb('insumo', 'editTipoInsumo', array(tipoInsumoTableClass::ID => $key->$idTipoInsumo)) ?>" class="btn btn-primary btn-xs"><?php echo i18n::__('edit', null, 'user') ?></a>
                                  <div class="mdl-tooltip mdl-tooltip--large" for="editDetalle<?php echo $countDetale ?>">
                                      Editar detalles
                                  </div>    
                                  <a href="#" id="deleteRegistro<?php echo $countDetale ?>" class="btn btn-sm btn-danger fa fa-trash-o" data-toggle="modal" data-target="" onclick="modalDelete(<?php echo $key->$idTipoInsumo ?>, '<?php echo tipoInsumoTableClass::getNameField(tipoInsumoTableClass::ID, true) ?>', '<?php echo routing::getInstance()->getUrlWeb('insumo', 'deleteVacunacion') ?>')"><?php echo i18n::__('delete') ?></a>
                                  <div class="mdl-tooltip mdl-tooltip--large" for="deleteRegistro<?php echo $countDetale ?>">
                                      Eliminar registro
                                  </div>    
                              </td>
                          </tr>
                  </form>
                  </form>
                  <?php  $countDetale++ ?>
                <?php endforeach//close foreach  ?>

                </tbody>
            </table>
            <!-- PAGINATOR -->
            <div class="text-right">
                <nav>
                    <ul class="pagination" id="slqPaginador">
                        <li class='<?php echo (($page == 1 or $page == 0) ? "disabled" : "active" ) ?>' id="anterior"><a href="#" aria-label="Previous"onclick="paginador(1, '<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'indexVacunacion') ?>')"><span aria-hidden="true">&Ll;</span></a></li>
                        <?php $count = 0 ?>
                        <?php for ($x = 1; $x <= $cntPages; $x++): ?>
                          <li class='<?php echo (($page == $x) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $x ?>, '<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'indexVacunacion') ?>')"><a href="#"><?php echo $x ?> <span class="sr-only">(current)</span></a></li>
                          <?php $count ++ ?>        
                        <?php endfor //close for  ?>
                        <li class='<?php echo (($page == $count) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $count ?>, '<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'indexVacunacion') ?>')" id="anterior"><a href="#" aria-label="Previous"><span aria-hidden="true">&Gg;</span></a></li>
                    </ul>
                </nav>
            </div> 
            <form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'deleteVacunacion') ?>" method="POST">
                <input type="hidden" id="idDelete" name="<?php echo vacunacionTableClass::getNameField(vacunacionTableClass::ID, true) ?>">
            </form>
        </div>
        <!-- WINDOWS MODAL DELETE MASIVE -->
        <div class="modal fade" id="myModalEliminarMasivo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('borrar seleccion') ?></h4>
                    </div>
                    <div class="modal-body">

                        <?php echo i18n::__('deleteMasive') ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"> <?php echo i18n::__('cancel') ?></button>
                        <button type="button" class="btn btn-danger" onclick="$('#frmDeleteAll').submit()"> <?php echo i18n::__('confirm') ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- WINDOWS MODAL FILTER -->
<div class="modal fade" id="myModalFilter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('filterBy') ?>:</h4>
            </div>
            <div class="modal-body">
                <form id="filterForm" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'indexVacunacion') ?>">
                    <table class="table table-bordered">
                        <tr>
                            <th>
                                <?php echo i18n::__('numer', null, 'dpVenta') ?>:
                            </th>
                            <th>
                                <input  type="text" name="filter[id]">
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <?php echo i18n::__('fechaRegistro', null, 'vacunacion') ?>:
                            </th>
                            <th>
                                <input  type="datetime-local" name="filter[fecha]">
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <?php echo i18n::__('animal', null, 'animal') ?>:
                            </th>
                            <th>
                                <select name="filter[animal]">
                                    <option value="">...</option>
                                    <?php foreach ($objAnimal as $key): ?>

                                      <option value="<?php echo $key->id ?>">
                                          <?php echo $key->numero_identificacion ?>
                                      </option>
                                    <?php endforeach; //close foreach ?>
                                </select>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <?php echo i18n::__('veterinario') ?>:
                            </th>
                            <th>
                                <select name="filter[veterinario]">
                                    <option value="">...</option>

                                    <?php foreach ($objVeterinario as $key): ?>
                                      <option value="<?php echo $key->id ?>">
                                          <?php echo $key->nombre_completo ?>
                                      </option>
                                    <?php endforeach; //close foreach  ?>
                                </select>
                            </th>
                        </tr>
                    </table>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('close', null, 'vacunacion') ?></button>
                <button type="button" class="btn btn-primary" onclick="$('#filterForm').submit()"><?php echo i18n::__('buscar') ?></button>
            </div>
        </div>
    </div>
</div>

<!-- WINDOWS MODAL DETAIL VACCINATION -->
<div class="modal fade" id="myModalDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('newDetailVaccination', null, 'detalleVacunacion') ?>:</h4>
            </div>
            <div class="modal-body">

                <form id="detailForm" name="detailForm" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'createDetalleVacunacion') ?>">

                    <input type="hidden" value="" name="<?php echo detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::ID_REGISTRO, true) ?>" id="<?php echo detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::ID_REGISTRO, true) ?>">
                    <h3><?php echo i18n::__('fecha', null, 'detalleVacunacion') ?></h3>
                    <input type="datetime-local" name="<?php echo detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::FECHA, true) ?>">    

                    <h3><?php echo i18n::__('vacuna', null, 'detalleVacunacion') ?></h3>
                    <select name="<?php echo detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::VACUNA, true) ?>">
                        <option value="">...</option>
                        <?php foreach ($objVacuna as $key): ?> 

                          <option value="<?php echo $key->id ?>"><?php echo $key->nombre_vacuna ?></option>
                        <?php endforeach; //close foreach  ?>
                    </select>

                    <h3><?php echo i18n::__('dosis', null, 'detalleVacunacion') ?></h3>
                    <input type="text" name="<?php echo detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::DOSIS, true) ?>">

                    <h3><?php echo i18n::__('accion') ?></h3>
                    <select name="<?php echo detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::ACCION, true) ?>">
                        <option value="">...</option>
                        <option><?php echo i18n::__('enfermedad') ?></option>
                        <option><?php echo i18n::__('gestacion') ?></option>
                        <option><?php echo i18n::__('parto') ?></option>
                        <option><?php echo i18n::__('rutina') ?></option>
                        <option><?php echo i18n::__('nacido') ?></option>
                    </select>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">   <?php echo i18n::__('cancel') ?></button>
                <button type="button" class="btn btn-primary" onclick="$('#detailForm').submit()">Insertar</button>
                <!--<input type="submit"  class="btn btn-primary" value=<?php echo i18n::__('confirm') ?> >-->

            </div>
        </div>
    </div>
</div>


<!-- WINDOWS MODAL DELETE -->
<div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">  <?php echo i18n::__('confirmDelete') ?></h4>
            </div>
            <div class="modal-body">

                <?php echo i18n::__('eliminarIndividual') ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"> <?php echo i18n::__('cancel') ?></button>
                <button id="delete" name="delete" type="button" class="btn btn-danger fa fa-eraser" onclick="eliminar(, '<?php echo vacunacionBaseTableClass::getNameField(vacunacionTableClass::ID, true) ?>', '<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'deleteVacunacion') ?>')"> <?php echo i18n::__('delete') ?></button>
            </div>
        </div>
    </div>
</div> 