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
                    withSonarQubeEnv() {
                        sh "${scannerHome}/bin/sonar-scanner"
                    }
                }
            }
        }

        stage('OWASP Dependency-Check') {
            steps {
                script {
                    // Exécute OWASP Dependency-Check en ligne de commande
                    // Vous pouvez ajuster le chemin du projet selon la structure de votre code
                    sh '''
                        dependency-check --project "Akauting_scan" --scan . --out dependency-check-report --format "HTML"
                    '''
                }
            }
        }
    }
}
