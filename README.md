# Lilliputs


## 概要
(2021/09/04〜 閉鎖中)
  
Laravel で作成した「今日のメニューが思いつかない」人のためのレシピアプリです。  
    
「メイン食材」「調理方法」の「ルーレット」がついていて、  
レシピ候補の絞り込みを「運任せ」にすることができます。  
毎日のメニュー決めをサポートしてくれるアプリを目指して作成しました。

## 工夫・苦労した点

- **インフラ構成**  
開発環境は、`docker-compose`による`Laravel` + `Nginx` + `MySQL`の構成です。  
本番環境は、開発環境のコンテナ構成を生かす形で AWSの`ECS Fargate` + `RDS`に構築しました。    
`CircleCI`のjobに`ECR`イメージと`ECS Fargate`タスクの更新ジョブを設定していて、  
GitHubのmainブランチへpushした内容がそのまま本番環境に反映されるようになっています。  
また、AWSリソースの作成に関しては、一部をのぞき基本的に`Terraform`を利用して行いました。  

- **「ルーレット」**  
「メイン食材」と「調理方法」のルーレット(スタート、ストップボタン付き)を回し、  
その結果に該当するレシピの候補群を提案する機能です。  
ルーレットの見た目とデータバインドの設定はVue.jsのコンポーネントで実装しました。  
(ルーレット実行中に切り替わる食材のアイコンは、FontAwesomeのものです。)  

- **検索機能**  
検索機能は、レシピのタイトルによる部分一致の「キーワード検索」と、  
２つのセレクトボックスの選択による「カテゴリ検索」を実装しました。  
カテゴリ検索は二種のモデル(Maingred, Method)のセレクトボックスを扱うため、    
利便性を高めるためにVue.jsのaxiosによる非同期通信が可能なものにしました。

- **DB設計**  
アプリ内でメインで扱うモデルであるレシピ(`Recipe`)に持たせるカラムは最小限にとどめ、  
材料群/調理工程群/メイン食材/メイン調理方法 に関しては、それぞれ別のモデルで管理する形で設計しました。  
「材料群」と「調理工程群」に関しては、レシピに関連づける数の可変性を持たせるために、  
`Recipe`：`Ingredient(材料)`、`Recipe`：`Process(調理工程)`をそれぞれ**１：多**で、  
一方カテゴリ的に扱う「メイン食材」と「メイン調理方法」に関しては、レコード追加実装時の柔軟性を考慮して、  
`Recipe`：`Maingred(メイン食材)`、`Recipe`：`Method(メイン調理方法)`をそれぞれ**多：１**の  
リレーションを組む形で設計しました。  
  

## 使用技術

|                    |             |
|--------------------|-------------|
| **PHP**            | 7.3.23      |
| **Laravel**        | 6.18.43     |
| **Vue**            | 2.5.17      | 
| **Nginx**          | 1.19.2      | 
| **MySQL**          | 5.7.31      | 
| **Docker**         | 19.03.8     |
| **docker-compose** | 1.25.5      |
| **Terraform**      | 0.13.4      |
| **CircleCI**       | 2.0         |
| **MacOS Catalina** | 10.15.6     |

##### 本番環境で利用したAWSの主なリソース
|                       |                    |
|-----------------------|--------------------|
| コンテナ運用            | ECS Fargate        |
| イメージ管理            | ECR                |
| データベース            | RDS (MySQL 5.7.31) |
| ロードバランサー         | ELB (ALB)          |
| ドメイン管理            | Route53            |
| SSL証明書              | ACM                |
| 画像アップロード         | S3                 |
| 仮想ネットワーク         | VPC                |


## 主な機能

- **レシピ関連の基本機能**  
一覧表示、詳細表示、新規投稿、編集、削除  
(RecipeにはIngredient/Process/Maingred/Method/Userの5モデルとリレーションを持たせています)  

- **検索関連機能**  
レシピのタイトル検索(部分一致)  
レシピのメイン材料と調理方法によるカテゴリ検索(セレクトボックス、非同期通信)  

- **「ルーレット」関連の機能**  
メイン材料と調理方法をランダムで選択するルーレット、  
ルーレットの結果を元にレシピの候補を表示する機能

- **ユーザー関連**  
新規登録、ログイン、ログアウト、  
パスワード再設定機能と再設定用のメール配信  

## サンプルユーザーの認証情報
- メールアドレス  
sample@lilliputs.com  
- パスワード  
test1234  


## 更新履歴

2020/10/19 => 作成開始  
2020/10/30 => AWS ECS Fargate にてデプロイ  
2020/11/02 => 検索機能の実装  
2020/11/04 => 「ルーレット」の実装  
2020/11/05 => レスポンシブ対応  
2020/11/18 => パスワード再設定機能の実装 
  
2021/09/04 => 一時閉鎖することにしました
