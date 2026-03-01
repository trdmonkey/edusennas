<?php

return [
    'admin-user' => [
        'title' => 'Users',

        'actions' => [
            'index' => 'Users',
            'create' => 'New User',
            'edit' => 'Edit :name',
            'edit_profile' => 'Edit Profile',
            'edit_password' => 'Edit Password',
        ],

        'columns' => [
            'id' => 'ID',
            'last_login_at' => 'Last login',
            'first_name' => 'First name',
            'last_name' => 'Last name',
            'email' => 'Email',
            'password' => 'Password',
            'password_repeat' => 'Password Confirmation',
            'activated' => 'Activated',
            'forbidden' => 'Forbidden',
            'language' => 'Language',
                
            //Belongs to many relations
            'roles' => 'Roles',
                
        ],
    ],

    'user' => [
        'title' => 'Users',

        'actions' => [
            'index' => 'Users',
            'create' => 'New User',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'email_verified_at' => 'Email verified at',
            'password' => 'Password',
            'rol' => 'Rol',
            'estado' => 'Estado',
            'color' => 'Color',
            
        ],
    ],

    'categorium' => [
        'title' => 'Categorías',

        'actions' => [
            'index' => 'Listado de Categorías',
            'create' => 'Nueva Categoría',
            'edit' => 'Editar Categoría: :name',
        ],

        'columns' => [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'slug' => 'Slug',
            'descripcion' => 'Descripción',
            'estado' => 'Estado',
        ],
    ],

    'palabra' => [
        'title' => 'Palabra',

        'actions' => [
            'index' => 'Listado de Palabras',
            'create' => 'Nueva Palabra',
            'edit' => 'Editar Palabra: :name',
        ],

        'columns' => [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'slug' => 'Slug',
            'descripcion' => 'Descripción',
            'estado' => 'Estado',
            'estado_texto' => 'Estado',
            'link' => 'Link',
            'categoria_id' => 'Categoria',
        ],
    ],

    // Do not delete me :) I'm used for auto-generation
];