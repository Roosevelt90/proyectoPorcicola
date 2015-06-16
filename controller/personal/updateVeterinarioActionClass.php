<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as log;

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class updateVeterinarioActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $id = request::getInstance()->getPost(veterinarioTableClass::getNameField(proveedorTableClass::ID, true));

                $numero_documento = request::getInstance()->getPost(veterinarioTableClass::getNameField(proveedorTableClass::NUMERO_DOC, true));
                $nombre_completo = request::getInstance()->getPost(veterinarioTableClass::getNameField(proveedorTableClass::NOMBRE, true));
                $tipo_doc = request::getInstance()->getPost(veterinarioTableClass::getNameField(proveedorTableClass::TIPO_DOC, true));
                $direccion = request::getInstance()->getPost(veterinarioTableClass::getNameField(proveedorTableClass::DIRECCION, true));
                $ciudad = request::getInstance()->getPost(veterinarioTableClass::getNameField(proveedorTableClass::CIUDAD, true));
                $telefono = request::getInstance()->getPost(veterinarioTableClass::getNameField(proveedorTableClass::TEL, true));

                veterinarioTableClass::validateEdit($nombre_completo, $direccion, $telefono, $numero_documento);

                $ids = array(
                    veterinarioTableClass::ID => $id
                );

                $data = array(
                    veterinarioTableClass::NUMERO_DOC => $numero_documento,
                    veterinarioTableClass::NOMBRE => $nombre_completo,
                    veterinarioTableClass::TIPO_DOC => $tipo_doc,
                    veterinarioTableClass::DIRECCION => $direccion,
                    veterinarioTableClass::TEL => $telefono,
                    veterinarioTableClass::CIUDAD => $ciudad
                );
                veterinarioTableClass::update($ids, $data);
                 log::register('update', veterinarioTableClass::getNameTable());
           
            }
            routing::getInstance()->redirect('personal', 'indexVeterinario');
  } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
