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
                    sh "${scannerHome}/bin/sonar-scanner -Dsonar.projectKey=SonarScanner -Dsonar.host.url=http://localhost:9000 -Dsonar.login=squ_85c7fc552caddcd33b36dc220ea2e0f37199f711"
                }
            }
        }
    }
}
