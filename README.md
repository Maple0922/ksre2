# ksre2
くされエン部室予約アプリ

<br><br>

## コマンド

`git clone https://github.com/Maple0922/ksre2.git`
<br>
`cd ksre2`
<br>
`npm i`
<br>
`npm i -D stylelint`
<br>
`npm i -D stylelint-config-standard`
<br>
`npm i -D lint-staged husky`
<br>
`php -S localhost:8080`

http://localhost:8080

<br><br>

## phpファイル構成

### ホーム
`index.php`

### Reserve系
`list.php`:一覧
`reserve.php`:新規
`complete.php`:完了
`edit.php?id=:id`:変更(変更/削除)
`update.php`:変更完了
`delete.php`:削除完了

### News系
`news.php`:一覧
`post.php`:新規
`submit.php`:完了
`rewrite.php?id=:id`:編集(更新/削除)
`renewal.php`:更新完了
`erase.php`:削除完了

### Debug系
`table.php`:reserveのデータ一覧

<br><br>

## sqlite テーブル
<br>
- reserve
`CREATE TABLE IF NOT EXISTS "reserve" (id integer primary key autoincrement, name text, year integer, month integer, date integer, startTimeHour integer, startTimeMinute text, endTimeHour integer, endTimeMinute text);`

- news
`CREATE TABLE IF NOT EXISTS "news" (id integer primary key autoincrement, name text, year integer, month integer, date integer, title text, content text);`
