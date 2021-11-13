<div class="card border-primary">
	<div class="card-header text-white bg-primary">Menú</div>
	<div class="card-body">
		<ul class="nav flex-column nav-pills ">
			@if (auth()->check())
				<li @if (request()->is('home')) class="nav-link active" @endif  class="nav-link list-group-item-action ">
					<a href="/home">Dashboard</a>
				</li>

				@if(! auth()->user()->is_client)
				<li @if (request()->is('ver')) class="nav-link active" @endif class="nav-link list-group-item-action">
					<a href="/incidencias">Ver Incidencias</a>
				</li>
				@endif

				<li @if (request()->is('reportar')) class="nav-link active" @endif class="nav-link list-group-item-action">
					<a href="/reportar"  >Reportar Incidencias</a>
				</li>

				@if(auth()->user()->is_admin)
				<li role="presentation" class="nav-link list-group-item-action dropdown">
					<a class="dropdown-toggle"  data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
					  Administración <span class="caret"> </span>
					</a>
					<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
					  <li ><a href="/usuarios" class="nav-link list-group-item-action">Usuario</a></li>
					  <li ><a href="/proyectos" class="nav-link list-group-item-action">Proyectos</a></li>
					  {{-- <li ><a href="/config" class="nav-link list-group-item-action">Configuración</a></li> --}}
					</ul>
				</li>
				@endif
			@else
				<li class="nav-link list-group-item-action"><a href="#" >Bienvenido</a></li>
				<li class="nav-link list-group-item-action"><a href="#" >Instrucciones</a></li>
				<li class="nav-link list-group-item-action"><a href="#" >Créditos</a></li>
			@endif
			{{-- <li><a href="#" class="list-group-item list-group-item-action"class="list-group-item list-group-item-action">Administración</a></li> --}}
		</ul>
	</div>
</div>


