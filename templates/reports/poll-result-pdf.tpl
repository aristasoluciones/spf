<html>
    <head>
        <title>Reporte</title>
        <style type="text/css">
            body {
                font-family: helvetica, Sans-Serif;
                font-size: 12px;
                line-height: 1;
            }
            #page-wrap {
                width: 700px;
                margin: 0 auto;
                page-break-inside: avoid;
            }
            table {
                font-size: 12px;
                line-height: 20px;
                padding-bottom: 15px;
            }
            table.outline-table {
                border: 2px solid #ccc;
                border-spacing: 0;
            }
            tr.border-bottom td, td.border-bottom {
                border-bottom: 1px solid #ccc;
            }
            tr.border-top td, td.border-top {
                border-top: 1px solid #ccc;
            }
            tr.border-right td, td.border-right {
                border-right: 1px solid #ccc;
            }
            tr.border-left td, td.border-left {
                border-left: 1px solid #ccc;
            }
            tr.border-right td:last-child {
                border-right: 0px;
            }
            tr.center td, td.center {
                text-align: center;
                vertical-align: text-top;
            }
            td.pad-left {
                padding-left: 5px;
            }
            tr.right-center td, td.right-center {
                text-align: right;
                padding-right: 50px;
            }
            tr.right td, td.right {
                text-align: right;
            }
            .encuBreak{
                page-break-inside: avoid;
            }
            .mayuscula{
                text-transform: uppercase;
            }
        </style>
    </head>
    <body>
    <div class="page-wrap">
        <table width="100%">
            <tbody>
            <tr>
                <td rowspan="2" width="30%" valign="middle" style="text-align: center">
                    <img src={$logo}" width="130px">
                </td>
                <td width="70%" valign="top">
                    <div style="text-transform: uppercase;font-weight: bold;text-align: center">
                        <p>Fiscalia General del Estado de Chiapas</p>
                        <p>Guia para la identificacion de riesgo de violencia feminicida</p>
                    </div>

                </td>
            </tr>
            </tbody>
        </table>
        <table width="100%">
            <tr class="border-bottom">
                <td width="10%" class="mayuscula"><b>Nombre completo</b></td>
                <td width="35%" class="mayuscula">{$info.nombre} {$info.apaterno} {$amaterno}</td>
                <td width="10%" class="mayuscula"><b>Edad</b></td>
                <td class="mayuscula">{$info.edad}</td>
            </tr>
            <tr class="border-bottom">
                <td width="35%" class="mayuscula"><b>Municipio</b></td>
                <td width="35%" class="mayuscula">{$info.municipio}</td>
                <td width="10%" class="mayuscula"><b>Zona</b></td>
                <td class="mayuscula">{$info.tipo}</td>
            </tr>
            <tr class="border-bottom">
                <td  class="mayuscula"><b>Diagnostico</b></td>
                <td  style="text-align: left" class="mayuscula">Violencia {$resultGeneral}</td>
                <td class="mayuscula"><b>% de violencia</b></td>
                <td class="mayuscula">{$porcentajeGeneral} %</td>
            </tr>
            <tr class="border-bottom">
                <td  class="mayuscula"><b>Tiempo de relacion con su pareja</b></td>
                <td  style="text-align: left" class="mayuscula">{$info.timeRelacion}</td>
                <td class="mayuscula"><b>Numero de hijos</b></td>
                <td class="mayuscula">{$info.numHijo}</td>
            </tr>
        </table>
        {foreach from=$encuestas item=encu key=kenc}
            <table width="100%" class="encuBreak" >
                {if $encu.tipo neq "Todos"}
                    <tr class="border-bottom">
                        <td class="mayuscula"><b>Encuesta</b></td>
                        <td class="mayuscula">{$encu.nombre}</td>
                    </tr>
                    <tr class="border-bottom">
                        <td class="mayuscula"><b>Resultado encuesta</b></td>
                        <td class="mayuscula">{$encu.resultado}</td>
                    </tr>
                {else}
                    <tr>
                        <td colspan="2" class="mayuscula"><b>{$encu.nombre}</b></td>
                    </tr>
                {/if}
                <tbody>
                {foreach from=$encu.preguntas item=item key=key}
                    <tr><td colspan="2">{$key+1}.- {$item.pregunta}</td></tr>
                    <tr><td colspan="2">
                            {foreach from=$item.opciones item=item2 key=key}
                                {if $item.currentAnswer eq $item2}
                                <div class="md-radio">
                                    <input type="radio" name="question_{$item.preguntaId}" id="question_{$item.preguntaId}_{$key}" value='{$item2}' class="md-radiobtn" {if $item.currentAnswer eq $item2}checked{/if}>
                                    <label for="question_{$item.preguntaId}_{$key}">
                                        <span class="inc"></span>
                                        <span class="check"></span>
                                        <span class="box"></span>
                                        {$item2|strtolower|ucfirst}
                                    </label>
                                </div>
                                {/if}
                            {/foreach}
                        </td>
                    </tr>
                {/foreach}
                </tbody>
            </table>
        {/foreach}
        <table>
            <tr>
                <td colspan="2">
                    <br>
                    <img src={$chart}" width="650px">
                </td>
            </tr>
            <tr>
                <td  colspan="2" class="mayuscula">
                    <b>Observaciones:<b>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: justify">
                    {$info.comentarioAdicional}
                </td>
            </tr>

        </table>
    </div>

    </body>
</html>