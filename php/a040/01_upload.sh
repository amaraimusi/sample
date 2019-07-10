#!/bin/sh
echo 'ソースコードを差分アップロードします。'

rsync -auvz ../a040 amaraimusi@amaraimusi.sakura.ne.jp:www/sample/php


echo "------------ 送信完了"
cmd /k