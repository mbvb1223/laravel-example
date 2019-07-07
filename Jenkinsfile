#!/usr/bin/env groovy

node('master') {
    try {
        stage('Prepare') {
            steps {
                sh 'composer install'
                sh 'rm -rf build/api'
                sh 'rm -rf build/coverage'
                sh 'rm -rf build/logs'
                sh 'rm -rf build/pdepend'
                sh 'rm -rf build/phpdox'
                sh 'mkdir build/api'
                sh 'mkdir build/coverage'
                sh 'mkdir build/logs'
                sh 'mkdir build/pdepend'
                sh 'mkdir build/phpdox'
            }
        }
        stage('build') {
            // Checkout the app at the given commit sha from the webhook
            checkout scm

            // Install dependencies, create a new .env file and generate a new key, just for testing
            sh "cp .env.example .env"
            docker.build('app')

            sh "php artisan key:generate"

            // Run any static asset building, if needed
            // sh "npm install && gulp --production"
        }

        stage('test') {
            // Run any testing suites
            sh " php artisan migrate:refresh --seed"
            sh "./vendor/bin/phpunit"
        }

        stage('deploy') {
            // If we had ansible installed on the server, setup to run an ansible playbook
            // sh "ansible-playbook -i ./ansible/hosts ./ansible/deploy.yml"
            sh "echo 'WE ARE DEPLOYING.......'"
        }
    } catch(error) {
        throw error
    } finally {
        // Any cleanup operations needed, whether we hit an error or not
    }

}