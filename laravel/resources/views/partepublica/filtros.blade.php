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
<script>
    (function()
    {
        function doFilter()
        {
            //Array que guardaran los filtros checkeaods
            let searchIdsLenguajes = [];
            let searchIdsFuncionalidades = [];
            //Agregue un id para identificar los filtros de lenguajes con los de funcionalidades
            document.querySelectorAll('#feature-childs-1-lenguajes .filter-value:checked').forEach((cb) => 
            {
                searchIdsLenguajes.push(cb.value);
            });
            document.querySelectorAll('#feature-childs-pf  .filter-value:checked').forEach((cb) => 
            {
                searchIdsFuncionalidades.push(cb.value);
            });
            let mostrarSoftware= false;
           
            document.querySelectorAll('#software-list > li').forEach( (el) => 
            {
                if( searchIdsLenguajes.length <= 0  && searchIdsFuncionalidades.length <= 0)
                {
                    el.classList.remove('d-none');
                }
                else
                {
                    let sf_lenguajes = JSON.parse(el.dataset.sf_lenguaje);
                    let sf_funcionalidades = JSON.parse(el.dataset.sf_funcionalidad);
                    
                    let containsLenguaje = false;
                    let containsFuncionalidades = false;
                    
                
            
                    for(let i=0; i<searchIdsLenguajes.length; i++){
                        //Busco que lenguajes está seleccionado 
                            let existe = sf_lenguajes.find(function(lenguaje, index) {
                            if(lenguaje.lenguaje_id == searchIdsLenguajes[i])
                                return true;
                            });
                            if( typeof existe !="undefined"){
                                //Si existe es distinto a undefined muestra el software
                                containsLenguaje = true;
                                break;   
                            }
                        }
                        for(let i=0; i<searchIdsFuncionalidades.length; i++){
                        //Busco que las funcionalidades seleccionadasw está seleccionado 
                            let existe = sf_funcionalidades.find(function(funcionalidad, index) {
                            if(funcionalidad.funcionalidad_id == searchIdsFuncionalidades[i])
                                return true;
                            });
                            if( typeof existe !="undefined"){
                                //Si existe es distinto a undefined muestra el software
                                containsFuncionalidades = true;
                                break;   
                            }
                        }
                    if(  ((containsLenguaje && searchIdsLenguajes.length > 0)   && (containsFuncionalidades && searchIdsFuncionalidades.length > 0)) || ((containsLenguaje && searchIdsFuncionalidades.length == 0) || (containsFuncionalidades && searchIdsLenguajes.length == 0))  ){
                        el.classList.remove('d-none');
                    }else{
                        el.classList.add('d-none');
                    }
                }
                
            });
        }
        document.querySelectorAll('#feature-childs-1-lenguajes .filter-value').forEach( (cb) => 
        {
            cb.addEventListener('click', function(e)
            {
                doFilter();	
            });
        });
        document.querySelectorAll('#feature-childs-pf .filter-value').forEach( (cb) => 
        {
            cb.addEventListener('click', function(e)
            {
                doFilter();	
            });
        });
    })();
    </script>