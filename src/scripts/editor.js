/**
 * Import a file with the correct ES6 Module way:
 * https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Statements/import
 * import defaultExport from "module-name";
 *
 * Then use it like this:
 * new defaultExport();
 */

import './blocks/anchors/index.js';
import './blocks/anchors/inner.js';

/**
 * app.main
 */
const main = async (err) => {

    if (err) {
        // handle HMR errors
        console.error(err);
    }

    // application code
    app();

    /**
     * Initialize
     *
     * @see https://webpack.js.org/api/hot-module-replacement
     */
    import.meta.webpackHot?.accept(main);
};

/**
 * Add custom code inside this function
 */
const app = () => {
    // Add your imported code here, for example: new defaultExport();
}

document.addEventListener("DOMContentLoaded", function (event) {
    main();
});
