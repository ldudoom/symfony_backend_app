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


## Personalización de las vistas administrativas
***


### POST
***

1. Empezamos por actualizar las vistas de Post, en primer lugar, vamos a descomentar el metodo del controlador que se encuentra encerrado en comentarios:

   ***/src/Controller/Admin/PostCrudController.php***
   ```php
   // Importamos las clases necesarias
   use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
   use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
   use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
   use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
   use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
   
   // Descomentamos el metodo
   public function configureFields(string $pageName): iterable
   {
        return [
            IdField::new('id')->onlyOnIndex(),
            AssociationField::new('category', 'Category'),
            TextField::new('title'),
            SlugField::new('slug')->setTargetFieldName('title'),
            TextEditorField::new('content')->hideOnIndex(),
        ];
   }
   ```

2. Agregamos el método de configuracion del CRUD con el siguiente código

   ***/src/Controller/Admin/PostCrudController.php***
   ```php
   use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
   
   
   public function configureCrud(Crud $crud): Crud
   {
        return $crud->setSearchFields(['title', 'content'])
                    ->setDefaultSort(['title' => 'DESC']);
   }
   ```

3. Por ultimo, para no obtener un error al momento de renderizar el formulario de Post, debido a que tiene una asociación con Categoria, debemos especificar el méto __toString() de la siguiente manera:

   ***/src/Entity/Category.php***
   ```php
   public function __toString(): string
   {
        return (string) $this->getName();
   }
   ```
   
### CATEGORY
***

1. Importamos las clases necesarias para hacer nuestra configuración

   ***/src/Controller/Admin/CategoryCrudController.php***
   ```php
   use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
   use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
   use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
   ```

2. Agregamos el metodo de configuración del CRUD
   
   ***/src/Controller/Admin/CategoryCrudController.php***
   ```php
   public function configureCrud(Crud $crud): Crud
   {
        return $crud->setSearchFields(['name'])
                    ->setDefaultSort(['name' => 'ASC']);
   }
   ```

3. Descomentamos y colocamos el metodo correcto en el método de configuración de campos

   ***/src/Controller/Admin/CategoryCrudController.php***
   ```php
   public function configureFields(string $pageName): iterable
   {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('name'),
            SlugField::new('slug')->setTargetFieldName('name')
        ];
   }
   ```

### COMMENTS
***

1. Importamos las clases necesarias en el controlador para hacer la configuración

***/src/Controller/Admin/CommentCrudController.php***
```php
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
```

2. Agregamos el metodo de configuración del CRUD

   ***/src/Controller/Admin/CommentCrudController.php***
   ```php
   public function configureCrud(Crud $crud): Crud
   {
        return $crud->setSearchFields(['content'])
                    ->setDefaultSort(['id' => 'DESC']);
   }
   ```

3. Descomentamos y colocamos el metodo correcto en el método de configuración de campos

   ***/src/Controller/Admin/CommentCrudController.php***
   ```php
   public function configureFields(string $pageName): iterable
   {
        return [
            IdField::new('id')->onlyOnIndex(),
            AssociationField::new('post', 'Post'),
            TextEditorField::new('content'),
        ];
   }
   ```
   
4. Agregamos el metodo __toString() en la entidad Post


   ***/src/Entity/Post.php***
   ```php
   public function __toString(): string
   {
        return (string) $this->getTitle();
   }
   ```


## Traducción del Panel Administrativo
***

Actualizamos el archvio ***translation.yaml*** cambiando el idioma de ingles a español.

***/config/translation.yaml***
```yaml
framework:
    default_locale: es
```

Podemos hacer esto debido a que EasyAdmin ya trae los archivo de traducción a varios idiomas, entre ellos el español

De todas maneras, el sistema toma, en ciertas partes, el nombre de nuestras entidades, por lo que seguramente van a seguirse viendo en el idioma ingles, para eso hacemos la siguiente configuración en los controladores

***/src/Controller/Admin/CategoryCrudController.php***
```php
public function configureCrud(Crud $crud): Crud
{
     return $crud
         ->setEntityLabelInSingular('Categoría')
         ->setEntityLabelInPlural('Categorías')
         ->setSearchFields(['name'])
         ->setDefaultSort(['name' => 'ASC']);
}
```

