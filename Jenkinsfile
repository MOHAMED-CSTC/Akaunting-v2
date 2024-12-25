pipeline {
    agent any

    stages {
        stage('SCM') {
            steps {
                // Récupérer le code source depuis le dépôt SCM
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
        stage('OWASP Dependency-Check Analysis') {
            steps {
                // Exécute l'analyse OWASP Dependency-Check
                dependencyCheck additionalArguments: '--scan ./ --out ./dependency-check-report', odcInstallation: 'dependency-check'

                // Publie les résultats de l'analyse sous forme de rapport XML
                dependencyCheckPublisher pattern: 'dependency-check-report/dependency-check-report.xml'
            }
        }
        stage('Build Docker Image') {
            steps {
                script {
                    echo 'Building Docker image...'
                    // Construire l'image Docker
                    sh 'docker build -t my-image:latest .'
                }
            }
        }
        stage('Push Docker Image') {
            steps {
                script {
                    echo 'Pushing Docker image...'
                    // Pousser l'image vers le registre Docker (assurez-vous d'être connecté)
                    sh 'docker push my-image:latest'
                }
            }
        }
    }

    post {
        always {
            echo 'Pipeline completed'
        }
    }
}
