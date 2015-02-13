<?php
use mvc\routing\routingClass as routing ?>
<?php $id = usuarioCredencialTableClass::ID ?>
<?php $user = usuarioTableClass::USER ?>
<?php $credencial = credencialTableClass::NOMBRE ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<div class="container container-fluid">
    <div class="row">
        <div class="col-xs-4-offset-4 titulo">
            <h2>
                <?php  echo i18n::__('read', NULL, 'userCredencial') ?>
            </h2>
        </div>
    </div>
    <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('usuario', 'deleteSelect') ?>" method="POST">
        <div class="row">
            <div class="col-xs-4-offset-4 nuevo">
                <a href="<?php echo routing::getInstance()->getUrlWeb('usuarioCredencial', 'insert') ?>" class="btn btn-success btn-xs">Nuevo</a>
                <a href="#" class="btn btn-danger btn-xs" onclick="borrarSeleccion()">Borrar</a>
            </div>
        </div>
        <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <th><input type="checkbox" id="chkAll"></th>
                    <th>Id</th>
                    <th>Usuario</th>
                    <th>Credencial</th>
                    <th> Acciones </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($objUsuarioCredencial as $key): ?>
                    <tr>
                        <td><input type="checkbox" name="chk[]" value="<?php echo $usuario->$id ?>"></td>
                        <td><?php echo $key->$id ?></td>
                        <td><?php echo $key->$user ?></td>
                        <td><?php echo $key->$credencial ?></td>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm disabled">Ver</a>
                            <a href="<?php echo routing::getInstance()->getUrlWeb('usuario', 'edit', array(usuarioTableClass::ID => $usuario->$id)) ?>" class="btn btn-info  btn-sm"><?php echo i18n::__('modify', NULL, 'user') ?></a>
                            <a href="#" onclick="confirmarEliminar(<?php echo $usuario->$id ?>)" class="btn btn-danger btn-sm">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </form>
    <form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('usuario', 'delete') ?>" method="POST">
        <input type="hidden" id="idDelete" name="<?php echo usuarioTableClass::getNameField(usuarioTableClass::ID, true) ?>">
    </form>
</div>
