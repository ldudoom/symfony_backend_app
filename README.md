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
>   ```shell
>   $ php bin/console doctrine:migrations:status
>   
>   # O abreviado 
>   
>   $ php bin/console d:mi:sta
>   ```

> Para deshacer la última migración, _**ojo** no traten de modificar migraciones anterioes, y asegurarse de que la bbdd esté vacía_
>   ```shell
>   $ php bin/console doctrine:migration:execute `DoctrineMigrations\Version...` --down
>   ```


## Panel Administrativo
***

Vamos a generar el panel administrativo para, justamente, poder administrar la información en BBDD de las entidades que hemos creado.

1. Iniciamos instalando el componente necesario para nuestra configuración:

   ```shell
   $ composer require easycorp/easyadmin-bundle
   ```

   Ahora tenemos nuevos comandos en nuestro sistema, si ejecutamos `$ php bin/console` veremos comandos como:
   
   ```shell
   make:admin:crud                            Creates a new EasyAdmin CRUD controller class
   make:admin:dashboard                       Creates a new EasyAdmin Dashboard class
   ```
   Que son los comandos que usaremos para crear nuestros componentes del lado del admin.

2. Vamos a iniciar construyendo el Dashboard con la ayuda del comando `$ php bin/console make:admin:dashboard` y completamos el asistente con la siguiente información 

   ```shell
   $ php bin/console make:admin:dashboard
   
    Which class name do you prefer for your Dashboard controller? [DashboardController]:
    > 
   
    In which directory of your project do you want to generate "DashboardController"? [src/Controller/Admin/]:
    > 
   
   
                                                                                                                           
    [OK] Your dashboard class has been successfully generated.                                                             
                                                                                                                           
   
    Next steps:
    * Configure your Dashboard at "src/Controller/Admin/DashboardController.php"
    * Run "make:admin:crud" to generate CRUD controllers and link them from the Dashboard.
   
   ```
   
   Con esta acción, se genera el directorio "**Admin**" dentro de "**/src/Controller**", y dentro se genera el archivo **DashboardController.php** que tiene el siguiente código:

   ```php
   <?php
   
   namespace App\Controller\Admin;
   
   use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
   use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
   use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
   use Symfony\Component\HttpFoundation\Response;
   use Symfony\Component\Routing\Annotation\Route;
   
   class DashboardController extends AbstractDashboardController
   {
       #[Route('/admin', name: 'admin')]
       public function index(): Response
       {
           return parent::index();
   
           // Option 1. You can make your dashboard redirect to some common page of your backend
           //
           // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
           // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());
   
           // Option 2. You can make your dashboard redirect to different pages depending on the user
           //
           // if ('jane' === $this->getUser()->getUsername()) {
           //     return $this->redirect('...');
           // }
   
           // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
           // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
           //
           // return $this->render('some/path/my-dashboard.html.twig');
       }
   
       public function configureDashboard(): Dashboard
       {
           return Dashboard::new()
               ->setTitle('Backend Application');
       }
   
       public function configureMenuItems(): iterable
       {
           yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
           // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
       }
   }
   
   ```
   
   Este momento tenemos la version por defecto del dashboard de nuestro admin, y lo podremos ver en la ruta [https://localhost:8000/admin](https://localhost:8000/admin) una vez que levantemos nuestro servidor local ejecutando el comando `$ symfony serve`

3. Vamos a crear nuestra primera configuración, será el primer CRUD de nuestro sistema, para eso haremos lo siguiente:

   ```shell
   $ php bin/console make:admin:crud
   
    Which Doctrine entity are you going to manage with this CRUD controller?:
     [0] App\Entity\Category
     [1] App\Entity\Comment
     [2] App\Entity\Post
    > 0
   0
   
    Which directory do you want to generate the CRUD controller in? [src/Controller/Admin/]:
    >
   
    Namespace of the generated CRUD controller [App\Controller\Admin]:
    >
   
                                                                                                                           
    [OK] Your CRUD controller class has been successfully generated.                                                       
                                                                                                                           
   
    Next steps:
    * Configure your controller at "src/Controller/Admin/CategoryCrudController.php"
    * Read EasyAdmin docs: https://symfony.com/doc/master/bundles/EasyAdminBundle/index.html
   
   ```

4. Tenemos un nuevo archivo llamado **CategoryCrudController.php** dentro de **/src/Controller/Admin** con el siguiente código:

   **/src/Controller/Admin/CategoryCrudController.php**
   ```php
   <?php
   
   namespace App\Controller\Admin;
   
   use App\Entity\Category;
   use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
   
   class CategoryCrudController extends AbstractCrudController
   {
       public static function getEntityFqcn(): string
       {
           return Category::class;
       }
   
       /*
       public function configureFields(string $pageName): iterable
       {
           return [
               IdField::new('id'),
               TextField::new('title'),
               TextEditorField::new('description'),
           ];
       }
       */
   }
   
   ```
   
5. Vamos ahora a generar los 2 Controladores CRUD adicionales que nos hacen falta, uno para Post y uno para Comment

   ```shell
   $ php bin/console make:admin:crud
   
    Which Doctrine entity are you going to manage with this CRUD controller?:
     [0] App\Entity\Category
     [1] App\Entity\Comment
     [2] App\Entity\Post
    > 1
   0
   
    Which directory do you want to generate the CRUD controller in? [src/Controller/Admin/]:
    >
   
    Namespace of the generated CRUD controller [App\Controller\Admin]:
    >
   
                                                                                                                           
    [OK] Your CRUD controller class has been successfully generated.                                                       
                                                                                                                           
   
    Next steps:
    * Configure your controller at "src/Controller/Admin/CommentCrudController.php"
    * Read EasyAdmin docs: https://symfony.com/doc/master/bundles/EasyAdminBundle/index.html
   
   ```

   ```shell
   $ php bin/console make:admin:crud
   
    Which Doctrine entity are you going to manage with this CRUD controller?:
     [0] App\Entity\Category
     [1] App\Entity\Comment
     [2] App\Entity\Post
    > 2
   0
   
    Which directory do you want to generate the CRUD controller in? [src/Controller/Admin/]:
    >
   
    Namespace of the generated CRUD controller [App\Controller\Admin]:
    >
   
                                                                                                                           
    [OK] Your CRUD controller class has been successfully generated.                                                       
                                                                                                                           
   
    Next steps:
    * Configure your controller at "src/Controller/Admin/PostCrudController.php"
    * Read EasyAdmin docs: https://symfony.com/doc/master/bundles/EasyAdminBundle/index.html
   
   ```
   

6. Lo siguiente es configurar el **DashboardController** de tal manera que nos permita acceder a los componentes que hemos generado, para eso, hacemos los siguientes cambios.

   ***/src/Controller/Admin/DashboardController.php***
   ```php
   use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
   
   
   #[Route('/admin', name: 'admin')]
   public function index(): Response
   {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(PostCrudController::class)->generateUrl());
   }
   ```
   Estas acciones harán que veamos por defecto la pantalla principal del CRUD de Posts, con lo cual veremos la pantalla de **Lista de Posts**

7. Vamos ahora a configurar los items del menú del panel de administración

```php
use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Post;

public function configureMenuItems(): iterable
{
     yield MenuItem::section('ADMIN');
     yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
     yield MenuItem::linkToCrud('Categories', 'fas fa-tag', Category::class);
     yield MenuItem::linkToCrud('Posts', 'fas fa-list', Post::class);
     yield MenuItem::linkToCrud('Comments', 'fas fa-comment', Comment::class);
     yield MenuItem::section('WEB SITE');
     yield MenuItem::linkToRoute('Sitio Web', 'fas fa-globe', 'app_home');
}
```


