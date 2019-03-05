<?php
/**
 * LSCorePHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2018, LadySusy
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package		LSCorePHP
 * @author		LadySusy Dev
 * @copyright	Copyright (c) 2018, LadySusy (http://www.ladysusy.org/)
 * @license		http://opensource.org/licenses/MIT	MIT License
 */
 
// Evitar acceso directo
defined('_LS') or die;

/**
 * SGC clase para utilitarios
 */
class Utils
{
   /**
    * Me permite eliminar un array
    * 
    * @param  $array
    * @param  $deleteItkey
    * @param  $useOldKeys
    * 
    * @return boolean True En caso de exito
    */
   public static function elimArray(&$array, $deleteItKey, $useOldKeys = FALSE)
   {
      if($deleteItKey === FALSE) return FALSE;
      unset($array[$deleteItKey]);
         
      return TRUE;
   }
   
    /**
     * Me permite redimencionar una imagen
     *
     * @param string $ruta1 Ruta de la imagen a redimencionar
     * @param string $ruta2 Nueva ruta de la imagen
     * @param int $ancho    Nuevo ancho
     * @param int $alto        Nuevo alto
     *
     * @return boolean true en caso de exito
     */
    public static function redImagen($ruta1, $ruta2, $ancho, $alto)
    {
        // Obteniendo foto redimencionada
        $image = new Imagick($ruta1);
        $image->cropThumbnailImage($ancho, $alto);
        $image->writeImage($ruta2);
        return true;
    }
    
    /**
     * Me permite obtener la imagen del usuario
     * 
     * @param string $imageBase Descripción de imagen
     * 
     * @return string nombre de imagen
     */
     public static function getImageUser($imageBase, $thumb = false, $ancho = '', $alto ='')
     {
        // Ruta base para fotos de usuarios
        $ruta = LS_IMAGENES.'/fotos/';
        
        if ($imageBase == null) {
            $foto = 'usuario_nofoto.png';
        } else {
            $foto = $imageBase;
            if (!file_exists($ruta.$foto)) {
                $foto = 'usuario_nofoto.png';
            }
        }
        
        // Verificamos si existe y su miniatura
        if ($thumb == true) {
            if ($ancho != '' && $alto != '') {
                $imagenFinal = $ruta.strstr($foto, '.', true).'_'.$ancho.'x'.$alto.'.png';
                $imagenInicial = $ruta.$foto;
                Utils::redImagen($imagenInicial, $imagenFinal, $ancho, $alto);
            } else {
                $imagenFinal = $ruta.strstr($foto, '.', true).'_24x24.png';
                if (!file_exists($imagenFinal)) {
                    $ancho=48;
                    $alto=48;
                    $imagenInicial = $ruta.$foto;
                    Utils::redImagen($imagenInicial, $imagenFinal, $ancho, $alto);
                }
            }
            $imagenFinal = strstr($imagenFinal, 'imagenes');
        } else {
            $imagenFinal = strstr($ruta.$foto, 'imagenes');
        }
 
        return $imagenFinal;
    }
    
    /**
      * Me permite obtener todos los elementos de un formulario
      * 
      * @param array $keys   Valores a obtener
      * @param string $exclede   Valor a excluir
      * 
      * @return array con los valores de los elementos
      */ 
    public static function datosPost($keys, $exclude = null)
    {
      $array = array();
      // Un ciclo con la información
      foreach ($_POST as $key=>$val)
      {
         if (is_array($keys))
         {
            if (in_array($key, $keys)) $array[$key] = $val;
         } elseif($keys==="TODOS") {
            if (isset($exclude))
            {
               if(is_array($exclude))
               {
                  if (!in_array($key,$exclude)) $array[$key] = $val;
               } else {
                  if ($key!=$exclude) $array[$key] = $val;
               }
         
            } else {
               $array[$key] = $val;
            }
      
         } else 
       
         return $_POST[$keys];
      }
      return $array;
   }
   
   /**
    * Lista de navegación del sistema
    * 
    * @param int $nivel Nivel en el que nos encontramos
    * 
    * @return string Contenido a mostrar
    */
    public static function listNav($nivel = null, $ida = null, $idm = null)
    {
        ob_start();
        ?>
        <ul class="list-inline">
            <li class="list-inline-item fa fa-users fa-lg" style="color:#880E4F;" aria-hidden="true"></li><a href="index.php?ladysusycom=com_usuarios&vista=usuarios">Gestión de Usuarios</a>
            <li class="list-inline-item"></li>
            <li class="list-inline-item"></li>
            <li class="list-inline-item fa fa-cubes fa-lg" style="color:#455A64;" aria-hidden="true"></li><a href="index.php?ladysusycom=com_areas&vista=areas">Gestión de Areas</a>
            <?php
            if ($nivel == 1) {
                ?>
                 <i class="fa fa-caret-right fa-lg" style="color:#455A64;" aria-hidden="true"></i> <li class="list-inline-item fa fa-gears fa-lg" style="color:#455A64;" aria-hidden="true"></li> Gestión de Macroactividades
                <?php
            } elseif ($nivel == 2) {
                ?>
                <i class="fa fa-caret-right fa-lg" style="color:#455A64;" aria-hidden="true"></i> <li class="list-inline-item fa fa-gears fa-lg" style="color:#455A64;" aria-hidden="true"></li><a href="index.php?ladysusycom=com_areas&vista=macroactividades&ida=<?php echo $ida; ?>">Gestión de Macroactividades</a>
                <i class="fa fa-caret-right fa-lg" style="color:#455A64;" aria-hidden="true"></i> <li class="list-inline-item fa fa-list fa-lg" style="color:#455A64;" aria-hidden="true"></li> Gestión de Actividades
                <?php
            } elseif ($nivel == 3) {
                ?>
                <i class="fa fa-caret-right fa-lg" style="color:#455A64;" aria-hidden="true"></i> <li class="list-inline-item fa fa-gears fa-lg" style="color:#455A64;" aria-hidden="true"></li><a href="index.php?ladysusycom=com_areas&vista=macroactividades&ida=<?php echo $ida; ?>">Gestión de Macroactividades</a>
                <i class="fa fa-caret-right fa-lg" style="color:#455A64;" aria-hidden="true"></i> <li class="list-inline-item fa fa-list fa-lg" style="color:#455A64;" aria-hidden="true"></li><a href="index.php?ladysusycom=com_areas&vista=actividades&ida=<?php echo $ida; ?>&idm=<?php echo $idm; ?>">Gestión de Actividades</a>
                <i class="fa fa-caret-right fa-lg" style="color:#455A64;" aria-hidden="true"></i> <li class="list-inline-item fa fa-tasks fa-lg" style="color:#455A64;" aria-hidden="true"></li> Gestión de Tareas
                <?php
            }
            ?>
        </ul>
        <?php
        $contenido = ob_get_contents();
        ob_end_clean();
        
        return $contenido;  
    }
    
