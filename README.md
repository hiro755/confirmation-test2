# laravel-docker-template

環境構築
Dockerビルド
1.cd coachtech/laravel
2.git clone git@github.com:Estra-Coachtech/laravel-docker-template.git
3.DockerDesktopアプリを立ち上げる
docker-compose up -d --build

Laravel環境構築
1.docker-compose exec php bash
2.composer install
3.「.env.example」ファイルを 「.env」ファイルに命名を変更。または、.envファイルを作成します
4.env以下の環境変数を追加
　DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass

5.アプリケーションキーの作成
　php artisan key:generate
 
6.マイグレーションの実行
　php artisan migrate

 7.シーディングの実行
  php artisan db:seed

  利用技術（実行環境）
  ・ＰＨＰ8.3.0
  ・ララベル8.83.27
  ・MySQL8.0.26

ER図
<img width="1920" height="1080" alt="スクリーンショット 2025-08-23 125804" src="https://github.com/user-attachments/assets/e1a87e9d-4120-4881-8d44-bfc4755b22cb" />

URL
・開発環境：http://localhost/products
・phpMyAdmin:：http://localhost:8080/
