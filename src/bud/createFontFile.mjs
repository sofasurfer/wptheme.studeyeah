import fs from "fs";

/**
 * Creates a SCSS file with variables including the fonts
 * @param {string} fontPath relative path to the font files
 */

export default function createFontFile (fontPath = './src/fonts/') {

    if (!fs.existsSync(fontPath)) return;

    fs.readdir(fontPath, (err, filenames) => {
        let fontArray = [];
        let cssString = '';

        filenames.forEach(filename => {

            if (filename.endsWith('.woff') || filename.endsWith('.woff2') || filename.endsWith('.ttf') || filename.endsWith('.otf') || filename.endsWith('.eot')) {
                const fontName = filename.split('.')[0]
                const fontExtension = filename.split('.')[1]
                let font = fs.readFileSync(fontPath + filename)
                font = Buffer.from(font).toString('base64')

                fontArray.push({
                    name: fontName + '_' + fontExtension,
                    data: `data:font/woff2;charset=utf-8;base64,${font}`,
                    fileExtension: filename.split('.').pop()
                })
            }

        })

        fontArray.forEach(font => {
            cssString += `
            $${font.name}: '${font.data}';
        `
        })

        fs.writeFileSync(fontPath + 'inlineFonts.scss', cssString);
    })

}
