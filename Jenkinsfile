pipeline {
    agent any
    stages {
        stage('Snyk Test') {
            steps {
                withCredentials([string(credentialsId: '48182f96-b58c-40d9-830c-c7d7404136a8', variable: 'SNYK_API')]) {
                    snykSecurity(
                        snykInstallation: 'Snyk',
                        snykTokenId: SNYK_API
                    )
                }
            }
        }
    }
}
