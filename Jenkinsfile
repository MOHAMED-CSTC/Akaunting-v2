pipeline {
    agent { label 'linux' }
    options {
        buildDiscarder(logRotator(numToKeepStr: '5'))
        timestamps() 
    }
    stages {
        stage('Checkout') {
            steps {
                checkout scm 
            }
        }
        stage('SonarQube Scan') {
            steps {
                withSonarQubeEnv('SonarScanner') {
                    sh './mvnw clean org.sonarsource.scanner.maven:sonar-maven-plugin:6.2.1.4610:sonar'
                }
            }
        }
    }
}
