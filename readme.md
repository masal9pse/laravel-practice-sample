ローカル開発環境: homestead で構築した https://github.com/masal9pse/song-picture-text を mamp 環境に移行した

本番環境 AWS(VPC,EC2,RDS,ELB,一部CloudFormationで構築) https://song-picture-mamp.work/

# 使い方

```
composer install

npm install

php artisan serve

npm run watch

php artisan migrate --seed
```

## 機能一覧
· 曲一覧表示機能

· 歌詞詳細機能

· ユーザー一覧表示機能(view に vue を使用)

· 管理ユーザー認証機能(/admin でアクセスする)=>わかりやすいように遷移できるボタンつけました。

· 管理画面から曲を投稿できる

· ユーザー認証機能

· ページネーション機能

· 検索機能

· 画像投稿機能

· 匿名コメント機能

· ユーザー認証コメント機能

· １つの曲に対して、タグを紐づける機能（多対多）

· いいね機能(Vue 化)

· ページネーション機能

# トップページ
詳細ページで歌詞を閲覧できます。
![スクリーンショット 2020-06-25 5 33 33](https://user-images.githubusercontent.com/51937772/85625242-187ea200-b6a6-11ea-914e-f7054c18d92c.png)

# 管理画面
ここから歌詞データを登録する
![スクリーンショット 2020-06-25 5 34 52](https://user-images.githubusercontent.com/51937772/85625345-48c64080-b6a6-11ea-94d7-a8f7d3295b8b.png)

# 使用技術一覧

html/css/PHP/Laravel/MySQL/JavaScript/Vue/Git/Github/

# その他

1. github の issue,pullRequest 活用

# インフラ構成図

<img width="500" alt="https.png" src="https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/439295/e4cd5652-66b6-af9b-8a7f-21241e8e05a4.png">

# 作った目的と意識したこと
1. Laravelの理解度を向上させる

· これを作ろうとした当時はCRUD機能をどう実装すればいいのか分からないレベルでした。
６割ほど完成しましたが、基本的なPHP/Laravelの理解度は格段に深まったと思います。
なので、UI部分はそこまで意識せずテンプレートを使いまわしながら少し変えています。

2. 閲覧者、採用者の手間を減らす。

· 認証機能を最低限のものでかつメアドやパスワードを初めから表示してEnterを押すだけにしたり、決済機能や外部サービス認証など確認するのが面倒な機能は避けるようにして、見る人の工数を少なくできるよう工夫しています。
インフラにAWSを使って読み込みを高速化しているのもそのためです（もちろん技術自体がWEB業界でよく使用されているからとうい理由が一番ですが）。

# やりたいこと
1. ファットコントローラー防止
2. 意味のある単体テストを記述
3. ８GBで使用するとメモリ不足で重くなったので（ https://github.com/masal9pse/docker-laravel-apache ）、16GBを買ったらローカルでDocker,docker-composeを使用する。
4. UI/UX を整える
5. S3 に画像を保存する。
6. テストがある程度かけたら、circleCIとgithubを連携させてCIを導入する
