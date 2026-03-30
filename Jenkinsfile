pipeline {
    agent any

    environment {
        // On définit le nom de l'image
        DOCKER_IMAGE = "momydiop/isi-burger:latest"
    }

    stages {
        stage('Pull du code') {
            steps {

                git branch: 'momy_diop_burger',
                    url: 'https://github.com/MomysahidDIOP/examen_laravel_momydp_isi_burger.git'
            }
        }

        stage('Installation des dépendances Laravel') {
            steps {
                // On s'assure que composer est lancé proprement
                sh 'composer install --no-dev --optimize-autoloader'
                sh 'cp .env.example .env'
                sh 'php artisan key:generate'
            }
        }

        stage('Build assets') {
            steps {
                sh 'npm install'
                sh 'npm run build'
            }
        }

        stage('Création image Docker') {
            steps {
                // on Utilise la variable d'environnement
                sh "docker build -t ${DOCKER_IMAGE} ."
            }
        }

        stage('Push Docker Hub') {
            steps {
                // On utilise l'ID que créé dans Jenkins
                withCredentials([usernamePassword(
                    credentialsId: 'docker-hub-credentials',
                    usernameVariable: 'DOCKER_USER',
                    passwordVariable: 'DOCKER_PASS'
                )]) {
                    sh 'echo $DOCKER_PASS | docker login -u $DOCKER_USER --password-stdin'
                    sh "docker push ${DOCKER_IMAGE}"
                }
            }
        }
    }

    post {
        success {
            echo 'Pipeline ISI Burger terminé avec succès !'
        }
        failure {
            echo 'Echec du pipeline ISI Burger - Vérifiez les logs'
        }
    }
}
