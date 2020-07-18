## 機能一覧
- 曲一覧表示機能

- 歌詞詳細機能

- ユーザー認証機能
 - すでに認証ユーザーを登録して入力しているので Enterを押すだけで大丈夫です
 
- 管理ユーザー認証機能
  - (/admin でアクセスする)=>わかりやすいように遷移できるボタンつけました。
  - この機能も最初から認証ユーザーを登録して入力しているので Enterを押すだけでOKです
  
- 管理画面から曲データを投稿できる

- ページネーション機能

- 検索機能

- 画像投稿機能

- 匿名コメント機能

- ユーザー認証コメント機能

- １つの曲に対して、タグを紐づける機能（多対多）

- いいね機能(Vue/Ajax)

- ページネーション機能

- 継続的インテグレーション
  - CircleCIでテストの自動化（テストコードは現在追記中）
 
- 継続的デプロイ
  - ひとまずCircleCIだけで AWSへのデプロイ作業を自動化

# トップページ
詳細ページで歌詞を閲覧できます。
![スクリーンショット 2020-06-25 5 33 33](https://user-images.githubusercontent.com/51937772/85625242-187ea200-b6a6-11ea-914e-f7054c18d92c.png)

# 管理画面
ここから歌詞データを登録する
![スクリーンショット 2020-06-25 5 34 52](https://user-images.githubusercontent.com/51937772/85625345-48c64080-b6a6-11ea-94d7-a8f7d3295b8b.png)

# 使用技術一覧

* HTML

+ CSS

- Javascript / Vue.js / Ajax

* PHP 7.2 

+ Laravel 5.5

- PostgreSQL

- Linux(各種コマンド操作)

- Nginx(Web Server)

- Git/GitHub(pull request, Issues 等による擬似チーム開発)

-  CircleCI

- AWS 
  - EC2/RDS/VPC/IAM/Route53/ELB/CloudFormation

# インフラ構成図

![infra-structure2](https://user-images.githubusercontent.com/51937772/87854452-1a5a1f00-c94d-11ea-99a8-9bf43b9f2ad8.png)


# 作った目的と意識したこと
1. Laravelの理解度を向上させる

- これを作ろうし始めた時はCRUD機能をどう実装すればいいのか分からないレベルでした。
成果物の完成度を上げていくうちに、基本的なPHP/Laravelの理解度は格段に深まったと思います。
また上記の理由よりUI部分は手間をかけず、Bootstrapを使って最低限のviewで完結させています。

2. 閲覧者、採用者の手間を減らす

- 認証機能を最低限のものでかつメアドやパスワードを初めから表示してEnterを押すだけにしたり、決済機能や外部サービス認証など確認するのが面倒な機能は避けるようにして、見る人の工数を少なくできるよう工夫しています。
インフラにAWSを使って読み込みを早くしているのもそのためです。

# インストール方法

```
composer install

npm install

php artisan serve

npm run watch

php artisan migrate --seed
```

# これからの課題
- 歌詞データが全く足りないので、外部APIからテーブルにブチ混みたい。
- ファットコントローラーの防止
- 意味のある単体テストを記述
- Docker,docker-composeでローカル開発環境を構築
  - 現在自分が使っている８GBでそれを使うとメモリ不足でまともに開発できなくなるので、16GBを使用する
- UI/UX を整える
- テストコードをさらに追記する。
- 一緒に開発してくれる人がいれば、フォークしてもらって共同開発してみたい
- 現在はCircleCIだけで自動デプロイしているので、CodeDeployも使って自動化する

### 以前使用していたが、開発環境を変更したため使わなくなったリポジトリのURL
https://github.com/masal9pse/song-picture-text
