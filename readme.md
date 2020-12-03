# インストール方法

```
$ docker -v
Docker version 19.03.13, build 4484c46d9d

$ docker-compose -v
docker-compose version 1.27.4, build 40524192

$ docker-compose up -d --build

$ docker-compose exec app bash

$ composer install

$ npm install

$ php artisan migrate --seed

$ npm run dev

$ php artisan serve
```

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

- ユーザーの CRUD 機能(管理画面からアクセス、API 連携)

- タグ付け機能

- phpunit で feature テスト

- Bootsrap,CSS を用いてレスポンシブ対応

- CircleCI 自動ビルド・自動テスト

# 使用技術一覧

- PHP 7.2

* Laravel 5.5

* HTML(Blade)

* CSS

* Bootstrap

* Javascript / Vue.js / Ajax(Axios)

* MySQL => PostgreSQL

- Linux(各種コマンド操作)

- Nginx(Web Server)

* prettier(インデント誤りを自動で補正)

- Git/GitHub(pull request, Issues 等による擬似チーム開発)

* Docker/docker-compose

- CircleCI

## インフラ構成図

![infra-structure2](https://user-images.githubusercontent.com/51937772/87854452-1a5a1f00-c94d-11ea-99a8-9bf43b9f2ad8.png)

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
