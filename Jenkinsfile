#!/usr/bin/env groovy

node('master') {
    try {
        agent { dockerfile true }
        stage('Checkout source code') {
            // Checkout the app at the given commit sha from the webhook
            checkout scm
        }

        stage('Build') {
            // Install dependencies, create a new .env file and generate a new key, just for testing
            sh "cp .env.example .env"
        }

        stage('Test') {
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
        cleanWs cleanWhenFailure: true
    }
}