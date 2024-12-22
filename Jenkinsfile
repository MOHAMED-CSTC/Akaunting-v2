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
                    sh "${scannerHome}/bin/sonar-scanner -Dsonar.projectKey=Akaunting_scan -Dsonar.host.url=http://http://172.24.131.219:9000 -Dsonar.login=squ_681f506b7ae339e3decc7bedafd9ce152dc901f2"
                }
            }
        }
    }
}
