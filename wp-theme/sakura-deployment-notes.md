# Sakura本番デプロイ作業ログ

対象サイト: `https://www.rikiya-okawa963.jp/wp/`（さくらのレンタルサーバ / 共有ホスティング）

## ゴール
Formspreeベースの旧静的サイトを、WordPress + Gravity Formsの問い合わせフォームに置き換える。
最終的にはドメインルート (`rikiya-okawa963.jp/`) を、現在 `/wp` で稼働しているWordPressビルドに切り替える（本番カットオーバー）。

## 決定事項
- **works01〜08は静的HTMLのまま維持**（Gravity Formsを含まないためPHP化は不要と判断）。
- カットオーバー前に `/wp` 側を完全に検証してから、ルートを切り替える方針（静的サイトは検証完了まで触らない）。

## 完了したステップ

1. **テーマのアップロード**
   `wp-theme/`（`front-page.php`, `page-english.php`, `header.php`, `footer.php`, `functions.php`, `style.css`, `assets/`）を
   さくらのファイルマネージャ経由で `wp-content/themes/wp-theme/` に配置し、有効化。
   - 注意点: テーマは必ず専用サブフォルダに入れる必要がある（直下に置くとWordPressに認識されない）。最初この点でミスがあり、`wp-theme` サブフォルダを作って修正した。

2. **Gravity Forms導入**
   `gravityforms_2.10.5.zip` をwp-adminからアップロード・有効化・ライセンスキー登録。
   Contact FormをForm ID 1として作成（テーマコードが `gravity_form(1, ...)` と `gform_submit_button_1` フィルタでID 1をハードコードしているため、これが最初に作られるフォームである必要があった）。

3. **パーマリンク設定**
   設定 → パーマリンク設定 → 「投稿名」を選択して保存。`/wp/english` のようなきれいなURLが有効に。

4. **英語ページの作成**
   固定ページを新規作成、スラッグを `english` に設定して公開。
   `page-english.php` はスラッグの自動マッチで適用されるため、Templateドロップダウンの手動選択は不要。
   `header.php` のナビ切り替えロジックは `is_page_template('page-english.php') || is_page('english')` で両方の適用経路に対応。

5. **フォーム送信テスト（データ保存の確認）**
   実際にテスト送信 → Gravity Forms「Entries」に記録されることを確認。ここまでは成功。

## 現在進行中の作業: メール通知が届かない問題

**症状**: フォーム送信は成功し、Entriesにはデータが保存されるが、設定した通知先メール
(`rikiyadazo89@gmail.com`) にメールが届かない。

**原因**: さくらのレンタルサーバー（共有ホスティング）ではPHPの `mail()` 関数によるメール送信が
SPF/DKIM未整備などの理由で信頼性が低く、サイレントに握りつぶされることがある。

**対応策**: `gravitysmtp_2.3.1.zip`（Gravity SMTPプラグイン）をインストールし、
認証付きSMTP経由の送信に切り替える。

### 試したこと
- **Google連携（OAuth）**: Integrations → 「＋」→ Google を選択したが、事前にGoogle Cloud Console側で
  OAuthクライアント（Client ID / Client Secret）を発行し、リダイレクトURIを登録する必要があると判明。
  設定の手間が大きいため、**この方式は保留し、Custom SMTPに切り替える方針に変更**。
- **Custom SMTP（現在進行中）**: Gmailの「アプリ パスワード」を発行するため、Googleアカウントの
  セキュリティ設定 → アプリ パスワード画面まで到達。アプリ名を入力してパスワードを生成する直前の状態。

### 次にやること
1. Googleアカウント側でアプリパスワード（16桁）を発行・コピー
2. Gravity SMTP → Integrations → Custom SMTP で以下を設定:
   - SMTP Host: `smtp.gmail.com`
   - SMTP Port: `587`
   - Encryption: `TLS`
   - SMTP Username: `rikiyadazo89@gmail.com`
   - SMTP Password: 発行したアプリパスワード
   - From Email: `rikiyadazo89@gmail.com`
3. 設定保存後、再度テスト送信 → 今度は実際にメールが届くか確認

## カットオーバー前のチェックリスト（未着手）
- [ ] SMTP経由でのメール到達確認（進行中）
- [ ] 本番切り替え前に、現行の静的サイト（`index.html`, `assets/`, `works01-08.html`）をバックアップ
- [ ] ドメインルートの切り替え方式を決定・実施
  - 推奨: WordPressの「サイトアドレス (home)」のみルートに変更し、「WordPressアドレス (siteurl)」は `/wp` のまま維持する方式（コアファイル移動やDB検索置換を避けられる、安全な方法）
  - ルート直下に `index.php` を配置し、`/wp/wp-blog-header.php` を読み込むよう編集
  - ルートの `.htaccess` にWordPressの書き換えルールを追加（既存の `/index.html` へのリダイレクトルールとの競合に要注意）
- [ ] works01〜08.html が新しいルート構成でも正しくアクセスできることを確認
- [ ] Gravity Formsの必須マーク表示が日本語「(必須)」になっている件（WPLANG=ja由来）→ 英語ページでの表示をどうするか未決定
