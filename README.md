# eArc minimal

Installation skeleton of the eArc framework. 

The eArc stands for explicit architecture. It is about the urge to make code as
easy to comprehend as possible and the strive to touch the programmers freedom
to code as little as possible. In short it is about simplicity and good
architecture.

To function right out of the box this installation comes with the 
[twig template engine](https://packagist.org/packages/twig/twig). Feel free to 
use any template engine you like.

This skeleton is configured for the use with an apache2 web-server and the
installation instruction refer to it. You are free to use any web-server you
want. Please note the PHP version must be 7.2 or higher.  

Please note that the components have a more detailed documentation at their 
git page:
- [earc/core (dispatcher class/app lifecycle)](https://github.com/Koudela/eArc-core)
- [earc/di (dependency container class/dependency injection)](https://github.com/Koudela/eArc-di)    
- [earc/router (router class)](https://github.com/Koudela/eArc-router)

## Table of Contents
 
 - [Installation](#installation)
   - [1. Get the source code](#1-get-the-source-code)
   - [2. Configure the web-server](#2-configure-the-web-server)
   - [3. Edit composer.json](#3-edit-composerjson)
   - [4. Initialise your favorite vcs](#4-initialise-your-favorite-vcs)
 - [Usage](#usage)
   - [Launching the application](#launching-the-application)
   - [Using the controller](#using-the-controller)
   - [The application lifecycle](#the-application-lifecycle)
     - [The access controllers](#the-access-controllers)
     - [The main controller](#the-main-controller)
     - [Middleware](#middleware) 
       - [Example](#example)
 - [Releases](#releases)
   - [release v0.1](#release-v01)

## Installation

### 1. Get the source code

Suppose your project folder for the eArc app is `/path/to/your/new/projekt/app`.
Installation via composer:

```bash
$ composer create-project earc/minimal /path/to/your/new/projekt/app
```

If you do not have composer installed please check the 
[composer homepage](https://getcomposer.org/download/) for installation
instructions.

### 2. Configure the web-server

This instruction is for linux users running an apache2 web-server. If you are
running another web-server or living on windows or mac or if you have configured
apache in a unusual way please consult the internet. 

(1) Create and open a file `my-app.conf` in the `/etc/apache2/sites-available`
directory.

```bash
$ sudo vim /etc/apache2/sites-available/my-app.conf
```

Of course you can use nano as well or any editor you like.

(2) Add the apache configuration and save the file. For development purposes
something like the following should suffice.  
```apacheconfig
<VirtualHost *:80>
    ServerName my-app.vm 
    ServerAlias www.my-app.vm
   
    ServerAdmin webmaster@localhost
    DocumentRoot /path/to/your/new/projekt/app/public/
   
    <Directory /path/to/your/new/projekt/app/public/>
        Options Indexes FollowSymLinks MultiViews
        AllowOverride FileInfo
        Require all granted
    </Directory>
   
    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
```
 
(3) Enable the my-app.vm site.

```bash
$ sudo a2ensite
```
 
(4) Check if you need to edit `/etc/hosts`

```bash
$ sudo vim /etc/hosts
```

Maybe you must add something like the following.

```apacheconfig
127.0.0.2   my-app.vm   www.my-app.vm
```

(5) Reload apache

```bash
sudo service apache2 restart
```

(6) Open your browser at `http://my-app.vm`.

If all went well you can now see the somewhat spartan eArc welcome page.

### 3. Edit composer.json
 
Now it's a good time to edit the composer.json in the project base folder to
your need.

### 4. Initialise your favorite vcs

If you are using git. Go to your project base folder and type:

```bash
$ git init
```

Thumps up! You're ready to code...

If you are new to the eArc framework please read the next section! 

## Usage

### Launching the application

### Using the controller

## Advanced Usage

### The application lifecycle

The dispatching process has 5 phases:
1. Execution of the middleware registered to dispatch start.
2. Execution of the access controllers 
3. Execution of the middleware registered to dispatch between.
4. Execution of the main controller
5. Execution of the middleware registered to dispatch end.

If one of the controllers returns a router object the dispatching process
starts all over again injecting the new router object. 

#### The access controllers

#### The main controller

#### Middleware

##### Example

## Releases

### release v0.1

the first official release

