<ul class="sidebar-menu menu" data-widget="tree">
    <li class="header">Navegacion</li>
		<?php
			// verifica q sea 'Admin' para dejar editar usuarios
			$role = $this->session->userdata('role');
			if($role == '1'){

				echo "<li><a href='".base_url('Login/usuarios')."'><i class='fa fa-user'></i>Administracion usuarios</a></li>";
			}
		?>

		<li class="treeview">
        <a href="#">
            <i class="fa  fa-circle-o"></i> <span>Arbolado ABM</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="#" class="link" data-link="Area"><i class="fa fa-fw fa-map"></i> Areas Geográficas</a></li>
            <li><a href="#" class="link" data-link="Departamento"><i class="fa fa-fw fa-cubes"></i> Departamentos</a></li>
            <li><a href="#" class="link" data-link="Manzana"><i class="fa fa-fw fa-cubes"></i> Manzanas</a></li>
            <li><a href="#" class="link" data-link="Calle"><i class="glyphicon glyphicon-road "></i> Calles</a> </li>
            <li><a href="#" class="link" data-link="Arbol"><i class="glyphicon glyphicon-tree-conifer"></i> Tipo de Arboles</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa  fa-circle-o"></i> <span>Censos</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="#" class="link" data-link="Censo/Nuevo"><i class="fa fa-fw fa-cubes"></i> Nuevo Censo</a></li>
            <li><a href="#" class="link" data-link="Censo"><i class="fa fa-fw fa-cubes"></i> Lista Censos</a></li>
        </ul>
    </li>
    <li class="treeview">
         <a href="#">
            <i class="fa  fa-circle-o"></i> <span>Reportes</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">            
             <li><a href="#" class="link" data-link="Reporte"><i class="fa fa-bar-chart"></i>Reporte Total</a></li>
             <li><a href="#" class="link" data-link="Reporte/listar_gral_1"><i class="fa fa-bar-chart"></i>Reporte Gral. 1</a></li>
             <li><a href="#" class="link" data-link="Reporte/listar_gral_2"><i class="fa fa-bar-chart"></i>Reporte Gral. 2</a></li>
        </ul>
    </li>
    <li><a href="#" class="link" data-link="Mapa"><i class="fa fa-fw fa-map"></i> Mapa</a></li>
</ul>