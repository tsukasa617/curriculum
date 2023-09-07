# dev-survey-management-system
内部開発： 「顧客管理システム」

### ブランチ運用
- 社内システムと同様の運用
  - [社内システム ～ ブランチ運用](https://github.com/epkotsoftware/internal-system#ブランチ運用)

### 資料・ソース解説動画
[仕様書](
https://s3.us-west-2.amazonaws.com/secure.notion-static.com/a361ce9d-8348-4030-b54b-3447f90779e9/%E9%A1%A7%E5%AE%A2%E7%AE%A1%E7%90%86%E3%82%AC%E3%82%A4%E3%83%89.pdf?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Credential=AKIAT73L2G45EIPT3X45%2F20230202%2Fus-west-2%2Fs3%2Faws4_request&X-Amz-Date=20230202T085646Z&X-Amz-Expires=86400&X-Amz-Signature=de55180e14a9fa0be2e70fb327238cecb5596adefc34280020aab4e6539d800c&X-Amz-SignedHeaders=host&response-content-disposition=filename%3D%22%25E9%25A1%25A7%25E5%25AE%25A2%25E7%25AE%25A1%25E7%2590%2586%25E3%2582%25AC%25E3%2582%25A4%25E3%2583%2589.pdf%22&x-id=GetObject)

## バージョン情報
|  ---      |  バージョン  |
|  ----     |  ----     |
|  Laravel  |  9.49.0   |
|  PHP      |  8.1.14   |
|  mysql    |  8.0.32   |
|  apache   |  2.4.54   |

## 進捗状況

完全完了

設計書　[Uploading リグラント要件定義書.pdf…]()

仕様書　[顧客管理ガイド.pdf](https://github.com/epkotsoftware/dev-survey-management-system/files/10802427/default.pdf)


## 環境構築手順
#### 1. リポジトリをクローン
```shell
$ git clone {url}
```

#### 2. リポジトリに移動
```shell
$ cd [プロジェクト名]
```

#### 3. コンテナ起動
```shell
$ docker-compose up -d
```

#### 4. webコンテナ内へアクセス
```shell
$ docker-compose exec web bash
```

#### 5. Laravelのプロジェクトフォルダへ移動
```shell
$ cd SurveyManagementSystem
```

#### 6. envファイルの作成
```shell
$ cp .env.example .env
```

#### 7. composerインストール
```shell
$ composer install
```

#### 8. アプリケーションキーを生成
```shell
$ php artisan key:generate
```

#### 9. マイグレーション実行
```shell
$ php artisan migrate
```

#### 10. シーダー実行
```shell
$ php artisan db:seed
```

#### 11. 動作確認
http://localhost:1000
ID：`00000001`
password：`//test//`

#### 12. phpmyadmin
http://localhost:1100

#### Larastanの使用
```shell
// 開発ルートディレクトリになっているかを確認
$ cd SurveyManagementSystem
$ composer lint
// コマンドの後ろに -- を付けて、server/SurveyManagementSystem/を除いたパス を入力するとそのファイルだけを対象にすることが可能
// (例：composer lint -- app/Models/Client.php)
```
#### Pintの使用
```shell
// 開発ルートディレクトリになっているかを確認
$ cd SurveyManagementSystem
$ composer fix
// コマンドの後ろに -- を付けて、server/SurveyManagementSystem/を除いたパス を入力するとそのファイルだけを対象にすることが可能
// (例：composer fix -- app/Models/Client.php)
```
