pipeline {
    agent any

    environment {
        DOCKER_IMAGE = "momydiop/isi-burger:latest"
        COMPOSER = "C:\\laragon\\bin\\composer\\composer.bat"
        PHP = "C:\\laragon\\bin\\php\\php-8.3.13-nts-Win32-vs16-x64\\php.exe"
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
                bat 'C:\\laragon\\bin\\php\\php-8.3.13-nts-Win32-vs16-x64\\php.exe C:\\composer\\composer.phar install --no-dev --optimize-autoloader'
                bat 'copy .env.example .env'
                bat 'C:\\laragon\\bin\\php\\php-8.3.13-nts-Win32-vs16-x64\\php.exe artisan key:generate'
            }
        }

        stage('Build assets') {
            steps {
                bat 'npm install'
                bat 'npm run build'
            }
        }

        stage('Création image Docker') {
            steps {
                bat "docker build -t %DOCKER_IMAGE% ."
            }
        }

        stage('Push Docker Hub') {
            steps {
                withCredentials([usernamePassword(
                    credentialsId: 'docker-hub-credentials',
                    usernameVariable: 'DOCKER_USER',
                    passwordVariable: 'DOCKER_PASS'
                )]) {
                    bat 'echo %DOCKER_PASS% | docker login -u %DOCKER_USER% --password-stdin'
                    bat "docker push %DOCKER_IMAGE%"
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
