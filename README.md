# Wordpress Theme: Starter 📖

This is a starter theme for Wordpress utilizing a modern build process with webpack 5.

💡 there are two webpack instances. The one in the root (with budJS) is for developers. While the one in ``./src/templates/`` 
is meant for HTML/CSS template designers. There is no need for developers to touch it, unless you want to view the
 design. If so, follow the steps for designers.

These technologies are used:

- [Wordpress](https://wordpress.org/)
- [Webpack](https://webpack.js.org/)
- [bud.js](https://bud.js.org/) for the compilation process
- [sass/scss](https://sass-lang.com/)
- [Javascript ES6](https://javascript.info/)
- [yarn](https://yarnpkg.com/) or [npm](https://www.npmjs.com/)
- [node (v18)](https://nodejs.org/)
- [github workflows](https://docs.github.com/en/actions/using-workflows)

# A quick word about bud.js 💮

bud.js is a javascript build framework with add-on support for Babel, React, PostCSS, Sass, Typescript, esbuild, ESLint, Prettier, and more.
In this project we use it to handle the entire build process.

The config file is located at `bud.config.mjs`. It contains Javascript, so we can do any processing with nodeJS to pass arguments. Or edit the config file to change the build process.

#### What the heck is ```.mjs```? It's the extension for "Javascript Modules" --> https://docs.fileformat.com/web/mjs/

Place further extensions for bud in ``./src/bud/``. ``./src/bud/createFontFile.mjs`` is an extension that writes all the font files into a scss file.

# Installation ⛺

[OPTIONAL] First of all, get yourself [nvm](https://github.com/nvm-sh/nvm) to switch node versions on the fly.

If you want to switch to a different node version, you can do it with the following command:

```bash
nvm use <version>
```

The minimal version of node needed is visible in ``package.json`` at ``"engines": {...}``. Most likely it is going to be v18.4.0

---

1️⃣ Install the dependencies with the following command:

| yarn             | npm             |
|------------------|-----------------|
| ``yarn install`` | ``npm install`` |

2️⃣ Run the development server:

| yarn         | npm             |
|--------------|-----------------|
| ``yarn dev`` | ``npm run dev`` |

This will start watching the files and recompile them when they change. Everything is injected via the main javascript file with browserSync.

3️⃣ Build for production:

| yarn           | npm               |
|----------------|-------------------|
| ``yarn build`` | ``npm run build`` |

🤬 Stuck on install?
```
[5/5] Building fresh packages...
[1/2] ⠁ @roots/bud
[-/2] ⠁ waiting...
```
| yarn           | npm               |
|----------------|-------------------|
| ``yarn clean`` | ``npm run clean`` |

## Common issues 💩

1) Having an error locally or in Github actions / workflows (Something like ``ENOENT`` for example)?
Try removing the ``yarn.lock`` file and ``node_modules`` folder. Start the installation process again.

---

# BrowserSync with static HTML & CSS - for Designers 🎨

Go to your folder ``./src/templates/`` and open it.

---

🟠 Select the Node version needed (default v18.4.0) with ``Node Version Manager``

| nvm                   | example            |
|-----------------------|--------------------|
| ``nvm use <version>`` | ``nvm use 18.4.0`` |

tip: you can use ``nvm use 18``, and it will use the most recent version of it.

🟡 Install the dependencies with the following command:

| yarn             | npm             |
|------------------|-----------------|
| ``yarn install`` | ``npm install`` |

🟢 Run browserSync:

| yarn         | npm             |
|--------------|-----------------|
| ``yarn dev`` | ``npm run dev`` |


✨ BrowserSync is running on port 8080 now. It should automatically open the URL ``http://localhost:8080``.
Your browser should now reload on changes made in HTML, CSS or Javascript.

---

🔵 OPTIONAL: build the files. (this has no influence on the commit)

| yarn           | npm               |
|----------------|-------------------|
| ``yarn build`` | ``npm run build`` |

In general there is no need for this.

☘️ Extras:

- Filepath for images: ``../../images/<image-name>.jpg``
- Use filepath from images. Not from the dist folder. Subfolders are accepted.
- Javascript goes into ``./src/templates/index.js``

# Adding HTML files and viewing them - for Designers 🍭

This is done automatically when running or building.

Webpack will look for the files called ``index.html``, ``teaser.html``, ``about.html``, and ``contact.html`` in the HTML folder.
Accessing them is simple. Just add the filename behind your browserSync URL: ``http://localhost:8080/teaser.html``


# BrowserSync with Wordpress - for Devs 👾

Go to your running website. For example:

``http://localhost/your_project/``

Start the development server (2️⃣).
Then add the port specified in the ``bud.config.mjs`` file (default **``:3010``** or ``:3000``) to your path:

````http://localhost:3010/your_project/````

Your browser should now reload on changes made in CSS or Javascript.


# Hot reloading in Wordpress 🔥

Start the development server (2️⃣), then add the port to your URL and enjoy the magic.

---

# Javascript 💻

This projects requires you to use ES6 conventions. Like the extensions ``.mjs`` (module javascript) and ``.cjs`` (common javascript _for compatibility_).
``require()`` will not work. However you will have to use [ES6 imports](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Statements/import):

```js
import defaultExport from "module-name";
// or
import { export1 } from "module-name";
```

# Fonts in sass 🖤

Add your font files to the ``./src/fonts/`` folder. The files will be compiled into the dynamic ``./src/fonts/inlineFonts.scss`` file.
If you import that file into SCSS the fonts will be available in your CSS as variables.

``./src/fonts/webfont_open_sans.woff`` will be available in SCSS as ``$webfont_open_sans_woff``.
 
⚠️The fonts are only recompiled on initial run of ``dev`` or ``build``, and are not watched.

# Inlining Assets 🥽
Since bud 6.6.6
```CSS
.example {
    background: url(@src/test.svg?inline)
}
```

# Images/Icons 🖼

Images and icons are copied into the ``./dist/`` folder and can be referenced in HTML and SASS.


| Plain HTML                                 | SASS / SCSS                       |
|--------------------------------------------|-----------------------------------|
| ``src="../../dist/logo-lanz-stripes.svg"`` | ``url(../../images/sprite.svg)``  |

⚠️Note that in plain HTML you reference the built files in the ``./dist/`` folder, however in SASS/SCSS you reference the files in the ``./src/images/`` folder (uncompiled).

# Loading Assets in PHP / Wordpress 🐘

It is as simple as getting the correct path to the file you need. Don't forget to run or build your project,
so the assets are available. Still confused? Check the ``./dist/manifest.json`` file, which contains all the paths to the files.

```php
apply_filters( 'get_file_from_dist', 'images/ico/example.png' );
```


# Github Workflows 🚀

Workflows are located in the ``.github/workflows/`` folder.

# For Developers 🎮

Functions, Classes and Methods are to be documented. Use this convention:
[PHP Docstrings](http://phpdocu.sourceforge.net/howto.php)

You should use the same convention for Javascript.

```php
/**
* The short description
*
* As many lines of extendend description as you want {@link element} links to an element
* {@link http://www.example.com Example hyperlink inline link} links to a website
* Below this goes the tags to further describe element you are documenting
*
* @param  	type	$varname	description
* @return 	type	description
* @access 	public or private
* @author 	author name 
* @copyright	name date
* @version	version
* @see		name of another element that can be documented, produces a link to it in the documentation
* @link		a url
* @since  	a version or a date
* @deprecated	description
* @deprec	alias for deprecated
* @magic	phpdoc.de compatibility
* @todo		phpdoc.de compatibility
* @exception	Javadoc-compatible, use as needed
* @throws  	Javadoc-compatible, use as needed
* @var		type	a data type for a class variable
* @package	package name
* @subpackage	sub package name, groupings inside of a project
*/
```

Example:
```php
/**
* return the day of the week
*
* @param string $month 3-letter Month abbreviation
* @param integer $day day of the month
* @param integer $year year
* @return integer 0 = Sunday, value returned is from 0 (Sunday) to 6 (Saturday)
*/
function day_week($month, $day, $year)
{
...
}
```

# Wordpress Navigation Classes 🧭
| Class Name                    | Description                                   |
|-------------------------------|-----------------------------------------------|
| `current-menu-item`           | Added when the menu-item is the current one   |
| `current-menu-ancestor`       | An ancestor of the current menu-item          |
| `current-menu-parent`         | The parent of the current menu-item           |
| `current-menu-item-has-children` | A menu-item with children                  |

Note: Classes like "current_menu_page", "current_menu_post", "current_menu_event" are CPT (custom post type) specific!

# Commit Conventions 🤖
Please follow this conventions when commiting to this project. https://gist.github.com/qoomon/5dfcdf8eec66a051ecd85625518cfd13

Schema: `<type>(<optional scope>): <subject>`

Example: `feat(shopping cart): add the amazing button`

# Deployment

To deploy the main branch to the LIVE server, you can make a pull request to the deoloyment branch:
```
git checkout deployment
git merge main
git push
```

This will automatically release the main branch to the LIVE server.

## Setup deployment

Create a new branch deployment

```
git checkout -b deployment
```

Add the public key (1PW "GIT Deployment Public Key") to the cyon admin
<img width="1142" alt="cyon_access" src="https://github.com/user-attachments/assets/b05f98fc-1924-4d63-b429-0d3e62be92f4">

Change the GIT Server Variables according to your project:
<img width="1174" alt="server_variables" src="https://github.com/user-attachments/assets/09f2f23f-6674-478d-8bdf-41b8b2761b53">

The full deployment script can be changed here:
/.github/workflows/deployment.yml

