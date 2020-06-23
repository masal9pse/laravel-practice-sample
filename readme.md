homesteadで構築した https://github.com/masal9pse/song-picture-text をmamp環境に移行した


インフラ AWS(VPC,EC2,RDS,ELB)  https://song-picture-mamp.work/


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

# その他
1. github の issue,pullRequest 活用

# インフラ構成図

<img width="500" alt="https.png" src="https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/439295/e4cd5652-66b6-af9b-8a7f-21241e8e05a4.png">

# やりたいこと
1. ファットコントローラー防止
2. 意味のある単体テストを記述
3. 現在は個人開発なのでmampで十分だが、チーム開発する場合、開発環境にDockerを使用したい => macbookPro16GB使う  
4. 独自ドメインを取って、route53で紐付けした後、SSL通信する。
5. UI/UXを整える
