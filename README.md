# FreeFood - Manuel Echavarria 

## Resumen de la aplicación

Se hizo una aplicación la cual de entrada tiene una landing page con un formulario de login (**Este no es un login funcional**), al presionar el botón de ingresar, este lleva a otra página donde se encuentra una pequeña tabla con los registros de la base de datos, además, de los botones de acción para el CRUD. Esta aplicación fue desarrollada bajo CodeIgniter (**PHP**) en su versión 4.1.9, JavaScript, AJAX y manejo de JSON.

Como resultado esta cumple con todo lo solicitado por el equipo de reclutamiento, ya que permite agregar, editar, leer y borrar registros, además, valida campos requeridos, contiene un search el cual busca por todas las columnas de la tabla, filtra por edad y nombre (**Por defecto viene ordenado por ID de manera ascendente**) y, por último, cuenta con un paginador de registros.

## Librerías usadas

- **JQuery:** es una librería de JavaScript diseñada para simplificar la manipuilación del DOM. Dentro del proyecto es utilizada un poco para la manipulaciónd del DOM y para algunas librerías que dependen de ella.

- **Boostrap:** este es un framework front-end, el cual permite desarrollar aplicaciones Web y sitios móviles firts. Dentro del proyecto es usado para hacer uso de un desarrollo más ágil y responsive, ya que se utilizaron muchas clases pertenecientes a este.

- **Select picker:** este es un plugin de basado en JQuery que trabaja con los selects. Dentro del proyecto es utilizada para estilizar un poco los select, por lo general la uso para proyectos que demanden de select dinámicos.

- **DataTables:** este es un plugin que utiliza JQuery para la creación de tablas con paginación, búsqueda, entre otras características. Dentro del proyecto fue utilizado para aprovechar las características que este ofrece de: búsqueda, paginación, filtro de columnas y convertir la tabla de registros responsive de manera relativamente sencilla. 

    - Tambien dentro del proyecto existen los siguientes plugins para DataTables:
        - DataTables bs4: sirve para dar estilos de Bootstrap 4 al datatable. 
        - DataTables responsives: sirve para convertir la tabla responsives a dispositivos móviles.

- **Font Awesome:** es una toolkit de íconos basados en CSS. Dentro del proyecto es usado para implementar algunos íconos y hacer las páginas un poco más user Firendly.

- **Sweet Alert:** es un plugin de JQuery con el cual podemos dar un aspecto profesional a las alertas con JavaScript. Dentro del proyecto fue utilizado para estilizar las alertas.

## Pasos requeridos para montar la app en un entorno

Pasos a seguir:
- Lo primero que debemos hacer es poner la carpeta del proyecto dentro de las carpetas del servidor (XAMPP, laragon, etc).
- Importar la base de datos a nuestra SGBD, esta se encuentra dentro del proyecto con el nombre `bd_freefood.sql`.
- Una vez configurada la base de datos, nos dirigimos a nuestro archivo .env (Dentro del proyecto) y ponemos las credenciales de nuestro usuario de la base de datos, por defecto está el usuario **root** sin contraseña, en caso de tener otro usuario deberán configurarlo ahí, además está configurado para un SGBD MySQL, como phpMyAdmin, heidyDB, etc.

**Con esto sería suficiente para que la app funcione, si presentan inconvenientes pueden escribir a mi correo o llamarme sin ningún problema**

## Estructura del proyecto

- FreeFood
    - app
        - Controllers
        - Models
        - View
            - Templates
                - Modals
                    - Aquí se encuentran todos los modales utilizados
                - header
                - footer
    - dist
        - css
        - img
        - js
    - plugins (Dentro de esta carpeta se encuentran todas las librerías y plugins utilizados)
    - .env 
    - bd_freefood
    - README.md

## URL de acciones

**post** este nos permite crear un nuevo registro para poderla implementar seria de la siguiente forma (con datos de ejemplo):
- http://localhost/FreeFood/Residentes/post?idResidente=&txtNombres=prueba&txtApellidos=prueba&intEdad=12&intTelefono=8099051413&txtCorreo=m.alejandro%40gmail.com&txtDireccion=prueba&txtObservacion=prueba+&listStatus=1 

**put** este nos permite modificar un registro, para poderla implementar seria de la siguiente forma (con datos de ejemplo):
- http://localhost/FreeFood/Residentes/put?idResidente=1&txtNombres=prueba&txtApellidos=prueba&intEdad=12&intTelefono=8099051413&txtCorreo=m.alejandro%40gmail.com&txtDireccion=prueba&txtObservacion=prueba+&listStatus=1 

**delete** este nos permite eliminar un registro, para poderla implementar seria de la siguiente forma:
- http://localhost/FreeFood/Residentes/delete/idRegistro=1

**Cabe destacar que los metodos post, put y delete validan de que se hagan un POST de lo contrario no se podrá hacer nada**

**get** esta nos permite modificar un obtener registros, para poderla implementar seria de la siguiente forma:
- Traer todos los registros: 
    - http://localhost/FreeFood/Residentes/get

- Traer un solo registro:
    - http://localhost/FreeFood/Residentes/get/1