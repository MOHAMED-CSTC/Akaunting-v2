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
     
        failure {
            echo "Échec du pipeline. Veuillez vérifier les journaux pour diagnostiquer le problème."
        }
    }
}
