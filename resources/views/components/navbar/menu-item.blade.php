@if(isset($parent) and $parent>=1)
    <li class="nav-item {{isset($open)?"menu-open":""}}">
        <a href="{{isset($url)?$url:"#"}}" class="nav-link {{isset($active)?"active":null}}">
            <i class="nav-icon fas {{$icon}}"></i>
            <p>
                {{$name}}
                @if(isset($parent) and $parent>=1)
                    <i class="right fas fa-angle-left"></i>
                @endif
            </p>
        </a>
        {{$slot}}
    </li>
@else
    <li class="nav-item">
        <a href="{{isset($url)?$url:"#"}}" class="nav-link {{isset($active)?"active":null}}">
            <i class="nav-icon fas {{$icon}}"></i>
            <p>
                {{$name}}
            </p>
        </a>
    </li>

@endif
