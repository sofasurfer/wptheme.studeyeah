# Fonts

Simply drop your fonts into this folder. Fonts will then automatically be available as variables in your Sass.

Examples:

arial_black_font_bold.woff2 ➡️ ``$arial_black_font_bold_woff2``

arial_black_font_regular.woff ➡️ ``$arial_black_font_regular_woff``

---

Webpack will generate a file called ``inlineFonts.scss`` which then can be imported into your sass file
so you can use the variable.