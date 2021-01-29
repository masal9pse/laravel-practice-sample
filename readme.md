# インストール方法

```
$ git clone "this repo"

$ docker -v
Docker version 19.03.13, build 4484c46d9d

$ docker-compose -v
docker-compose version 1.27.4, build 40524192

$ docker-compose up -d --build

$ docker-compose exec app bash

$ copy env.example .env
// databaseをdocker-composeで作成したテーブルと合わせることを推奨します

$ composer install

$ php artisan key generate

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

- 検索機能 => タイトルと歌詞と詳細ページに書かれているコメントで検索できます。

- バリデーション機能（日本語化）

- 画像ファイルのアップロード機能

- 匿名コメント機能

- ユーザー認証コメント機能、投稿＋削除

  - 外部キー制約を設定しているのでコメント削除するとそれに紐づく返信も削除します。

- 返信機能

- いいね機能(Vue/Ajax/Laravel で API を作成)

- ユーザーの CRUD 機能(laravel/vue/ajax 管理画面からアクセス、API 連携)

- 削除機能を非同期で実装(jquery/Ajax を使用)

- タグ付け機能(ここの投稿の部分だけがっつり SQL 書いています。)

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

### これから追加したいこと

- jquery と Ajax で API をやりとりして非同期処理を実装する

### 以前使用していたが、開発環境を変更したため使わなくなったリポジトリの URL

https://github.com/masal9pse/song-picture-text
