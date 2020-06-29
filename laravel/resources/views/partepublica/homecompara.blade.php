@extends('layouts.layoutPublica')
@section('content')
<div class="row mb-3" style="font-size:20px;">
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		<div >
			<b style="color:#000;">({{$softwares->count()}})</b> apps en total
		</div>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		<div class="text-right">
			Ordenar por:&nbsp;&nbsp;
			<select name="" class="d-inline">
				<option>Relevancia</option>
			</select>
		</div>
	</div>
</div>
<ul id="software-list" class="list" itemscope="" itemtype="https://schema.org/ItemList">
	<meta itemprop="numberOfItems" content="">
	@foreach($softwares as $key => $software)
	
<li class="list-item-new software-{{$software->id}}" data-mid="18233" itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem" data-sf="">
		<meta itemprop="position" content="0">
											<span class="new-verified-badge">
			<img src="https://dev.comparasoftware.com/platform/images/verificado-green.png" alt="Verificado">
			
		</span>
											<div class="row no-gutters">
			<div class="col-xs-12 col-sm-3">
				<div id="software-image-1690" class="software-image">
					<a href="{{$software->url}}">
						<img alt="Fracttal" class="img-thumbnail img-fluid" data-src="{{$software->imagen}}" src="{{$software->imagen}}">
					</a>
				</div>
				<div class="col-bottom" style="margin-top:15px;">
					<div class="rating text-center">
						<span class="stars-rate">
							<span class="stars-fill" style="width:88%;"></span>
						</span>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-7">
				<h2 class="title">
					<a href="{{$software->url}}" itemprop="url" class="ppc-provider-site" data-sid="{{$software->id}}" data-cid="{{$software->id}}" data-source="click">
						<span itemprop="name">{{$software->nombre}}</span>
						<i class="fa fa-external-link" style="font-size:17px;margin:0 0 0 10px;"></i>
					</a>
																</h2>
				<div class="excerpt">
					{{$software->descripcion}}
											<a href="{{$software->url}}">Ver mas de {{$software->nombre}}</a>
				</div>
				<div class="col-bottom">
					<a href="{{$software->url}}" id="software-more-info-1690" class="">
						Ver más información
						<i class="fa "></i>
					</a>
					|
					<a href="javascript:;" id="software-prices-1690" class="btn-form" data-code="Zm9ybS1wcmljZXM=" data-param_catid="140" data-param_sid="1690">
						Cotizar {{$software->nombre}}
					</a>
					|
					<a href="javascript:;" id="software-compare-1690" class="add-2-compare" data-id="1690" data-label="Fracttal" data-href="https://dev.comparasoftware.com/platform/fracttal" data-image="/wp-content/uploads/2018/08/logoFracttal-Box.png" data-in="Comparando" data-out="+ Añadir a comparación">
						+ Añadir a comparación
					</a>
				</div>
			</div>
			<div class="col-xs-12 col-sm-2">
				<div class="buttons" style="display:table-cell;vertical-align:middle;height:200px;text-align:center;">
				  	<a href="{{$software->url}}" target="_blank" id="software-website-1690" class="btn btn-block ppc-provider-site" data-sid="1690" data-cid="140" data-source="click">
						<i class="fa fa-external-link" style="font-size:25px;"></i>
						<span class="d-block">Ir a la web</span>
					</a>
																</div>
			</div>
		</div>
	</li>
	@endforeach
		
	
								</ul>
@endsection