**DISCONTINUED WORK**, refer to [Proper Modern Codeigniter](http://bango29.com/proper-modern-codeigniter/).

## Directory Structure

A plain CI install have the following directory structure:

```
fancy-project-name
|___ application
|___ system
|___ index.php
```

#### Why is this bad?

First of all, upgrades to CI means that we just replace the `system` directory with the new one. So why not remove it completely from the root and of course versioning.

#### The New

Here is how it looks now:

```
fancy-project-name
|___ htdocs
|___ ___ application
|___ ___ index.php
|___ system
```

With the above directory structure, I find *clarity* if nothing else.

Rearranging the `system` folder means that I need to modify `index.php` to relect the current directory structure.

```
/*
 *------------------------------------------------------
 * SYSTEM FOLDER NAME
 *------------------------------------------------------
 *
 * This variable must contain the name of your "system" folder.
 * Include the path if the folder is not in the same  directory
 * as this file.
 *
 */
        $system_path = '../system';
```

## Composer

I fell in love with Composer the moment I knew about it. It gives a sense of ease with an eye for simplicity. Any top platform **must** have a great package manager.

Now my directory structure reflects the following:

```
fancy-project-name
|___ htdocs
|___ ___ application
|___ ___ index.php
|___ system
|___ composer.json
```

Another things I must do is adding classes available through Composer to be autoloaded. So edit `index.php` and the following line to the top.

```
/*
 *------------------------------------------------------
 * COMPOSER DEPENDENCIES
 *------------------------------------------------------
 */
include_once '../vendor/autoload.php';
```

## Autoloading Core Controllers

I used to put all core controllers at `application/core/MY_Controller.php`. Not cool! There's a nice read up [here](http://philsturgeon.uk/blog/2010/02/CodeIgniter-Base-Classes-Keeping-it-DRY) to do it cleanly.

Following the blog post above, added the below lines to the end of my `application/config/config.php`.

```
/*
|-------------------------------------------------------
| Autoloading Core Controllers
|-------------------------------------------------------
|
| Autoload all core controllers from application/core cleanly.
|
*/
function __autoload($class) {
    if(strpos($class, 'CI_') !== 0) {
        @include_once(APPPATH . 'core/' . $class . EXT);
    }
}
```

## Integration Testing

A good read up from [here](http://philsturgeon.uk/blog/2012/05/composer-with-codeigniter) taught me how to enable Integration Testing in CI through the use of Composer. When building an API, I like to do integration testings to make sure that I have a safety margin when writing or modifying codes.

### Buzz

[Buzz](https://github.com/kriswallsmith/Buzz) is a lightweight HTTP client. Fits the need perfectly. My `composer.json` looks like this:

```
{
    "require": {
        "kriswallsmith/buzz": "*"
    }
}
```

Now to use Buzz, I need a base class for running my integrations tests from the command line and blocking real HTTP requests to it. I added a new core controller called `application/core/Test_Controller.php`.
