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
        stage('OWASP SCAN') {
            steps {
                // Exécute l'analyse OWASP Dependency-Check
                dependencyCheck additionalArguments: '--scan ./ --out ./dependency-check-report --format ALL', 
                                odcInstallation: 'dependency-check'

                // Publie les résultats de l'analyse sous forme de rapport XML
                dependencyCheckPublisher pattern: 'dependency-check-report/dependency-check-report.xml'
            }
        }

        stage('Build') {
            steps {
                echo 'Building...'
                // Ajoutez vos étapes de build ici
            }
        }

        stage('Test') {
            steps {
                echo 'Testing...'
                snykSecurity(
                    snykInstallation: 'Snyk', // Remplacez par le nom de votre installation Snyk dans Jenkins
                    snykTokenId: 'Snyk_API',  // Assurez-vous que ce credential existe dans Jenkins
                    monitorProjectOnBuild: true, // Optionnel : pour surveiller le projet
                    failOnIssues: true         // Optionnel : échoue si des vulnérabilités sont trouvées
                )
            }
        }

        stage('Deploy') {
            steps {
                echo 'Deploying...'
                // Ajoutez vos étapes de déploiement ici
            }
        }
    }
}
