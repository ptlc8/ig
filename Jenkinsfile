pipeline {
    agent any

    parameters {
        string(name: 'PIXABAY_API_KEY', defaultValue: params.PIXABAY_API_KEY ?: null, description: 'Pixabay API key')
    }

    stages {
        stage('Build') {
            steps {
                sh 'docker compose build'
            }
        }
        stage('Deploy') {
            steps {
                sh 'docker compose down --remove-orphans'
                sh 'docker compose up -d'
            }
        }
    }
}
