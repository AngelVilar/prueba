# Prueba Mirai
Repositorio para prueba en WordPress de Mirai

### PRUEBA 1: Indicar el comando de WP-CLI que se debería lanzar para borrarlas. 🔧

Lo primero que debemos hacer es un backup por si acaso surge algún error. Para ello tenemos que estar en nuestro servidor en la ubicación correcta y lanzar el comando:

```wp db export tar -vczf nombredelbackup.gz .```

Una vez realizado esto el comando para borrar las tablas es el siguiente:

```wp site list --field=url | xargs -n1 -I % wp --url=% option delete fs_active_plugins fs_debug_mode fs_accounts fs_wsalp```

No he podido probarlo ya que no tengo ningún entorno multisite instalado actualmente pero la sintaxis es esa.

Además del CLI, un forma alternativa de hacerlo es buscando en phpMyadmin haciendo la búsqueda en la base de datos del multisite y hacer la búsqueda manual. Para ello he creado un usuario de prueba en CDMON y he hecho un multisite en wordpress www.pruebamirai.com.mialias.net usuario: prueba365  password: xOH6JV5K y para acceder a wordpress: usuario: mirai contraseña: prueba123 podéis acceder a su base de datos que he creado para comprobarla a través de PhpMyadmin con las claves: usuario: myprue3e581 contraseña: TCEiAcvD
www.pruebamirai.com/phpMyAdmin/
Ahí en phpMyAdmin buscaría las options que hay que borrar y hacerlo manualmente. Nos dará 3 resultados, uno por cada base de datos de cada site.

### PRUEBA 2: Código necesario que debería incluirse en el footer.php de un theme para que se muestre en un div los datos obtenidos por el plugin. Se puede ver dentro del plugin.⚙️

```/* Fución para la escritura en el footer */
add_action('wp_footer', 'mirai_footer');
function mirai_footer(){
   
// campos solicitados
    echo "<div style='color:#ffffff; background: #000000; text-align:center;'>";  
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
	echo "</div>";
    ?>
<?php
};
`
