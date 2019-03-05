<?php
/**
 * Roles
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
class Rol
{
    /**
     * Permisos para el rol
     */ 
    protected $permisos;
    
    /**
     * Constructor de la clase
     */ 
     protected function __construct() 
     {
         $this->permisos = array();
     }
    
    /**
     * Obteniendo permisos para un rol
     * 
     * @param int $id_rolsistema El id del rol del sistema
     * 
     * @return array permisos
     */ 
    public static function getRolPermisos($id_rolsistema)
    {            
        // Consultando los datos
        $rol = new LSRol();
        $db = LSPrincipal::getDBO();
        $query = $db->getQuery();
        $query->select('p.tx_descripcion AS permiso_desc ');
        $query->from('&&__rolsistema_permiso AS rp');
        $query->join('', 'ls_permiso AS p ON rp.id_permiso = p.id');
        $query->where('rp.id_rolsistema = "'.$id_rolsistema.'"');
        
        if (!$resultSQL = $db->setQuery($query)) {
            return null;
        } else {
            while ($row = $resultSQL->fetch_assoc()) {
                $rol->permisos[$row['permiso_desc']] = true;
            }
        } 
    
        return $rol;
    }
    
    /*
     * Verifica si un permiso esta establecido
     * 
     * @param int $permiso El permiso a verificar
     * 
     * @return true o false
     */ 
    public function verificarPermiso($permiso) {
        return isset($this->permisos[$permiso]);
    }
}
