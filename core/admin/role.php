<?php
$role = array(
    'slug' => 'min_editor',
    'name' => 'Editor Min',
    'capability' => array(
            'read'         => true,  // true allows this capability
            'edit_posts'   => true,
            'read_private_posts'   => true,
            'edit_private_posts'   => true,
            'edit_published_posts' => true, // Use false to explicitly deny
        )
);


function create_roles($role){
    add_role(
        $role['slug'],
        __( $role['name'] ),
        $role['capability']
    );
}


function remove_roles($role){
    //check if role exist before removing it
    if( get_role($role['slug']) ){
          remove_role( $role['slug'] );
    }
}

$capability = array(
    'edit_posts',
    'edit_private_posts',
    'read_private_posts',
    'edit_published_posts'
);

function add_capability($role, $capability){
    // global $wp_roles; // global class wp-includes/capabilities.php
    // $wp_roles->add_cap( $role, $capability ); 

    $curent_role = get_role( $role );
    foreach ($capability as $key => $value) {
        $curent_role->add_cap( $value );
    }
}

function remove_capability($role, $capability){
    // global $wp_roles; // global class wp-includes/capabilities.php
    // $wp_roles->add_cap( $role, $capability ); 

    $curent_role = get_role( $role );
    foreach ($capability as $key => $value) {
        $curent_role->remove_cap( $value );
    }
}
?>