#!/usr/bin/env groovy

pipeline {
    agent any
    stages {
        stage('Build') {
            steps {
                checkout scm
                sh "cp .env.example .env"
                def customImage = docker.build('app')
                docker.build('webserver')
                docker.build('db')
                customImage.inside {
                    sh 'composer install'
                    sh 'php artisan key:generate'
                }
            }
        }
        stage('Test') {
            steps {
                def customImage = docker.build('app')
                customImage.inside {
                    sh 'php ./vendor/bin/phpunit'
                }
            }
        }

        stage('Deploy') {
            // If we had ansible installed on the server, setup to run an ansible playbook
            // sh "ansible-playbook -i ./ansible/hosts ./ansible/deploy.yml"
            sh "echo 'WE ARE DEPLOYING.......'"
        }
    }
}