***/src/Controller/Admin/PostCrudController.php***
```php
public function configureCrud(Crud $crud): Crud
{
     return $crud
         ->setEntityLabelInSingular('Publicación')
         ->setEntityLabelInPlural('Publicaciones')
         ->setSearchFields(['title', 'content'])
         ->setDefaultSort(['title' => 'ASC']);
}
```

***/src/Controller/Admin/CommentCrudController.php***
```php
public function configureCrud(Crud $crud): Crud
{
        return $crud
            ->setEntityLabelInSingular('Comentario')
            ->setEntityLabelInPlural('Comentarios')
            ->setSearchFields(['content'])
            ->setDefaultSort(['id' => 'DESC']);
}
```

## Estructura de Datos Falsos
***

Vamos a generar los datos falsos para tener informacion y ver mejor nuestro panel de administración:

1. Instalamos los componentes que nos ayudan con la generación de datos falsos:

   ```shell
   $ composer require orm-fixtures --dev
   $ composer require zenstruck/foundry --dev
   ```

2. Ahora ejecutamos el comando para generar los datos falsos, y seleccionamos la opción para generar datos para todas nuestras Entidades

   ```shell
   $ php bin/console make:factory
   
    // Note: pass --test if you want to generate factories in your tests/ directory
   
    // Note: pass --all-fields if you want to generate default values for all fields, not only required fields
   
    Entity, Document or class to create a factory for:
     [0] App\Entity\Category
     [1] App\Entity\Comment
     [2] App\Entity\Post
     [3] All
    > 3
   3
   
    created: src/Factory/CategoryFactory.php
    created: src/Factory/PostFactory.php
    created: src/Factory/CommentFactory.php
   
              
     Success! 
              
   
    Next: Open your new factory and set default values/states.
    Find the documentation at https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
   
   ```
   
3. Realizamos la configuracion para llenar de datos nuestra base:

   ***/src/DataFixtures/AppFixtures.php***
   ```php
   use App\Factory\CategoryFactory;
   use App\Factory\CommentFactory;
   use App\Factory\PostFactory;
   
   
   public function load(ObjectManager $manager): void
   {
        CategoryFactory::createMany(8);
   
        PostFactory::createMany(40, function() {
            return [
                'comments' => CommentFactory::new()->many(0,10),
                'category' => CategoryFactory::random()
            ];
        });
   }
   ```
   
4. Ahora configuramos cada uno de los archivos Factory

   ***/src/Factory/CategoryFactory.php***
   ```php
    use Symfony\Component\String\Slugger\AsciiSlugger;
   
    protected function getDefaults(): array
    {
        $slugger = new AsciiSlugger();
        $name = self::faker()->unique()->word();
        return [
            'name' => $name,
            'slug' => strtolower($slugger->slug($name)),
        ];
    }
   ```
   
   ***/src/Factory/CommentFactory.php***
   ```php
    protected function getDefaults(): array
    {
        return [
            'content' => self::faker()->text(),
        ];
    }
   ```
   
   ***/src/Factory/PostFactory.php***
   ```php
    use Symfony\Component\String\Slugger\AsciiSlugger;
   
    protected function getDefaults(): array
    {
        $slugger = new AsciiSlugger();
        $title = self::faker()->unique()->sentence();
        return [
            'content' => self::faker()->text(),
            'slug' => strtolower($slugger->slug($title)),
            'title' => $title,
        ];
    }
   ```

5. Ejecutamos el comando que poblará nuestras tablas con la configuracion que hemos hecho

   ```shell
   $ php bin/console doctrine:fixtures:load
   ```


   
## Campos SLUG configurados como UNICOS
***

Vamos a empezar con el campo slug de nuestra entidad **Category.php**

1. Importamos la clase necesaria

   ***/src/Entity/Category.php***
   ```php
   use Symfony\Bridge\Doctrine\Validator\Constrains\UniqueEntity;
   ```

2. Agregamos la anotacion necesaria en la clase para generar esta validacion

   ***/src/Entity/Category.php***
   ```php
   #[ORM\Entity(repositoryClass: CategoryRepository::class)]
   #[UniqueEntity('slug')]
   class Category
   {
   ...
   
   ```

