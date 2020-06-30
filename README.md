# Crud de Items y filtros , en vue, portal de admin y  portal publico 



## Installation

``` bash
# clonar  el repo
$ git clone https://github.com/simp06/comparasoftware.git my-project

# ir al directorio laravel
$ cd my-project/laravel

# instalar las dependencias de laravel
$ composer install

# instalar las dependencias de node , es requisito tener instalados node
$ npm install
```

### Configuracion de base de datos


Copiar archivo  ".env.example", cambiar el nombre a  ".env".

* DB_CONNECTION=mysql
* DB_HOST=127.0.0.1
* DB_PORT=3306
* DB_DATABASE=database
* DB_USERNAME=root
* DB_PASSWORD=


### Siguiente paso 

``` bash
# en el directorio laravel 
# generar laravel APP_KEY
$ php artisan key:generate

# generar jwt secret
$ php artisan jwt:secret

# correr migraciones y  seeders
$ php artisan migrate:refresh --seed

```

```bash
#  ir a coreui
$ cd ../coreui

# instalar dependendias del front
$ npm install

```

``` bash
# Regresar al directorio laravel
$ cd ../laravel

# generar mixing
$ npm run dev

# y repetir el mixing
$ npm run dev
```

## Ejecutar laravel

``` bash
# ejecutar el proyecto en el servidor local
$ php artisan serve

```
## Ejecutar Admin
Abrir localhost direccion: [localhost:8000/admin](localhost:8000/admin)  
 
* Username : admin
* Password: password

--- 

## Componentes y controladores

### Componentenes:
* CreateSoftware
* EditSoftware
* Softwares
### Controladores:
* SoftwareController
* ComparaController


#### SoftwareController
Controlador usado para la api de software

#### ComparaController
Controlador usado para la parte publica 

### Filtros 
Los filtros fueron creados por separados es decir existen filtros de lenguajes y de funcionalidades, no se considero como una sola entedidad.

### Templates Blade 
  * -- views/layoutPublica
  * -- views/partepublica
  *  --- views/partepublica/filtros
  *  --- views/partepublica/footer
  *  --- views/partepublica/homecompara



## Links

**Admin**

* <localhost:port/admin>


**Publica**

* <localhost:port/compara>

## Copyright and license

copyright 2018 creativeLabs Łukasz Holeczek. Code released under [the MIT license](https://github.com/coreui/coreui-free-laravel-admin-template/blob/master/LICENSE).
There is only one limitation you can't can’t re-distribute the CoreUI as stock. You can’t do this if you modify the CoreUI. In past we faced some problems with persons who tried to sell CoreUI based templates.

