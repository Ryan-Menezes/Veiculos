@can($can)
<div class="col-lg-4 col-6">
    <!-- small box -->
    <div class="small-box {{ $class }}">
        <div class="inner">
            <h3>{{ $content }}</h3>

         	 <p>{{ $title }}</p>
        </div>
      	<div class="icon">
        	  <i class="{{ $icon }}"></i>
      	</div>
      	<a href="{{ route($route) }}" class="small-box-footer">Mais Informações <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
@endcan