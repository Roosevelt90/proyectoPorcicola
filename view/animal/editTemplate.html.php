<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php
use mvc\view\viewClass as view ?>
<main class="mdl-layout__content mdl-color--grey-100">
  <div class="mdl-grid demo-content">
    <div class="container">
      <div class="row">
        <div class="col-xs-4-offset-4 text-center">

          <h2><?php echo i18n::__('edit', NULL, 'animal') ?> </h2>
        </div>
      </div>
    </div>
<?php view::includeHandlerMessage() ?>
<?php view::includePartial('animal/formAnimal', array('objAnimal' => $objAnimal, 'objGenero' => $objGenero, 'objRaza' => $objRaza, 'objLote' => $objLote)) ?>