3. Vamos a realizar el cambio de tal manera que se actualice nuestra BBDD tambien

   ***/src/Entity/Category.php***
   ```php
   #[ORM\Column(length: 128, unique: true)]
   private ?string $name = null;
   
   #[ORM\Column(length: 128, unique: true)]
   private ?string $slug = null;
   ```
   
4. Vamos a realizar los mismos pasos en la entidad **Post.php**

   ***/src/Entity/Post.php***
   ```php
   use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
   
   #[ORM\Entity(repositoryClass: PostRepository::class)]
   #[UniqueEntity('slug')]
   class Post
   {
       #[ORM\Column(length: 128, unique: true)]
       private ?string $title = null;
   
       #[ORM\Column(length: 255, unique: true)]
       private ?string $slug = null;
       ...
   
   ```

5. Ahora vamos a generar las migraciones para poder posteriormente actualizar nuestra BBDD

   ```shell
   $ php bin/console make:migration
   ```
   
   Esto genera la migración con el siguiente código:

   ```php
   final class Version20230411190938 extends AbstractMigration
   {
      
      public function getDescription(): string
      {
         return '';
      }
   
       public function up(Schema $schema): void
       {
           // this up() migration is auto-generated, please modify it to your needs
           $this->addSql('CREATE UNIQUE INDEX UNIQ_64C19C15E237E06 ON category (name)');
           $this->addSql('CREATE UNIQUE INDEX UNIQ_64C19C1989D9B62 ON category (slug)');
           $this->addSql('CREATE UNIQUE INDEX UNIQ_5A8A6C8D2B36786B ON post (title)');
           $this->addSql('CREATE UNIQUE INDEX UNIQ_5A8A6C8D989D9B62 ON post (slug)');
       }
   
       public function down(Schema $schema): void
       {
           // this down() migration is auto-generated, please modify it to your needs
           $this->addSql('DROP INDEX UNIQ_64C19C15E237E06 ON category');
           $this->addSql('DROP INDEX UNIQ_64C19C1989D9B62 ON category');
           $this->addSql('DROP INDEX UNIQ_5A8A6C8D2B36786B ON post');
           $this->addSql('DROP INDEX UNIQ_5A8A6C8D989D9B62 ON post');
       }
   }
   ```

6. Corremos el comando para ejecutar nuestra nueva migracion

   ```shell
   $ php bin/console doctrine:migrations:migrate
   ```
   

## Estructura de Usuarios
***

1. Para generar la entidad de usuarios, ejecutamos el siguiente comando:

   ```shell
   $ php bin/console make:user
   ```

2. LLenamos el asistente de la siguiente manera:

   ```shell
    The name of the security user class (e.g. User) [User]:
    > User
   
    Do you want to store user data in the database (via Doctrine)? (yes/no) [yes]:
    > yes
   
    Enter a property name that will be the unique "display" name for the user (e.g. email, username, uuid) [email]:
    > email
   
    Will this app need to hash/check user passwords? Choose No if passwords are not needed or will be checked/hashed by some other system (e.g. a single sign-on server).
   
    Does this app need to hash/check user passwords? (yes/no) [yes]:
    > yes
   
    created: src/Entity/User.php
    created: src/Repository/UserRepository.php
    updated: src/Entity/User.php
    updated: config/packages/security.yaml
   
              
     Success! 
              
   
    Next Steps:
      - Review your new App\Entity\User class.
      - Use make:entity to add more fields to your User entity and then run make:migration.
      - Create a way to authenticate! See https://symfony.com/doc/current/security.html
   
   ```
   
3. Generamos el archivo de migracion

   ```shell
   $ php bin/console make:migration
   ```
   
4. Ejecutamos la migración antes generada

   ```shell
   $ php bin/console doctrine:migrations:migrate
   ```
   
## Registro e inicio de sesion
***

Vamos ahora a habilitar el formulario de login y de registro, y vamos a proteger nuestro panel de administración 
para que no pueda acceder ningun usuario a menos de que realice el proceso de login.

1. Ejecutamos el comando que nos ayuda a habilitar el formulario de login:

   ```shell
   $ php bin/console make:auth
   ```

