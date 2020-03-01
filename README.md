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
`index.php`:ホーム <br>
<br>
### Reserve系
`list.php`:一覧 <br>
`reserve.php`:新規 <br>
`complete.php`:完了 <br>
`edit.php?id=:id`:変更(変更/削除) <br>
`update.php`:変更完了 <br>
`delete.php`:削除完了 <br>
<br>
### News系
`news.php`:一覧 <br>
`post.php`:新規 <br>
`submit.php`:完了 <br>
`rewrite.php?id=:id`:編集(更新/削除) <br>
`renewal.php`:更新完了 <br>
`erase.php`:削除完了 <br>
<br>
### Debug系
`table.php`:reserveのデータ一覧 <br>

<br><br>

## sqlite テーブル

### reserve
> CREATE TABLE IF NOT EXISTS "reserve" (id integer primary key autoincrement, name text, year integer, month integer, date integer, startTimeHour integer, startTimeMinute text, endTimeHour integer, endTimeMinute text);

### news
> CREATE TABLE IF NOT EXISTS "news" (id integer primary key autoincrement, name text, year integer, month integer, date integer, title text, content text);
