# Backend Application con Symfony 6
***

## Configuración Inicial
***
Lo primero que debemos hacer es instalar el CLI de Symfony, siguiendo las instrucciones de su documentación oficial:

[https://symfony.com/download](https://symfony.com/download)

Una vez instalado el CLI, instalamos un proyecto limpio de Symfony utilizando el comando:

```shell
$ symfony new backend-application
```

En caso de tener problemas para instalar el CLI de Symfony, podemos instalar el nuevo proyecto usando ***composer***

```shell
$ composer create-project symfony/skeleton:"6.2.*" backend-application
```

> <small>***NOTA:*** Instalamos una versión mínima de Symfony para desarrollar nuestro proyecto, para tener una cantidad 
mínima de dependencias y poder ir agregando lo que necesitemos mientras avanzamos en el desarrollo, de esta manera, tendremos 
una solución liviana y con el código necesario para que haga lo que necesitamos, y no vamos a tener código ni dependencias 
que no necesitemos, con lo cual el proyecto estará construido de manera muy eficiente y tendrá un mejor rendimiento</small>


Una vez que tenemos instalado nuestro proyecto en su versión básica, vamos a instalar las dependencias que necesitamos:

```shell
$ composer require symfony/maker-bundle --dev
$ composer require symfony/orm-pack
$ composer require symfony/form
$ composer require symfony/debug-pack
$ composer require symfony/twig-pack
$ composer require symfony/webpack-encore-bundle
```

Ahora procedemos a instalar los componentes para tener completamente habilitado nuestro frontend:

```shell
$ npm install
```

> ***Nota:*** Para habilitar completamente los componentes de front (bootstrap) para formularios vamos a hacer lo siguiente:

1. Instalamos bootstrap en nuestro proyecto, ejecutando:

    ```shell
    $ npm install bootstrap --save-dev
    ```

2. En el archivo ***assets/styles/app.css*** agregamos:

    ```css
    @import 'bootstrap';
    ```

3. Luego en el archivo ***config/packages/twig*** agregamos la siguiente línea dentro del bloque **_twig_**

    ```yaml
      twig:
        form_themes: ['bootstrap_5_layout.html.twig']
    ...
    ```

4. Por ultimo, ejecutamos en la consola el comando:

    ```shell
    $ npm run dev
    ```
   

## Sistema de Datos
***

Ahora vamos a configurar nuestro sistema de datos.

1. Vamos a iniciar nuestra configuración comentando las lineas de configuración de BBDD del archivo .env:
   ```dotenv
   ###> doctrine/doctrine-bundle ###
   # Format described at https://www.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/configuration.html#connecting-using-a-url
   # IMPORTANT: You MUST configure your server version, either here or in config/packages/doctrine.yaml
   #
   # DATABASE_URL="sqlite:///%kernel.project_dir%/var/data.db"
   # DATABASE_URL="mysql://app:!ChangeMe!@127.0.0.1:3306/app?serverVersion=8&charset=utf8mb4"
   # DATABASE_URL="postgresql://app:!ChangeMe!@127.0.0.1:5432/app?serverVersion=15&charset=utf8"
   ###< doctrine/doctrine-bundle ###
   ```
2.  Generamos nuestro archivo de variables de entorno, para eso, creamos el archivo ***.env.local***

3. Agregamos la línea con la configuración de conexión a la BBDD y colocamos nuestras credenciales y el nombre de la BBDD

   ```dotenv
   DATABASE_URL="mysql://dbUserName:dbUserPassword@127.0.0.1:3306/dbName?serverVersion=8&charset=utf8mb4"
   ```

4. Generar la base de datos en nuestro DBMS

   ```shell
   $ php bin/console doctrine:database:create   
   ```
   Deberemos recibir un mesnaje como este:
   ```shell
   Created database `dbName` for connection named default
   ```

Con eso, nuestro sistema queda configurado para conectarse a la BBDD y tenemos generada la misma.

Ahora vamos a generar nuestras entidades.

1. Creamos la entidad Category

   ```shell
   $ php bin/console make:entity
   
   Class name of the entity to create or update (e.g. BraveChef):
   > Category
   Category
   
   created: src/Entity/Category.php
   created: src/Repository/CategoryRepository.php
   
   Entity generated! Now let's add some fields!
   You can always add more fields later manually or by re-running this command.
   
   New property name (press <return> to stop adding fields):
   > name
   
   Field type (enter ? to see all types) [string]:
   >
   
   
   Field length [255]:
   > 128
   
   Can this field be null in the database (nullable) (yes/no) [no]:
   >
   
   updated: src/Entity/Category.php
   
   Add another property? Enter the property name (or press <return> to stop adding fields):
   > slug
   
   Field type (enter ? to see all types) [string]:
   >
   
   
   Field length [255]:
   > 128
   
   Can this field be null in the database (nullable) (yes/no) [no]:
   >
   
   updated: src/Entity/Category.php
   ```
   
2. Creamos la entidad Post
   
   ```shell
   $ php bin/console make:entity

   Class name of the entity to create or update (e.g. BravePuppy):
   > Post
   Post
   
   created: src/Entity/Post.php
   created: src/Repository/PostRepository.php
   
   Entity generated! Now let's add some fields!
   You can always add more fields later manually or by re-running this command.
   
   New property name (press <return> to stop adding fields):
   > title
   
   Field type (enter ? to see all types) [string]:
   >
   
   
   Field length [255]:
   > 128
   
   Can this field be null in the database (nullable) (yes/no) [no]:
   >
   
   updated: src/Entity/Post.php
   
   Add another property? Enter the property name (or press <return> to stop adding fields):
   > slug
   
   Field type (enter ? to see all types) [string]:
   >
   
   
   Field length [255]:
   >
   
   Can this field be null in the database (nullable) (yes/no) [no]:
   >
   
   updated: src/Entity/Post.php
   
   Add another property? Enter the property name (or press <return> to stop adding fields):
   > content
   
   Field type (enter ? to see all types) [string]:
   > text
   text
   
   Can this field be null in the database (nullable) (yes/no) [no]:
   >
   
   updated: src/Entity/Post.php
   
   Add another property? Enter the property name (or press <return> to stop adding fields):
   >
   
   
   
   Success!
   
   
   Next: When you're ready, create a migration with php bin/console make:migration

   ```
   
3. Creamos la entidad Comment

   ```shell
   $ php bin/console make:entity

   Class name of the entity to create or update (e.g. VictoriousElephant):
   > Comment
   Comment
   
   created: src/Entity/Comment.php
   created: src/Repository/CommentRepository.php
   
   Entity generated! Now let's add some fields!
   You can always add more fields later manually or by re-running this command.
   
   New property name (press <return> to stop adding fields):
   > content
   
   Field type (enter ? to see all types) [string]:
   > text
   text
   
   Can this field be null in the database (nullable) (yes/no) [no]:
   >
   
   updated: src/Entity/Comment.php
   
   Add another property? Enter the property name (or press <return> to stop adding fields):
   >
   
   
   
   Success!
   
   
   Next: When you're ready, create a migration with php bin/console make:migration

   ```
   
4. Creamos nuestras migraciones

   ```shell
   $ php bin/console make:migrations
   ```
   
5. Ahora vamos a ejecutar las migraciones para que se actualice nuestra BBDD

   ```shell
   $ php bin/console doctrine:migrations:migrate
   ```


## Relaciones de Tablas
***

Ahora vamos a generar las relaciones que existen entre las tarblas y entidades de nuestro sistema, por ejemplo, una categoria tendra varias publicaciones, y una publicación tendrá varios comentarios.

1. Construimos la relación entre Category y Post

   ```shell
   $ php bin/console make:entity

   Class name of the entity to create or update (e.g. TinyChef):
   > Category
   Category
   
   Your entity already exists! So let's add some new fields!
   
   New property name (press <return> to stop adding fields):
   > posts
   
   Field type (enter ? to see all types) [string]:
   > relation
   relation
   
   What class should this entity be related to?:
   > Post
   Post
   
   What type of relationship is this?
    ------------ --------------------------------------------------------------------- 
   Type         Description
    ------------ --------------------------------------------------------------------- 
   ManyToOne    Each Category relates to (has) one Post.                             
   Each Post can relate to (can have) many Category objects.
   
   OneToMany    Each Category can relate to (can have) many Post objects.            
   Each Post relates to (has) one Category.
   
   ManyToMany   Each Category can relate to (can have) many Post objects.            
   Each Post can also relate to (can also have) many Category objects.
   
   OneToOne     Each Category relates to (has) exactly one Post.                     
   Each Post also relates to (has) exactly one Category.
    ------------ --------------------------------------------------------------------- 
   
   Relation type? [ManyToOne, OneToMany, ManyToMany, OneToOne]:
   > OneToMany
   OneToMany
   
   A new property will also be added to the Post class so that you can access and set the related Category object from it.
   
   New field name inside Post [category]:
   > category
   
   Is the Post.category property allowed to be null (nullable)? (yes/no) [yes]:
   > no
   
   Do you want to activate orphanRemoval on your relationship?
   A Post is "orphaned" when it is removed from its related Category.
   e.g. $category->removePost($post)
   
   NOTE: If a Post may *change* from one Category to another, answer "no".
   
   Do you want to automatically delete orphaned App\Entity\Post objects (orphanRemoval)? (yes/no) [no]:
   > yes
   
   updated: src/Entity/Category.php
   updated: src/Entity/Post.php
   
   Add another property? Enter the property name (or press <return> to stop adding fields):
   >
   
   
   
   Success!
   
   
   Next: When you're ready, create a migration with php bin/console make:migration



   ```
   
2. Ahora vamos a generar la relación entre Post y Comment

   ```shell
   $ php bin/console make:entity
   
    Class name of the entity to create or update (e.g. AgreeableGnome):
    > Post
   Post
   
    Your entity already exists! So let's add some new fields!
   
    New property name (press <return> to stop adding fields):
    > comments
   
    Field type (enter ? to see all types) [string]:
    > relation
   relation
   
    What class should this entity be related to?:
    > Comment
   Comment
   
   What type of relationship is this?
    ------------ -------------------------------------------------------------------- 
     Type         Description                                                         
    ------------ -------------------------------------------------------------------- 
     ManyToOne    Each Post relates to (has) one Comment.                             
                  Each Comment can relate to (can have) many Post objects.            
                                                                                      
     OneToMany    Each Post can relate to (can have) many Comment objects.            
                  Each Comment relates to (has) one Post.                             
                                                                                      
     ManyToMany   Each Post can relate to (can have) many Comment objects.            
                  Each Comment can also relate to (can also have) many Post objects.  
                                                                                      
     OneToOne     Each Post relates to (has) exactly one Comment.                     
                  Each Comment also relates to (has) exactly one Post.                
    ------------ -------------------------------------------------------------------- 
   
    Relation type? [ManyToOne, OneToMany, ManyToMany, OneToOne]:
    > OneToMany
   OneToMany
   
    A new property will also be added to the Comment class so that you can access and set the related Post object from it.
   
    New field name inside Comment [post]:
    >
   
    Is the Comment.post property allowed to be null (nullable)? (yes/no) [yes]:
    > no
   
    Do you want to activate orphanRemoval on your relationship?
    A Comment is "orphaned" when it is removed from its related Post.
    e.g. $post->removeComment($comment)
   
    NOTE: If a Comment may *change* from one Post to another, answer "no".
   
    Do you want to automatically delete orphaned App\Entity\Comment objects (orphanRemoval)? (yes/no) [no]:
    > yes
   
    updated: src/Entity/Post.php
    updated: src/Entity/Comment.php
   
    Add another property? Enter the property name (or press <return> to stop adding fields):
    >
   
   
              
     Success! 
              
   
    Next: When you're ready, create a migration with php bin/console make:migration
   ```

3. Generamos las migraciones con los cambios que hemos generado

```shell
$ php bin/console make:migration
```

4. Y ahora ejecutamos esta migración para que esos cambios queden reflejados en nuestra BBDD

```shell
$ php bin/console doctrine:migrations:migrate

# Abreviado

$ php bin/console d:mi:mi
```

   
> **NOTA:** Para saber el estado de las migraciones podemos ejecutar el comando:
 
   ```shell
   $ php bin/console doctrine:migrations:status
   
   # O abreviado 
   
   $ php bin/console d:mi:sta
   ```