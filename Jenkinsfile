#!/usr/bin/env groovy

node('master') {
    try {
        stage('Build') {
            // Checkout the app at the given commit sha from the webhook
            checkout scm

            def customImage = docker.build('app')

            // Install dependencies, create a new .env file and generate a new key, just for testing
            sh "cp .env.example .env"


            docker.build('webserver')
            docker.build('db')

            customImage.inside {
                sh 'composer install'
                sh 'php artisan key:generate'
            }
        }

        stage('Test') {
            def customImage = docker.build('app')

            customImage.inside {
                sh 'php ./vendor/bin/phpunit'
            }
        }

        stage('Deploy') {
            // If we had ansible installed on the server, setup to run an ansible playbook
            // sh "ansible-playbook -i ./ansible/hosts ./ansible/deploy.yml"
            sh "echo 'WE ARE DEPLOYING.......'"
        }

        stage('Clean Work Space') {
            cleanWs()
            sh 'pwd'
            sh 'ls'
        }
    } catch(error) {
        throw error
    } finally {
        // Any cleanup operations needed, whether we hit an error or not
    }
}