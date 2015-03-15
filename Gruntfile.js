module.exports = function(grunt) {
    require('load-grunt-tasks')(grunt);

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        phplint: {
            options: {
                swapPath: '/tmp'
            },
            application: [
                './src/**/*.php',
                './tests/**/*.php'
            ]
        },
        phpcs: {
            options: {
                bin: './vendor/bin/phpcs',
                standard: './phpcs.xml'
            },
            application: {
                dir: [
                    './src',
                    './tests'
                ]
            }
        },
        phpmd: {
            options: {
                bin: './vendor/bin/phpmd',
                rulesets: './phpmd.xml',
                reportFormat: 'text'
            },
            application: {
                dir: './src'
            }
        },
        phpcpd: {
            options: {
                bin: './vendor/bin/phpcpd',
                quiet: false,
                ignoreExitCode: true
            },
            application: {
                dir: './src'
            }
        },
        phpunit: {
            options: {
                bin: './vendor/bin/phpunit',
                coverage: true
            },
            application: {
                configuration: './phpunit.xml'
            }
        }
    });

    grunt.registerTask('default', ['phplint', 'phpcs', 'phpmd']);
    grunt.registerTask('all', ['default', 'phpcpd', 'phpunit']);
};
