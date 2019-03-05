<?php
/**
 * PrivilegioUsuarios
 * 
 * @author      ATE/José Roberto Alas <ladysusydev@gmail.org>
 * @copyright   Copyright (C) 2016, LadySusy/LS
 * @licencia    http://www.ladysusy.org/licencias/ladysusy-licencia.php
 */
 
// Evitar acceso directo
defined('_LS') or die;

/**
 * clase LSCargas
 */ 
class Privilegio
{   
    /*
     * var $roles Roles del usuario
     */ 
    private $roles;
    
    private $id_usuario;
    /*
     * Consultando si el usuario tiene permisos
     * 
     * @param int $id El id del usuario
     * 
     * @return object LSPrivilegioUsuario
     */ 
    public static function getAutorizacion($id) {

            $privUser = new LSPrivilegio();
            $privUser->id_usuario = $id;
            $privUser->initRoles();
            
            return $privUser;
    }
    
    /*
     * Inicializando los roles del usuario
     * 
     * @param int $id_persona El id de la persona
     * 
     * @return void 
     */ 
    protected function initRoles() {
        
         // Consultando los datos
        $this->roles = array();
        $db = LSPrincipal::getDBO();
        $query = $db->getQuery();
        $query->select('s.id_rolsistema AS id_rol, rs.tx_descripcion AS rol_nombre');
        $query->from('&&__seguridad AS s');
        $query->join('', 'ls_rolsistema AS rs ON s.id_rolsistema = rs.id');
        $query->where('s.id_persona = "'.$this->id_usuario.'"');
        
        if (!$resultSQL = $db->setQuery($query)) {
            return null;
        } else {
            while ($row = $resultSQL->fetch_assoc()) {
                $this->roles[$row['rol_nombre']] = LSRol::getRolPermisos($row['id_rol']);
            }
        }
    }
        
    /*
     * Verificando si un usuario tiene acceso
     * 
     * @param string $permiso Permiso solicitado
     * 
     * @return true o false
    */ 
    public function verificarAcceso($permiso) {
        foreach ($this->roles as $rol) {
            if ($rol->verificarPermiso($permiso)) {
                return true;
            }
        }
            
        return false;
    } 
}
