import { babel } from '@rollup/plugin-babel';
import commonjs from '@rollup/plugin-commonjs';
import { nodeResolve } from '@rollup/plugin-node-resolve';
import terser from '@rollup/plugin-terser';

const production = !process.env.ROLLUP_WATCH;

const commonPlugins = [
  nodeResolve({
    browser: true,
  }),
  commonjs(),
  babel({
    babelHelpers: 'bundled',
    exclude: 'node_modules/**',
    presets: [
      ['@babel/preset-env', {
        targets: {
          browsers: ['>0.2%', 'not dead', 'not op_mini all']
        }
      }]
    ]
  })
];

if (production) {
  commonPlugins.push(terser({
    compress: {
      drop_console: true,
    },
  }));
}

export default [
  {
    input: 'js/theme.js',
    output: {
      file: 'dist/js/theme.min.js',
      format: 'iife',
      sourcemap: !production
    },
    plugins: commonPlugins
  },
  {
    input: 'js/forum.js',
    output: {
      file: 'dist/js/forum.min.js',
      format: 'iife',
      sourcemap: !production
    },
    plugins: commonPlugins
  },
  {
    input: 'js/utils.js',
    output: {
      file: 'dist/js/utils.min.js',
      format: 'iife',
      sourcemap: !production
    },
    plugins: commonPlugins
  },
  {
    input: 'js/animations.js',
    output: {
      file: 'dist/js/animations.min.js',
      format: 'iife',
      sourcemap: !production
    },
    plugins: commonPlugins
  }
];
