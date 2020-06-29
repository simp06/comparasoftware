<div class="widget">
    <div id="filter-card" class="card">
        <div class="card-header"><h5 class="card-title">Filtros de busqueda</h5></div>
                                <ul class="feature-box">
            <li>
                <a href="#feature-childs-1-lenguajes" data-toggle="collapse">
                    <i class="fa lenguage"></i> Lenguage
                </a>
                
                <ul id="feature-childs-1-lenguajes" class="feature-items collapse multi-collapse ">
                    @foreach($lenguajes as $id=>$lenguaje)  
                    <li>
                        <div class="custom-control custom-checkbox custom-control-solid filter">
                            <input class="custom-control-input filter-value" id="filter-lenguaje-{{$id}}" type="checkbox" name="" value="{{$id}}" />
                            <label class="custom-control-label filter" for="filter-cb-lenguaje-{{$id}}">{{$lenguaje}}</label>
                        </div>
                    </li>
                    @endforeach   
                </ul>
          </li>
        </ul>
        <ul  id="" class="feature-box">
            <li>
                <a href="#feature-childs-pf" data-toggle="collapse">
                    <i class="fa category-features"></i> Funcionalidades
                </a>
                <ul id="feature-childs-pf" class="feature-items collapse multi-collapse show">
                    @foreach($funcionalidades as $id => $funcionalidad)    
                    <li>
                        <div class="custom-control custom-checkbox custom-control-solid filter">
                        <input class="custom-control-input filter-value" id="filter-cb-funcionalidad-{{$id}}" type="checkbox" name="" value="{{$id}}" />
                            <label class="custom-control-label filter" for="filter-cb-funcionalidad-{{$id}}">{{$funcionalidad}}</label>
                        </div>
                    </li>
                    @endforeach   
               </ul>
            </li>
        </ul>
    </div>
</div>