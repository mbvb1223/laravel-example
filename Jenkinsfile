#!/usr/bin/env groovy

pipeline {
    agent any
    stages {
        stage('Clean workspace') {
            steps {
                echo "Running ${env.BUILD_ID} on ${env.JENKINS_URL}"
                deleteDir()
                sh 'ls -lah'
            }
        }
        stage('Build') {
            steps {
                // Checkout the app at the given commit sha from the webhook
                checkout scm
            }
        }
    }
}