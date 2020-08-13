# このアプリケーションについて

就職活動用に、主に PHP/Laravel を使用してポートフォリオとして制作した自作 WEB アプリケーションです。
制作に至った過程として、インターン先で使われていた管理ユーザーログイン機能を取り入れようとしたこと、また音楽を聴くのが好きという２点がこのアプリケーションを作る理由になりました。
一番やりたかった要件として、一般ユーザーが曲と歌詞を閲覧できるようにすること、そしてユーザーに勝手に曲、歌詞を登録されたり編集、削除されないようその部分を管理ユーザのみができることとしました。他のタグ付け機能やコメント機能などはリレーションや外部キー制約等を理解するための勉強用の機能として実装しました。他の機能は下記に記載しています。
ただ歌詞データが少なすぎる、という致命的な弱点を抱えているので、日本語の歌詞、曲がある外部 API を探しています。

開発途中から Docker、docker-compose による環境構築を行い、保守性を高めるために CircleCI を導入することで、自動テストを走らせて安全性を図るなど、モダンな技術を意識して導入するようにしました。
本番環境は AWS EC2 にデプロイし、各種 AWS サービスの利用・CD(自動デプロイ)機能も実装し、「git push」コマンドのみでテストから自動デプロイまで行える形にしました。
GitHub の Issues,pull request 等を利活用し、擬似チーム開発を取り入れて作成しました。

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

- 歌詞投稿機能

- ユーザー認証機能

- 管理ユーザー認証機能

- DB テーブルのリレーション管理

- ページネーション機能

- 検索機能

- バリデーション機能（日本語化）

- 画像ファイルのアップロード機能

- 匿名コメント機能

- ユーザー認証コメント機能、投稿＋削除

  - 外部キー制約を設定しているのでコメント削除するとそれに紐づくリプライしたデータも削除します。

- リプライ機能

- いいね機能(Vue/Ajax)

- タグ付け機能

- phpunit で単体テスト

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
  1. Vagrant+virtialbox での Homestead で構築 =>
  2. 起動の手軽さを求めて mamp に変更 =>
  3. htdocs 以外のディレクトリでも作業したいので Mac 内に PHP と MySQL を入れて Laravel 環境構築
  4. circleCI の設定ファイルに合わせるために Docker,docker-compose で再構築

### これからの課題

- テストコードをさらに追記する。（優先順位高）
- コミットメッセージを英語で書く（すぐやる）
- DRY 原則を意識しつつリファクタリングする。(優先度高)
- terraform でインフラをコード化して、本番環境を EC2 から ECS に変更する。
- 歌詞データが全く足りないので、外部 API からテーブルにシードする
- ファットコントローラーの防止
- UI/UX を整えて勉強用のサービスから、実サービスとして運用してみる。
- 一緒に開発してくれる人がいれば、クローンしてもらって共同開発してみたい
- 現在は CircleCI だけで自動デプロイしているので、CodeDeploy も使って自動化する
- 実サービスとして運用するのは著作権的にまずそうだと今更ながら気がついたので、どこかしらでサービス自体を大きく変更する。

### 以前使用していたが、開発環境を変更したため使わなくなったリポジトリの URL

https://github.com/masal9pse/song-picture-text

# インストール方法

```
composer install

npm install

php artisan serve

npm run watch

php artisan migrate --seed
```
