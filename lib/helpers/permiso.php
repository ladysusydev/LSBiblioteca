<?php
/**
 * Cargas
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
class LSCargas
{
    /**
     * El archivo que se importa
     * 
     * @var array
     */
    protected static $archivoImportado = array();
    
    /**
     * Imrporta archivos
     * 
     * @param string $ruta, contiene la ruta del archivo a incluir
     * 
     * @return
     */
    public static function importar($ruta)
    {
        // Verificando si la ruta esta importada ya.
        if (!isset(self::$archivoImportado[$ruta])) {
            // Configurar algunas variables.
            $exito  = false;
            $base = dirname(__FILE__);
            $path = str_replace('.', DIRECTORY_SEPARATOR, $ruta);
                
            // Si existe el archivo a incluir
            if (is_file($base . '/' . $path . '.php')) {
                $exito = (bool) include_once $base . '/' . $path . '.php';
            }
            self::$archivoImportado[$ruta] = $exito;
        }

        return self::$archivoImportado[$ruta];
    }
    
    
    /**
     * Iniciando el cargador automatico
     */ 
     public static function init() 
     {
         spl_autoload_register(array('LSCargas', 'cargas'));
     }
    
    /**
     * Este metodo me permite cargar todos los archivos
     * ubicados en lib/cms
     * 
     * @param  string $class Que sera lo que vamos a cargar
     * 
     * @return  void
     */
     private static function cargas($class)
     {
        if (class_exists($class, false)) {
            return true;
        }

        // Separando LS del nombre del archivo
        $class = substr($class, 5);
        $rutaCargas = LS_LIBRERIAS.'/cms';
        $ruta = $rutaCargas . '/' . strtolower($class) . '.php';

        // Incluimos el archivo, verificando que exista
        if (file_exists($ruta)) {
            return include $ruta;
        }
     }
}
 
 /**
 * Importando librerias necesaris cuando sean requeridas
 * 
 * @param   string  $ruta, que sera lo que vamos a importar
 * 
 * @return  boolean  True en caso de exito
 */
function lsimportar($ruta)
{
    return LSCargas::importar($ruta);
}
