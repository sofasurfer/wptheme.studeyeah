import createFontFile from './src/bud/createFontFile.mjs';
/**
 * @see {@link https://bud.js.org/guides/configure}
 * @param {import('@roots/bud').Bud} bud
 */


export default async (bud) => {
    createFontFile('./src/fonts/');

    bud
        .when(
            bud.isProduction,
            () => bud.hash().minimize(),
        )

        /**
         * Application entrypoints
         *
         * Paths are relative to your resources directory
         * meaning of the "@" symbol https://stackoverflow.com/a/42711271/7262739
         */
        .entry({
            index: ['@src/scripts/index.js', '@src/styles/main.scss'],
            editor: ['@src/scripts/editor.js', '@src/styles/editor.scss'],
        })

        /**
         * These files should be processed as part of the build
         * even if they are not explicitly imported in application assets.
         */
        .assets([
            {from: bud.path("@src/images"), to: bud.path("images/@file")},
            {from: bud.path("@src/fonts"), to: bud.path("fonts/@file")},
        ])

        /**
         * These files will trigger a full page reload
         * when modified.
         */
        .watch('@src/**/*')

        /**
         * Development URL to be used in the browser.
         */
        .serve('http://localhost:3010')

        /**
         * Target URL to be proxied by the dev server.
         *
         * This should be the URL you use to visit your local development server.
         */
        .proxy(new URL('http://localhost/nf-starter'))
};
