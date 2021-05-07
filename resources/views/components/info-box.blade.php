<div class="info-box">
    <span class="info-box-icon {{$bgClass}} elevation-1"><i class="fas {{isset($icon)?$icon:"fa-cog"}}"></i></span>

    <div class="info-box-content">
        <span class="info-box-text">{{$slot}}</span>
        <span class="info-box-number">
                  {{$count ?? 0}}
                  <small>{{$unit ?? ""}}</small>
                </span>
    </div>
</div>
