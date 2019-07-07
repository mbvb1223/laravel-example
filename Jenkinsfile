#!/usr/bin/env groovy

node('master') {
    try {
        stage('build') {
            // Checkout the app at the given commit sha from the webhook
            checkout scm

            // Install dependencies, create a new .env file and generate a new key, just for testing
            sh "cp .env.example .env"

            def customImage = docker.build('app')
            docker.build('webserver')
            docker.build('db')

            customImage.inside {
                sh 'composer install'
                sh 'php artisan key:generate'
            }
        }

        stage('test') {
            customImage.inside {
                sh './vendor/bin/phpunit'
            }
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