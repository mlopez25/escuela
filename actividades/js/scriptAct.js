/* global $ */
$(document).ready(function() {
    
    var page = 1;
    
    /* ***********
        CARGADOR DE AJAX
    ***************** */
    $('#cargando').append( '<img src="/loading.gif" /> ');
    $('#body').hide();
    $('.footer').hide();
    $('.footer-copy').hide();

    $.ajax({
        url: 'index.php',
        data: {
            ruta: 'actividad',
            accion: 'userpage',
            pagina: page
        },
        type: "GET",
        dataType: "json"
    }).done(function(objetoJson) {
        actualizar(objetoJson);
        addEventToActivitiesLink();
        addEventToReadMoreLink();
        $('.menu_pie').show();
        ocultarCargador();
    });
    
    function mostrarCargador(){
        $('#cargando').show();
        $('#body').hide();
        $('.footer').hide();
        $('.footer-copy').hide();
    }
    
    function ocultarCargador(){
        $('#cargando').hide();
        $('#body').show();
        $('.footer').show();
        $('.footer-copy').show();
    }
    
    function contenidoSidebar(){
        mostrarCargador();
        $.ajax({
            url: 'index.php',
            data: {
                ruta: 'actividad',
                accion: 'contentsidebar',
            },
            type: 'GET',
            dataType: 'json',
        }).done(function(objetoJson) {
            $('.sidebar').append( estructuraSidebar(objetoJson) );
            addEventToSidebarBuscar();
            addEventToSidebarProximas();
            addEventToSidebarGrupo();
            addEventToSidebarProfesor();
            addEventToSidebarActividad();
            addEventToSidebarEntreFechas();
            ocultarCargador();
        });
    }
    
    function addEventToPagesLinks(){
        $('.page-link').on('click', function(){
            mostrarCargador();
            var pagina = $(this).data('page');
            if(pagina == 'p+1') {
                page++;
            } else if(pagina == 'p-1') {
                page--;
            } else {
                page = pagina;
            }
            if(page < 1) {
                page = 1;
            }
            $.ajax({
                url: 'index.php',
                data: {
                    ruta: 'actividad',
                    accion: 'userpage',
                    pagina: page
                },
                type: "GET",
                dataType: "json"
            }).done(function(objetoJson) {
                $('#actividadDestacada').empty();
                $('#restoActividades').empty();
                $('.menu_pie').empty();
                $('.sidebar').empty();
                page = objetoJson.page;
                actualizar(objetoJson);
                $('.menu_pie').hide();
                ocultarCargador();
            });
            
        });
    }
    
    function addEventToSidebarBuscar(){
        $('.sidebarBuscar').on('click', function() {
            event.preventDefault();
            
            $('.containerSingle').empty();
            $('#restoActividades').empty();
            
            var textoBusqueda = $('.inputBuscar');
            
            if( validarNull(textoBusqueda) ){
                mostrarCargador();
                
                $.ajax({
                    url: 'index.php',
                    data: {
                        ruta: 'actividad',
                        accion: 'busqueda',
                        texto: textoBusqueda.val()
                    },
                    type: 'GET',
                    dataType: 'json',
                }).done(function(objetoJson) {
                    search( objetoJson, textoBusqueda.val() );
                    $('.menu_pie').hide();
                    ocultarCargador();
                });
            }
        });
    }
    
    function addEventToSidebarEntreFechas(){
        $('.buscarActividad').on('click', function(){
            event.preventDefault();
            $('.containerSingle').empty();
            $('#restoActividades').empty();
            
            var fechaA = $('#fechaA').val();
            var fechaB = $('#fechaB').val();
            
            if( validarNull( $('#fechaA') ) && validarNull( $('#fechaB') ) ){
                if( Date.parse(fechaB) > Date.parse(fechaA) ){
                    mostrarCargador();
                    
                    $.ajax({
                        url: 'index.php',
                        data: {
                            ruta: 'actividad',
                            accion: 'actividadesentrefechas',
                            fechaa: fechaA,
                            fechab: fechaB
                        },
                        type: 'GET',
                        dataType: 'json',
                    }).done(function(objetoJson) {
                        $('.error_buscar').text('');
                        var info = '';
                        archive(objetoJson, info);
                        addEventToActivitiesLink();
                        $('.menu_pie').hide();
                        ocultarCargador();
                    });
                } else{
                    $('.error_buscar').text('La Fecha Final no puede ser menor que la Fecha Inicial');
                }
            } else{
                $('.error_buscar').text('Debe escribir las fechas para buscar');
            }
        });
    }
    
    function addEventToSidebarGrupo(){
        $('.sidebarGrupo').on('click', function(){
            var idGrupo = $(this).data('grupo');
            var nombre = $(this).data('nombre');
            
            event.preventDefault();
            $('.containerSingle').empty();
            $('#restoActividades').empty();
            mostrarCargador();
            $.ajax({
                url: 'index.php',
                data: {
                    ruta: 'actividad',
                    accion: 'listActividadesGrupo',
                    id: idGrupo
                },
                type: 'GET',
                dataType: 'json',
            }).done(function(objetoJson) {
                archive(objetoJson, nombre);
                addEventToActivitiesLink();
                $('.menu_pie').hide();
                ocultarCargador();
            });
            
        });
    }

    function addEventToSidebarProfesor(){
        $('.sidebarProfesor').on('click', function(){
            var idProfesor = $(this).data('profesor');
            var nombre = $(this).data('nombre');
            
            event.preventDefault();
            $('.containerSingle').empty();
            $('#restoActividades').empty();
            mostrarCargador();
            
            $.ajax({
                url: 'index.php',
                data: {
                    ruta: 'actividad',
                    accion: 'listActividadesProfesor',
                    id: idProfesor
                },
                type: 'GET',
                dataType: 'json',
            }).done(function(objetoJson) {
                $('#restoActividades').append( getPerfilProfesor(objetoJson.profesor) );
                archive(objetoJson, nombre);
                addEventToActivitiesLink();
                $('.menu_pie').hide();
                ocultarCargador();
            });
        });
    }
    
    function addEventToSidebarActividad(){
        $('.sidebarMes').on('click', function(){
            var mes = $(this).data('mes');
            var nombre = $(this).data('nombre');
            
            event.preventDefault();
            $('.containerSingle').empty();
            $('#restoActividades').empty();
            
            mostrarCargador();
            
            $.ajax({
                url: 'index.php',
                data: {
                    ruta: 'actividad',
                    accion: 'listActividadesMes',
                    mes: mes
                },
                type: 'GET',
                dataType: 'json',
            }).done(function(objetoJson) {
                archive(objetoJson, nombre);
                addEventToActivitiesLink();
                $('.menu_pie').hide();
                ocultarCargador();
            });
        });
    }
    
    function addEventToSidebarProximas(){
        $('.sidebarProximas').on('click', function(){
            var actvDest = $(this).data('actividad');

            event.preventDefault();
            $('.containerSingle').empty();
            $('#restoActividades').empty();
            mostrarCargador();
            
            $.ajax({
                url: 'index.php',
                data: {
                    ruta: 'actividad',
                    accion: 'viewact',
                    id: actvDest
                },
                type: 'GET',
                dataType: 'json',
            }).done(function(objetoJson) {
                single(objetoJson);
                $('.menu_pie').hide();
                ocultarCargador();
            });
        });
    }


    function addEventToSidebarDepartamento(){
        $('.sidebarDepartamento').on('click', function(){
            var idDepartamento = $(this).data('departamento');
            var nombre = $(this).data('nombre');
            
            event.preventDefault();
            $('.containerSingle').empty();
            $('#restoActividades').empty();
            mostrarCargador();
            $.ajax({
                url: 'index.php',
                data: {
                    ruta: 'actividad',
                    accion: 'listActividadesDepartamento',
                    id: idDepartamento
                },
                type: 'GET',
                dataType: 'json',
            }).done(function(objetoJson) {
                archive(objetoJson, nombre);
                addEventToActivitiesLink();
                $('.menu_pie').hide();
                ocultarCargador();
            });
            
        });
    }

    function addEventToActivitiesLink(){
        $('.titulodestacadoActividades').on('click', function(){
            var actvDest = $(this).data('actividad');

            event.preventDefault();
            $('.containerSingle').empty();
            $('#restoActividades').empty();
            $('.menu_pie').empty();
            mostrarCargador();
            
            $.ajax({
                url: 'index.php',
                data: {
                    ruta: 'actividad',
                    accion: 'viewact',
                    id: actvDest
                },
                type: 'GET',
                dataType: 'json',
            }).done(function(objetoJson) {
                single(objetoJson);
                $('.menu_pie').hide();
                ocultarCargador();
            });
            
        });
    }
    
    function addEventToReadMoreLink(){
        $('.readMore').on('click', function(){
            var actvDest = $(this).data('actividad');

            event.preventDefault();
            $('.containerSingle').empty();
            $('#restoActividades').empty();
            mostrarCargador();
            
            $.ajax({
                url: 'index.php',
                data: {
                    ruta: 'actividad',
                    accion: 'viewact',
                    id: actvDest
                },
                type: 'GET',
                dataType: 'json',
            }).done(function(objetoJson) {
                single(objetoJson);
                $('.menu_pie').hide();
                ocultarCargador();
            });
            
        });
    }

    
/* ***************** LLAMADAS A ESTRUCTURAS ********************* */    
    
    function single(objetoJson){
        $('#restoActividades').append( getSingle( objetoJson.actividad ) );
    }
    
    function archive(objetoJson, inf){
        $('#restoActividades').append( getArchive (objetoJson.actividades, inf ) );
    }
    
    function search(objetoJson, busqueda){
        $('#restoActividades').append( getSearch (objetoJson, busqueda ) );
        addEventToSidebarGrupo();
        addEventToSidebarDepartamento();
        addEventToSidebarProfesor();
        addEventToSidebarActividad();
        addEventToActivitiesLink();
    }
    

/* ***************** ESTRUCTURAS ********************* */

    function getPagination(page, pages){
        var s = '<li class="page-item"><a href="#" data-page="p-1"><img class="flechaIz" src="/wp/wp-content/themes/landmarkcollege/images/chevron.svg"></a></li>';
        for( var i = 1; i <= pages; i++){
            s += '<li class="page-item"><a class="page-link" href="#" data-page="'+ i +'">' + i + '</a></li>';
        }
        s += '<li class="page-item"><a href="#" data-page="p+1"><img class="flecha" src="/wp/wp-content/themes/landmarkcollege/images/chevron.svg"></a></li>';
        return s;
    }
    
    function actualizar(objetoJson){
        
        $('#actividadDestacada').append( getActividadDestacada( objetoJson.fecha ) );
        for (var i = 0; i < objetoJson.actividades.length; ++i) {
            $('#restoActividades').append( getRestoActividades( objetoJson.actividades[i] ) );
        }
        contenidoSidebar();
        $('.menu_pie').append(getPagination(objetoJson.page, objetoJson.pages));
        addEventToPagesLinks();
    }
    
    function estructuraSidebar(objetoJson){
        var s = 
            '<section class="col-lg-12 rellenar">' +
                '<h3>Buscador</h3>' +
                '<div class="input-group">' +
                    '<input type="search" class="form-control inputBuscar" placeholder="¿Necesitas buscar algo?" value="" title="Buscar:">' +
                    '<span class="input-group-btn">' +
                        '<button class="btn btn-default sidebarBuscar" type="button">Buscar</button>' +
                    '</span>' +
                '</div>' +
            '</section>' +

            '<section class="col-lg-12 rellenar">' +
                '<h3>Próximas Actividades</h3> ' ;
                for(var a=0; a<objetoJson.actividades.length; a++){
                    s += '<li><a href="" data-actividad="'+ objetoJson.actividades[a].idActividad +'" class="sidebarProximas">' + objetoJson.actividades[a].titulo + '</a></li>';
                }
            s += '</section>' +
            '<section class="col-lg-12 rellenar">' +
                '<h3>Buscar Actividades</h3> ' +
                '<form method="POST" id="formBuscarActividad">' +
                    '<input type="date" name="fecha" value="" id="fechaA"><br/>' +
                    '<input type="date" name="fecha" value="" id="fechaB"><br/>' +
                    '<input type="submit" value="Buscar" class="buscarActividad">' +
                '</form>' +
                '<span class="error_buscar"></span>' +
            '</section>' +
            '<section class="col-lg-12 rellenar">' +
                '<h3>Actividades</h3> ';
                for(var f=0; f<objetoJson.meses.length; f++){
                    s += '<li><a href="" data-mes="'+ objetoJson.meses[f].num +'" data-nombre="' + objetoJson.meses[f].mes + '" class="sidebarMes">' + objetoJson.meses[f].mes + '</a></li>' ;
                }
            s += '</section>' +
            '<section class="col-lg-12 rellenar">' +
                '<h3>Grupos</h3> ';
                for(var g=0; g<objetoJson.grupos.length; g++){
                    var curso = objetoJson.grupos[g].nombre + ' ' + objetoJson.grupos[g].nivel;
                    s += '<li><a href="" data-grupo="'+ objetoJson.grupos[g].idGrupo +'" data-nombre="' + curso + '" class="sidebarGrupo">' + curso + '</a></li>';
                }
            s += '</section>' +
            '<section class="col-lg-12 rellenar">' +
                '<h3>Profesores</h3> ';
                for(var p=0; p<objetoJson.profesores.length; p++){
                    s += '<li><a href="" data-profesor="'+ objetoJson.profesores[p].idProfesor +'" data-nombre="' + objetoJson.profesores[p].nombre + '" class="sidebarProfesor">' + objetoJson.profesores[p].nombre + '</a></li>';
                }
            s += '</section>' +
            '<section class="col-lg-12 rellenar">' +
                '<h3>Páginas</h3>' +
                '<li><a href="https://proyect-school-krast.c9users.io/wp/">Inicio</a></li>' +
                '<li><a href="https://proyect-school-krast.c9users.io/wp/noticias/">Noticias</a></li>' +
                '<li><a href="https://proyect-school-krast.c9users.io/actividades">Actividades</a></li>' +
                '<li><a href="https://proyect-school-krast.c9users.io/wp/colegio">Colegio</a></li>' +
                '<li><a href="https://proyect-school-krast.c9users.io/wp/colegio/#cursos">Cursos</a></li>' +
                '<li><a href="https://proyect-school-krast.c9users.io/wp/contacto/">Contacto</a></li>' +
            '</section>'
        ;
        
        return s;
    }
    
    function cadenaMes(fecha){
        var meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 
            'Octubre', 'Noviembre', 'Diciembre'];
            
        var numMes = fecha.substr(5, 2);
        if( numMes.substr(0, 1) == 0){
            numMes = fecha.substr(6, 1);
        }
        numMes--;
        
        return meses[numMes];
    }
    
    function excerptAct(description){
        var descripcion = '';
        var longitud=30;
 
        if( description.length > longitud ){
            var separador = " ";
            var arrayElem = description.split(separador, longitud);

            for (var i=0; i<longitud; i++) {
                descripcion += arrayElem[i] + ' ';
            }
            descripcion += '...';
        }else{
            var descripcion = description;
        }
        
        return descripcion;
    }

    function getRestoActividades(actividades) {
        
        var mes = cadenaMes( actividades.fecha );
        var excerpt = excerptAct( actividades.descripcion );
        
        var s =
            '<div class="contAct">' +
				'<div class="latest-posts-grid-left">' +
					'<ul class="post-date">' +
						'<li>' + actividades.fecha.substr(8, 2) +
						'<span>' + mes + '</span></li>' +
					'</ul>' +
				'</div>' +
				'<div class="latest-posts-grid-right post-ajuste">';
				    if( actividades.imagen === null ){
				        s += '<a><div style="background-image:url(/imagenesActividades/notimagen.jpg)" class="img-responsive post-img divImg"></div></a>';
				    } else {
				        s += '<a><div style="background-image:url(/imagenesActividades/' + actividades.imagen + ')" class="img-responsive post-img divImg"></div></a>';
				    }
				
				s +=	
					'<h4><a class="titulodestacado titulodestacadoActividades" data-actividad="'+ actividades.idActividad +'" href="">' + actividades.titulo + '</a></h4>' +
					'<ul>' +
						'<li>' + actividades.profesor + ' | </li>' +
						'<li>' + actividades.departamento + '</li>' +
					'</ul>' +
					'<ul>' +
					    '<li>' + actividades.grupo + ' | </li>' +
						'<li>' + actividades.lugar + '</li>' +
					'</ul>' +
					'<p class="contDes">' + excerpt + '</p>' +
					'<div class="more">' +
						'<a href="" class="hvr-sweep-to-top readMore" data-actividad="'+ actividades.idActividad +'">Leer Más  &#10511;</a>' +
					'</div>' +
				'</div>' +
				'<div class="clearfix"> </div>' +
			'</div>';
        return s;
    }
    
    function getActividadDestacada(actividad){
        
        var mes = cadenaMes( actividad.fecha );
        var excerpt = excerptAct( actividad.descripcion );
        
        var s =
            '<div class="contenidoActividad">' +
                '<div class="imagenActDestacada">';
                    if( actividad.imagen === null ){
    				        s += '<div style="background-image:url(/imagenesActividades/notimagen.jpg)" class="img-responsive post-img divImg"></div>';
    				    } else {
    				        s += '<div style="background-image:url(/imagenesActividades/' + actividad.imagen + ')" class="img-responsive post-img divImg"></div>';
    				    }
    			s +=
    			'</div>' +
    			'<div class="contentAct">' +
                    '<div class="fechaActividad fechaActDest"><span>' + 
                        actividad.fecha.substr(8, 2) + 
                            '<br/><p class="mes">' + mes + '</p></span>' + 
                    '</div>' +
                    '<div class="wrapperActividad wrapperActDest">' +
                        '<h4><a class="tituloActDest titulodestacadoActividades" data-actividad="'+ actividad.idActividad +'" href="">' + actividad.titulo + '</a></h4>' +
                        '<span class="detalles">Grupo: <span>' + actividad.grupo + '</span></span>' +
                        '<span class="detalles">Profesor: <span>' + actividad.profesor + '</span></span>' +
                        '<span class="detalles">Departamento: <span>' + actividad.departamento + '</span></span>' +
                        '<p class="descripcionActividad">' + excerpt + '</p>' +
                        '<span class="detalles">Lugar: <span>' + actividad.lugar + '</span></span><br/>' +
                        '<div class="more moreActDest">' +
						    '<a href="" class="hvr-sweep-to-top readMore" data-actividad="'+ actividad.idActividad +'">Leer Más  &#10511;</a>' +
					    '</div>' +
                    '</div>' +
                '</div>' +
            '</div>'
        ;
        return s;
        

    }
    
    function getSingle(actividad){
        
        var mes = cadenaMes( actividad.fecha );
        
        var s =
            '<div class="contenidoActividad">';
                if( actividad.imagen === null ){
                    s += '<img src="/imagenesActividades/notimagen.jpg" />';
                } else {
                    s += '<img src="/imagenesActividades/' + actividad.imagen + '" />';
                }
                
                s += 
                '<div class="contentAct">' +
                    '<div class="fechaActividad"><span>' + 
                        actividad.fecha.substr(8, 2) + 
                            '<br/><p class="mes">' + mes + 
                        '</p></span>' + 
                    '</div>' +
                    '<div class="wrapperActividad">' +
                        '<p class="tituloActividad">' + actividad.titulo + '</p>' +
                        '<span class="detalles">Grupo: <span>' + actividad.grupo + '</span></span>' +
                        '<span class="detalles">Profesor: <span>' + actividad.profesor + '</span></span>' +
                        '<span class="detalles">Departamento: <span>' + actividad.departamento + '</span></span>' +
                        '<p class="descripcionActividad">' + actividad.descripcion.replace(new RegExp("\n","g"), "<br/>") + '</p>' +
                        '<div class="lugarActividad">' + actividad.lugar + '<span>Lugar</span></div>' +
                        '<div class="hora">' +
                            '<p>' + actividad.horaInicio.substr(0, 5) + '<span>Hora Inicio</span></p>' +
                            '<p>' + actividad.horaFinal.substr(0, 5) + '<span>Hora Final</span></p>' +
                        '</div>' +
                    '</div>' +
                '</div>' +
            '</div>'
        ;
        return s;
    }
    
    function getArchive(actividades, inf){
        var s = '';
        
        s += '<div class="content-archiveA">';
        
        if( inf === '' ){
            
        } else{
            s += '<h1>Actividades de ' + inf + '</h1>';
        }
        
        if( actividades.length == 0 ){
            s += '<p class="archivenot">No se ha encontrado ninguna Actividad</p>';
        } else{
            for(var i=0; i<actividades.length; i++){
                
                var mes = cadenaMes( actividades[i].fecha );
                var excerpt = excerptAct( actividades[i].descripcion );
                
                s += 
                    '<div class="ArchiveActividad">' +
                        '<div class="fechaActividad fechaArchiveAct">' +
                            '<span>' + actividades[i].fecha.substr(8, 2) + '<br><p class="mes">' + mes + '</p></span>' + 
                        '</div>' +
                        '<div class="wrapperArchiveAct">' +
                            '<h4><a class="tituloArchiveAct titulodestacadoActividades" data-actividad="'+ actividades[i].idActividad +'" href="">' + actividades[i].titulo + '</a></h4>' +
                            '<span class="detalles">Grupo: <span>' + actividades[i].grupo + '</span></span>' +
                            '<span class="detalles">Profesor: <span>' + actividades[i].profesor + '</span></span>' +
                            '<span class="detalles">Departamento: <span>' + actividades[i].departamento + '</span></span>' +
                            '<p class="descripcionActividad">' + excerpt + '</p>' +
                            '<span class="detalles">Lugar: <span>' + actividades[i].lugar + '</span></span><br/>' +
                            '<div class="more moreActDest">' +
    						    '<a href="" class="hvr-sweep-to-top readMore" data-actividad="'+ actividades[i].idActividad +'">Leer Más  &#10511;</a>' +
    					    '</div>' +
                        '</div>' +
                    '</div><br/><hr/>';
            }
        }
        
        s += '</div>';
        
        return s;
    }
    
    function getSearch(objetoJson, busqueda){
        var s = '';
        
        s += '<div class="content-archive">' + 
            '<h1>Resultados de Búsqueda: " ' + busqueda + ' "</h1>';
        
        if( objetoJson.datosActividad.length == 0){
        } else{
            for(var i=0; i<objetoJson.datosActividad.length; i++){
            
                var actividad = objetoJson.datosActividad[i];
                
                var mes = cadenaMes( actividad.fecha );
                var excerpt = excerptAct( actividad.descripcion );

                s += 
                    '<div class="ArchiveActividad">' +
                        '<div class="fechaActividad fechaArchiveAct">' +
                            '<span>' + actividad.fecha.substr(8, 2) + '<br><p class="mes">' + mes + '</p></span>' + 
                        '</div>' +
                        '<div class="wrapperArchiveAct">' +
                            '<h4><a class="tituloArchiveAct titulodestacadoActividades" data-actividad="'+ actividad.idActividad +'" href="">' + actividad.titulo + '</a></h4>' +
                            '<span class="detalles">Grupo: <span>' + actividad.grupo + '</span></span>' +
                            '<span class="detalles">Profesor: <span>' + actividad.profesor + '</span></span>' +
                            '<span class="detalles">Departamento: <span>' + actividad.departamento + '</span></span>' +
                            '<p class="descripcionActividad">' + excerpt + '</p>' +
                            '<span class="detalles">Lugar: <span>' + actividad.lugar + '</span></span><br/>' +
                            '<div class="more moreActDest">' +
    						    '<a href="" class="hvr-sweep-to-top readMore" data-actividad="'+ actividad.idActividad +'">Leer Más  &#10511;</a>' +
    					    '</div>' +
                        '</div>' +
                    '</div><br/><hr/>';
            }
            s += '</div>';
        }
        
        if( objetoJson.datosGrupo.length == 0){
        } else{
            for(var h=0; h<objetoJson.datosGrupo.length; h++){
                var grupo = objetoJson.datosGrupo[h];
                s += 
                    '<div class="ArchiveGrupo">' +
                    '<p><a href="" data-grupo="' + grupo.idGrupo + '" data-nombre="' + grupo.nombre + " " + grupo.nivel + '" class="sidebarGrupo searchGrupo" >' + grupo.nombre + ' ' + grupo.nivel + '</a></p>' +
                    '</div>';
            }
        }
        
        if( objetoJson.datosProfesor.length == 0){
        } else{
            for(var j=0; j<objetoJson.datosProfesor.length; j++){
                var profesor = objetoJson.datosProfesor[j];
                s += 
                    '<div class="ArchiveProfesor">' +
                        '<div class="imagProfesor" >';
                            if( profesor.imagen === null ){
                                s += '<img class="user" src="/imagenesProfesores/user.png" />';
                            } else {
                                s += '<img class="imgprof" src="/imagenesProfesores/' + profesor.imagen + '" />';
                            }
            
                    s +=
                        '</div>' +
                        '<div class="infoProfesor">' +
                            '<p class="inforNombreProf"><a href="" data-profesor="' + profesor.idProfesor + '" data-nombre="' + profesor.nombre + '" class="sidebarProfesor">' + profesor.nombre + '</a></p><hr class="hr-author">' +
                            '<p class="inforDepProf"><span>Departamento</span>' + profesor.departamento + '</p>' +
                        '</div>' +
                    '</div><br/>';
            }
        }
        
        if( objetoJson.datosDepartamento.length == 0){
        } else{
            for(var g=0; g<objetoJson.datosDepartamento.length; g++){
                var departamento = objetoJson.datosDepartamento[g];
                s += 
                    '<div class="ArchiveDepartamento">' +
                    '<p><a href="" data-departamento="' + departamento.idDepartamento + '" data-nombre="' + departamento.departamento + '" class="sidebarDepartamento searchDepartamento">' + departamento.departamento + '</a></p>' +
                    '</div>';
            }
        }
        
        return s;
    }
    
    function getPerfilProfesor(profesor){
        var s = 
            '<div class="contenProfesor">' +
                '<div class="imagenProfesor" >';
                    if( profesor.imagen === null ){
                        s += '<img class="user" src="/imagenesProfesores/user.png" />';
                    } else {
                        s += '<img class="imgprof" src="/imagenesProfesores/' + profesor.imagen + '" />';
                    }
            
            s +=
                '</div>' +
                '<div class="inforProfesor">' +
                    '<p class="inforNombreProf">' + profesor.nombre + '</p><hr class="hr-author">' +
                    '<p class="inforDepProf"><span>Departamento</span>' + profesor.departamento + '</p>' +
                '</div>' +
            '</div><br/>';
        return s;
    }


/* ***************** FUNCIONES PARA VALIDAR FORMULARIOS ********************* */
    
    
    function validarNull(nodo){
        var campo = nodo.val();
        
        if(campo == ''){
            nodo.addClass('invalid');
            return false;
        } else{
            nodo.addClass('valid');
            return true;
        }
        
    }

});