<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $nombreEmpleado = empleadoTableClass::NOMBRE ?>
<?php $id = empleadoTableClass::ID ?>
<form method="post" action="<?php echo routing::getInstance()->getUrlWeb('bodega', ((isset($objSalida) == TRUE) ? 'updateESalida' : 'createSalida')) ?>">
  <?php if (isset($objSalida)): ?>
  <input type="hidden" name="<?php echo salidaBodegaTableClass::getNameField(salidaBodegaTableClass::ID, TRUE) ?>" value="<?php echo $objSalida[0]->$id ?>">
  <?php endif; //close if  ?>
  <div class="container">
    <div class="row">
      <div class="col-xs-6-offset-3">

          <table class="table table-responsive "> 
            <tr>
              <th>
                Fecha
              </th>
              <th>
                <input type="datetime-local" name="<?php echo salidaBodegaTableClass::getNameField(salidaBodegaTableClass::FECHA, true) ?>">
              </th>   

            </tr>
            <tr>
              <th>  
                <?php echo i18n::__('empleado', NULL, 'empleado') ?>:
              </th>
              <th> 
                <select name="<?php echo salidaBodegaTableClass::getNameField(salidaBodegaTableClass::EMPLEADO, true) ?>">
                  <option value="">...</option>
                  <?php foreach ($objEmpleado as $key): ?>
                    <option value="<?php echo $key->$id ?>"> <?php echo $key->$nombreEmpleado ?></option>
                  <?php endforeach; //close foreach  ?>
                </select>
              </th>   
            </tr>
            <tr>
              <th colspan="2">
            <div class="text-center">
                <input type="submit" class="btn" value="<?php echo i18n::__(((isset($objSalida) == TRUE) ? 'edit' : 'register'), $culture = NULL, $dictionary = 'user') ?>">
            </div>
            </th>
            </tr>
          </table>
      </div>
    </div>
  </div>
</form>
</div>
</main>