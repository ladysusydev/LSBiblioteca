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
class Etiquetas {
$xmlstr = <<<XML
<?xml version='1.0' standalone='yes'?>
<lsra>
    <tablas>
        <roles>
            <enc>
                <titulo>DTR_TITULO</titulo>
                <boton_nuevo>DTR_BOTON_NUEVO</boton_nuevo>
            </enc>
            <id>DTR_ID</id>
            <nombre>DTR_NOMBRE</nombre>
            <descripcion>DTR_DESCRIPCION</descripcion>
            <opciones>DTR_OPCIONES</opciones>
       </roles>
       <permisos>
            <enc>
                <titulo>DTP_TITULO</titulo>
                <boton_nuevo>DTP_BOTON_NUEVO</boton_nuevo>
            </enc>
            <id>DTP_ID</id>
            <descripcion>DTP_DESCRIPCION</descripcion>
            <categoria>DTP_CATEGORIA</categoria>
            <opciones>DTP_OPCIONES</opciones>
       </permisos>
       <mensajes>
            <enc>
                <titulo>DTLM_TITULO</titulo>
                <boton_vaciar>DTLM_BOTON_VACIAR</boton_vaciar>
            </enc>
            <id>DTLM_ID</id>
            <persona>DTLM_PERSONA</persona>
            <acceso>DTLM_ACCESO</acceso>
            <accion>DTLM_ACCION</accion>
            <descripcion>DTLM_DESCRIPCION</descripcion>
            <ip>DTLM_IP</ip>
            <equipo>DTLM_EQUIPO</equipo>
            <navegador>DTLM_NAVEGADOR</navegador>
            <so>DTLM_SO</so>
            <opciones>DTLM_OPCIONES</opciones>
       </mensajes>
    </tablas>
    <dashboard>
        <enc>
            <titulo_pri>DTM_TITULO_PRI</titulo_pri>
            <titulo_sec icon="fa-fw fa-dashboard" colorIcon="FFC107">DTM_TITULO_SEC</titulo_sec>
            <estados>DTM_ESTADOS</estados>
            <estados_todos>DTM_ESTADOS_TODOS</estados_todos>
        </enc>
        <menu>
            <componentes>
                <titulo id="collapseComponents" icon="fa-cubes" colorIcon="006df0">DTM_COMPONENTES</titulo>
                <items>
                    <item link="index1.php">DTM_PERSONAS</item>
                    <item link="index2.php">DTM_CURSOS</item>
                    <item link="index3.php">DTM_NOTAS</item>
                </items>
            </componentes>
            <sistema>
                <titulo id="collapseExamplePages" icon="fa-cog" colorIcon="006df0">DTM_SISTEMA</titulo>
                <items>
                    <item>DTM_USUARIOS</item>
                    <item>DTM_ROLES</item>
                    <item>DTM_PERMISOS</item>
                    <item>DTM_MENSAJES</item>
                </items>
            </sistema>
            <graficos>
                <titulo id="collapseMulti" icon="fa-pie-chart" colorIcon="006df0">DTM_GRAFICOS</titulo>
                <items>
                    <item link="index8.php">DTM_GPERSONAS</item>
                    <item link="index9.php">DTM_GCURSOS</item>
                </items>    
            </graficos>
        </menu>
    </dashboard>
</lsra>
XML;
