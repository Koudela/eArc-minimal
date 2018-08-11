# eArc minimal

Installation skeleton of the eArc framework. 

The eArc stands for explicit architecture. It is about the urge to make code as
easy to comprehend as possible and the strive to touch the programmers freedom
to code as little as possible. In short it is about simplicity and good
architecture.

To function right out of the box this installation comes with the 
[twig template engine](https://packagist.org/packages/twig/twig). Feel free to 
use any template engine you like.

This skeleton is configured for the use with an apache2 web server and the
installation instruction refer to it. You are free to use any web server you
want. Please note the PHP version must be 7.2 or higher.  

The eArc framework components have a more detailed documentation at their 
git page:
- [earc/core (dispatcher/app lifecycle)](https://github.com/Koudela/eArc-core)
- [earc/di (dependency container/dependency injection)](https://github.com/Koudela/eArc-di)    
- [earc/router (router)](https://github.com/Koudela/eArc-router)

## Table of Contents
 
 - [Classification](#classification)
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

## Classification

The eArc framework is the antithesis to the traditional MVC frameworks where
there is only one base directory for every file usage (e.g. controller, entity,
service, view, ...). The core idea at the beginning of eArcs creation was:
> We have this file system. It is one of the most basic concepts of all common
operating systems. Trees are very potent data structures. Why not express common
basic programming concepts and problems like ownership, access, flow, control,
domain and dependency through it? Why not boost our comprehension of the
programming code by the file system itself?

When work was in progress I realised that the web backend framework problem
domain has decomposed itself into two tree domains. Each with its own base
concepts and language.
 
1. The first tree domain is the world of the User-Interface. *Routing*,
*access*, *request flow/control* and *user interaction* is expressed through
the `/src/web-route` folder with its access and main controllers and its
views. 

2. The second tree domain is the world of the services* and the business logic.
*Domain*, *domain aggregation* and *domain interaction* is expressed in the four
top level domain base folders `/src/businessDomains`,
`/src/configurationDomains`, `/src/outputDomains` and `/src/persistenceDomains`,
the (sub-) domain structure and the specific domain interfaces. Every domain is
a small MVC world of its own (although business, configuration and persistence
domains are lacking the views and output domains are lacking the model). 

The eArc framework transforms the monolithic app approach of traditional MVCs
into some sort of microservices meets controller-template-tree architecture.

*Third party services reside in the `/vendor` folder. Only if the application is 
shielded against the third party service through an anti corruption layer or
adapter service or has a separate app specific configuration service it can be
detected through the base domains folder structure.  

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

