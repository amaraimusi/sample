#!/bin/sh
echo 'ソースコードを差分アップロードします。'

rsync -auvz ../a009 amaraimusi@amaraimusi.sakura.ne.jp:www/sample/js


echo "------------ 送信完了"
cmd /k