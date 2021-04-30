var route = "dashboard";
var fechaInicial = moment().format('Y-MM-DD');
var fechaFinal = moment().format('Y-MM-DD'); 

$('#fecharango').daterangepicker({
    autoApply: true,
    autoUpdateInput: true,
    /*locale: {
        cancelLabel: 'Clear'
    },*/
    locale: {
        "format": "DD-MM-YYYY",
        "separator": " - ",
        "applyLabel": "Guardar",
        "cancelLabel": "Cancelar",
        "fromLabel": "Desde",
        "toLabel": "Hasta",
        "customRangeLabel": "Personalizar",
        "daysOfWeek": [
            "Do",
            "Lu",
            "Ma",
            "Mi",
            "Ju",
            "Vi",
            "Sa"
        ],
        "monthNames": [
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Setiembre",
            "Octubre",
            "Noviembre",
            "Diciembre"
        ],
        "firstDay": 1
    },
});

$('#fecharango').on('apply.daterangepicker', function(ev, picker) {
    fechaInicial = picker.startDate.format('YYYY-MM-DD');
    fechaFinal = picker.endDate.format('YYYY-MM-DD');

    // LIMPIAR CANVAS
    limpiarCanvas();
    
    // GRAFICAS DE PACIENTES
    graficarPacientes();

    // GRAFICAS DE CONSULTAS
    graficarConsultas();
    
});

limpiarCanvas = function(){
    
    if(window.barChartPacientesAI){
      window.barChartPacientesAI.clear();
      window.barChartPacientesAI.destroy();
    }

    if(window.donutChartPacientesEdad){
      window.donutChartPacientesEdad.clear();
      window.donutChartPacientesEdad.destroy();
    }

    if(window.pieChartPacientesSexo){
      window.pieChartPacientesSexo.clear();
      window.pieChartPacientesSexo.destroy();
    }

    if(window.lineChartConsultasResumen){
      window.lineChartConsultasResumen.clear();
      window.lineChartConsultasResumen.destroy();
    }
};

graficarPacientes = function(){
    Core.post(route+"/pacientes-graficas/"+fechaInicial+"/"+fechaFinal).then((res) => {
        // GENERAR GRAFICO DE BARRAS (PACIENTES -> ACTIVOS / INACTIVOS)
        var dataPacientesAI = {
            labels: ['Activos','Inactivos'],
            datasets: 
            [{
              label               : 'Pacientes',
              //backgroundColor     : ['rgba(60,141,188,0.9)', 'rgba(300,60,188,0.9)'],
              //borderColor         : ['rgba(60,141,110,0.8)', 'rgba(300,60,110,0.9)'],

              backgroundColor     : ['rgba(36, 227, 144,0.8)', 'rgba(247,104,58,0.8)'],
              borderColor         : ['rgba(36, 227, 144,0.8)', 'rgba(247,104,58,0.8)'],

              pointRadius          : false,
              pointColor          : '#3b8bba',
              pointStrokeColor    : 'rgba(60,141,188,1)',
              pointHighlightFill  : '#fff',
              pointHighlightStroke: 'rgba(60,141,188,1)',
              data                : [res.data.activos,res.data.inactivos]     
            }],
          };
        
          var optionsPacientesAI = {
            responsive              : true,
            maintainAspectRatio     : false,
            datasetFill             : false,
            scales: {
              yAxes: [{
                ticks: {
                  beginAtZero: true
                }
              }]
            },
          };
        
          var chartCanvasPacientesAI = $('#pacientes_ai').get(0).getContext('2d');
          var barChartDataPacientesAI = jQuery.extend(true, {}, dataPacientesAI);
        
          // CREAR INSTANCIA DE GRAFICO DE BARRAS
          window.barChartPacientesAI = new Chart(chartCanvasPacientesAI, {
            type: 'bar', 
            data: barChartDataPacientesAI,
            options: optionsPacientesAI
          });

          // GENERAR GRAFICO DE DONUS (PACIENTES POR EDAD -> NIÑOS / JOVENES / MAYORES)
          var dataPacientesEdad = {
            labels: ['Niños','Jovenes','Mayores'],
            datasets: [{
              data: [res.data.ninos,res.data.jovenes,res.data.mayores],
              backgroundColor : ['rgba(192,242,44, 0.8)', 'rgba(44,242,54,0.8)', 'rgba(44,242,196, 0.8)'],
            }]
          }
              
          var optionsPacientesEdad = {
            maintainAspectRatio : false,
            responsive : true,
          }

          var chartCanvasPacientesEdad = $('#pacientes_njm').get(0).getContext('2d');
          var doughnutChartDataPacientesEdad = jQuery.extend(true, {}, dataPacientesEdad);
          
          // CREAR INSTANCIA DE GRAFICO DE DONUS
          window.donutChartPacientesEdad = new Chart(chartCanvasPacientesEdad, {
            type: 'doughnut',
            data: doughnutChartDataPacientesEdad,
            options: optionsPacientesEdad      
          });  
          
          // GENERAR GRAFICO DE TORTA (PACIENTES POR SEXO (MASCULINO - FEMENINO))
          var dataPacientesSexo = {
            data: [res.data.masculino, res.data.femenino],
            backgroundColor: ['rgba(44,57,242,0.8)','rgba(242,44,179,0.8)',],
            borderColor: ['rgba(44,57,242,0.8)','rgba(242,44,179,0.8)',],
            borderWidth: 1,
          };

          var optionsPacientesSexo = {
            maintainAspectRatio : false,
            responsive : true,
          }

          var chartCanvasPacientesSexo = $('#pacientes_mf').get(0).getContext('2d');
          var pieChartDataPacientesSexo = jQuery.extend(true, {}, dataPacientesSexo);

          // CREAR INSTANCIA DE GRAFICO DE TORTA
          window.pieChartPacientesSexo = new Chart(chartCanvasPacientesSexo, {
            type: 'pie',
            data: {
              labels: ['Masculino', 'Femenino'],
              datasets: [
                pieChartDataPacientesSexo
              ]
            },
            options: optionsPacientesSexo
          });
    });
};

graficarConsultas = function(){
    Core.post(route+"/consultas-graficas/"+fechaInicial+"/"+fechaFinal).then((res) => {
      // GENERAR GRAFICO DE LINEAS (CONSULTAS RESUMEN)
      var fechas = [];
      var cantidades = [];
      var faux;

      fechas.push("");
      cantidades.push(0);

      res.data.consultas_fecha.forEach(function(value, index){
        faux = value.fecha.split("-");
        fechas.push(faux[2]+"-"+faux[1]+"-"+faux[0]);
        cantidades.push(value.cantidad);
      });

      var dataConsultasResumen = {
        label: "Registro de Consultas",
        data: cantidades,
        backgroundColor: 'rgba(54, 162, 235, 0.2)', 
        borderColor: 'rgba(54, 162, 235, 1)', 
        borderWidth: 1,
      };

      var optionsConsultasResumen = {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }],
          xAxes:[{
            ticks: {
              beginAtZero: true
            }
          }]
        },
        responsive: true,
      };

      var chartCanvasConsultasResumen = $('#consultas_fecha').get(0).getContext('2d');
      var lineChartDataConsultasResumen = jQuery.extend(true, {}, dataConsultasResumen);

      window.lineChartConsultasResumen = new Chart(chartCanvasConsultasResumen, {
        type: "line",
        data:{
          labels: fechas,
          datasets: [
            lineChartDataConsultasResumen
          ]
        },
        options: optionsConsultasResumen,
      });
    });
};

$(document).ready(function(){
    limpiarCanvas();
    graficarPacientes();
    graficarConsultas();
});