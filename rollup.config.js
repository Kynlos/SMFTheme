import babel from '@rollup/plugin-babel';
import resolve from '@rollup/plugin-node-resolve';
import commonjs from '@rollup/plugin-commonjs';
import { terser } from 'rollup-plugin-terser';

const production = !process.env.ROLLUP_WATCH;

export default [
    {
        input: 'js/theme.js',
        output: {
            file: 'dist/js/theme.min.js',
            format: 'iife',
            sourcemap: !production
        },
        plugins: [
            resolve(),
            commonjs(),
            babel({
                babelHelpers: 'bundled',
                exclude: 'node_modules/**'
            }),
            production && terser()
        ]
    },
    {
        input: 'js/forum.js',
        output: {
            file: 'dist/js/forum.min.js',
            format: 'iife',
            sourcemap: !production
        },
        plugins: [
            resolve(),
            commonjs(),
            babel({
                babelHelpers: 'bundled',
                exclude: 'node_modules/**'
            }),
            production && terser()
        ]
    },
    {
        input: 'js/animations.js',
        output: {
            file: 'dist/js/animations.min.js',
            format: 'iife',
            sourcemap: !production
        },
        plugins: [
            resolve(),
            commonjs(),
            babel({
                babelHelpers: 'bundled',
                exclude: 'node_modules/**'
            }),
            production && terser()
        ]
    },
    {
        input: 'js/utils.js',
        output: {
            file: 'dist/js/utils.min.js',
            format: 'iife',
            sourcemap: !production
        },
        plugins: [
            resolve(),
            commonjs(),
            babel({
                babelHelpers: 'bundled',
                exclude: 'node_modules/**'
            }),
            production && terser()
        ]
    }
];
