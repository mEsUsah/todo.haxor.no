pipeline {
    agent any

    stages {
        stage('Setup') {
            steps {
                git branch: 'master', url: 'https://github.com/mEsUsah/todo.haxor.no.git'
                
                // Install PHP dependencies
                sh '/usr/bin/php8.2 /usr/bin/composer install'
                
                // Create .env file
                sh 'cp .env.example .env'
                
                // Replace default values in .env file
                sh "sed -i 's/DB_HOST=db/DB_HOST=localhost/' .env"
                sh "sed -i 's/DB_DATABASE=db/DB_DATABASE=todohaxor/' .env"
                sh "sed -i 's/DB_USERNAME=db/DB_USERNAME=todohaxor/' .env"
                sh "sed -i 's/DB_PASSWORD=db/DB_PASSWORD=todohaxor/' .env"
                
                // Run migrations and generate app key
                sh "/usr/bin/php8.2 artisan migrate:fresh"
                sh "/usr/bin/php8.2 artisan key:generate"
            }
        }
        stage('Test PHP') {
            steps {
                sh "/usr/bin/php8.2 artisan test --log-junit report/junit.xml"
                junit 'report/*.xml'
            }
        }
    }
}