2. Llenamos el asistente con la siguiente información

   ```shell
    What style of authentication do you want? [Empty authenticator]:
     [0] Empty authenticator
     [1] Login form authenticator
    > 1
   1
   
    The class name of the authenticator to create (e.g. AppCustomAuthenticator):
    > AppAuthenticator
   
    Choose a name for the controller class (e.g. SecurityController) [SecurityController]:
    > 
   
    Do you want to generate a '/logout' URL? (yes/no) [yes]:
    > yes
   
    created: src/Security/AppAuthenticator.php
    updated: config/packages/security.yaml
    created: src/Controller/SecurityController.php
    created: templates/security/login.html.twig
   
              
     Success! 
              
   
    Next:
    - Customize your new authenticator.
    - Finish the redirect "TODO" in the App\Security\AppAuthenticator::onAuthenticationSuccess() method.
    - Review & adapt the login template: templates/security/login.html.twig.
   
   ```
   

3. Ahora vamos a generar el formulario de registro de usuarios

   ```shell
   $ php bin/console make:registration-form
   ```
   > **NOTA:** En caso de requerirlo, instalar el componente de anotaciones ejecutando: `composer require doctrine/annotations`

4. Llenamos el asistente de la siguiente manera

   ```shell
   Creating a registration form for App\Entity\User
   
    Do you want to add a @UniqueEntity validation annotation on your User class to make sure duplicate accounts aren't created? (yes/no) [yes]:
    > yes
   
    Do you want to send an email to verify the user's email address after registration? (yes/no) [yes]:
    > no
   
    Do you want to automatically authenticate the user after registration? (yes/no) [yes]:
    > yes
   
    updated: src/Entity/User.php
    created: src/Form/RegistrationFormType.php
    created: src/Controller/RegistrationController.php
    created: templates/registration/register.html.twig
   
              
     Success! 
              
   
    Next:
    Make any changes you need to the form, controller & template.
   
    Then open your browser, go to "/register" and enjoy your new form!
   
   ```
   

Una vez que tenemos instalados nuestros formularios de login y registro, vamos a proteger nuestro panel administrativo

Para eso simplemente vamos al archivo de configuración de seguridad, y descomentamos la linea que bloquea el acceso a 
usuarios no autorizados:

***/config/packages/security.yaml***
```yaml
security:
   access_control:
      - { path: ^/admin, roles: ROLE_ADMIN }
```

Este momento, si intentamos registrarnos y acceder al panel admin, vamos a tener un error, de acceso de negado, esto se da debido a que 
tenemos en la base de datos creado el usuario luego del registro, pero este usuario aun no tiene asignado ningun rol, de momento solo 
editamos el registro de usuario en la BBDD agregandole el rol ROLE_ADMIN:

```
["ROLE_ADMIN"]
```


## CRUD de Usuarios
***

Vamos a replicar configuraciones anteriores, especificamente de CRUD para generarl el de usuarios.

1. Ejecutamos el comando que inicia la configuracion del CRUD de usuarios:

   ```shell
   $ php bin/console make:admin:crud
   ```

2. Llenamos el asistente con la siguiente informacion:

   ```shell
    Which Doctrine entity are you going to manage with this CRUD controller?:
     [0] App\Entity\Category
     [1] App\Entity\Comment
     [2] App\Entity\Post
     [3] App\Entity\User
    > 3
   3
   
    Which directory do you want to generate the CRUD controller in? [src/Controller/Admin/]:
    > 
   
    Namespace of the generated CRUD controller [App\Controller\Admin]:
    > 
   
                                                                                                                           
    [OK] Your CRUD controller class has been successfully generated.                                                       
                                                                                                                           
   
    Next steps:
    * Configure your controller at "src/Controller/Admin/UserCrudController.php"
    * Read EasyAdmin docs: https://symfony.com/doc/master/bundles/EasyAdminBundle/index.html
   
   ```
   
3. Agregamos el acceso a este nuevo CRUD en nuestro panel, agregando el siguiente codigo en **DashboardController.php**

   ***/src/Controller/Admin/DashboardController.php***
   ```php
   use App\Entity\User;
   
   public function configureMenuItems(): iterable
   {
        ...
        yield MenuItem::linkToCrud('Users', 'fa fa-user', User::class);
        ...
   }
   ```

4. Personalizamos la lista de usuarios y los formularios, realizando la siguiente configuracion en el controlador

