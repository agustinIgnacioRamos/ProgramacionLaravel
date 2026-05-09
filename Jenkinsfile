pipeline {
    agent any

    triggers {
        githubPush()
    }

    options {
        timestamps()
        disableConcurrentBuilds()
    }

    environment {
        DEPLOY_ENV_DIR = '/opt/apps/programacion-laravel'
        APP_URL = 'http://138.36.236.251'
    }

    stages {
        stage('Prepare environment') {
            steps {
                sh '''
                    set -eu

                    mkdir -p "$DEPLOY_ENV_DIR"

                    if [ ! -f "$DEPLOY_ENV_DIR/.env" ]; then
                        cp .env.example "$DEPLOY_ENV_DIR/.env"

                        sed -i "s|^APP_NAME=.*|APP_NAME=ProgramacionLaravel|" "$DEPLOY_ENV_DIR/.env"
                        sed -i "s|^APP_ENV=.*|APP_ENV=production|" "$DEPLOY_ENV_DIR/.env"
                        sed -i "s|^APP_DEBUG=.*|APP_DEBUG=false|" "$DEPLOY_ENV_DIR/.env"
                        sed -i "s|^APP_URL=.*|APP_URL=$APP_URL|" "$DEPLOY_ENV_DIR/.env"

                        sed -i "s|^DB_CONNECTION=.*|DB_CONNECTION=mysql|" "$DEPLOY_ENV_DIR/.env"
                        sed -i "s|^DB_HOST=.*|DB_HOST=mysql|" "$DEPLOY_ENV_DIR/.env"
                        sed -i "s|^DB_PORT=.*|DB_PORT=3306|" "$DEPLOY_ENV_DIR/.env"
                        sed -i "s|^DB_DATABASE=.*|DB_DATABASE=programacion|" "$DEPLOY_ENV_DIR/.env"
                        sed -i "s|^DB_USERNAME=.*|DB_USERNAME=programacion|" "$DEPLOY_ENV_DIR/.env"
                        sed -i "s|^DB_PASSWORD=.*|DB_PASSWORD=programacion_password|" "$DEPLOY_ENV_DIR/.env"

                        app_key="base64:$(docker run --rm php:8.5-cli php -r 'echo base64_encode(random_bytes(32));')"
                        sed -i "s|^APP_KEY=.*|APP_KEY=$app_key|" "$DEPLOY_ENV_DIR/.env"
                    fi

                    cp "$DEPLOY_ENV_DIR/.env" .env
                '''
            }
        }

        stage('Build and deploy') {
            steps {
                sh '''
                    set -eu

                    docker compose pull mysql
                    docker compose up -d --build --remove-orphans
                '''
            }
        }

        stage('Reset database') {
            steps {
                sh '''
                    set -eu

                    docker compose exec -T app php artisan migrate:fresh --seed --force
                    docker compose exec -T app php artisan optimize
                '''
            }
        }

        stage('Health check') {
            steps {
                sh '''
                    set -eu

                    for i in $(seq 1 20); do
                        if docker compose exec -T app php artisan about --only=environment >/dev/null 2>&1; then
                            exit 0
                        fi

                        sleep 3
                    done

                    docker compose logs --tail=120 app
                    exit 1
                '''
            }
        }
    }
}
