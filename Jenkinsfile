pipeline {
    agent any
    options {
        buildDiscarder(logRotator(numToKeepStr: '10')) // Conserve les 5 derniers builds
    }
    environment {
        DOCKERHUB_CREDENTIALS = credentials('Docker_token') // Jeton Docker Hub
    }
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
                    // Utilise SonarScanner pour analyser le code source
                    def scannerHome = tool 'SonarScanner'
                    withSonarQubeEnv('SonarQube') {
                        sh "${scannerHome}/bin/sonar-scanner"
                    }
                }
            }
        }
        stage('OWASP Dependency-Check Analysis') {
            steps {
                // Exécute OWASP Dependency-Check pour analyser les dépendances
                dependencyCheck additionalArguments: '--scan ./ --out ./dependency-check-report', 
                                odcInstallation: 'dependency-check'

                // Publie les résultats de l'analyse
                dependencyCheckPublisher pattern: 'dependency-check-report/dependency-check-report.xml'
            }
        }
        stage('Build Docker Image') {
            steps {
                // Construction de l'image Docker
                sh 'docker build -t mohamedbouchakour/akauting_cstc:latest .'
            }
        }
        stage('Scan Docker Image') {
            steps {
                // Analyse de l'image Docker pour détecter les vulnérabilités
                sh 'docker scan mohamedbouchakour/akauting_cstc:latest'
            }
        }
        stage('Publish Docker Image') {
            steps {
                withCredentials([usernamePassword(
                    credentialsId: 'Docker_token', 
                    usernameVariable: 'DOCKERHUB_USER', 
                    passwordVariable: 'DOCKERHUB_PASS'
                )]) {
                    // Publication de l'image sur Docker Hub
                    sh '''
                        docker login -u $DOCKERHUB_USER -p $DOCKERHUB_PASS
                        docker push mohamedbouchakour/akauting_cstc:latest
                        docker logout
                    '''
                }
            }
        }
    }
    post {
        always {
            echo "Nettoyage des fichiers temporaires et des images locales"
            sh '''
                docker rmi mohamedbouchakour/akauting_cstc:latest || true
                rm -rf dependency-check-report || true
            '''
        }
        success {
            echo "Pipeline exécuté avec succès."
        }
        failure {
            echo "Échec du pipeline. Veuillez vérifier les journaux pour diagnostiquer le problème."
        }
    }
}
