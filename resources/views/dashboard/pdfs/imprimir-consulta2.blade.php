<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Paciente - {{ $consulta[0]->paciente->nombre }} </title>
</head>
<body>
    <header style="padding: 0;">
        <div style="width:100%;">
            <div style="width:77%; float: left; font-size: 12px;">
                <br><br>
                <table>
                    <tr>
                        <td><img src="{{ asset($configuracion->) }}"></td>
                        <td>{{ $consulta[0]->paciente->afilicacion === "" ? "N/A" : $consulta[0]->paciente->afiliacion }}</td>
                    </tr>
                    <tr>
                        <td><b>Nombre:</b></td>
                        <td>{{ $consulta[0]->paciente->nombre }}</td>
                    </tr>
                    <tr>
                        <td><b>Edad:</b></td>
                        <td>{{ $extra["edad"] }}</td>
                    </tr>
                    <tr>
                        <td><b>Sexo:</b></td>
                        <td>{{ $consulta[0]->paciente->sexo === "M" ? "Masculino" : "Femenino" }}</td>
                    </tr>
                    <tr>
                        <td><b>Estado:</b></td>
                        <td>{{ $extra["estado"]->nombre }}</td>
                    </tr>
                    <tr>
                        <td><b>Ciudad:</b></td>
                        <td>{{ $extra["ciudad"]->nombre }}</td>
                    </tr>
                </table>
            </div>
            <div style="width:23%; float: right; font-size:11px;">
                <table>
                    <tr>
                        <td style="font-size: 14px important!"><b>Nº Consulta:</b></td>
                        <td style="font-size: 14px important!"">{{ str_pad($consulta[0]->id, 10, "0", STR_PAD_LEFT) }}</td>
                    </tr>
                    <tr>
                        <td><b>Fecha:</b></td>
                        <td>{{ $extra["fecha"]  }}</td>
                    </tr>
                    <tr>
                        <td><b>Hora:</b></td>
                        <td>{{ $extra["hora"]  }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div style="clear: both;"></div>
    </header>
    <div style="width:100%; text-align: center; font-size: 20px; font-weigth: bold; margin-top: 30px; margin-bottom: 30px;">
        Registro de Consulta
    </div>
    <div style="width:65%; float: left; padding: 0px; margin-top: 20px;">
        <div style="width:100%; padding: 0px;">
            <br><span><b>Motivo de consulta</b></span><br>
            <p style="width:100%; height:80px; min-height: 80px; padding: 2px; background-color: rgb(235, 231, 231); text-align: justify;">
                {{ trim($consulta[0]->motivo) }}
            </p>
        </div>
        <table style="width:100%; margin-top: 10px; !important">
            <tr>
                <td><b>Peso (Kg)</b></td>
                <td><b>Talla (mts)</b></td>
                <td><b>IMC</b></td>
                <td><b>Temperatura</b></td>
            </tr>
            <tr>
                <td style="background-color: rgb(235, 231, 231)">{{ $consulta[0]->peso === NULL ? "N/A" : $consulta[0]->peso }}</td>
                <td style="background-color: rgb(235, 231, 231)">{{ $consulta[0]->talla === NULL ? "N/A" : $consulta[0]->talla }}</td>
                <td style="background-color: rgb(235, 231, 231)">{{ $consulta[0]->imc === NULL ? "N/A" :  $consulta[0]->imc }}</td>
                <td style="background-color: rgb(235, 231, 231)">{{ $consulta[0]->temperatura === NULL ? "N/A" : $consulta[0]->temperatura }}</td>
            </tr>
            <tr>
                <td><b>P. Sistole</b></td>
                <td><b>P. Diastole</b></td>
                <td><b>F. Cardiaca</b></td>
                <td><b>F. Respiratoria</b></td>
            </tr>
            <tr>
                <td style="background-color: rgb(235, 231, 231)">{{ $consulta[0]->arterial_sistole === NULL ? "N/A" : $consulta[0]->arterial_sistole }}</td>
                <td style="background-color: rgb(235, 231, 231)">{{ $consulta[0]->arterial_diastole === NULL ? "N/A" : $consulta[0]->arterial_diastole }}</td>
                <td style="background-color: rgb(235, 231, 231)">{{ $consulta[0]->arterial_frecuencia === NULL ? "N/A" : $consulta[0]->arterial_frecuencia }}</td>
                <td style="background-color: rgb(235, 231, 231)">{{ $consulta[0]->frecuencia_respiratoria === NULL ? "N/A" : $consulta[0]->frecuencia_respiratoria }}</td>
            </tr>
            <tr>
                <td colspan="2"><b>C. Abdominal(cm)</b></td>
                <td colspan="2"><b>Pronostico ligado a evoluci&oacute;n</b></td>
            </tr>
            <tr>
                <td colspan="2" style="background-color: rgb(235, 231, 231)">{{ $consulta[0]->circunferencia_abdominal === NULL ? "N/A" : $consulta[0]->circunferencia_abdominal }}</td>
                <td colspan="2" style="background-color: rgb(235, 231, 231)">{{ $consulta[0]->pronostivo_ligado_evolucion === 1 ? "Sí" : "No" }}</td>
            </tr>
        </table>
        <div style="width:100%;">
            <span><b>An&aacute;lisis, Plan de estudios y tratamiento</b></span><br>
            <p style="width:100%; height:80px; min-height: 80px; padding: 2px; background-color: rgb(235, 231, 231); text-align: justify">
                {{ $consulta[0]->tratamiento === NULL ? "N/A" : trim($consulta[0]->tratamiento) }}
            </p>
        </div>
    </div>
    <div style="width:30%; float: right; padding: 2px; margin-top: 20px;">
        <span><b>Referido a:</b></span><br><br>
        @if ($consulta[0]->receta)
        <input type="checkbox" checked> Receta
        @else
        <input type="checkbox"> Receta
        @endif
        <br>
        @if ($consulta[0]->controlados)
        <input type="checkbox" checked> Controlados
        @else
        <input type="checkbox"> Controlados    
        @endif
        <br>
        @if ($consulta[0]->laboratorios)
        <input type="checkbox" checked> Laboratorios
        @else
        <input type="checkbox"> Laboratorios    
        @endif
        <br>
        @if ($consulta[0]->rayosx)
        <input type="checkbox" checked> Gabinete Rayos X
        @else
        <input type="checkbox"> Gabinete Rayos X    
        @endif
        <br>
        @if ($consulta[0]->interconsulta)
        <input type="checkbox" checked> Referencia / Interconsulta
        @else
        <input type="checkbox"> Referencia / Interconsulta
        @endif
        <br>
        @if ($consulta[0]->indicaciones)
        <input type="checkbox" checked> Indicaciones
        @else
        <input type="checkbox"> Indicaciones
        @endif
        <br>
        @if ($consulta[0]->electrocardiograma)
        <input type="checkbox" checked> Electrocardiograma
        @else
        <input type="checkbox"> Electrocardiograma    
        @endif
        <br>
        @if ($consulta[0]->incapacidad)
        <input type="checkbox" checked> Incapacidad
        @else
        <input type="checkbox"> Incapacidad    
        @endif
        <br>
        @if ($consulta[0]->constancia_asistencia)
        <input type="checkbox" checked> Constancia Asistencia
        @else
        <input type="checkbox"> Constancia Asistencia    
        @endif
        <br>
        @if ($consulta[0]->cuidados_maternos)
        <input type="checkbox" checked> Cuidados Maternos
        @else
        <input type="checkbox"> Cuidados Maternos    
        @endif
        <br>
        @if ($consulta[0]->citologia_cerv_vaginal)
        <input type="checkbox" checked> Citolog&iacute;a Cerv. Vaginal
        @else
        <input type="checkbox"> Citolog&iacute;a Cerv. Vaginal    
        @endif
        <br>
        @if ($consulta[0]->preparados)
        <input type="checkbox" checked> Preparados
        @else
        <input type="checkbox"> Preparados
        @endif
        <br>
        @if ($consulta[0]->estudios_especiales)
        <input type="checkbox" checked> Estudios Especiales
        @else
        <input type="checkbox"> Estudios Especiales
        @endif
        <br>
        @if ($consulta[0]->estudios_audiologicos)
        <input type="checkbox" checked> Estudios Audiolog&iacute;cos
        @else
        <input type="checkbox"> Estudios Audiolog&iacute;cos
        @endif
        <br>
        @if ($consulta[0]->sugerir_cirugia)
        <input type="checkbox" checked> Sugerir cirugia
        @else
        <input type="checkbox"> Sugerir cirugia
        @endif
        <br>
        @if ($consulta[0]->proc_urologia)
        <input type="checkbox" checked> Proc. Urolog&iacute;a
        @else
        <input type="checkbox"> Proc. Urolog&iacute;a
        @endif
        <br>
        @if ($consulta[0]->proc_hematologia)
        <input type="checkbox" checked> Proc. Hematolog&iacute;a
        @else
        <input type="checkbox"> Proc. Hematolog&iacute;a
        @endif
        <br>
        @if ($consulta[0]->valoracion_preanestecia)
        <input type="checkbox" checked> Valoraci&oacute;n Preanestecia
        @else
        <input type="checkbox"> Valoraci&oacute;n Preanestecia
        @endif
        <br>
        @if ($consulta[0]->contrareferencia)
        <input type="checkbox" checked> Contrareferencia
        @else
        <input type="checkbox"> Contrareferencia
        @endif
    </div>
    <br>
</body>
</html>