***/src/Controller/Admin/UserCrudController.php***
```php
namespace App\Controller\Admin;

use App\Entity\User;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;


use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Usuario')
            ->setEntityLabelInPlural('Usuarios')
            ->setSearchFields(['email'])
            ->setDefaultSort(['id' => 'DESC']);
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            EmailField::new('email'),
            ChoiceField::new('roles')->setChoices([
                'Administrador' => 'ROLE_ADMIN',
                'Usuario' => 'ROLE_USER',
            ])->allowMultipleChoices(),
        ];
    }
}

```


## Relaciones de tablas con los Usuarios
***

Ahora vamos a modificar el modulo de usuarios, para eso seguimos los siguientes pasos:

1. Modificamos la entidad User de la siguiente manera

   ```shell
   $ php bin/console make:entity
   
   Class name of the entity to create or update (e.g. OrangeChef):
    > User
   User
   
    Your entity already exists! So let's add some new fields!
   
    New property name (press <return> to stop adding fields):
    > name
   
    Field type (enter ? to see all types) [string]:
    > 
   
   
    Field length [255]:
    > 128
   
    Can this field be null in the database (nullable) (yes/no) [no]:
    > 
   
    updated: src/Entity/User.php
   
    Add another property? Enter the property name (or press <return> to stop adding fields):
    > posts
   
    Field type (enter ? to see all types) [string]:
    > relation
   relation
   
    What class should this entity be related to?:
    > Post
   Post
   
   What type of relationship is this?
    ------------ ----------------------------------------------------------------- 
     Type         Description                                                      
    ------------ ----------------------------------------------------------------- 
     ManyToOne    Each User relates to (has) one Post.                             
                  Each Post can relate to (can have) many User objects.            
                                                                                   
     OneToMany    Each User can relate to (can have) many Post objects.            
                  Each Post relates to (has) one User.                             
   
     ManyToMany   Each User can relate to (can have) many Post objects.            
                  Each Post can also relate to (can also have) many User objects.
   
     OneToOne     Each User relates to (has) exactly one Post.
                  Each Post also relates to (has) exactly one User.
    ------------ -----------------------------------------------------------------
   
    Relation type? [ManyToOne, OneToMany, ManyToMany, OneToOne]:
    > OneToMany
   OneToMany
   
    A new property will also be added to the Post class so that you can access and set the related User object from it.
   
    New field name inside Post [user]:
    >
   
    Is the Post.user property allowed to be null (nullable)? (yes/no) [yes]:
    > no
   
    Do you want to activate orphanRemoval on your relationship?
    A Post is "orphaned" when it is removed from its related User.
    e.g. $user->removePost($post)
   
    NOTE: If a Post may *change* from one User to another, answer "no".
   
    Do you want to automatically delete orphaned App\Entity\Post objects (orphanRemoval)? (yes/no) [no]:
    > yes
   
    updated: src/Entity/User.php
    updated: src/Entity/Post.php
    
   Add another property? Enter the property name (or press <return> to stop adding fields):
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
     ManyToOne    Each User relates to (has) one Comment.
                  Each Comment can relate to (can have) many User objects.
   
     OneToMany    Each User can relate to (can have) many Comment objects.
                  Each Comment relates to (has) one User.
   
     ManyToMany   Each User can relate to (can have) many Comment objects.
                  Each Comment can also relate to (can also have) many User objects.
   
     OneToOne     Each User relates to (has) exactly one Comment.
                  Each Comment also relates to (has) exactly one User.
    ------------ --------------------------------------------------------------------
   
    Relation type? [ManyToOne, OneToMany, ManyToMany, OneToOne]:
    > OneToMany
   OneToMany
   
    A new property will also be added to the Comment class so that you can access and set the related User object from it.
   
    New field name inside Comment [user]:
    >
   
    Is the Comment.user property allowed to be null (nullable)? (yes/no) [yes]:
    > no
   
    Do you want to activate orphanRemoval on your relationship?
    A Comment is "orphaned" when it is removed from its related User.
    e.g. $user->removeComment($comment)
   
    NOTE: If a Comment may *change* from one User to another, answer "no".
   
    Do you want to automatically delete orphaned App\Entity\Comment objects (orphanRemoval)? (yes/no) [no]:
    > yes
   
    updated: src/Entity/User.php
    updated: src/Entity/Comment.php
   
    Add another property? Enter the property name (or press <return> to stop adding fields):
    >
   
   
              
     Success! 
              
   
    Next: When you're ready, create a migration with php bin/console make:migration
   
   ```

