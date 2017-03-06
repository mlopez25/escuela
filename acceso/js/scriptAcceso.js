/* global $ */
$(document).ready(function() {
    
    $('.container_access').hide();
    var page = 1;
    var pageProfes = 1;
    var pageDepartamento = 1;
    var pageGrupos = 1;
    $('.error_login').hide();
    var contError = 0;
    
    /* ***********
        CARGADOR DE AJAX
    ***************** */
    $('#cargando').append( '<img src="/loading.gif" /> ');
    $('#body').hide();
    
    function mostrarCargador(){
        $('#cargando').show();
        $('#body').hide();
    }
    
    function ocultarCargador(){
        $('#cargando').hide();
        $('#body').show();
    }

    
    $.ajax({
        url: 'index.php',
        data: {
            ruta: 'profesor',
            accion: 'islogin'
        },
        type: 'GET',
        dataType: 'json',
    }).done(function (objetoJson){
        login(objetoJson);
        addEventToLogin();
        ocultarCargador();
    });
    
    function addEventToLogin(){
        $('#login_teach').on('click', function() {
            
            var nombre = $('#inputlog_name');
            var password = $('#inputlog_password');
            $('.error_login').show();
            event.preventDefault();
            
            if( validarNull(nombre) ){
                if( validarPassword(password, 6)){
                    mostrarCargador();
                    
                    $.ajax({
                        url: 'index.php',
                        data: {
                            ruta: 'profesor',
                            accion: 'login',
                            nombre: nombre.val(),
                            password: password.val(),
                        },
                        type: 'GET',
                        dataType: 'json'
                    }).done(function(objetoJson) {
                        iniciar(objetoJson);
                        ocultarCargador();
                    });
                }
            } else{
                $('.error_login').text('Debe escribir Usuario y Contraseña');
            }
        });
    }
    
    function iniciar(objetoJson){
        mostrarCargador();
        $.ajax({
            url: 'index.php',
            data: {
                ruta: 'profesor',
                accion: 'islogin'
            },
            type: 'GET',
            dataType: 'json',
        }).done(function (objetoJson){
            login(objetoJson);
            addEventToLogin();
            ocultarCargador();
        });
    }
    
    function login(objetoJson){
        if(contError > 0){
            $('.error_login').show();
        }
        
        if( objetoJson.login == 1){
            $('.banner3').hide();
            $('.containerAcceso').hide();
            $('.container_access').show();
            
            if(objetoJson.profesor.directivo == 1){
                $('.container_aside').append( asideDirectivo(objetoJson) );
                contenidoProfesor(objetoJson);
                addEventToCloseSession();
                addEventToEditarPerfil();
                addEventToListActivities();
                addEventToAsideAddActivities();
                addEventToListTeachers();
                addEventToAsideAddProfesor();
                addEventToListDepartament();
                addEventToAsideAddDepartament();
                addEventToListGroup();
                addEventToAsideAddGrupo();
            }else{
                $('.container_aside').append( asideNoDirectivo(objetoJson) );
                contenidoProfesor(objetoJson);
                addEventToCloseSession();
                addEventToEditarPerfil();
                addEventToListActivities();
                addEventToAsideAddActivities();
            }
            
        } else{
            $('.error_login').text('El nombre o la contraseña no están bien escritos');
            contError++;
        }
    }
    
    /* ********************** ASIDE ************************** */
    
    function asideDirectivo(objetoJson){
        var s = 
            '<div class="container-logo">' +
                '<a href="https://proyect-school-krast.c9users.io/wp/" >' +
                '<img src="/wp/wp-content/themes/landmarkcollege/images/logo2.png" />' +
                '</a>' +
            '</div>' +
            '<a href="" class="cerrarSesion">Cerrar Sesión</a>' +
            '<h3>Mi Perfil</h3>' +
            '<a href="" class="editarPerfil" data-profesor="'+ objetoJson.profesor.id +'">Editar Perfil</a>' +
            '<h3>Actividades</h3>' +
            '<a href="" class="listarActividades" data-profesor="'+ objetoJson.profesor.id +'" >Listar Actividades</a>' +
            '<a href="" class="nuevaActividad" data-profesor="'+ objetoJson.profesor.id +'">Nueva Actividad</a>' +
            '<h3>Profesores</h3>' +
            '<a href="" class="listarProfesores">Listar Profesores</a>' +
            '<a href="" class="nuevoProfesor">Nuevo Profesor</a>' +
            '<h3>Departamentos</h3>' +
            '<a href="" class="listarDepartamentos" >Listar Departamentos</a>' +
            '<a href="" class="nuevoDepartamento">Nuevo Departamento</a>' +
            '<h3>Grupos</h3>' +
            '<a href="" class="listarGrupos">Listar Grupos</a>' +
            '<a href="" class="nuevoGrupo">Nuevo Grupo</a>';
            
        return s;
    }
    
    function asideNoDirectivo(objetoJson){
        var s = 
            '<div class="container-logo">' +
                '<a href="https://proyect-school-krast.c9users.io/wp/" >' +
                '<img src="/wp/wp-content/themes/landmarkcollege/images/logo2.png" />' +
                '</a>' +
            '</div>' +
            '<a href="" class="cerrarSesion">Cerrar Sesión</a>' +
            '<h3>Mi Perfil</h3>' +
            '<a href="" class="editarPerfil" data-profesor="'+ objetoJson.profesor.id +'">Editar Perfil</a>' +
            '<h3>Actividades</h3>' +
            '<a href="" class="listarActividades" data-profesor="'+ objetoJson.profesor.id +'">Listar Actividades</a>' +
            '<a href="" class="nuevaActividad" data-profesor="'+ objetoJson.profesor.id +'">Nueva Actividad</a>';
            
        return s;
    }
    
    /* ********************** FIN ASIDE ************************** */

    
    function addEventToCloseSession(){
         $('.cerrarSesion').on('click', function() {
            mostrarCargador();
            $.ajax({
                url: 'index.php',
                data: {
                    ruta: 'profesor',
                    accion: 'logout'
                },
                type: 'GET',
                dataType: 'json',
            }).done(function (objetoJson){
                ocultarCargador();
            });
         });
    }
    
    
    /* ************************* FUNCIONES DE PROFESORES *************************** */
    
    function listProfesores(objetoJson){
        
        var s = '<div class="contenedorListProfesores">';
        
        for (var i = 0; i < objetoJson.profesores.length; ++i) {
            
            s += 
                '<div class="detProf">' +
                    '<div class="detProfImg">';
                    
                        if(objetoJson.profesores[i].imagen === null){
                            s += '<img src="/imagenesProfesores/user.png" />';
                        } else{
                            s += '<img src="/imagenesProfesores/' + objetoJson.profesores[i].imagen + '" />';
                        }
                        
            s +=
                    '</div>' +
                    '<p class="detProfnombre">' + objetoJson.profesores[i].nombre + '</p><hr class="detProf">' +
                    '<p class="detProfd"><span>Departamento:</span>' + objetoJson.profesores[i].departamento + '</p>' +
                    '<p class="detProfd"><span>Responsabilidad:</span>' + objetoJson.profesores[i].directivo + '</p>' +
                    '<div class="operacProf">' +
                        '<a href="" class="editarProfesor" data-profesor="'+ objetoJson.profesores[i].idProfesor +'">Editar</a>' +
                        '<a href="" class="eliminarProfesor" data-profesor="'+ objetoJson.profesores[i].idProfesor +'">Eliminar</a>' +
                    '</div>' +
                '</div>';
        }
        
        s += '</div>';
                    
        $('.contenido').append( s );
        addEventToDeleteProfesor();
        addEventToEditProfesor();
        addEventToPagesLinksProfes();
    }
    
    function resultadoListarProfesores(){
        $('.contenido').empty();
        $('.menu_pie').empty();
        mostrarCargador();
        
        $.ajax({
            url: 'index.php',
            data: {
                ruta: 'profesor',
                accion: 'profesorespage',
                pagina: pageProfes
            },
            type: 'GET',
            dataType: 'json',
        }).done(function (objetoJson){
            $('.contenido').empty();
            listProfesores(objetoJson);
            $('.menu_pie').append(getPaginationProfes(objetoJson.page, objetoJson.pages));
            addEventToPagesLinksProfes();
            ocultarCargador();
        });
    }
    
    function addEventToPagesLinksProfes(){
        $('.page-link').on('click', function(){
            mostrarCargador();
            
            var pagina = $(this).data('page');
            if(pagina == 'p+1') {
                pageProfes++;
            } else if(pagina == 'p-1') {
                pageProfes--;
            } else {
                pageProfes = pagina;
            }
            if(page<1) {
                pageProfes = 1;
            }
            
            $.ajax({
                url: 'index.php',
                data: {
                    ruta: 'actividad',
                    accion: 'profesorespage',
                    pagina: pageProfes
                },
                type: "GET",
                dataType: "json"
            }).done(function(objetoJson) {
                resultadoListarProfesores();
                ocultarCargador();
            });
            
        });
    }
    
    function getPaginationProfes(page, pages){
        var s = '';
        for( var i = 1; i <= pages; ++i){
            s+= '<li class="page-item pagina-borrar"><a class="page-link" href="#" data-page="' + i +'">' + i + '</a></li>';
        }
        return s;
    }
    
    function contenidoProfesor(objetoJson){
        $('.menu_pie').empty();
        var idProfesor = objetoJson.profesor.id;
        mostrarCargador();
        
        $.ajax({
            url: 'index.php',
            data: {
                ruta: 'actividad',
                accion: 'userpage',
                id: idProfesor,
                pagina: page
            },
            type: 'GET',
            dataType: 'json',
        }).done(function (objetoJson){
            listActividades(objetoJson);
            $('.menu_pie').append(getPagination(objetoJson.page, objetoJson.pages, idProfesor));
            addEventToPagesLinks();
            ocultarCargador();
        });
    }
    
    function addEventToPagesLinks(){
        $('.page-link').on('click', function(){
            mostrarCargador();
            
            var pagina = $(this).data('page');
            var profesor = $(this).data('profesor');
            if(pagina == 'p+1') {
                page++;
            } else if(pagina == 'p-1') {
                page--;
            } else {
                page = pagina;
            }
            if(page<1) {
                page = 1;
            }
            
            $.ajax({
                url: 'index.php',
                data: {
                    ruta: 'actividad',
                    accion: 'userpage',
                    id: profesor,
                    pagina: page
                },
                type: "GET",
                dataType: "json"
            }).done(function(objetoJson) {
                $('.contenido').empty();
                $('.container_aside').empty();
                iniciar(objetoJson);
                ocultarCargador();
            });
            
        });
    }
    
    function getPagination(page, pages, idProfesor){
        var s = '';
        for( var i = 1; i <= pages; ++i){
            s+= '<li class="page-item pagina-borrar"><a class="page-link" href="#" data-page="' + i +'" data-profesor="' + idProfesor + '">' + i + '</a></li>';
        }
        return s;
    }
    
    function nuevoProfesor(objetoJson){
        var s = 
            '<div class="anade center-elements column-elements">' +
                '<h1 class="titulo_form">Añade un Profesor</h1>' +
                '<form method="POST" enctype="multipart/form-data" id="formAddProfesor">' +
            
                    '<div class="cont-campos">' +
                        '<input type="text" name="nombre" value="" placeholder="Nombre" id="add_nombre" /><br/>' +
                        '<input type="password" name="password" value="" placeholder="Contraseña" id="add_password" /><br/>' +
                        '<select name="departamento" id="add_departamento">';
                            for(var i=0; i<objetoJson.departamentos.length; i++){
                                if(i == 0){
                                    s +='<option value="' + objetoJson.departamentos[i].idDepartamento + '" select>' + objetoJson.departamentos[i].departamento + '</option>';
                                }else{
                                    s +='<option value="' + objetoJson.departamentos[i].idDepartamento + '">' + objetoJson.departamentos[i].departamento + '</option>';   
                                }
                            }
                        s += 
                        '</select><br/>' +
                        '<select name="directivo" id="add_directivo">' +
                            '<option value="1" select>Directivo</option>' +
                            '<option value="0">No directivo</option>' +
                        '</select>' +
                        
                        '<div class="input-group">' +
                            '<label class="input-group-btn">' +
                                '<span class="btn btn-primary">' +
                                'Selecciona&hellip; <input type="file" name="imagen" id="fileprofesor" style="display: none;">' +
                                '</span>' +
                            '</label>' +
                            '<input type="text" class="form-control" readonly>' +
                        '</div>' +
                        
                    '</div>' +
                
                    '<input type="submit" value="Crear" class="add_profesor" /><br/>' +
                    '<span class="error_add"></span>' +
                 '</form>' +
            '</div>';
            
            return s;
    }
    
    function estructuraEditarPerfil(objetoJson){
        $('.menu_pie').empty();

        var s = 
            '<div class="edit center-elements column-elements">' +
                '<h1 class="titulo_form">Editar Perfil</h1>' +
                '<form method="POST" enctype="multipart/form-data" id="formAddProfesor">' +
            
                    '<div class="cont-campos">' +
                        '<input type="hidden" name="id" value="' + objetoJson.profesor.idProfesor + '" id="edit_id" />' +
                        '<input type="hidden" name="nombrepk" value="' + objetoJson.profesor.nombre + '" id="edit_nombrepk" />' +
                        '<input type="hidden" name="passwordpk" + value="' + objetoJson.profesor.password + '" id="edit_passwordpk" />';
                        
                        if(objetoJson.profesor.imagen === null){
                        } else{
                            s += '<div class="imagenProfesor">' +
                                    '<img src="/imagenesProfesores/' + objetoJson.profesor.imagen + '" />' +
                                 '</div><br/>';
                        }
                        
                        s +=
                        '<input type="text" name="nombre" value="' + objetoJson.profesor.nombre + '" placeholder="Nombre" id="edit_nombre" /><br/><br/>' +
                        '<input type="password" name="password" value="" placeholder="Antigua Contraseña" id="edit_oldPassword" /><br/>' +
                        '<input type="password" name="password" value="" placeholder="Nueva Contraseña" id="edit_newPassword" /><br/>' +
                        '<input type="password" name="password" value="" placeholder="Repita la Contraseña" id="edit_repitPassword" /><br/><br/>' +
                        '<select name="departamento" id="edit_departamento">';
                            for(var i=0; i<objetoJson.departamentos.length; i++){
                                s +='<option value="' + objetoJson.departamentos[i].idDepartamento + '" ';
                                
                                if (objetoJson.profesor.departamento == objetoJson.departamentos[i].idDepartamento){
                                    s += 'selected ';
                                }
                                s += '>' + objetoJson.departamentos[i].departamento + '</option>';
                            }
                        s += 
                        '</select><br/>' +
                        
                        '<select name="directivo" id="edit_directivo">';
                                s +='<option value="1" ';
                                
                                if (objetoJson.profesor.directivo == 1){
                                    s += 'selected ';
                                }
                                s += '>Directivo</option>';
                                
                                s +='<option value="0" ';
                                
                                if (objetoJson.profesor.directivo == 0){
                                    s += 'selected ';
                                }
                                s += '>No Directivo</option>';
                        s += 
                        '</select><br/>' +
                    '</div>' +
                    
                    '<div class="input-group">' +
                        '<label class="input-group-btn">' +
                            '<span class="btn btn-primary">' +
                            'Selecciona&hellip; <input type="file" name="imagen" id="fileprofesor" style="display: none;">' +
                            '</span>' +
                        '</label>' +
                        '<input type="text" class="form-control" readonly>' +
                    '</div>' +
                    
                    '<input type="submit" value="Guardar" class="edit_perfil"/><br/>' +
                    '<span class="error_edit"></span>' +
                    '<input type="submit" value="Darse de Baja" data-profesor="' + objetoJson.profesor.idProfesor + '" class="eliminarProfesor eliminarPerfil"/><br/>' +
                 '</form>' +
            '</div>';
            
            return s;
    }
    
    function estructuraEditarProfesor(objetoJson){
        var s = 
            '<div class="editar center-elements column-elements">' +
                '<h1 class="titulo_form">Editar al profesor ' + objetoJson.profesor.nombre + '</h1>' +
                '<form method="POST" enctype="multipart/form-data" id="formAddProfesor">' +
            
                    '<div class="cont-campos">' +
                        '<input type="hidden" name="id" value="' + objetoJson.profesor.idProfesor + '" id="edit_id" /><br/>' +
                        '<input type="hidden" name="nombrepk" value="' + objetoJson.profesor.nombre + '" id="nombrepk" /><br/>' +
                        '<input type="text" name="nombre" value="' + objetoJson.profesor.nombre + '" placeholder="Nombre" id="edit_nombre" /><br/>' +
                        '<select name="departamento" id="edit_departamento">';
                            for(var i=0; i<objetoJson.departamentos.length; i++){
                                s +='<option value="' + objetoJson.departamentos[i].idDepartamento + '" ';
                                
                                if (objetoJson.profesor.departamento == objetoJson.departamentos[i].idDepartamento){
                                    s += 'selected ';
                                }
                                s += '>' + objetoJson.departamentos[i].departamento + '</option>';
                            }
                        s += 
                        '</select><br/>' +
                        
                        '<select name="directivo" id="edit_directivo">';
                                s +='<option value="1" ';
                                
                                if (objetoJson.profesor.directivo == 1){
                                    s += 'selected ';
                                }
                                s += '>Directivo</option>';
                                
                                s +='<option value="0" ';
                                
                                if (objetoJson.profesor.directivo == 0){
                                    s += 'selected ';
                                }
                                s += '>No Directivo</option>';
                        s += 
                        '</select><br/>';
                        
                        if(objetoJson.profesor.imagen === null || objetoJson.profesor.imagen === ''){
                        } else{
                            s += '<div class="imagenProfesor">' +
                                    '<img src="/imagenesProfesores/' + objetoJson.profesor.imagen + '" />' +
                                 '</div><br/>';
                        }
                        
                        s +=
                        '<div class="input-group">' +
                            '<label class="input-group-btn">' +
                                '<span class="btn btn-primary">' +
                                'Selecciona&hellip; <input type="file" name="imagen" id="fileprofesor" style="display: none;">' +
                                '</span>' +
                            '</label>' +
                            '<input type="text" class="form-control" readonly>' +
                        '</div>' +
                        
                    '<input type="submit" value="Guardar" class="edit_profesor" />' +
                    '<span class="error_edit"></span>'
                 '</form>' +
            '</div>';
            
            return s;
    }
    
    /* ******* EVENTS FOR TEACHERS ****** */
    
    function addEventToEditarPerfil(){
        $('.editarPerfil').on('click', function() {
            event.preventDefault();
            $('menu_pie').empty();
            mostrarCargador();
            
            $.ajax({
                url: 'index.php',
                data: {
                    ruta: 'profesor',
                    accion: 'getProfesorDepartamentos',
                    id: $(this).data('profesor')
                },
                type: 'GET',
                dataType: 'json',
            }).done(function (objetoJson){
                $('.contenido').empty();
                $('.contenido').append( estructuraEditarPerfil(objetoJson) );
                addEventToEditPerfil();
                addEventToDeleteProfesor();
                ocultarCargador();
            });
        });
    }
    
    function addEventToEditPerfil(){
        $('.edit_perfil').on('click', function() {
            event.preventDefault();
            $('.menu_pie').empty();
            
            var idProfesor = $('#edit_id').val();
            
            if( validarNull( $('#edit_nombre') ) ){
                if( validarNull( $('#edit_oldPassword') ) ){
                    if( $('#edit_oldPassword').val() === $('#edit_passwordpk').val() ){
                        if( $('#edit_newPassword').val() === $('#edit_repitPassword').val() ){
                            
                            mostrarCargador();
                            
                            var f = document.getElementById('formAddProfesor');
                            var formData = new FormData(f);
                            var archivo = document.getElementById("fileprofesor");
                            formData.append('archivo', archivo.files[0]);
                            
                            var nombre = '';
                            
                            if(archivo.files[0] !== undefined){
                                nombre = archivo.files[0]['name'];
                            } else{
                                nombre = null;
                            }
                
                            $.ajax({
                                url: 'subirProf.php',
                                data: formData,
                                type: 'POST',
                                contentType: false,
                                processData: false
                            });
                            
                            $.ajax({
                                url: 'index.php',
                                data: {
                                    ruta: 'profesor',
                                    accion: 'edit',
                                    id: idProfesor,
                                    nombrepk: $('#edit_nombrepk').val(),
                                    nombre: $('#edit_nombre').val(),
                                    password: $('#edit_newPassword').val(),
                                    departamento: $('#edit_departamento option:selected').attr('value'),
                                    directivo: $('#edit_directivo option:selected').attr('value'),
                                    imagen: nombre
                                },
                                type: 'GET',
                                dataType: 'json',
                            }).done(function (objetoJson){
                                $('.contenido').empty();
                                $('.contenido').append( estructuraEditarPerfil(objetoJson) );
                                addEventToEditPerfil();
                                ocultarCargador();
                            });
                        
                        } else{
                            $('.error_edit').text('Las contraseñas no son iguales');
                        }
                    } else {
                        $('.error_edit').text('La contraseña no es la misma que tenía en su perfil');
                    }
                } else{
                    $('.error_edit').text('Si desea modificar su perfil debe de escribir su contraseña');
                }
            }else{
                $('.error_edit').text('El nombre no puede estar vacio');
            }
        });
    }
    
    function addEventToListTeachers(){
        $('.listarProfesores').on('click', function(){
            event.preventDefault();
            $('.menu_pie').empty();
            mostrarCargador();
            
            $.ajax({
                url: 'index.php',
                data: {
                    ruta: 'profesor',
                    accion: 'profesorespage',
                    pagina: 'pageProfes'
                },
                type: 'GET',
                dataType: 'json',
            }).done(function (objetoJson){
                $('.contenido').empty();
                listProfesores(objetoJson);
                $('.menu_pie').append(getPaginationProfes(objetoJson.page, objetoJson.pages));
                addEventToPagesLinksProfes();
                ocultarCargador();
            });
        });
    }
    
    function addEventToAsideAddProfesor(){
        $('.nuevoProfesor').on('click', function() {
            event.preventDefault();
            $('.menu_pie').empty();
            mostrarCargador();
            
            $.ajax({
                url: 'index.php',
                data: {
                    ruta: 'actividad',
                    accion: 'listDepartamentos',
                },
                type: 'GET',
                dataType: 'json',
            }).done(function (objetoJson){
                $('.contenido').empty();
                $('.contenido').append( nuevoProfesor(objetoJson) );
                addEventToAddProfesor();
                ocultarCargador();
            });

        });
    }
    
    function addEventToAddProfesor(){
        $('.add_profesor').on('click', function(){
            event.preventDefault();
            $('.menu_pie').empty();
            
            if( validarNull( $('#add_nombre') ) && ( validarNull($('#add_password')) ) ){
                
                mostrarCargador();
                
                var f = document.getElementById('formAddProfesor');
                var formData = new FormData(f);
                var archivo = document.getElementById("fileprofesor");
                formData.append('archivo', archivo.files[0]);
                
                var nombre = '';
                
                if(archivo.files[0] !== undefined){
                    nombre = archivo.files[0]['name'];
                } else{
                    nombre = null;
                }
    
                $.ajax({
                    url: 'subirProf.php',
                    data: formData,
                    type: 'POST',
                    contentType: false,
                    processData: false
                });
                
                $.ajax({
                    url: 'index.php',
                    data: {
                        ruta: 'profesor',
                        accion: 'doinsert',
                        nombre: $('#add_nombre').val(),
                        password: $('#add_password').val(),
                        departamento: $('#add_departamento').val(),
                        directivo: $('#add_directivo option:selected').attr('value'),
                        imagen: nombre
                    },
                    type: 'GET',
                    dataType: 'json',
                }).done(function (objetoJson){
                    if(objetoJson.p == 0){
                        $('.error_add').text('El Nombre del Profesor ya se encuentra en la Base de Datos');
                    } else {
                        resultadoListarProfesores();
                    }
                    ocultarCargador();
                });
            } else {
                $('.error_add').text('Los Campos Nombre y Contraseña son obligatorios');
            }
        });
    }
    
    function addEventToDeleteProfesor(){
        $('.eliminarProfesor').on('click', function(){
            event.preventDefault();
            $('.menu_pie').empty();

            if(!confirm('¿Realmente quiere borrar al Profesor?')){
                event.preventDefault();
            } else{
                mostrarCargador();
                
                $.ajax({
                    url: 'index.php',
                    data: {
                        ruta: 'profesor',
                        accion: 'dodelete',
                        idProfesor: $(this).data('profesor'),
                    },
                    type: 'GET',
                    dataType: 'json',
                }).done(function (objetoJson){
                    resultadoListarProfesores();
                    ocultarCargador();
                });
            }
        });
    }
    
    function addEventToEditProfesor(){
        $('.editarProfesor').on('click', function() {
            event.preventDefault();
            $('.menu_pie').empty();
            mostrarCargador();
            
            $.ajax({
                url: 'index.php',
                data: {
                    ruta: 'profesor',
                    accion: 'getProfesorDepartamentos',
                    id: $(this).data('profesor')
                },
                type: 'GET',
                dataType: 'json',
            }).done(function (objetoJson){
                $('.contenido').empty();
                $('.contenido').append( estructuraEditarProfesor(objetoJson) );
                addEventToEditarProfesor();
                ocultarCargador();
            });
        });
    }
    
    function addEventToEditarProfesor(){
        $('.edit_profesor').on('click', function() {
            event.preventDefault();
            $('.menu_pie').empty();
            
            if( validarNull( $('#edit_nombre') ) ){
                mostrarCargador();
                
                var f = document.getElementById('formAddProfesor');
                var formData = new FormData(f);
                var archivo = document.getElementById("fileprofesor");
                formData.append('archivo', archivo.files[0]);
                
                var nombre = '';
                
                if(archivo.files[0] !== undefined){
                    nombre = archivo.files[0]['name'];
                } else{
                    nombre = null;
                }
    
                $.ajax({
                    url: 'subirProf.php',
                    data: formData,
                    type: 'POST',
                    contentType: false,
                    processData: false
                });
                
                $.ajax({
                    url: 'index.php',
                    data: {
                        ruta: 'profesor',
                        accion: 'edit',
                        id: $('#edit_id').val(),
                        nombrepk: $('#nombrepk').val(),
                        nombre: $('#edit_nombre').val(),
                        departamento:  $('#edit_departamento option:selected').attr('value'),
                        directivo: $('#edit_directivo option:selected').attr('value'),
                        imagen: nombre
                    },
                    type: 'GET',
                    dataType: 'json',
                }).done(function (objetoJson){
                    if(objetoJson.p == 0){
                        $('.error_edit').text('El Nombre ya se encuentra en la Base de Datos');
                        $('#edit_nombre').toggleClass('valid');
                        $('#edit_nombre').addClass('invalid');
                    } else {
                        resultadoListarProfesores();
                    }
                    ocultarCargador();
                });
            } else{
                $('.error_edit').text('No puede dejar el campo vacio');
            }
        });
    }
    
    /* ************************* FUNCIONES DE ACTIVIDADES *************************** */
    
    function listActividades(objetoJson){
        $('.contenido').append('<div class="containerActivities">');
        for (var i = 0; i < objetoJson.actividades.length; ++i) {
            $('.contenido').append( dolistActividades( objetoJson.actividades[i] ) );
        }
        $('.contenido').append('</div>');
        addEventToDeleteActivity();
        addEventToEditActivity();
        addEventToActivitiesLink();
        addEventToReadMoreLink();
    }
    
    function dolistActividades(actividades){
        
        var meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 
            'Octubre', 'Noviembre', 'Diciembre'];
            
        var numMes = actividades.fecha.substr(5, 2);
        if( numMes.substr(0, 1) == 0){
            numMes = actividades.fecha.substr(6, 1);
        }
        numMes--;
        
        var descripcion = '';
        var longitud=30;
 
        if( actividades.descripcion.length > longitud ){
            var separador = " ";
            var arrayElem = actividades.descripcion.split(separador, longitud);

            for (var i=0; i<longitud; i++) {
                descripcion += arrayElem[i] + ' ';
            }
            descripcion += '...';
        }else{
            var descripcion = actividades.descripcion;
        }
        
        var s =
            '<div class="actividadAbrr">' +
				'<div class="latest-posts-grid-left">' +
					'<ul class="post-date">' +
						'<li>' + actividades.fecha.substr(8, 2) +
						'<span>' + meses[ numMes ] + '</span></li>' +
					'</ul>' +
				'</div>' +
				'<div class="latest-posts-grid-right post-ajuste">';
				    if(actividades.imagen == null || actividades.imagen == ''){
				        s += '<a><div style="background-image:url(../imagenesActividades/notimagen.jpg)" class="img-responsive post-img divImg"></div></a>';
				    } else{
				        s += '<a><div style="background-image:url(../imagenesActividades/' + actividades.imagen + ')" class="img-responsive post-img divImg"></div></a>';
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
					'<p>' + descripcion + '</p>' +
					'<div class="more">' +
						'<a href="" class="hvr-sweep-to-top readMore" data-actividad="'+ actividades.idActividad +'">Leer Más  &#10511;</a>&nbsp;' +
						'<a href="" class="hvr-sweep-to-top editarActividad" data-actividad="'+ actividades.idActividad +'">Editar</a>&nbsp;' +
						'<a href="" class="hvr-sweep-to-top eliminarActividad" data-actividad="'+ actividades.idActividad +'">Eliminar</a>' +
					'</div>' +
				'</div>' +
				'<div class="clearfix"> </div>' +
			'</div>';
        return s;
    }
    
    function verActividad(actvDest){
        event.preventDefault();
        $('.contenido').empty();
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
            ocultarCargador();
        });
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
    
    function single(objetoJson){
        $('.contenido').append( getSingle( objetoJson.actividad ) );
    }
    
    function getSingle(actividad){
        var mes = cadenaMes( actividad.fecha );
        
        var s =
            '<div class="contenidoActividad">';
                if( actividad.imagen === null || actividad.imagen === '' ){
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
    
    function nuevaActividad(objetoJson){
        var s = 
            '<div class="anade center-elements column-elements">' +
                '<h1 class="titulo_form">Añade una Actividad</h1>' +
                '<form method="POST" enctype="multipart/form-data" id="formaddActividad">' +
            
                    '<div class="cont-campos">' +
                        '<select name="departamento" id="add_departamento">';
                            for(var i=0; i<objetoJson.departamentos.length; i++){
                                if(i == 0){
                                    s +='<option value="' + objetoJson.departamentos[i].idDepartamento + '" select>' + objetoJson.departamentos[i].departamento + '</option>';
                                }else{
                                    s +='<option value="' + objetoJson.departamentos[i].idDepartamento + '">' + objetoJson.departamentos[i].departamento + '</option>';   
                                }
                            }
                        s += 
                        '</select><br/>' +
                        
                        '<select name="grupo" id="add_grupo">';
                            for(var i=0; i<objetoJson.grupos.length; i++){
                                if(i == 0){
                                    s +='<option value="' + objetoJson.grupos[i].idGrupo + '" select>' + objetoJson.grupos[i].nombre + ' ' + objetoJson.grupos[i].nivel + '</option>';
                                }else{
                                    s +='<option value="' + objetoJson.grupos[i].idGrupo + '">' + objetoJson.grupos[i].nombre + ' ' + objetoJson.grupos[i].nivel + '</option>';
                                }
                            }
                        s += 
                        '</select><br/><br/>' +
                        '<input type="text" name="titulo" value="" placeholder="titulo" id="add_titulo" /><br/>' +
                        '<textarea type="text" rows="8" name="descripcion" value="" placeholder="descripcion" id="add_descripcion"></textarea><br/><br/>' +
                        '<input type="date" name="fecha" value="" placeholder="fecha" id="add_fecha" /><br/>' +
                        '<input type="text" name="lugar" value="" placeholder="lugar" id="add_lugar" /><br/>' +
                        '<input type="time" name="horaInicio" value="" placeholder="horaInicio" id="add_horaInicio" /><br/>' +
                        '<input type="time" name="horaFinal" value="" placeholder="horaFinal" id="add_horaFinal" /><br/>' +
                        '<div class="input-group">' +
                            '<label class="input-group-btn">' +
                                '<span class="btn btn-primary">' +
                                'Selecciona&hellip; <input type="file" name="imagen" id="fileactividad" style="display: none;">' +
                                '</span>' +
                            '</label>' +
                            '<input type="text" class="form-control" readonly>' +
                        '</div>' +
                    '</div>' +
                
                    '<input type="submit" value="Crear" class="add_actividad" data-profesor="'+ objetoJson.id +'" /><br/>' +
                    '<span class="error_add"></span>' +
                 '</form>' +
            '</div>';
            
            return s;
    }
    
    function estructuraEditarActividad(objetoJson){
        var s = 
            '<div class="edit center-elements column-elements">' +
                '<h1 class="titulo_form">Editar la Actividad: " ' + objetoJson.actividad.titulo + ' "</h1>' +
                '<form method="POST" enctype="multipart/form-data" id="formAddActividad>' +
                    '<input type="hidden" name="id" value="' + objetoJson.actividad.idActividad + '" id="edit_id" /><br/>' +
                    '<div class="cont-campos">' +
                        '<select name="departamento" id="edit_departamento">';
                            for(var i=0; i<objetoJson.departamentos.length; i++){
                                if( objetoJson.actividad.departamento === objetoJson.departamentos[i].idDepartamento ){
                                    s +='<option value="' + objetoJson.departamentos[i].idDepartamento + '" selected>' + objetoJson.departamentos[i].departamento + '</option>';
                                }else{
                                    s +='<option value="' + objetoJson.departamentos[i].idDepartamento + '">' + objetoJson.departamentos[i].departamento + '</option>';   
                                }
                            }
                        s += 
                        '</select><br/>' +
                        
                        '<select name="grupo" id="edit_grupo">';
                            for(var i=0; i<objetoJson.grupos.length; i++){
                                if( objetoJson.actividad.grupo == objetoJson.grupos[i].idGrupo ){
                                    s +='<option value="' + objetoJson.grupos[i].idGrupo + '" selected>' + objetoJson.grupos[i].nombre + ' ' + objetoJson.grupos[i].nivel + '</option>';
                                }else{
                                    s +='<option value="' + objetoJson.grupos[i].idGrupo + '">' + objetoJson.grupos[i].nombre + ' ' + objetoJson.grupos[i].nivel + '</option>';
                                }
                            }
                        s += 
                        '</select><br/><br/>' +
                        '<input type="text" name="titulo" value="' + objetoJson.actividad.titulo + '" placeholder="titulo" id="edit_titulo" /><br/>' +
                        '<textarea type="text" name="descripcion" placeholder="descripcion" id="edit_descripcion">' + objetoJson.actividad.descripcion + '</textarea><br/><br/>' +
                        '<input type="date" name="fecha" value="' + objetoJson.actividad.fecha + '" placeholder="fecha" id="edit_fecha" /><br/>' +
                        '<input type="text" name="lugar" value="' + objetoJson.actividad.lugar + '" placeholder="lugar" id="edit_lugar" /><br/>' +
                        '<input type="time" name="horaInicio" value="' + objetoJson.actividad.horaInicio + '" placeholder="horaInicio" id="edit_horaInicio" /><br/>' +
                        '<input type="time" name="horaFinal" value="' + objetoJson.actividad.horaFinal + '" placeholder="horaFinal" id="edit_horaFinal" /><br/>';
                        if(objetoJson.actividad.imagen === null || objetoJson.actividad.imagen === ''){
                        } else{
                            s += '<div class="imagenActividad">' +
                                    '<img src="/imagenesActividades/' + objetoJson.actividad.imagen + '" />' +
                                 '</div><br/>';
                        }
                        s += 
                        '<div class="input-group">' +
                            '<label class="input-group-btn">' +
                                '<span class="btn btn-primary">' +
                                'Selecciona&hellip; <input type="file" name="imagen" id="fileactividad" style="display: none;">' +
                                '</span>' +
                            '</label>' +
                            '<input type="text" class="form-control" readonly>' +
                        '</div>' +
                        
                    '</div>' +
                    '<input type="submit" value="Guardar" class="edit_actividad" /><br/><br/>' +
                    '<span class="error_edit"></span>' +
                 '</form>' +
            '</div>';
            
            return s;
    }
    
    /* ******* EVENTS FOR ACTIVITIES ****** */
    
    function addEventToActivitiesLink(){
        $('.titulodestacadoActividades').on('click', function(){
            $('.menu_pie').empty();
            var actvDest = $(this).data('actividad');
            verActividad(actvDest);
        });
    }
    
    function addEventToReadMoreLink(){
        $('.readMore').on('click', function(){
            var actvDest = $(this).data('actividad');
            verActividad(actvDest);
        });
    }

    function addEventToAddActivities(){
        $('.add_actividad').on('click', function(){
            event.preventDefault();
            $('.menu_pie').empty();
            mostrarCargador();
            
            if( validarNull( $('#add_titulo') ) && validarNull( $('#add_fecha') ) 
                && validarNull( $('#add_lugar') ) && validarNull( $('#add_horaInicio') ) && validarNull( $('#add_horaFinal') ) ){
            
                var idProfesor = $(this).data('profesor');
                
                var f = document.getElementById('formaddActividad');
                var formData = new FormData(f);
                var archivo = document.getElementById("fileactividad");
                formData.append('archivo', archivo.files[0]);
                
                var nombre = '';
                
                if(archivo.files[0] !== undefined){
                    nombre = archivo.files[0]['name'];
                } else{
                    nombre = null;
                }
    
                $.ajax({
                    url: 'subir.php',
                    data: formData,
                    type: 'POST',
                    contentType: false,
                    processData: false
                });
    
                $.ajax({
                    url: 'index.php',
                    data:{
                        ruta: 'actividad',
                        accion: 'doinsert',
                        idProfesor: idProfesor,
                        departamento: $('#add_departamento option:selected').val(),
                        grupo: $('#add_grupo option:selected').attr('value'),
                        titulo: $('#add_titulo').val(),
                        descripcion: $('#add_descripcion').val(),
                        fecha: $('#add_fecha').val(),
                        lugar: $('#add_lugar').val(),
                        horaInicio: $('#add_horaInicio').val(),
                        horaFinal: $('#add_horaFinal').val(),
                        imagen: nombre
                    },
                    type: 'GET',
                    dataType: 'json',
                }).done(function (objetoJson){
                    $('.contenido').empty();
                    $('.container_aside').empty();
                    iniciar(objetoJson);
                    ocultarCargador();
                });
            }  else {
                $('.error_add').text('Debe completar los campos señalados');
                ocultarCargador();
            }
        });    
    }
    
    function addEventToDeleteActivity(){
        $('.eliminarActividad').on('click', function(){
            event.preventDefault();
            $('.menu_pie').empty();

            if(!confirm('¿Realmente quiere borrar la actividad?')){
                event.preventDefault();
            } else{
                mostrarCargador();
                
                $.ajax({
                    url: 'index.php',
                    data: {
                        ruta: 'actividad',
                        accion: 'dodelete',
                        idActividad: $(this).data('actividad'),
                    },
                    type: 'GET',
                    dataType: 'json',
                }).done(function (objetoJson){
                    $('.contenido').empty();
                    $('.container_aside').empty();
                    iniciar(objetoJson);
                    ocultarCargador();
                });
            }
        });
    }
    
    function addEventToListActivities(){
        $('.listarActividades').on('click', function() {
            $('.menu_pie').empty();
            var idData = $(this).data('profesor');
            mostrarCargador();
            
            $.ajax({
                url: 'index.php',
                data: {
                    ruta: 'actividad',
                    accion: 'getActividades',
                    id: idData
                },
                type: 'GET',
                dataType: 'json',
            }).done(function (objetoJson){
                listActividades(objetoJson);
                ocultarCargador();
            });
            
        });
    }
    
    function addEventToAsideAddActivities(){
        $('.nuevaActividad').on('click', function() {
            event.preventDefault();
            $('.menu_pie').empty();
            var idData = $(this).data('profesor');
            mostrarCargador();

            $.ajax({
                url: 'index.php',
                data: {
                    ruta: 'actividad',
                    accion: 'listGruposDepartamentos',
                    idProfesor: idData
                },
                type: 'GET',
                dataType: 'json',
            }).done(function (objetoJson){
                    $('.contenido').empty();
                    $('.contenido').append( nuevaActividad(objetoJson) );
                    addEventToAddActivities();
                    ocultarCargador();
                });
                
            });
    }
    
    function addEventToEditActivity(){
        $('.editarActividad').on('click', function() {
            event.preventDefault();
            $('.menu_pie').empty();
            mostrarCargador();
            
            $.ajax({
                url: 'index.php',
                data: {
                    ruta: 'actividad',
                    accion: 'getActividadGrupoDepartamento',
                    id: $(this).data('actividad')
                },
                type: 'GET',
                dataType: 'json',
            }).done(function (objetoJson){
                $('.contenido').empty();
                $('.contenido').append( estructuraEditarActividad(objetoJson) );
                addEventToEditarActividad();
                ocultarCargador();
            });
                
        });
    }
    
    function addEventToEditarActividad(){
        $('.edit_actividad').on('click', function() {
            event.preventDefault();
            $('.menu_pie').empty();
            
            mostrarCargador();
            
            if( validarNull( $('#edit_titulo') ) && validarNull( $('#edit_fecha') ) 
                && validarNull( $('#edit_lugar') ) && validarNull( $('#edit_horaInicio') ) && validarNull( $('#edit_horaFinal') ) ){
            
                
                var f = document.getElementById('formaddActividad');
                var formData = new FormData(f);
                var archivo = document.getElementById("fileactividad");
                formData.append('archivo', archivo.files[0]);
                
                var nombre = '';
                
                if(archivo.files[0] !== undefined){
                    nombre = archivo.files[0]['name'];
                } else{
                    nombre = null;
                }
    
                $.ajax({
                    url: 'subir.php',
                    data: formData,
                    type: 'POST',
                    contentType: false,
                    processData: false
                });
                
                $.ajax({
                    url: 'index.php',
                    data: {
                        ruta: 'actividad',
                        accion: 'doedit',
                        id: $('#edit_id').val(),
                        departamento: $('#edit_departamento option:selected').attr('value'),
                        grupo: $('#edit_grupo option:selected').attr('value'),
                        titulo: $('#edit_titulo').val(),
                        descripcion: $('#edit_descripcion').val(),
                        fecha: $('#edit_fecha').val(),
                        lugar: $('#edit_lugar').val(),
                        horaInicio: $('#edit_horaInicio').val(),
                        horaFinal: $('#edit_horaFinal').val(),
                        imagen: nombre
                    },
                    type: 'GET',
                    dataType: 'json',
                }).done(function (objetoJson){
                    $('.contenido').empty();
                    $('.container_aside').empty();
                    iniciar(objetoJson);
                    ocultarCargador();
                });

            }  else {
                $('.error_edit').text('Debe completar los campos señalados');
                ocultarCargador();
            }

        });
    }
    
    /* ************************* FUNCIONES DE DEPARTAMENTOS *************************** */
    
    function resultadoListarDepartamentos(){
        $('.contenido').empty();
        $('.menu_pie').empty();
        mostrarCargador();   
                
        $.ajax({
            url: 'index.php',
            data: {
                ruta: 'actividad',
                accion: 'departamentopage',
                pagina: pageDepartamento
            },
            type: 'GET',
            dataType: 'json',
        }).done(function (objetoJson){
            $('.contenido').empty();
            listDepartamento(objetoJson);
            $('.menu_pie').append(getPaginationDepart(objetoJson.page, objetoJson.pages));
            addEventToPagesLinksDepart();
            ocultarCargador();
        });
    }
    
    function addEventToPagesLinksDepart(){
        $('.page-link').on('click', function(){
            mostrarCargador();
            var pagina = $(this).data('page');
            if(pagina == 'p+1') {
                pageDepartamento++;
            } else if(pagina == 'p-1') {
                pageDepartamento--;
            } else {
                pageDepartamento = pagina;
            }
            if(page<1) {
                pageDepartamento = 1;
            }
            
            $.ajax({
                url: 'index.php',
                data: {
                    ruta: 'actividad',
                    accion: 'departamentopage',
                    pagina: pageDepartamento
                },
                type: "GET",
                dataType: "json"
            }).done(function(objetoJson) {
                resultadoListarDepartamentos();
                ocultarCargador();
            });
            
        });
    }
    
    function getPaginationDepart(page, pages){
        var s = '';
        for( var i = 1; i <= pages; ++i){
            s+= '<li class="page-item pagina-borrar"><a class="page-link" href="#" data-page="' + i +'">' + i + '</a></li>';
        }
        return s;
    }
    
    function listDepartamento(objetoJson){
        var s = '<div class="contenedorListDepartamentos">';
        
        for (var i = 0; i < objetoJson.departamentos.length; ++i) {
            s += 
                '<div class="detDepart">' +
                    '<p>' + objetoJson.departamentos[i].departamento + '</p>' +
                    '<div class="operacDepart">' +
                        '<a href="" class="editarDepartamento" data-departamento="'+ objetoJson.departamentos[i].idDepartamento +'">Editar</a>' +
                        '<a href="" class="eliminarDepartamento" data-departamento="'+ objetoJson.departamentos[i].idDepartamento +'">Eliminar</a>' +
                    '</div>' +
                '</div>';
        }
        
        s += '</div>';
                    
        $('.contenido').append( s );
        addEventToDeleteDepartamento();
        addEventToEditDepartamento();
    }
    
    function nuevoDepartamento(objetoJson){
        var s = 
            '<div class="anade center-elements column-elements">' +
                '<h1 class="titulo_form">Añade un Departamento</h1>' +
                '<form method="POST" enctype="multipart/form-data">' +
            
                    '<input type="text" name="departamento" value="" placeholder="Departamento" id="add_departamento" /><br/>' +
                
                    '<input type="submit" value="Crear" class="add_departamento" /><br/>' +
                    '<span class="error_add"></span>' +
            
                 '</form>' +
            '</div>';
            
        return s;
    }
    
    function estructuraEditarDepartament(objetoJson){
        var s = 
            '<div class="edit center-elements column-elements">' +
                '<h1 class="titulo_form">Editar el Departamento ' + objetoJson.departamento.departamento + '</h1>' +
                '<form method="POST" enctype="multipart/form-data">' +
            
                    '<div class="cont-campos">' +
                        '<input type="hidden" name="id" value="' + objetoJson.departamento.idDepartamento + '" id="edit_id" /><br/>' +
                        '<input type="text" name="departamento" value="' + objetoJson.departamento.departamento + '" placeholder="Departamento" id="edit_departamento" /><br/>' +
                    '<input type="submit" value="Guardar" class="edit_departamento" /><br/>' +
                    '<span class="error_edit"></span>'
                 '</form>' +
            '</div>';
            
            return s;
    }
    
    /* ******* EVENTS FOR DEPARTAMENTS ****** */
    
    function addEventToListDepartament(){
        $('.listarDepartamentos').on('click', function(){
           event.preventDefault();
           $('.menu_pie').empty();
           mostrarCargador();
           
            $.ajax({
                url: 'index.php',
                data: {
                    ruta: 'actividad',
                    accion: 'departamentopage',
                    pagina: pageDepartamento
                },
                type: 'GET',
                dataType: 'json',
            }).done(function (objetoJson){
                $('.contenido').empty();
                listDepartamento(objetoJson);
                $('.menu_pie').append(getPaginationDepart(objetoJson.page, objetoJson.pages));
                addEventToPagesLinksDepart();
                ocultarCargador();
            });
        });
    }
    
    function addEventToAsideAddDepartament(){
        $('.nuevoDepartamento').on('click', function() {
            event.preventDefault();
            $('.menu_pie').empty();
        
            $('.contenido').empty();
            $('.contenido').append( nuevoDepartamento() );
            addEventToAddDepartamento();

        });
    }
    
    function addEventToAddDepartamento(){
        $('.add_departamento').on('click', function(){
            event.preventDefault();
            $('.menu_pie').empty();
            if( validarNull( $('#add_departamento') ) ) {
                mostrarCargador();
                
                $.ajax({
                    url: 'index.php',
                    data: {
                        ruta: 'actividad',
                        accion: 'doinsertDepartamento',
                        departamento: $('#add_departamento').val(),
                    },
                    type: 'GET',
                    dataType: 'json',
                }).done(function (objetoJson){
                    if(objetoJson.d == 0){
                        $('.error_add').text('El Departamento ya se encuentra en la Base de Datos');
                        $('#add_departamento').toggleClass('valid');
                        $('#add_departamento').addClass('invalid');
                    } else {
                        resultadoListarDepartamentos();
                    }
                    ocultarCargador();
                });
            } else {
                $('.error_add').text('El campo no puede estar vacio');
            }
        });
    }
    
    function addEventToDeleteDepartamento(){
        $('.eliminarDepartamento').on('click', function(){
            event.preventDefault();
            $('.menu_pie').empty();
    
            if(!confirm('¿Realmente quiere borrar el Departamento?')){
                event.preventDefault();
            } else{
                mostrarCargador();
                $.ajax({
                    url: 'index.php',
                    data: {
                        ruta: 'actividad',
                        accion: 'dodeleteDepartamento',
                        idDepartamento: $(this).data('departamento'),
                    },
                    type: 'GET',
                    dataType: 'json',
                }).done(function (objetoJson){
                    resultadoListarDepartamentos();
                    ocultarCargador();
                });
            }
        });
    }
    
    function addEventToEditDepartamento(){
        $('.editarDepartamento').on('click', function() {
            event.preventDefault();
            $('.menu_pie').empty();
            mostrarCargador();

            $.ajax({
                url: 'index.php',
                data: {
                    ruta: 'actividad',
                    accion: 'getDepartamento',
                    id: $(this).data('departamento')
                },
                type: 'GET',
                dataType: 'json',
            }).done(function (objetoJson){
                $('.contenido').empty();
                $('.contenido').append( estructuraEditarDepartament(objetoJson) );
                addEventToEditarDepartamento();
                ocultarCargador();
            });

        });
    }
    
    function addEventToEditarDepartamento(){
        $('.edit_departamento').on('click', function() {
            event.preventDefault();
            $('.menu_pie').empty();
            
            if( validarNull( $('#edit_departamento') ) ) {
                mostrarCargador();
                
                $.ajax({
                    url: 'index.php',
                    data: {
                        ruta: 'actividad',
                        accion: 'doeditDepartamento',
                        id: $('#edit_id').val(),
                        departamento: $('#edit_departamento').val(),
                    },
                    type: 'GET',
                    dataType: 'json',
                }).done(function (objetoJson){
                    if(objetoJson.d == 0){
                        $('.error_edit').text('Ese Departamento ya se encuentra en la Base de Datos');
                        $('#edit_departamento').toggleClass('valid');
                        $('#edit_departamento').addClass('invalid');
                    } else {
                        resultadoListarDepartamentos();
                    }
                    ocultarCargador();
                });
            } else{
                $('.error_edit').text('No puede dejar el campo vacio');
            }
        });
    }
    
    
    /* ************************* FUNCIONES DE GRUPOS *************************** */
    
    function resultadoListarGrupos(){
        $('.contenido').empty();
        $('.menu_pie').empty();
        mostrarCargador();
                
        $.ajax({
            url: 'index.php',
            data: {
                ruta: 'actividad',
                accion: 'grupopage',
                pagina: pageGrupos
            },
            type: 'GET',
            dataType: 'json',
        }).done(function (objetoJson){
            $('.contenido').empty();
            listGrupos(objetoJson);
            $('.menu_pie').append(getPaginationGroup(objetoJson.page, objetoJson.pages));
            addEventToPagesLinksGroup();
            ocultarCargador();
        });
    }
    
    function addEventToPagesLinksGroup(){
        $('.page-link').on('click', function(){
            event.preventDefault();
            mostrarCargador();
            
            var pagina = $(this).data('page');
            if(pagina == 'p+1') {
                pageGrupos++;
            } else if(pagina == 'p-1') {
                pageGrupos--;
            } else {
                pageGrupos = pagina;
            }
            if(page<1) {
                pageGrupos = 1;
            }
            
            $.ajax({
                url: 'index.php',
                data: {
                    ruta: 'actividad',
                    accion: 'grupopage',
                    pagina: pageGrupos
                },
                type: "GET",
                dataType: "json"
            }).done(function(objetoJson) {
                resultadoListarGrupos();
                ocultarCargador();
            });
            
        });
    }
    
    function getPaginationGroup(page, pages){
        var s = '';
        for( var i = 1; i <= pages; ++i){
            s+= '<li class="page-item pagina-borrar"><a class="page-link" href="#" data-page="' + i +'">' + i + '</a></li>';
        }
        return s;
    }
    
    function listGrupos(objetoJson){
        
        var s = '<div class="contenedorListGrupos">';
        
        for (var i = 0; i < objetoJson.grupos.length; ++i) {
            s += 
                '<div class="detGrupo">' +
                    '<p>' + objetoJson.grupos[i].nombre + ' '
                    + objetoJson.grupos[i].nivel + '</p>' +
                    '<div class="operacGrupo">' +
                        '<a href="" class="editarGrupo" data-grupo="'+ objetoJson.grupos[i].idGrupo +'">Editar</a>' +
                        '<a href="" class="eliminarGrupo" data-grupo="'+ objetoJson.grupos[i].idGrupo +'">Eliminar</a>' +
                    '</div>' +
                '</div>';
        }
        
        s += '</div>';
                    
        $('.contenido').append( s );
        addEventToDeleteGrupo();
        addEventToEditGrupo();
    }
    
    function nuevoGrupo(objetoJson){
        var s = 
            '<div class="anade center-elements column-elements">' +
                '<h1 class="titulo_form">Añade un Grupo</h1>' +
                '<form method="POST" enctype="multipart/form-data">' +
            
                    '<input type="text" name="nombre" value="" placeholder="Nombre" id="add_nombre" /><br/>' +
                    '<input type="text" name="nivel" value="" placeholder="Nivel" id="add_nivel" /><br/>' +
                    '<input type="submit" value="Crear" class="add_grupo" /><br/>' +
                    
                    '<span class="error_add"></span>' +
            
                 '</form>' +
            '</div>';
            
            return s;
    }
    
    function estructuraEditarGrupo(objetoJson){
        var s = 
            '<div class="edit center-elements column-elements">' +
                '<h1 class="titulo_form">Editar el Grupo ' + objetoJson.grupo.nombre + ' ' + objetoJson.grupo.nivel + '</h1>' +
                '<form method="POST" enctype="multipart/form-data">' +
            
                    '<div class="cont-campos">' +
                        '<input type="hidden" name="id" value="' + objetoJson.grupo.idGrupo + '" id="edit_id" /><br/>' +
                        '<input type="text" name="nombre" value="' + objetoJson.grupo.nombre + '" placeholder="Nombre" id="edit_nombre" /><br/>' +
                        '<input type="text" name="nivel" value="' + objetoJson.grupo.nivel + '" placeholder="Nivel" id="edit_nivel" /><br/>' +
                    '<input type="submit" value="Guardar" class="edit_grupo" />' +
                    '<span class="error_edit"></span>'
                 '</form>' +
            '</div>';
            
            return s;
    }
    
    /* ******* EVENTS FOR GROUPS ****** */
    
    function addEventToListGroup(){
        $('.listarGrupos').on('click', function(){
            event.preventDefault();
            $('.menu_pie').empty();
            mostrarCargador();
            
            $.ajax({
                url: 'index.php',
                data: {
                    ruta: 'actividad',
                    accion: 'grupopage',
                    pagina: pageGrupos
                },
                type: 'GET',
                dataType: 'json',
            }).done(function (objetoJson){
                $('.contenido').empty();
                listGrupos(objetoJson);
                $('.menu_pie').append(getPaginationGroup(objetoJson.page, objetoJson.pages));
                addEventToPagesLinksGroup();
                ocultarCargador();
            });
        });
    }
    
    function addEventToAsideAddGrupo(){
        $('.nuevoGrupo').on('click', function() {
            event.preventDefault();
            $('.menu_pie').empty();
            
            $('.contenido').empty();
            $('.contenido').append( nuevoGrupo() );
            addEventToAddGrupo();
        });
    }
    
    function addEventToAddGrupo(){
        $('.add_grupo').on('click', function(){
            event.preventDefault();
            $('.menu_pie').empty();

            if( (validarNull( $('#add_nombre') ) ) && (validarNull( $('#add_nivel') ) ) ) {
                mostrarCargador();
                
                $.ajax({
                    url: 'index.php',
                    data: {
                        ruta: 'actividad',
                        accion: 'doinsertGrupo',
                        nombre: $('#add_nombre').val(),
                        nivel: $('#add_nivel').val(),
                    },
                    type: 'GET',
                    dataType: 'json',
                }).done(function (objetoJson){
                    if(objetoJson.g == 0){
                        $('.error_add').text('El Grupo ya se encuentra en la Base de Datos');
                        $('#add_nombre').toggleClass('valid');
                        $('#add_nivel').toggleClass('valid');
                        $('#add_nombre').addClass('invalid');
                        $('#add_nivel').addClass('invalid');
                    }else{
                        resultadoListarGrupos();
                    }
                    ocultarCargador();
                });
            } else{
                $('.error_add').text( 'No puede dejar ningún campo vacio' );
            }
        });
    }
    
    function addEventToDeleteGrupo(){
        $('.eliminarGrupo').on('click', function(){
            event.preventDefault();
            $('.menu_pie').empty();

            if(!confirm('¿Realmente quiere borrar el Grupo?')){
                event.preventDefault();
            } else{
                mostrarCargador();
                
                $.ajax({
                    url: 'index.php',
                    data: {
                        ruta: 'actividad',
                        accion: 'dodeleteGrupo',
                        idGrupo: $(this).data('grupo'),
                    },
                    type: 'GET',
                    dataType: 'json',
                }).done(function (objetoJson){
                    resultadoListarGrupos();
                    ocultarCargador();
                });
            }
        });
    }

    function addEventToEditGrupo(){
        $('.editarGrupo').on('click', function() {
            event.preventDefault();
            $('.menu_pie').empty();
            mostrarCargador();
            
            $.ajax({
                url: 'index.php',
                data: {
                    ruta: 'actividad',
                    accion: 'getGrupo',
                    id: $(this).data('grupo')
                },
                type: 'GET',
                dataType: 'json',
            }).done(function (objetoJson){
                $('.contenido').empty();
                $('.contenido').append( estructuraEditarGrupo(objetoJson) );
                addEventToEditarGrupo();
                ocultarCargador();
            });
        });
    }
    
    function addEventToEditarGrupo(){
        $('.edit_grupo').on('click', function() {
            event.preventDefault();
            $('.menu_pie').empty();

            if( (validarNull( $('#edit_nombre') ) ) && (validarNull( $('#edit_nivel') ) ) ){
                mostrarCargador();
                
                $.ajax({
                    url: 'index.php',
                    data: {
                        ruta: 'actividad',
                        accion: 'doeditGrupo',
                        id: $('#edit_id').val(),
                        nombre: $('#edit_nombre').val(),
                        nivel: $('#edit_nivel').val()
                    },
                    type: 'GET',
                    dataType: 'json',
                }).done(function (objetoJson){
                    if(objetoJson.g == 0){
                        $('.error_edit').text('El Grupo ya se encuentra en la Base de Datos');
                        $('#edit_nombre').toggleClass('valid');
                        $('#edit_nivel').toggleClass('valid');
                        $('#edit_nombre').addClass('invalid');
                        $('#edit_nivel').addClass('invalid');
                    } else {
                        resultadoListarGrupos();                        
                    }
                    ocultarCargador();
                });
            } else{
                $('.error_edit').text('No puede dejar ningún campo vacio');
            }
        });
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
    
    function validarPassword(nodo, tam){
        var si_tamanio, si_letra, si_mayuscula, si_numero;
        var campo = nodo.val();
        
        //validar el tamaño
        if ( campo.length < tam ) {
            si_tamanio = false;
        } else {
            si_tamanio = true;
        }

        //validar que tiene letras
        if ( campo.match(/[A-z]/) ) {
            si_letra = true;
        } else {
            si_letra = false;
        }

        //validar que tiene mayúsculas
        if ( campo.match(/[A-Z]/) ) {
            si_mayuscula = true;
        } else {
            si_mayuscula = false;
        }
    
        //validar que tiene números
        if ( campo.match(/\d/) ) {
            si_numero = true;
        } else {
            si_numero = false;
        }
        
        if (si_tamanio && si_letra && si_mayuscula && si_numero){
            nodo.addClass('valid');
            return true;
        } else {
            nodo.addClass('invalid');
            $('.error_login').text('La contraseña debe tener minúsculas, mayúsculas y números');
            return false;
        }

    }
    
    

  $(document).on('change', ':file', function() {
    var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);

        $(':file').on('fileselect', function(event, numFiles, label) {

          var input = $(this).parents('.input-group').find(':text'),
              log = numFiles > 1 ? numFiles + ' files selected' : label;

          if( input.length ) {
              input.val(log);
          } else {
              if( log ) alert(log);
          }

      });
  });

}());