    /**
     * Codigo disponibles en generación de errores
     */ 
    public static function listHTTPstatusCodes($codigo) 
    {
        $code = array(
        100 => 'Continue',
        101 => 'Switching Protocols',
        102 => 'Processing', // WebDAV; RFC 2518
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information', // since HTTP/1.1
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        207 => 'Multi-Status', // WebDAV; RFC 4918
        208 => 'Already Reported', // WebDAV; RFC 5842
        226 => 'IM Used', // RFC 3229
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other', // since HTTP/1.1
        304 => 'Not Modified',
        305 => 'Use Proxy', // since HTTP/1.1
        306 => 'Switch Proxy',
        307 => 'Temporary Redirect', // since HTTP/1.1
        308 => 'Permanent Redirect', // approved as experimental RFC
        400 => 'Bad Request - Usuario o password no permitido',
        401 => 'Unauthorized - No esta autorizado para ingresar al sistema',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',
        418 => 'I\'m a teapot', // RFC 2324
        419 => 'Authentication Timeout', // not in RFC 2616
        420 => 'Enhance Your Calm', // Twitter
        420 => 'Method Failure', // Spring Framework
        422 => 'Unprocessable Entity', // WebDAV; RFC 4918
        423 => 'Locked', // WebDAV; RFC 4918
        424 => 'Failed Dependency', // WebDAV; RFC 4918
        424 => 'Method Failure', // WebDAV)
        425 => 'Unordered Collection', // Internet draft
        426 => 'Upgrade Required', // RFC 2817
        428 => 'Precondition Required', // RFC 6585
        429 => 'Too Many Requests', // RFC 6585
        431 => 'Request Header Fields Too Large', // RFC 6585
        444 => 'No Response', // Nginx
        449 => 'Retry With', // Microsoft
        450 => 'Blocked by Windows Parental Controls', // Microsoft
        451 => 'Redirect', // Microsoft
        451 => 'Unavailable For Legal Reasons', // Internet draft
        494 => 'Request Header Too Large', // Nginx
        495 => 'Cert Error', // Nginx
        496 => 'No Cert', // Nginx
        497 => 'HTTP to HTTPS', // Nginx
        499 => 'Client Closed Request', // Nginx
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
        506 => 'Variant Also Negotiates', // RFC 2295
        507 => 'Insufficient Storage', // WebDAV; RFC 4918
        508 => 'Loop Detected', // WebDAV; RFC 5842
        509 => 'Bandwidth Limit Exceeded', // Apache bw/limited extension
        510 => 'Not Extended', // RFC 2774
        511 => 'Network Authentication Required', // RFC 6585
        598 => 'Network read timeout error', // Unknown
        599 => 'Network connect timeout error', // Unknown
        );
        return $code[$codigo];
    }
    
    /**
     * Función que me permite obtener valores de auditoria
     * 
     * @param int $id Id del usuario
     * 
     * @return array
    */ 
    public static function getAudit($id_users, $accion, $descripcion)
    {
        $navegador = array("IE", "OPERA", "NETSCAPE", "FIREFOX", "SAFARI", "CHROME");
        $os = array("WIN", "MAC", "LINUX");

        // Datos principales
        $auditoria['access'] = Date("Y-m-d H:i:s");
        $auditoria['action'] = $accion;
        $auditoria['description'] = $descripcion;
        $auditoria['ip'] = $_SERVER['REMOTE_ADDR'];
        $auditoria['pc'] = gethostname();

        // Definiendo el navegador
        foreach ($navegador as $parent) {
            $s = strpos(strtoupper($_SERVER['HTTP_USER_AGENT']), $parent);
            if ($s) {
                $auditoria['browser'] = $parent;
            }
        }

        // Obtenemos el sistema operativo
        foreach($os as $val) {
            if (strpos(strtoupper($_SERVER['HTTP_USER_AGENT']), $val) !== false) {
                $auditoria['so'] = $val;
            }
        }
        $auditoria['state'] = 'A';
        $auditoria['id_users'] = $id_users;
        
    return $auditoria;
    }
}
