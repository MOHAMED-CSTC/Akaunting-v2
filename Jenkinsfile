pipeline {
    agent any

    stages {
        stage('SCM') {
            steps {
                checkout scm
            }
        }
        stage('Build') {
            steps {
                echo 'Building...'
            }
        }
        stage('Test') {
            steps {
                echo 'Testing...'
                snykSecurity(
                    snykInstallation: 'Snyk', // Remplacez par le nom de votre installation Snyk configurée dans Jenkins
                    snykTokenId: 'Snyk_API'  // Assurez-vous que ce credential existe
                    // Ajoutez d'autres paramètres si nécessaire
                )
            }
        }
        stage('Deploy') {
            steps {
                echo 'Deploying...'
            }
        }
    }
}
