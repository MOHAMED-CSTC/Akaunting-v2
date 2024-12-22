pipeline {
    agent any 
    
    stages { 
        stage('SCM Checkout') {
            steps {
                git branch: 'main', url: 'https://github.com/MOHAMED-CSTC/Akaunting-v2.git'
            }
        }
        stage('Run Sonarqube') {
            environment {
                scannerHome = tool 'SonarScanner'; // Nom du scanner défini dans la configuration Jenkins
            }
            steps {
                withSonarQubeEnv('SonarScanner') { // Nom de l'installation SonarQube dans Jenkins
                    sh "${scannerHome}/bin/sonar-scanner -Dsonar.projectKey=Akaunting-v2 -Dsonar.host.url=http://localhost:9000 -Dsonar.login=your_sonar_token"
                }
            }
        }
    }
}
