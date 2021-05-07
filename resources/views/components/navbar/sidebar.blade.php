<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('home.index')}}" class="brand-link">
        <img src="{{asset('assets/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">
            {{request()->user()->reseller->isp->name??"ISP NAME"}}:{{request()->user()->reseller->name??"Reseller Name"}}
        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->


                @foreach(\App\Models\System\Menu::where('parent_id',null)->orderBy('order','ASC')->with('children')->get() as $parent)

                    @if($parent->permission)
                        @can($parent->permission)
                            <x-navbar.menu-item
                                :url="$parent->route?Route::has($parent->route)?route($parent->route,$parent->route_attribute):'?routeerror':'#'"
                                :icon="$parent->icon??'fa-home'" name="{{$parent->name}}"
                                                :parent="count($parent->children)??0">
                                <ul class="nav nav-treeview">
                                    @foreach($parent->children as $child)
                                        @if($child->permission)
                                            @can($child->permission)
                                                <x-navbar.menu-child-item
                                                    :url="$child->route?route($child->route,$child->route_attribute):'#'"
                                                    :name="$child->name"/>
                                            @endcan
                                        @endif
                                    @endforeach
                                </ul>
                            </x-navbar.menu-item>
                        @endcan
                    @else
                        <x-navbar.menu-item
                            :url="$parent->route?Route::has($parent->route)?route($parent->route,$parent->route_attribute):'?routeerror':'#'"
                            :icon="$parent->icon??'fa-home'" name="{{$parent->name}}"
                                            :parent="count($parent->children)??0">
                            <ul class="nav nav-treeview">
                                @foreach($parent->children as $child)
                                    <x-navbar.menu-child-item
                                        :url="$child->route?route($child->route,$child->route_attribute):'#'"
                                        :name="$child->name"/>

                                @endforeach
                            </ul>
                        </x-navbar.menu-item>
                    @endif
                @endforeach
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
