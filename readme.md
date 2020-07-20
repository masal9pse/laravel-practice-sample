## 機能一覧

- 曲一覧表示機能

- 歌詞詳細機能

- 歌詞投稿機能

- ユーザー認証機能

- 管理ユーザー認証機能

- DB テーブルのリレーション管理

- ページネーション機能

- 検索機能

- 画像ファイルのアップロード機能

- 匿名コメント機能

- ユーザー認証コメント機能

- いいね機能(Vue/Ajax)

- 日本語対応

- バリデーション

- CircleCI/CD 自動ビルド・自動テスト・自動デプロイ

- phpunit で単体テスト

# トップページ

詳細ページで歌詞を閲覧できます。
![スクリーンショット 2020-06-25 5 33 33](https://user-images.githubusercontent.com/51937772/85625242-187ea200-b6a6-11ea-914e-f7054c18d92c.png)

# 管理画面

ここから歌詞データを登録する
![スクリーンショット 2020-06-25 5 34 52](https://user-images.githubusercontent.com/51937772/85625345-48c64080-b6a6-11ea-94d7-a8f7d3295b8b.png)

# 使用技術一覧

- HTML

* CSS

- Javascript / Vue.js / Ajax

* PHP 7.2

- Laravel 5.5

* MySQL

* Linux(各種コマンド操作)

* Nginx(Web Server)

* Git/GitHub(pull request, Issues 等による擬似チーム開発)

* CircleCI

* AWS
  - EC2/RDS(PostgreSQL)/VPC/IAM/Route53/ELB/CloudFormation

# インフラ構成図

![infra-structure2](https://user-images.githubusercontent.com/51937772/87854452-1a5a1f00-c94d-11ea-99a8-9bf43b9f2ad8.png)

# 作った目的と意識したこと

1. Laravel の理解度を向上させる

- これを作ろうし始めた時は CRUD 機能をどう実装すればいいのか分からないレベルでした。
  成果物の完成度を上げていくうちに、基本的な PHP/Laravel の理解度は格段に深まったと思います。
  また上記の理由より UI 部分は手間をかけず、Bootstrap を使って最低限の view で完結させています。

2. 閲覧者、採用者の手間を減らす

- 認証機能を最低限のものでかつメアドやパスワードを初めから表示して Enter を押すだけにしたり、決済機能や外部サービス認証など確認するのに手間のかかる機能は避けるようにして、閲覧者の負担をを少なくできるよう工夫しています。
  インフラに AWS を使って読み込みを早くしているのもそのためです。

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
- 歌詞データが全く足りないので、外部 API からテーブルにブチ混みたい。
- ファットコントローラーの防止
- Docker,docker-compose でローカル開発環境を構築
- UI/UX を整えて勉強用のサービスから、実サービスとして運用してみる。
  - 広告を入れる、twitter 等で宣伝する
- 一緒に開発してくれる人がいれば、フォークしてもらって共同開発してみたい
- 現在は CircleCI だけで自動デプロイしているので、CodeDeploy も使って自動化する
- 実サービスとして運用するのは著作権に引っかかりそうなので、どこかしらでサービス自体を大きく変更する。
  - 管理画面で投稿したものをいろいろいじれるようにしているのでニュースサイトや、ブログが理想的

### 以前使用していたが、開発環境を変更したため使わなくなったリポジトリの URL

https://github.com/masal9pse/song-picture-text
