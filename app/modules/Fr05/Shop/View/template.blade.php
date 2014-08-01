<!doctype>
<html>
<head>
<meta charset="utf-8">
<link href="{{ URL::asset('public/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('public/css/shop/style.css') }}" rel="stylesheet">
<link href="{{ URL::asset('public/css/my-classes.css') }}" rel="stylesheet">
<link href="{{ URL::asset('public/css/jquery-ui.min.css') }}" rel="stylesheet">
<script src="{{ URL::asset('public/js/jquery-1.11.1.min.js') }}"></script>
<script src="{{ URL::asset('public/js/jquery-ui-1.11.1.min.js') }}"></script>
<script src="{{ URL::asset('public/js/cart.js') }}"></script>
<!-- Add fancyBox -->
<link rel="stylesheet" href="{{ URL::asset('public/js/fancybox/source/jquery.fancybox.css?v=2.1.5') }}" type="text/css" media="screen" />
<script type="text/javascript" src="{{ URL::asset('public/js/fancybox/source/jquery.fancybox.js?v=2.1.5') }}"></script>
<script src="{{ URL::asset('public/js/cookies.js') }}"></script>
</head>
<body>
	<div id="fancyDiv" style="display:none;">
		<h2>Welcome to Fr05_Team3 Shop!</h2>
	</div>
	<a id="fancyLink" href="#fancyDiv"></a>
    <!--    BEGIN   :   TOP NAVBAR  -->
    <nav id="navbar-top" class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-nav-container">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="glyphicon glyphicon-align-right"></span>
                </button>
                <a class="navbar-brand" href="{{ URL::to('') }}">
                    <span>
                        <strong class="text-orange" style="font-size: 2em;">MEDIA</strong> Center
                    </span>
                </a>
            </div>
            <div id="navbar-nav-container" class="collapse navbar-collapse">
                <form class="navbar-form navbar-left col-sm-4" role="search">
                    <div class="input-group">
                        <input type="search" class="form-control" name="keyword" id="keyword">
                        <span type="submit" class="input-group-btn">
                            <button class="btn btn-default">
                                &nbsp;<span class="glyphicon glyphicon-search"></span>
                            </button>
                        </span>
                    </div>
                </form>
                <hr class="visible-xs">
                <div class="navbar-right">
                    <a href = "{{ URL::to('/cart') }}" class="btn btn-default navbar-btn margin-right-15">
                        <span class="glyphicon glyphicon-shopping-cart"></span> My Cart
                        <span id="countCart">({{ Fr05\Service\CartService::getTotalQuantity() }})</span>
                    </a>
                    <div class="btn-group pull-right">
                        <a href="{{ URL::to('auth/login') }}" class="btn btn-default navbar-btn">Login</a>
                        <a class="btn btn-default navbar-btn">Register</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!--    END:    :   TOP NAVBAR  -->
    
     <!--    BEGIN   :   CATEGORIES NAVBAR   -->
    <nav id="navbar-categories" class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#categories-nav-container">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="glyphicon glyphicon-align-right"></span>
                </button>
                <a class="navbar-brand" href="{{ URL::to('/search') }}?category_id=0">
                    <span>
                        Categories:
                    </span>
                </a>
            </div>
            <div id="categories-nav-container" class="collapse navbar-collapse">
            	<ul id="top-nav" class="nav navbar-nav navbar-right">
            	
            		<?php $currentIndex = 0; ?>
            		
            		@foreach (Fr05\Service\CategoryService::getAllTopLevel() as $topLevelCategory)
            		<li class="dropdown">
            			<a href="{{ URL::to('/search') }}?category_id={{$topLevelCategory->id}}">{{ $topLevelCategory->name }} ({{ $topLevelCategory->products->count() }})</a>
            			<!-- BEGIN:	SUB MENU -->
            			@if ($topLevelCategory->children->count())
	            			<ul class="dropdown-menu">
	            				@foreach ($topLevelCategory->children as $firstLevelChild)
		            				<li class="col-sm-4">
		            					<a href="{{ URL::to('/search') }}?category_id={{$firstLevelChild->id}}"><strong>{{ $firstLevelChild->name }} ({{ $firstLevelChild->products->count(0) }})</strong></a>
		            					
		            					@if ($firstLevelChild->children)
		            					<ul>
		            						@foreach ($firstLevelChild->children as $secLevelChild)
		            							<li><a href="{{ URL::to('/search') }}?category_id={{$secLevelChild->id}}">{{ $secLevelChild->name }} ({{ $secLevelChild->products->count() }})</a></li>
		            						@endforeach
		            					</ul>
		            					@endif
		            				</li>
		            				@if (++ $currentIndex == 3)
		            					<div class="clearfix"></div>
		            					<?php $currentIndex = 0; ?>
		            				@endif
	            				@endforeach
	            			</ul>
            			@endif
            			<!-- END:	SUB MENU -->
            		</li>
            		@endforeach
            	</ul>	
            </div>
        </div>
    </nav>
    <!--    END     :   CATEGORIES NAVBAR   -->
    
    
    
    <!--    BEGIN   :   CONTENT -->
    @yield('content')
    <!--    END   :   CONTENT   -->
    
    <!-- BEGIN:	FOOTER -->
    <div class="container">
    	<hr>
    	<div class="row">
    		<div class="col-xs-6">
    			<a class="navbar-brand padding-left-0" href="{{ URL::to('') }}">
                    <span>
                        <strong class="text-orange" style="font-size: 2em;">MEDIA</strong> Center
                    </span>
                </a>
    		</div>
    		<div class="col-xs-6 ha-right">
                <span>Tel.: (+84) 0166-202-9147</span>
    			<h4>Copyright © 2014 FR05/Team3 - Mock Pro-Shop</h4>
    		</div>
    	</div>
    </div>
    <!-- END:	FOOTER -->
</body>
<script src="{{ URL::asset('public/bootstrap/js/bootstrap.min.js') }}"></script>
<script>
	$('.carousel-indicators li').first().addClass('active');
	$('.carousel-inner .item').first().addClass('active');
</script>

</html>