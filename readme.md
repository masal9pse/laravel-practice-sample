homestead で構築した https://github.com/masal9pse/song-picture-text を mamp 環境に移行した

インフラ AWS(VPC,EC2,RDS,ELB) https://song-picture-mamp.work/

# 使い方

```
composer install

npm install
```

## 機能一覧

1. 曲一覧表示機能
2. ユーザー一覧表示機能(view に vue を使用)
3. 管理ユーザー認証機能(/admin でアクセスする)
4. ユーザー認証機能
5. 管理画面から曲を一覧表示
6. 管理画面から CRUD 機能実装
7. ページネーション機能
8. 検索機能
9. 画像投稿機能
10. コメント機能
11. タグ付けの CRUD 機能
12. １つの曲に対して、タグを紐づける機能（多対多）
13. いいね機能(Vue 化)

# トップページ
![スクリーンショット 2020-06-25 5 33 33](https://user-images.githubusercontent.com/51937772/85625242-187ea200-b6a6-11ea-914e-f7054c18d92c.png)

# 管理画面
![スクリーンショット 2020-06-25 5 34 52](https://user-images.githubusercontent.com/51937772/85625345-48c64080-b6a6-11ea-94d7-a8f7d3295b8b.png)

# 使用技術一覧

html/css/PHP/Laravel/MySQL/JavaScript/Vue/Git/Github/

# その他

1. github の issue,pullRequest 活用

# インフラ構成図

<img width="500" alt="https.png" src="https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/439295/e4cd5652-66b6-af9b-8a7f-21241e8e05a4.png">

# やりたいこと

1. ファットコントローラー防止
2. 意味のある単体テストを記述
3. 現在は個人開発なので mamp で十分だが、チーム開発する場合、開発環境に Docker を使用したい => macbookPro16GB 使う
4. UI/UX を整える
5. S3 に画像を保存する。
6. テストがある程度かけたら、circleCIとgithubを連携させてCIを導入する
