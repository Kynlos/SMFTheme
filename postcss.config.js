import postcssImport from 'postcss-import';
import postcssNested from 'postcss-nested';
import autoprefixer from 'autoprefixer';
import cssnano from 'cssnano';

export default {
    plugins: [
        postcssImport,
        postcssNested,
        autoprefixer,
        process.env.NODE_ENV === 'production' && cssnano({
            preset: ['default', {
                discardComments: {
                    removeAll: true,
                },
                normalizeWhitespace: false,
            }]
        })
    ].filter(Boolean)
};
