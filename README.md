# Line Countdown Sample

`index.php?d=2023/01/01` > EVER SmartLink > `offer.php` の流れのサンプルです。`offer.php`ではカウントダウンタイマーが動作します。

## 準備
`config.sample.php`をコピーして、`config.php`を設置してください。

- `$jwtSecret`はEVERの「TimeTunerトークン」から取得します。
- `$smartLinkUrl`はEVERで販売ページ用に作成したスマートリンクを設定してください。
- `$smartLinkApiUrl`は、キャンペーンURL（`https:example.ever.bz`）と、スラグ（`relative`の部分）だけを置き換えてください。

## 販売ページ設置URLの制限

販売ページを設置する際、`offer.php`（販売ページ）と、EVERキャンペーンが、同じドメインを共有している必要があることに注意してください。`offer.php`を開いたあと、EVERのAPI（`$smartLinkApiUrl`）に対して通信が行われますが、その際にEVERがThird-partyと認識された場合、多くのブラウザではRequest Cookiesが送信されず、カウントダウンタイマーを正常に動かすことができません。