2. Generamos la migracion de los cambios que acabamos de hacer

   ```shell
   $ php bin/console make:migration
   ```

3. Ahora debemos borrar todas las tablas antes de ejecutar esta migracion, ya que el cambio que vamos a hacer tiene restricciones de integridad referencial

   ```shell
   $ php bin/console doctrine:database:drop --force 
   ```
4. Ahora generamos nuevamente la BBDD

   ```shell
   $ php bin/console doctrine:database:create
   ```

5. Ahora si, ejecutamos la migracion para que los cambios queden hechos en nuestra BBDD

   ```shell
   $ php bin/console doctrine:migrations:migrate
   ```

6. Ahora vamos a crear el Factory de nuestros usuarios

   ```shell
   $ php bin/console make:Factory
   
   // Note: pass --test if you want to generate factories in your tests/ directory
   
    // Note: pass --all-fields if you want to generate default values for all fields, not only required fields
   
    Entity, Document or class to create a factory for:
     [0] App\Entity\User
     [1] All
    > 0
   0
   
    created: src/Factory/UserFactory.php
   
              
     Success! 
              
   
    Next: Open your new factory and set default values/states.
    Find the documentation at https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
   
   ```

7. Ahora modificamos la configuracion de los datos semilla en el archivo **AppFisctures.php**

   ***/src/DataFixtures/AppFixtures.php***
   ```php
   use App\Factory\UserFactory;
   
   public function load(ObjectManager $manager): void
    {
        CategoryFactory::createMany(8);
        UserFactory::createMany(8);
   
        PostFactory::createMany(40, function() {
            return [
                'comments' => CommentFactory::new()->many(0,10),
                'category' => CategoryFactory::random(),
                'user' => UserFactory::random(),
            ];
        });
    }
   ```

8. Ahora modificamos el Factory de comentarios

   ***/src/Factory/CommentFactory.php***
   ```php
   protected function getDefaults(): array
    {
        return [
            'content' => self::faker()->text(),
            'user' => UserFactory::random(),
        ];
    }
   ```

9. Ahora vamos a modificar el Factory de usuarios

   ***/src/Factory/UserFactory.php***
   ```php
   protected function getDefaults(): array
    {
        return [
            'email' => self::faker()->email(),
            'roles' => ['ROLE_USER'],
            'password' => '123456789',
            'name' => self::faker()->name(),
        ];
    }
   ```
   
10. Ahora hacemos la carga de los datos falsos en nuestra BBDD

```shell
$ php bin/console doctrine:fixtures:load

 Careful, database "symfony_backend" will be purged. Do you want to continue? (yes/no) [no]:
 > yes

   > purging database
   > loading App\DataFixtures\AppFixtures

```


## Encriptar contraseñas en datos semilla
***

Nuestra tabla de usuarios se esta poblando con usuarios pero tenemos el inconveniente de que las claves de 
acceso se estan guardando sin encriptar, esto por su puesto es un problema de seguridad, asi que vamos a 
corregirlo.

Para esto vamos a modificar el archivo **UserFactory.php** con el siguiente c&oacute;digo

***/src/Factory/UserFactory.php***
```php
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class UserFactory extends ModelFactory
{

    private UserPasswordHasherInterface $userPasswordHasher;
    
    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        parent::__construct();
        $this->userPasswordHasher = $userPasswordHasher;
    }
    
    protected function initialize(): self
    {
        return $this
            ->afterInstantiate(function(User $user): void {
                $user->setPassword(
                    $this->userPasswordHasher->hashPassword($user, $user->getPassword())
                );
            })
        ;
    }
    
    ...
}
```

Con esta configuración, podemos ejecutar nuevamente el comando para generar fake data en nuestro systema y ya tenemos 
los usuarios con passwords encriptados:

```shell
$ php bin/conaole doctrine:fixtures:load
```

Vamos a hacer un pequeño cambios en la configuracion de generacion de datos semilla para poder tener usuarios
Administradores tambien, este cambio lo hacemos en **AppFixtures.php**

