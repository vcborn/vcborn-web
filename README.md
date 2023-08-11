# vcborn

<!--markdownのプレビューは、Ctrl+Shift+Vで開くことができます-->

## ファイル概要

### html

```plain
index.html - トップページ
news.html - ニュース一覧ページ
creators.html - 所属クリエイター一覧
join.html - 参加応募ページ
contact.html - お問い合わせページ
presskit.html - プレスキットページ
tos.html - 利用規約ページ
privacypolicy.html - プライバシーポリシーページ
sitepolicy.html - サイトポリシーページ
services - vclinux - index.html - VCLinuxの紹介トップページ
services - monot - index.html - Monotの紹介トップページ
template.html - head,header,footerが設定してあるページ
article - template.html - お知らせ等の記事を書く際に元になるテンプレートページ。書いた記事はこのフォルダに入れていく予定
kikagaku.html - ニュース一覧ページなどのh2部分の動く幾何学模様のデモ用ファイル。本番環境で使ってはいない
maintenance.html - メンテナンス時用のページ
templates - HTMLメールのテンプレート（client: 送信者, host: 管理者）
```

### css

```plain
scss - style.scss - すべてのページのscssが書いてあるファイル。cssをいじるときはこのファイルをいじる
css - style.css - scssのコンパイル後のファイル。このファイルが適用されている
css - responsive.css - レスポンシブ用のCSSファイル。基本全部のレスポンシブ用のが書かれている
```

### 画像系

```plain
images - サイトで使うアイコンやロゴなどが入ってる
news-img - ニュース記事で使うサムネなどの画像が入ってる
icons - クリエイター一覧ページで使用するみんなのアイコンが入る予定
```

### javascript

```plain
js - script.js - すべてのファイルに適用されているjsファイル。jsをいじるときはこのファイルを
include.js - すべてのページのhead,header,footerの共通化のためのファイル。ルート相対パス、又は絶対パスを使用
```

## 実装すること

### トップページのスライドショー作成[済]

- #hero-header に実装する
- ul と li が一応入っているが要らなければ消しても OK
- サイズは 100%/70vh にしてあるが変更しても OK
- scss の 156 行目付近に関連 css あり

### article 用のページに目次を自動作成する[済]

- article の template.html にある id="contents-table"内に作成する
- h3~h5 までの要素を取得して inndrHTML とかかな？
- scss の 584 行目付近に関連 css あり

### 参加応募、お問い合わせページ作成[js 以外完成]

- join.html に参加応募フォームを、contact.html にお問い合わせフォーム作成
- php を使用する
- scss の 625 行目付近に関連 css あり
- 応募フォームの情報の送信先は DiscordBot に送る
- お問い合わせテストというディレクトリ内に現在お問い合わせ内容のみ送信できる要になっているものがありますので参考にしてください。
- join のなかの js をちゃんと作る(エラーメッセージ等)

### 所属クリエイターページ画像等挿入[済]

- creators.html を編集
- アイコン画像は icons フォルダに入れる

### レスポンシブ[済]

- 現状存在するページに関しては100%完成です。（見落としあるかも）
- レスポンシブ用の 1 ファイルだけで 300 行超えてるのは、、、ということで style.scss をだいたい読んでセレクタがどうなってるのかメモ書いて、200 行前半くらいまで行数を減らします。
- レスポンシブへの対応は Sorakime がやっているのでなにかあれば聞いてください。たぶん毎日 Discord は読んでるから基本的にはメンションとかしなくても返信はします
- 最近できたページについては基本 wamo がやっています。

### 広告

- A8.net と GoogleAdSense を使用したいと思うので広告スペース等の実装をお願いしたいです。
- サイトの最後などにちょこっと表示などで大丈夫です(ウザがられるとよくないので)
- ここで得た収入は来年のドメイン更新代に充てられます
- ここのご不明な点があれば pnuts に質問してください

※scss の位置はコードが追加・削除されるたびに変わるので参考程度に

## css に関して

- 基本的に使うカラーは scss で変数にしてあるのでそれを使用してください
- main の横幅は基本的に 1000px で、artcle は 900px になっています
- 基本的にページごとに css が当てられています。html の main に id が設定してあります
- scss で使用されている url 等は絶対パスかルート相対パスです
- クリエイター一覧ページのリンクの前にはアイコンが入るような設定しなっています。アイコンの追加が必要な場合は scss の 527 行目付近にあります

他に不明な点があれば PocoPota に質問してください

# member.vcborn

不明点は wamo に聞いてください。  
エラーなどあれば Trello に追加しておいてもらえると助かります。

## ファイル

```plain
login
├── index.html - メインページ（ログイン時表示）
├── login.html - ログインページ
├── profile.html - プロフィールページ
├── signup.html - アカウント登録ページ
└── groupkiyaku.pdf - グループ内規約（Discord #グループ内規約案とか 参照）
```

## 使用ライブラリ

- Sweetalert2
- Firebase SDK v9
- tsParticles

## 注意点

- localhost での認証はセキュリティ向上のため無効化してあります
- scss を変更したくなかったのでインライン CSS です
- 重要なデータは Firestore に保存してあります。必要があれば vcborn の Google アカウントで Firebase コンソールを開いてください

## 管理者・開発者向け

- expiredAtは基本2週間後に設定してあります
- もし招待コードを無効にする場合は、該当のドキュメントを削除するか、```expired:true```を追加してください

# monot-main

VCLinuxに搭載するブラウザ

## ファイル

```plain
monot-main
├── src - Electron用のhtmlやcss等々
├── main.js - 基本ウィンドウ
├── package-lock.json - node.jsのパッケージ
├── package.json - node.jsのパッケージ
└── README.md - github用
```

## 概要

VCLinuxではMonotを採用することになりました。
electronなのですこしWebとは違うかもしれませんが、
