# ksre2
くされエン部室予約アプリ

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


sqlite テーブル
<br>
- reserve
`CREATE TABLE IF NOT EXISTS "reserve" (id integer primary key autoincrement, name text, year integer, month integer, date integer, startTimeHour integer, startTimeMinute text, endTimeHour integer, endTimeMinute text);`

- news
`CREATE TABLE IF NOT EXISTS "news" (id integer primary key autoincrement, name text, year integer, month integer, date integer, title text, content text);`
