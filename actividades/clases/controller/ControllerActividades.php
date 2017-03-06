<?php

class ControllerActividades extends Controller {
    
    function userpage(){
        $pagina = Request::read('pagina');
        $this->viewactividades($pagina);
    }
    
    function viewactividades($pagina){
        $total = $this->getModel()->countUser();
        $controllerpage = new PageController($total, $pagina, $rpp = 7);
        
        $page = $controllerpage->getPage();
        if( $controllerpage->getPage() > $controllerpage->getPages() ){
            $page = $controllerpage->getPages();
        } else if( $controllerpage->getPage() < 1 ){
            $page = 1;
        }
        
        $fecha = $this->getModel()->getActividadesFecha();
        $actividades = $this->getModel()->getActividades($controllerpage->getPage());
        $this->getModel()->setData('actividades', $actividades);
        $this->getModel()->setData('fecha', $fecha);
        $this->getModel()->setData('page', $page);
        $this->getModel()->setData('pages', $controllerpage->getPages());
    }
    
    function viewact(){
        $idActividad = Request::read('id');
        $actividades = $this->getModel()->getActividad($idActividad);
        $this->getModel()->setData('actividad', $actividades);
    }
    
    function contentsidebar(){
        $grupos = $this->getModel()->getGrupos();
        $profesores = $this->getModel()->getProfesores();
        $actividades = $this->getModel()->getActividadesProximas();
        $meses = $this->getModel()->getActividadesMeses();
        $this->getModel()->setData('grupos', $grupos);
        $this->getModel()->setData('profesores', $profesores);
        $this->getModel()->setData('actividades', $actividades);
        $this->getModel()->setData('meses', $meses);
    }
    
    function listActividadesGrupo(){
        $readIdGrupo = Request::read('id');
        $actividades = $this->getModel()->getActividadesSidebar('grupo', $readIdGrupo);
        $this->getModel()->setData('actividades', $actividades);
    }
    
    function listActividadesProfesor(){
        $readIdProfesor = Request::read('id');
        $actividades = $this->getModel()->getActividadesSidebar('profesor', $readIdProfesor);
        $profesor = $this->getModel()->getDataProfesor($readIdProfesor);
        
        $this->getModel()->setData('actividades', $actividades);
        $this->getModel()->setData('profesor', $profesor);
    }
    
    function listActividadesDepartamento(){
        $readIdDepartamento = Request::read('id');
        $actividades = $this->getModel()->getActividadesSidebar('departamento', $readIdDepartamento);
        $this->getModel()->setData('actividades', $actividades);
    }
    
    
    function listActividadesMes(){
        $readMes = Request::read('mes');
        $actividades = $this->getModel()->getActividadesSidebarMes($readMes);
        
        $this->getModel()->setData('actividades', $actividades);
    }
    
    function actividadesentrefechas(){
        $readFechaA = Request::read('fechaa');
        $readFechaB = Request::read('fechab');
        $actividades = $this->getModel()->getActividadesEntreFechas($readFechaA, $readFechaB);
        $this->getModel()->setData('actividades', $actividades);
    }
    
    function busqueda(){
        $readTexto = Request::read('texto');
        
        $datosActividad = $this->getModel()->getBusquedaActividad($readTexto);
        $datosProfesor = $this->getModel()->getBusquedaProfesor($readTexto);
        $datosDepartamento = $this->getModel()->getBusquedaDepartamento($readTexto);
        $datosGrupo = $this->getModel()->getBusquedaGrupo($readTexto);
        
        $this->getModel()->setData('datosActividad', $datosActividad);
        $this->getModel()->setData('datosProfesor', $datosProfesor);
        $this->getModel()->setData('datosDepartamento', $datosDepartamento);
        $this->getModel()->setData('datosGrupo', $datosGrupo);
    }
    
}