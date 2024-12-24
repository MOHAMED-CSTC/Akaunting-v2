pipeline {
    agent any

    stages {
        stage('SCM') {
            steps {
                checkout scm

        stage('Test') {
            steps {
                echo 'Testing...'
                withCredentials([string(credentialsId: '48182f96-b58c-40d9-830c-c7d7404136a8', variable: 'Snyk_API')]) {
                    snykSecurity(
                        snykInstallation: 'Snyk',
                        snykTokenId: Snyk_API
                    )
                 }
             }
         }
     }
   }    
 }
}