***/src/DataFixtures/AppFixtures.php***
```php
public function load(ObjectManager $manager): void
{
        UserFactory::createOne([
            'name' => 'Admin',
            'email' => 'admin@myapp.com',
            'roles' => ['ROLE_ADMIN'],
        ]);

        UserFactory::createOne([
            'name' => 'User',
            'email' => 'user@myapp.com',
        ]);
        ...
}
```

Y volvemos a ejecutar el comando que genera nuestra fake data

```shell
$ php bin/conaole doctrine:fixtures:load
```

## Actualizaci&oacute;n del Panel Administrativo
***

Vamos a comenzar por modificar el modulo de comentarios, de tal manera que al momento de generar un nuevo 
comentario, me permita seleccionar cual es el usuario al que le pertenece.

***/src/Controller/Admin/CommentCrudController.php***
```php
public function configureFields(string $pageName): iterable
 {
     return [
         ...
         AssociationField::new('user', 'User'),
         ...
     ];
 }
```

Ahora hacemos lo mismo para el modulo de publicaciones 

***/src/Controller/Admin/PostCrudController.php***
```php
public function configureFields(string $pageName): iterable
 {
     return [
         ...
         AssociationField::new('user', 'User'),
         ...
     ];
 }
```

Agregamos el metodo __toString() en la entidad User.

***/src/Entity/User.php***
```php
public function __toString(): string
 {
     return (string) $this->getName();
 }
```

Vamos a agregar la propiedad nombre del usuario en el controlador.

***/src/Controller/Admin/UserCrudController.php***
```php
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

public function configureCrud(Crud $crud): Crud
 {
     return $crud
         ...
         ->setSearchFields(['name', 'email'])
         ...
 }

public function configureFields(string $pageName): iterable
 {
     return [
         ...
         TextField::new('name', 'Nombre'),
         ...
     ];
 }
```

Vamos ahora a quitar la funcionalidad de la creacion de usuarios desde el panel administrativo, esta funcion
quedara activa unicamente desde el formulario de registro.

***/src/Controller/Admin/UserCrudController.php***
```php
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
...

public function configureActions(Actions $actions): Actions
 {
     return parent::configureActions($actions)->disable(Action::NEW);
 }
```

Ahora vamos a agregar el campo de nombre en el formulario de registro

***/src/Form/RegistrationFormType.php***
```php
public function buildForm(FormBuilderInterface $builder, array $options): void
 {
     $builder
         ->add('name')
         ->add('email')
        ...
 }
```

***/templates/registration/register.html.twig
```html
{{ form_start(registrationForm) }}
     {{ form_row(registrationForm.name) }}
     {{ form_row(registrationForm.email) }}
    ...
```


## Web Publica
***

Ahora nos vamos a centrar en la configuración de nuestra Web Publica, ya tenemos el backend y nuestro panel administrativo, ahora
vamos a dejar funcionando el frontend del sistema, es decir la parte pública, donde tendrán acceso los usuarios sin necesidad de
estar logueado o registrado.

Lo primero que vamos a hacer es generar el controlador para gestionar las pantallas de la web publica:

```shell
$ php bin/console make:controller Page

 created: src/Controller/PageController.php
 created: templates/page/index.html.twig

           
  Success! 
           

 Next: Open your new controller class and add some pages!

```

Ahora, dejamos al controlador Page con el siguiente codigo:

***/src/Controller/PageController.php***
```php
#[Route('/', name: 'app_home')]
 public function home(): Response
 {
     return $this->render('page/home.html.twig', [
         'controller_name' => 'PageController',
     ]);
 }
```

Renombramos el archivo **index.html.twig** a **home.html.twig**

```shell
$ git mv templates/page/index.html.twig templates/page/home.html.twig
```

Lo siguiente será traer a esta vista la lista de publicaciones, y generar una ruta y una vista para ver el detalle de una publicacion,
para esto, vamos a modificar el controlador de la siguiente manera:

***/src/Controller/PageController.php***
```php
use App\Entity\Post;
use App\Repository\PostRepository;

#[Route('/', name: 'app_home')]
public function home(PostRepository $postRepository): Response
{
  return $this->render('page/home.html.twig', [
      'posts' => $postRepository->findLatest(),
  ]);
}

#[Route('/blog/{slug}', name: 'app_post')]
public function post(Post $post): Response
{
  return $this->render('page/post.html.twig', [
      'post' => $post,
  ]);
}
```

