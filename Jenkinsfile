pipeline {
    agent any

    stages {
        stage('SCM') {
            steps {
                checkout scm
            }
        }
        
        stage('SonarQube Analysis') {
            steps {
                script {
                    def scannerHome = tool 'SonarScanner'
                    withSonarQubeEnv('SonarQube-Server') { // Remplacez avec le nom de votre serveur SonarQube configuré
                        sh "${scannerHome}/bin/sonar-scanner"
                    }
                }
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
                // Utilisation des credentials pour Snyk
                withCredentials([string(credentialsId: '94a71aa9-ce30-4852-ac20-f806b266a36e', variable: 'Snyk_API')]) {
                    snykSecurity(
                        snykInstallation: 'Snyk-Installation-Name', // Remplacez avec le nom de votre installation Snyk dans Jenkins
                        snykTokenId: env.Snyk_API
                        // Ajoutez d'autres paramètres si nécessaire
                    )
                }
            }
        }

        stage('Deploy') {
            steps {
                echo 'Deploying...'
            }
        }
    }
}
