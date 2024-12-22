pipeline {
    agent any 
    
    stages { 
        stage('SCM Checkout') {
            steps{
           git branch: 'main', url: 'https://github.com/MOHAMED-CSTC/Akaunting-v2.git'
            }
        }
        // run sonarqube test
        stage('Run Sonarqube') {
            environment {
                scannerHome = tool 'SonarScanner';
            }
            steps {
              withSonarQubeEnv(credentialsId: 'Jenkins_token', installationName: 'SonarScanner') {
                sh "${scannerHome}/bin/sonar-scanner"
              }
            }
        }
    }
