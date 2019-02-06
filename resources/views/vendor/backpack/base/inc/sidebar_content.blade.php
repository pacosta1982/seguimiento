<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li><a href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>
<!-- Users, Roles Permissions -->
<li class="treeview">
    <a href="#"><i class="fa fa-group"></i> <span>Users, Roles, Permissions</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
      <li><a href="{{ backpack_url('user') }}"><i class="fa fa-user"></i> <span>Users</span></a></li>
      <li><a href="{{ backpack_url('role') }}"><i class="fa fa-group"></i> <span>Roles</span></a></li>
      <li><a href="{{ backpack_url('permission') }}"><i class="fa fa-key"></i> <span>Permissions</span></a></li>
    </ul>
  </li>
<li><a href='{{ backpack_url('category') }}'><i class='fa fa-gear'></i> <span>Categorias</span></a></li>
<li><a href='{{ backpack_url('items') }}'><i class='fa fa-tag'></i> <span>Rubros</span></a></li>
<li><a href='{{ backpack_url('proyrubro') }}'><i class='fa fa-tag'></i><span>Rubros Proyectos</span></a></li>
<li><a href='{{ backpack_url('unidad') }}'><i class='fa fa-tag'></i><span>Unidades</span></a></li>
<li><a href='{{ backpack_url('program') }}'><i class='fa fa-tag'></i> <span>Programas</span></a></li>