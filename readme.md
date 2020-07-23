# このアプリケーションについて

就職活動用に、主にPHP/Laravelを使用してポートフォリオとして制作した自作WEBアプリケーションです。
音楽を聴くのが好きなので、知りたい曲のタイトルを調べることで、その曲の歌詞をみたり、コメントやいいねを送り合ってコミニュケーションを取ることが可能です。 機能一覧については下記に記しました。
ただ歌詞データが少なすぎる、という致命的な弱点を抱えているので思考錯誤中です。
UIに関してはまだまだ改善の余地があると認識していますが、認証ユーザーが曲を勝手に投稿したり、編集できないよう管理ユーザー機能を作ったりいいね機能やコメント機能などリアルなサービスをイメージして作りました。
開発途中からからDocker、docker-composeによる環境構築を行い、 開発途中から保守性を高めるためにCircleCIを導入することで、自動テストを走らせて安全性を図るなど、モダンな技術を意識して導入するようにしました。
本番環境はAWS EC2にデプロイし、各種AWSサービスの利用・CD(自動デプロイ)機能も実装し、「git push」コマンドのみでテストから自動デプロイまで行える形にしました。
GitHubのIssues,pull request等を利活用し、擬似チーム開発を取り入れて作成しました。

### URL
https://song-picture-mamp.work/

- ユーザーログインと管理ユーザーログイン機能がありますが、すでにテストユーザーをDBに入れて入力もしてあるので、Enterを押すだけで簡単にログインできます。

# Webページサンプル

![スクリーンショット 2020-06-25 5 33 33](https://user-images.githubusercontent.com/51937772/85625242-187ea200-b6a6-11ea-914e-f7054c18d92c.png)


## 機能一覧

- 曲一覧表示機能

- 歌詞詳細機能

- 歌詞投稿機能

- ユーザー認証機能

- 管理ユーザー認証機能

- DBテーブルのリレーション管理

- ページネーション機能

- 検索機能 

- バリデーションを日本語対応

- 画像ファイルのアップロード機能

- 匿名コメント機能

- ユーザー認証コメント機能

- いいね機能(Vue/Ajax)

- タグ付け機能

- phpunit で単体テスト

- CircleCI/CD 自動ビルド・自動テスト・自動デプロイ


# 使用技術一覧

* PHP 7.2

- Laravel 5.5

- HTML(Blade)

- CSS

- Bootstrap 

- Javascript / Vue.js / Ajax

* MySQL

* Linux(各種コマンド操作)

* Nginx(Web Server)

* Git/GitHub(pull request, Issues 等による擬似チーム開発)

- Docker/docker-compose
  - 開発途中でDockerに変更したため、別のリポジトリで環境をコード化
  - https://github.com/masal9pse/song-picture-docker

* CircleCI

- prettier(インデント誤りを自動で補正) 

* AWS
  - EC2/RDS(PostgreSQL)/VPC/IAM/Route53/ELB/CloudFormation

# インフラ構成図

![infra-structure2](https://user-images.githubusercontent.com/51937772/87854452-1a5a1f00-c94d-11ea-99a8-9bf43b9f2ad8.png)

# インストール方法

```
composer install

npm install

php artisan serve

npm run watch

php artisan migrate --seed
```

# これからの課題

- テストコードをさらに追記する。（優先順位高）
- 歌詞データが全く足りないので、外部 API からテーブルにシードする
  - 課題: 日本語の曲のJsonURLがなかなか見つからないので取得しようがない。
- laravelプロジェクト内で、Dockerfile,docker-composeの２ファイルを記載しDocker化させたい(最優先)。
- ファットコントローラーの防止
- UI/UX を整えて勉強用のサービスから、実サービスとして運用してみる。
  - 広告を入れる、twitter 等で宣伝する
- 一緒に開発してくれる人がいれば、フォークしてもらって共同開発してみたい
- 現在は CircleCI だけで自動デプロイしているので、CodeDeploy も使って自動化する
- 実サービスとして運用するのは著作権的にまずそうだと今更ながら気がついたので、どこかしらでサービス自体を大きく変更する。
  - 管理画面で投稿したものをいろいろいじれるようにしているので落ち着いたらアルバイトシフト管理システムにリプレースする。

### 以前使用していたが、開発環境を変更したため使わなくなったリポジトリの URL

https://github.com/masal9pse/song-picture-text
