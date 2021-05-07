<li class="nav-item">
    <a href="{{isset($url)?$url:"#"}}" class="nav-link {{isset($active)?"active":""}}">
        <i class="far {{isset($icon)?$icon:"fa-circle"}} nav-icon"></i>
        <p>{{$name}}</p>
    </a>
</li>
