# このアプリケーションについて

就職活動用に、主に PHP/Laravel、一部Vueを を使用して制作したモノリシックなWEB アプリケーションです。
制作に至った過程として、インターン先で使われていた管理ユーザーログイン機能を取り入れようとしたこと、また音楽を聴くのが好きという２点がこのアプリケーションを作る理由になりました。

一番やりたかった要件として、ユーザーが曲と歌詞を閲覧できるようにすること、そして一般ユーザーに勝手に曲、歌詞を新規登録されたり編集、削除されないようその部分を管理ユーザのみできるようにしたことです。

他のタグ付け機能やコメント機能、、Vue とサーバーとの通信に Ajax を用いたユーザーの CRUD 機能などはリレーションや外部キー制約、API 連携等を理解するための勉強用の機能として実装しました。他の機能は下記に記載しています。テストも自己流になっている可能性が大ですが、管理画面から歌詞を投稿するところやコメント機能の部分などを自分で考えて書いてみましたので、時間があればコードの部分もみていただければ幸いです。

このサービスの問題点としては純粋に歌詞データが少なすぎるので日本語の歌詞、曲がある外部 API を探してそれを DB に入れるという処理をやろうとしています。

また開発途中から Docker、docker-compose による環境構築を行い、保守性を高めるために CircleCI を導入することで、自動テストを走らせて安全性を図るなど、モダンな技術を意識して導入するようにしました。
本番環境は AWS EC2 にデプロイし、各種 AWS サービスの利用・CD(自動デプロイ)機能も実装し、「git push」コマンドのみでテストから自動デプロイまで行える形にしました。
GitHub の Issues,pull request 等を利活用し、擬似チーム開発を取り入れて作成しました。

UI や js(vue)部分 に関しては自分は今のところバックエンド寄りの devops エンジニアを目指しているのであまり時間をかけずに、Bootstrap と最低限の CSS を用いてささっと実装しました。

### URL

https://song-picture-mamp.work/

- ユーザーログインと管理ユーザーログイン機能がありますが、すでにテストユーザーを DB に入れて入力もしてあるので、Enter を押すだけで簡単にログインできます。
  お好きにデータを追加したり、削除してもらって構いません。

## Web ページサンプル

![wantedlyimage](https://user-images.githubusercontent.com/51937772/89991779-4acc7900-dcbf-11ea-8f55-08d89b96dc0a.png)

![スクリーンショット 2020-08-10 3 26 03](https://user-images.githubusercontent.com/51937772/89739154-3fa7fc00-dab9-11ea-8306-317996706339.png)

## 機能一覧

- 曲一覧表示機能

- 歌詞詳細機能

- 歌詞投稿機能(管理者のみ)

- 歌詞削除機能(管理者のみ)

- ユーザー認証機能

- 管理ユーザー認証機能

- DB テーブルのリレーション管理

- ページネーション機能

- 検索機能

- バリデーション機能（日本語化）

- 画像ファイルのアップロード機能

- 匿名コメント機能

- ユーザー認証コメント機能、投稿＋削除

  - 外部キー制約を設定しているのでコメント削除するとそれに紐づく返信も削除します。

- 返信機能

- いいね機能(Vue/Ajax/Laravel で API を作成)

- ユーザーの CRUD 機能(管理者のみ、API 連携)

- タグ付け機能

- phpunit で単体テスト

- Bootsrap,CSS を用いてレスポンシブ対応

- CircleCI/CD 自動ビルド・自動テスト・自動デプロイ

# 使用技術一覧

- PHP 7.2

* Laravel 5.5

* HTML(Blade)

* CSS

* Bootstrap

* Javascript / Vue.js / Ajax

* PostgreSQL

- Linux(各種コマンド操作)

- Nginx(Web Server)

* prettier(インデント誤りを自動で補正)

- Git/GitHub(pull request, Issues 等による擬似チーム開発)

* Docker/docker-compose

- CircleCI

- AWS
  - EC2/RDS(PostgreSQL)/VPC/IAM/Route53/ELB/CloudFormation(EC2 と VPC のみコード化）

## インフラ構成図

![infra-structure2](https://user-images.githubusercontent.com/51937772/87854452-1a5a1f00-c94d-11ea-99a8-9bf43b9f2ad8.png)

### 他にやったこと

- Laravel のローカル開発環境を何度も移動した経験
  1. Homestead =>
  2. mamp =>
  3. Mac 内に brew で PHP と MySQL を入れて web サーバーは php artisan serve で作成 =>
  4. Docker,docker-compose

### これから追加したいこと

- API の開発(postman でのデバックに慣れる)
- テストコードをさらに追記する
- 動画アップロード(purePHP では実装済み)
- pdf 出力機能
- DRY 原則を意識しつつリファクタリングする。
- terraform でインフラをコード化して、本番環境を EC2 から ECS に変更する。
- 歌詞データが全く足りないので、外部 API からテーブルにシードする
- ファットコントローラーの防止
- UI/UX を整えて勉強用のサービスから、実サービスとして運用してみる。
- 一緒に開発してくれる人がいれば、クローンしてもらって共同開発してみたい
- 現在は CircleCI だけで自動デプロイしているので、CodeDeploy も使って自動化する
- 実サービスとして運用するのは著作権的にまずそうだと今更ながら気がついたので、どこかしらでサービス自体を大きく変更する。

### 以前使用していたが、開発環境を変更したため使わなくなったリポジトリの URL

https://github.com/masal9pse/song-picture-text

# クローン方法

```
docker-compose up -d --build

docker-compose exec app bash

composer install

npm install

php artisan migrate --seed

php artisan serve

npm run watch
```
