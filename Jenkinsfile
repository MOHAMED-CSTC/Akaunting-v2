pipeline {
    agent any

    stages {
        stage('SCM') {
            steps {
                echo 'Checking out code from SCM...'
                checkout scm // Vérifie et récupère le code source depuis le référentiel configuré
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
