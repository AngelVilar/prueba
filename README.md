# prueba
Repositorio para prueba en WordPress de Mirai
Prueba 1: Indicar el comando de WP-CLI que se debería lanzar para borrarlas. 

Lo primero que debemos hacer es un backup por si acaso surge algún error. Para ello lanzamos el comando:
nombreusuario@servidor [/WordPress/location] y dentro de la ubicación:

wp db export luego tar -vczf nombredelbackup.gz .
Una vez realizado esto el comando para borrar las tablas es el siguiente:

wp site list --field=url | xargs -n1 -I % wp --url=% option delete fs_active_plugins fs_debug_mode fs_accounts fs_wsalp

Para realizar la prueba lo primero ha sido crear un nuevo usuario en CDMON, un proveedor de hosting para poder realizarlo en un entorno de pruebas.

Al no tener acceso en este proveedor a SSH ni la terminal de consola no he podido probarlo, ya que no he querido probar en mi trabajo con ningún multisite para no cometer ningún error pero tiene que tener una sintaxis parecida.

Además del CLI, un forma alternativa de hacerlo es buscando en phpMyadmin haciendo la búsqueda en la base de datos del multisite y hacer la búsqueda manual. Para ello he creado un usuario de prueba en CDMON y he hecho un multisite en wordpress www.pruebamirai.com.mialias.net usuario: prueba365  password: xOH6JV5K y para acceder a wordpress: usuario: mirai contraseña: prueba123 podéis acceder a su base de datos que he creado para comprobarla a través de PhpMyadmin con las claves: usuario: myprue3e581 contraseña: TCEiAcvD
www.pruebamirai.com/phpMyAdmin/
Ahí en phpMyAdmin buscaría las options que hay que borrar y hacerlo manualmente. Para hacer estos pantallazos y ponerlo más claro he instalado un plugin que tenga las mismas variables para hacer la prueba, en este caso he encontrado alguno disponible de freemius.
 
Nos dará 3 resultados, uno por cada base de datos de cada site.
 
Examinamos la tabla para asegurarnos que es la que buscamos. Y procedemos a borrar manualmente.
Habrá que tener en cuenta casos puntuales como en el caso de fs_accounts,
además de los 3 sites que he creado también estará en el directorio general dentro de wp_sitemeta por tanto habrá que
borrarlo de ese registro también.

Todo este proceso podéis comprobarlo en el phpMyAdmin que os he compartido anteriormente.

PRUEBA 2: Código necesario que debería incluirse en el footer.php de un theme para que se muestre en un div los datos obtenidos por el plugin. Se puede ver dentro del plugin.

/* Fución para la escritura en el footer */
add_action('wp_footer', 'mirai_footer');
function mirai_footer(){
   
// campos solicitados    
    $fields = array('name', 'url', 'admin_email');
    $data = array();
    foreach($fields as $field) {
        $data[$field] = get_bloginfo($field);
        echo "".$data[$field]."";
        echo "</br>";  
    }
    // datos del post
    $post = get_post( $post );
    $title = isset( $post->post_title ) ? $post->post_title : '';
    $id    = isset( $post->ID ) ? $post->ID : 0;
    echo "".$title."";
    echo "</br>";
    echo "".$id."";   
    
  ?>
<?php
};
