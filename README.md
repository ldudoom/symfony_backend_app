# Backend Application con Symfony 6
***

## Configuración Inicial
***
Lo primero que debemos hacer es instalar el CLI de Symfony, siguiendo las instrucciones de su documentación oficial:

[https://symfony.com/download](https://symfony.com/download)

Una vez instalado el CLI, instalamos un proyecto limpio de Symfony utilizando el comando:

```bash
$ symfony new backend-application
```

En caso de tener problemas para instalar el CLI de Symfony, podemos instalar el nuevo proyecto usando ***composer***

```bash
$ composer create-project symfony/skeleton:"6.2.*" backend-application
```

> <small>***NOTA:*** Instalamos una versión mínima de Symfony para desarrollar nuestro proyecto, para tener una cantidad 
mínima de dependencias y poder ir agregando lo que necesitemos mientras avanzamos en el desarrollo, de esta manera, tendremos 
una solución liviana y con el código necesario para que haga lo que necesitamos, y no vamos a tener código ni dependencias 
que no necesitemos, con lo cual el proyecto estará construido de manera muy eficiente y tendrá un mejor rendimiento</small>


Una vez que tenemos instalado nuestro proyecto en su versión básica, vamos a instalar las dependencias que necesitamos:

```bash
$ composer require symfony/maker-bundle --dev
$ composer require symfony/orm-pack
$ composer require symfony/form
$ composer require symfony/debug-pack
$ composer require symfony/twig-pack
$ composer require symfony/webpack-encore-bundle
```

Ahora procedemos a instalar los componentes para tener completamente habilitado nuestro frontend:

```bash
$ npm install
```

> ***Nota:*** Para habilitar completamente los componentes de front (bootstrap) para formularios vamos a hacer lo siguiente:

1. Instalamos bootstrap en nuestro proyecto, ejecutando:

    ```bash
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

    ```bash
    $ npm run dev
    ```