Agregamos el metodo findLatest() en el repositorio de publicaciones

***/src/Repository/PostRepository.php***
```php
public function findLatest(): array
{
    return $this->createQueryBuilder('post')
              ->orderBy('post.id', 'DESC')
              ->setMaxResults(22)
              ->getQuery()
              ->getResult();
}
```

Imprimimos la lista de publicaciones en la vista **home.html.twig**

***/templates/page/home.html.twig***
```html
{% extends 'base.html.twig' %}

{% block title %}Hello PageController!{% endblock %}

{% block body %}
    {% for post in posts %}
        <h2>
            <a href="{{ path('app_post', { slug: post.slug }) }}">
                {{ post.title }}
            </a>
        </h2>
        <p>
            <strong>{{ post.category.name }}</strong>
            -
            {{ post.comments|length }} Comentarios
        </p>
        <hr>
    {% endfor %}
{% endblock %}
```


Creamos la vista que esta pendiente, post.html.twig

***/templates/page/post.html.twig***
```html
{% extends 'base.html.twig' %}

{% block title %}{{ post.title }}!{% endblock %}

{% block body %}
    <h1>{{ post.title }}</h1>
    {{ post.content }}
    <p>
        <strong>{{ post.category.name }}</strong>
        -
        {{ post.comments|length }} Comentarios
    </p>
{% endblock %}
```


## Estructura del formulario de comentarios
***

Ahora vamos a agregar un formulario para que los usuarios que visitan la web publica, puedan generar nuevos comentarios
en cada una de las publicaciones.

1. Vamos a agregar un nuevo archivo que será la vista del formulario de comentarios.
   ```shell
   $ touch templates/page/_comment-form.html.twig
   ```
   
2. Colocamos el siguiente código en el archivo **_comment-form.html.twig**
   
   ***/templates/page/_comment-form.html.twig***
   ```html
   {% if app.user %}
       <p>
           Comentar como <strong>{{ app.user.name }}</strong>
       </p>
   {% else %}
       <a href="{{ path('app_login') }}">Login</a>
   {% endif %}
   ```
   
3. Incluimos este archivo en el detalle de la publicación

   ***/templates/page/post.html.twig***
   ```html
   ...
   <div>
        {{ include('page/_comment-form.html.twig') }}
        <hr>
        
        {% for comment in post.comments %}
            <p>{{ comment.content }}</p>
            <hr>
        {% endfor %}
    </div>
   ```
   
4. Realizamos una redirección en el sistema para que ubique a los usuarios en el lugar correcto, tanto luego de que haga un login, como despues de un registro

   ***/Secutiry/AppAutenticator.php***
   ```php
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName)) {
            return new RedirectResponse($targetPath);
        }
        
        return new RedirectResponse($this->urlGenerator->generate('app_home'));
    }
   ```
   
5. Generamos el formulario para gestion de comentarios

```shell
$ php bin/console make:form

 The name of the form class (e.g. BraveKangarooType):
 > Comment

 The name of Entity or fully qualified model class name that the new form will be bound to (empty for none):
 > Comment
Comment

 created: src/Form/CommentType.php

           
  Success! 
           

 Next: Add fields to your form and start using it.
 Find the documentation at https://symfony.com/doc/current/forms.html

```

6. Agregamos el formulario en la vista de comentarios

   ***/templates/page/_comment-form.html.twig***
   ```html
   {% if app.user %}
       <p>
           Comentar como <strong>{{ app.user.name }}</strong>
       </p>
   
       {{ form(form) }}
   
   {% else %}
       <a href="{{ path('app_login') }}">Login</a>
   {% endif %}
   ```
   
7. Enviamos el formulario desde nuestro controlador

***/src/Controller/PageController.php***
```php
use App\Form\CommentType;

#[Route('/blog/{slug}', name: 'app_post')]
public function post(Post $post): Response
{
     $form = $this->createForm(CommentType::class);
     return $this->render('page/post.html.twig', [
         'post' => $post,
         'form' => $form->createView(),
     ]);
}
```

