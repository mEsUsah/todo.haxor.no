pipeline {
    agent any

    stages {
        stage('Setup') {
            steps {
                git branch: 'prod', url: 'https://github.com/mEsUsah/todo.haxor.no.git'
                
                // Install PHP dependencies
                sh '/usr/bin/php8.2 /usr/bin/composer install'
                
                // Create .env file
                sh 'cp .env.ci .env'
                
                // Generate app key
                sh "/usr/bin/php8.2 artisan key:generate"
                sh "/usr/bin/php8.2 artisan migrate"
            }
        }
        stage('Test PHP') {
            steps {
                sh "/usr/bin/php8.2 vendor/bin/phpunit --configuration phpunit_ci.xml --log-junit report/junit.xml"
                junit 'report/*.xml'
            }
        }
        stage('Deploy') {
            steps {
                sh "curl -X POST -g https://forge.laravel.com/servers/780266/sites/2431618/deploy/http?token=Yv6Mcic5aLyLpHqofqLZO4QsVk43V75F5fNRp6jI"
            }
        }
    }
}
