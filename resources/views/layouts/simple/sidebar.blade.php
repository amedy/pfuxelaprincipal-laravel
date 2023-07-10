<div class="sidebar-wrapper">
	<div>
		<div class="logo-wrapper">
            <a href="{{route('/')}}"><h6 class="f-w-900">Sistema Pfuxela</h6> </a>
			{{-- <a href="{{route('/')}}"><img class="img-fluid for-light" src="{{asset('assets/images/logo/logo.png')}}" alt=""><img class="img-fluid for-dark" src="{{asset('assets/images/logo/logo_dark.png')}}" alt=""></a> --}}
			<div class="back-btn"><i class="fa fa-angle-left"></i></div>
			<div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
		</div>
		<div class="logo-icon-wrapper"><a href="{{route('/')}}"><img class="img-fluid" src="{{asset('assets/images/logo/logo-icon.png')}}" alt=""></a></div>
		<nav class="sidebar-main">
			<div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
			<div id="sidebar-menu">
				<ul class="sidebar-links" id="simple-bar">
					<li class="back-btn">
						<a href="{{route('/')}}"><img class="img-fluid" src="{{asset('assets/images/logo/logo-icon.png')}}" alt=""></a>
						<div class="mobile-back text-end"><span>Voltar</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
					</li>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title {{request()->route()->getPrefix() == '/dashboard' ? 'active' : '' }}" href="{{route('dashboard')}}"><i data-feather="home"></i><span class="lan-3">{{ trans('lang.Dashboard') }}</span></a>
					</li>
                    @foreach ($categorias as $categoria)
                        <li class="sidebar-main-title">
                            <div>
                                <h6 class="lan-8">{{ $categoria->nome }}</h6>
                                <p class="lan-9">{{ $categoria->descricao }}</p>
                            </div>
                        </li>
                        @foreach ($menus as $menu)
                            @if ($categoria->id == $menu->categoria_id)
                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title {{request()->route()->getPrefix() == '/' . $menu->prefix ? 'active' : '' }}" href="#"><i class="icofont icofont-{{ $menu->icon }}"></i><span class="lan-3">  {{ $menu->nome }}</span>
                                        <div class="according-menu"><i class="fa fa-angle-{{request()->route()->getPrefix() == '/' . $menu->prefix }}' ? 'down' : 'right' }}"></i></div>
                                    </a>
                                    <ul class="sidebar-submenu" style="display: {{ request()->route()->getPrefix() == '/' . $menu->prefix ? 'block;' : 'none;' }}">
                                        @foreach ($submenus as $submenu)
                                            @if ($submenu->menu_id == $menu->id && $submenu->sidebar == 1)
                                                <li><a class="lan-4 {{ Route::currentRouteName()==$submenu->route ? 'active' : '' }}" href="{{route($submenu->route)}}">{{ $submenu->nome }}</a>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            @endif
                        @endforeach
                    @endforeach
				</ul>
			</div>
			<div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
		</nav>
	</div>
</div>
