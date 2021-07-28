@section('meta')
<title>
    Gallery | FeedThePoor - Donate money confidently and Transparently
</title>
@endsection



@section('title')

@endsection



@section('css')

.gird-item{
 display: flex;
 align-items: center;
 justify-content: center;
 background-color: #354F90;
 border-radius: 4px;
 transition: transform 0.3s ease-in-out;
background-size: cover;
background-position: center;
background-repeat: no-repeat;
}
.ejercico a {
	opacity: 0;
	text-decoration:none;
	cursor: none;
}
.gird-item:hover .ejercico a {
	color: white;
	opacity: 1;
	
}
.gird-item:hover {
	filter: opacity(0.9);
	transform: scale(1.04);
}
.gird-container{
	display: grid;
	grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
	 grid-auto-rows: minmax(150px, auto);
	 gap:15px; 
	 padding: 10px;
	 grid-auto-flow: dense; 
}
@media(min-width: 100px){
.wide {
	grid-column: span 2;
}
.tall {
	grid-row: span 2;
}
}
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />

@endsection



@section('content')
<br>
<br><br><br><br>
<br><br>
    <h1  class="display-3 text-center">Gallery</h1>
  <hr />
  <h4 class="display-6 text-center"><small class="text-muted">quots for feed the poor</small></h4>
<br><br>
<div class="gird-container">

  <div class="gird-item tall">
    <div class="ejercico">
    <a data-fancybox="gallery" href="img\cover-forgot-password.png" data-caption="image"><img src="img\cover-forgot-password.png"></a>
    </div>
  </div>

  <div class="gird-item" >
    <div class="ejercico">
     <a data-fancybox="gallery" href="img\cover-forgot-password.png" data-caption="image"><img src="img\cover-forgot-password.png"></a>
    </div>
  </div>
  <div class="gird-item">
    <div class="ejercico">
        <a data-fancybox="gallery" href="img\cover-forgot-password.png" data-caption="image"><img src="img\cover-forgot-password.png"></a>
    </div>
  </div>
  <div class="gird-item" >
    <div class="ejercico">
      <a data-fancybox="gallery" href="img\cover-forgot-password.png" data-caption="image"><img src="img\cover-forgot-password.png"></a>
    </div>
  </div>
  <div class="gird-item wide">
    <div class="ejercico">
        <a data-fancybox="gallery" href="img\cover-forgot-password.png" data-caption="image"><img src="img\cover-forgot-password.png"></a>
    </div>
  </div>
  <div class="gird-item tall">
    <div class="ejercico">
        <a data-fancybox="gallery" href="img\cover-forgot-password.png" data-caption="image"><img src="img\cover-forgot-password.png"></a>
    </div>
  </div>
  <div class="gird-item">
    <div class="ejercico">
        <a data-fancybox="gallery" href="img\cover-forgot-password.png" data-caption="image"><img src="img\cover-forgot-password.png"></a>
    </div>
  </div>
</div>
@endsection



@section('js')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

<script>
$.fancybox.defaults.animationEffect = "fade";
$('[data-fancybox="gallery"]').fancybox({
	thumbs : {
		autoStart : true
	}
    transitionEffect: "fade",
    transitionDuration: 366,
    animationEffect: "zoom",
    animationDuration: 366,
});
 </script>
@endsection